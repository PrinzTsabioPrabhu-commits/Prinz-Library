<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori; // Resource kategori sudah terpanggil
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * 1. Menampilkan Halaman COLLECTION
     */
    /**
     * 1. Menampilkan Halaman COLLECTION (Updated for Grouping)
     */
    public function index(Request $request)
    {
        $kategoriDipilih = $request->query('kategori');

        $bukus = Buku::query()
            ->with('kategori') // Eager load kategori supaya gak lemot (N+1 query fix)
            ->where('user_id', auth()->id())
            ->when($kategoriDipilih, function ($query, $kategori) {
                return $query->where('kategori_id', $kategori);
            })
            ->latest()
            ->get()
            ->groupBy(function ($item) {
                // Kelompokkan berdasarkan nama kategori, kalau gak ada kasih nama 'Umum'
                return $item->kategori->nama ?? 'Umum';
            });

        // Tetap ambil semua kategori untuk filter dropdown jika ada
        $semuaKategori = Kategori::all();

        return view('collection', [
            'bukus' => $bukus, // Sekarang isinya sudah terkelompok
            'kategoris' => $semuaKategori,
            'kategoriDipilih' => $kategoriDipilih,
        ]);
    }

    public function indexAdmin(Request $request)
    {
        return $this->index($request);
    }

    /**
     * 2. Menampilkan Halaman BERANDA
     */
    public function beranda()
    {
        $semuaBuku = Buku::where('user_id', auth()->id())->get();
        return view('beranda', ['bukus' => $semuaBuku]);
    }

    /**
     * 3. Menampilkan Form Tambah Buku
     */
    public function create()
    {
        // Ambil semua data dari tabel kategoris sesuai Model yang kamu kasih
        $kategori = Kategori::all();

        // Kirim datanya ke view
        return view('bukus.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:9999',
            'kategori'     => 'required',
            'image_url'    => 'nullable|url',
            'deskripsi'    => 'nullable|string',
        ]);

        Buku::create([
            'judul'        => $validated['judul'],
            'penulis'      => $validated['penulis'],
            'penerbit'     => $validated['penerbit'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'kategori_id'  => $validated['kategori'],
            'image_url'    => $validated['image_url'] ?? null,
            'deskripsi'    => $validated['deskripsi'] ?? null,
            'user_id'      => auth()->id(),
        ]);

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diarsip ke sistem!');
    }

    /**
     * 5. Menampilkan Form EDIT Buku
     */
    public function edit($id)
    {
        $buku = Buku::where('user_id', auth()->id())->findOrFail($id);
        $kategori = Kategori::all();

        return view('bukus.edit', compact('buku', 'kategori'));
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
            'kategori'     => 'required',
            'image_url'    => 'nullable|url',
            'deskripsi'    => 'nullable',
        ]);

        $buku = Buku::where('user_id', auth()->id())->findOrFail($id);

        $validated['kategori_id'] = $request->kategori;
        $buku->update($validated);

        return redirect()->route('bukus.index')->with('success', 'Metadata berhasil diperbarui!');
    }

    /**
     * 7. Menghapus Buku
     */
    public function destroy($id)
    {
        $buku = Buku::where('user_id', auth()->id())->findOrFail($id);
        $buku->delete();

        return redirect()->route('bukus.index')->with('success', 'Data telah dihapus dari database.');
    }

    /**
     * 8. Menampilkan Detail Buku
     */
    // app/Http/Controllers/BukuController.php

    // app/Http/Controllers/BukuController.php

    // app/Http/Controllers/BukuController.php

    public function show($id)
    {
        // Kita paksa Laravel ambil data kategorinya sekalian
        $buku = \App\Models\Buku::with('kategori')->findOrFail($id);

        // DEBUG: Hapus tanda komentar di bawah ini buat ngetes
        // dd($buku->kategori); 

        return view('bukus.show', compact('buku'));
    }
}
