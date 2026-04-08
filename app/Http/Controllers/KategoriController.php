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

            foreach ($subjects as $subject) {
                try {
                    // Pakai timeout lebih pendek biar gak nunggu kelamaan kalau internet down
                    $response = Http::timeout(5)->get('https://www.googleapis.com/books/v1/volumes', [
                        'q'            => "subject:{$subject}",
                        'maxResults'   => 1,
                        'key'          => $apiKey,
                        'printType'    => 'books', // Pastikan yang ditarik adalah buku, bukan majalah
                        'langRestrict' => 'en',
                    ]);

                    if ($response->successful() && isset($response->json()['items'][0])) {
                        $item = $response->json()['items'][0];
                        $volumeInfo = $item['volumeInfo'];
                        
                        // Fix Thumbnail ke HTTPS secara otomatis
                        $thumb = $volumeInfo['imageLinks']['thumbnail'] ?? null;
                        if ($thumb) {
                            $thumb = str_replace('http://', 'https://', $thumb);
                        }

                        $tempApiData[] = [
                            'name'         => $subject,
                            'google_id'    => $item['id'], // Simpan ID Volume asli Google
                            'totalItems'   => $response->json()['totalItems'] ?? 0,
                            'sample_thumb' => $thumb,
                            'description'  => $volumeInfo['description'] ?? 'No description available for this category.',
                        ];
                    }
                } catch (\Exception $e) {
                    // Logger bisa ditaruh di sini kalau mau trace error
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