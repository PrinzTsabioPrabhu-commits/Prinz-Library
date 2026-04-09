<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth; // Tambahkan ini biar gak error

class KategoriController extends Controller
{
    public function index()
    {
        // Optimasi Database: Ambil kategori lokal + hitung buku milik user yang login
        $kategoris = Kategori::withCount(['bukus' => function($query) {
            $query->where('user_id', Auth::id());
        }])->get();

        // Optimasi API: Cache selama 24 jam
        $apiCategories = Cache::remember('google_books_curated_v2', 86400, function () {
            $subjects = [
                'Science Fiction', 'Fantasy', 'Biography', 'History', 
                'Self-Help', 'Mystery', 'Romance', 'Business', 
                'Technology', 'Philosophy', 'Psychology', 'Art'
            ];
            
            $apiKey = config('services.google_books.key') ?? 'AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk';
            $tempApiData = [];
            $rateLimited = false;

            foreach ($subjects as $subject) {
                // Jika sudah kena rate limit, skip sisanya
                if ($rateLimited) {
                    $tempApiData[] = [
                        'name'         => $subject,
                        'google_id'    => null,
                        'totalItems'   => 0,
                        'sample_thumb' => null,
                        'description'  => 'Data sedang tidak tersedia.',
                    ];
                    continue;
                }

                try {
                    $response = Http::connectTimeout(2)->timeout(3)->get('https://www.googleapis.com/books/v1/volumes', [
                        'q'            => "subject:{$subject}",
                        'maxResults'   => 1,
                        'key'          => $apiKey,
                        'printType'    => 'books',
                        'langRestrict' => 'en',
                    ]);

                    // Deteksi rate limit
                    if ($response->status() === 429) {
                        $rateLimited = true;
                        $tempApiData[] = [
                            'name'         => $subject,
                            'google_id'    => null,
                            'totalItems'   => 0,
                            'sample_thumb' => null,
                            'description'  => 'API limit tercapai.',
                        ];
                        continue;
                    }

                    if ($response->successful() && isset($response->json()['items'][0])) {
                        $item = $response->json()['items'][0];
                        $volumeInfo = $item['volumeInfo'];
                        
                        $thumb = $volumeInfo['imageLinks']['thumbnail'] ?? null;
                        if ($thumb) {
                            $thumb = str_replace('http://', 'https://', $thumb);
                        }

                        $tempApiData[] = [
                            'name'         => $subject,
                            'google_id'    => $item['id'],
                            'totalItems'   => $response->json()['totalItems'] ?? 0,
                            'sample_thumb' => $thumb,
                            'description'  => $volumeInfo['description'] ?? 'No description available for this category.',
                        ];
                    }
                } catch (\Exception $e) {
                    $tempApiData[] = [
                        'name'         => $subject,
                        'google_id'    => null,
                        'totalItems'   => 0,
                        'sample_thumb' => null,
                        'description'  => 'Gagal memuat data.',
                    ];
                    continue; 
                }
            }
            return $tempApiData;
        });

        return view('kategoris.index', compact('kategoris', 'apiCategories'));
    }

    public function show($id)
    {
        // Ambil kategori beserta buku-buku milik user tersebut
        $kategori = Kategori::with(['bukus' => function($query) {
            $query->where('user_id', Auth::id())->latest();
        }])->findOrFail($id);

        return view('kategoris.show', compact('kategori'));
    }
}