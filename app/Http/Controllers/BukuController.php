<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    /**
     * 1. Menampilkan Halaman COLLECTION
     */
    public function index(Request $request)
    {
        $kategoriDipilih = $request->query('kategori');

        $bukus = Buku::query()
            ->with('kategori')
            ->where('user_id', Auth::id())
            ->when($kategoriDipilih, function ($query, $kategori) {
                return $query->where('kategori_id', $kategori);
            })
            ->latest()
            ->get();

        $semuaKategori = Kategori::all();

        return view('collection', [
            'bukus' => $bukus,
            'kategoris' => $semuaKategori,
            'kategoriDipilih' => $kategoriDipilih,
        ]);
    }

    // Di dalam BukuController.php
    public function indexAdmin()
    {
        $bukus = Buku::with('kategori')
            ->where('user_id', Auth::id()) // Ganti Auth::id() menjadi helper auth()
            ->get()
            ->groupBy(function ($item) {
                // Kelompokkan berdasarkan nama kategori    
                return $item->kategori->nama_kategori ?? 'Umum';
            });

        return view('collection', compact('bukus'));
    }
    /**
     * 2. Menampilkan Halaman BERANDA
     */
    public function beranda()
    {
        $semuaBuku = Buku::where('user_id', Auth::id())->get();
        return view('beranda', ['bukus' => $semuaBuku]);
    }

    /**
     * 3. Menampilkan Form Tambah Buku
     */
    public function create()
    {
        // Mengambil semua kategori yang baru saja kita seed
        $kategori = Kategori::all();

        return view('bukus.create', compact('kategori'));
    }

    /**
     * 4. Menyimpan Buku Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:9999',
            // Sesuaikan dengan nama di form & database agar tidak tertukar
            'kategori_id'  => 'required',
            'google_id'    => 'nullable|string',
            'image_url'    => 'nullable|url',
            'deskripsi'    => 'nullable|string',
            'stok'         => 'nullable|integer', // Tambahkan ini karena ada di fillable kamu
        ]);

        Buku::create([
            'judul'        => $validated['judul'],
            'penulis'      => $validated['penulis'],
            'penerbit'     => $validated['penerbit'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'kategori_id'  => $validated['kategori_id'], // Gunakan kunci yang sudah divalidasi
            'google_id'    => $validated['google_id'],
            'image_url'    => $validated['image_url'] ?? null,
            'deskripsi'    => $validated['deskripsi'] ?? null,
            'stok'         => $request->stok ?? 1, // Berikan nilai default jika stok kosong
            'user_id'      => Auth::id(),
        ]);

        return redirect()->route('bukus.index')->with('success', 'Karya baru telah tersemat di koleksimu.');
    }

    /**
     * 5. Menampilkan Form EDIT Buku
     */
   public function edit($id)
{
    // 1. Ambil data buku berdasarkan ID dan user yang login
    $buku = Buku::where('user_id', Auth::id())->findOrFail($id);

    // 2. AMBIL SEMUA KATEGORI (Ini yang bikin error kalau nggak ada)
    $kategoris = Kategori::all(); 

    // 3. Kirim SEMUA variabel ke view edit
    return view('bukus.edit', compact('buku', 'kategoris'));
}
    /**
     * 6. Mengupdate Data Buku
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'        => 'required|max:255',
            'penulis'      => 'required|max:255',
            'penerbit'     => 'required|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'kategori_id'  => 'required',
            'google_id'    => 'nullable|string',
            'image_url'    => 'nullable|url',
            'deskripsi'    => 'nullable',
        ]);

        $buku = Buku::where('user_id', Auth::id())->findOrFail($id);

        $buku->update($validated);

        return redirect()->route('bukus.index')->with('success', 'Metadata berhasil diperbarui!');
    }

    /**
     * 7. Menghapus Buku
     */
    public function destroy($id)
    {
        $buku = Buku::where('user_id', Auth::id())->findOrFail($id);
        $buku->delete();

        return redirect()->route('bukus.index')->with('success', 'Data telah dihapus dari database.');
    }

    /**
     /**
     * 8. Halaman Reader (Versi Anti-Error)
     */
    public function read($google_id)
    {
        $apiKey = "AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk";

        // 1. Ambil data detail buku dari API Google dulu
        $response = \Illuminate\Support\Facades\Http::get("https://www.googleapis.com/books/v1/volumes/{$google_id}?key={$apiKey}");

        if ($response->successful()) {
            $data = $response->json();
            $vol = $data['volumeInfo'] ?? [];

            // 2. Bungkus jadi object biar Blade bisa baca {{ $buku->judul }}
            $buku = (object) [
                'judul'     => $vol['title'] ?? 'Untitled Archive',
                'penulis'   => isset($vol['authors']) ? implode(', ', $vol['authors']) : 'Unknown Author',
                'penerbit'  => $vol['publisher'] ?? 'Global Publisher',
                'deskripsi' => isset($vol['description']) ? strip_tags($vol['description']) : 'No digital description encrypted for this unit.',
                'kategori'  => $vol['categories'][0] ?? 'General Archive'
            ];
        } else {
            // Fallback kalau API Google lagi ngambek (429/Limit)
            $buku = (object) [
                'judul' => 'Access Denied',
                'penulis' => 'System',
                'penerbit' => 'N/A',
                'deskripsi' => 'API Limit reached. Please refresh in a few minutes.',
                'kategori' => 'System'
            ];
        }

        // 3. Kirim variabel $buku dan $id ke view
        return view('reader', [
            'buku' => $buku,
            'id'   => $google_id
        ]);
    }
    /**
     * 9. Detail Buku
     */
    public function show($id)
    {
        $buku = Buku::with('kategori')->where('user_id', Auth::id())->findOrFail($id);
        return view('bukus.show', compact('buku'));
    }
}
