<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // Wajib ada untuk speed

class KategoriController extends Controller
{
    /**
     * Menampilkan halaman kategori dengan optimasi Cache & Eager Loading
     */
    public function index()
    {
        // 1. Optimasi Database: Ambil kategori lokal + hitung jumlah buku milik user
        $kategoris = Kategori::withCount(['bukus' => function($query) {
            $query->where('user_id', auth()->id());
        }])->get();

        // 2. Optimasi API: Gunakan Cache selama 24 jam (86400 detik)
        // Ini yang bikin halaman kamu nggak bakal loading lama lagi.
        $apiCategories = Cache::remember('google_books_curated', 86400, function () {
            $subjects = [
                'Science Fiction', 'Fantasy', 'Biography', 'History', 
                'Self-Help', 'Mystery', 'Romance', 'Business', 
                'Technology', 'Philosophy', 'Psychology', 'Art'
            ];
            
            $apiKey = 'AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk';
            $tempApiData = [];

            foreach ($subjects as $subject) {
                try {
                    $response = Http::timeout(3)->get('https://www.googleapis.com/books/v1/volumes', [
                        'q'            => "subject:{$subject}",
                        'maxResults'   => 1,
                        'key'          => $apiKey,
                        'langRestrict' => 'en',
                    ]);

                    $data = $response->json();

                    if ($response->successful() && !empty($data['items'])) {
                        $firstBook = $data['items'][0]['volumeInfo'];
                        $thumb     = $firstBook['imageLinks']['thumbnail'] ?? null;
                        
                        if ($thumb) {
                            $thumb = str_replace('http://', 'https://', $thumb);
                        }

                        $tempApiData[] = [
                            'name'         => $subject,
                            'totalItems'   => $data['totalItems'] ?? 0,
                            'sample_thumb' => $thumb,
                            'description'  => $firstBook['description'] ?? null,
                        ];
                    }
                } catch (\Exception $e) {
                    // Jika gagal, berikan data kosong agar tidak error di view
                    $tempApiData[] = [
                        'name'         => $subject,
                        'totalItems'   => 0,
                        'sample_thumb' => null,
                        'description'  => null,
                    ];
                }
            }
            return $tempApiData;
        });

        return view('kategoris.index', compact('kategoris', 'apiCategories'));
    }

    /**
     * Menangani fungsi "View Full Node"
     */
 public function show($id)
{
    $kategori = Kategori::with(['bukus' => function($query) {
        $query->where('user_id', auth()->id())->latest();
    }])->findOrFail($id);

    return view('kategoris.show', compact('kategori'));
}
}