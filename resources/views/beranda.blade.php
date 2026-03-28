@extends('app')

@section('content')
<style>
    /* 1. GLOBAL LUXURY VARS */
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.4);
        --card-bg: rgba(255, 255, 255, 0.02);
        --border-glass: rgba(255, 255, 255, 0.06);
        --smooth-ease: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* 2. ENHANCED BOOK CARDS */
    .book-card {
        background: var(--card-bg);
        backdrop-filter: blur(25px);
        border: 1px solid var(--border-glass);
        border-radius: 35px;
        padding: 24px;
        transition: all 0.8s var(--smooth-ease);
        position: relative;
    }

    .book-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--accent);
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.6), 
                    0 0 20px rgba(99, 102, 241, 0.1);
    }

    .img-container {
        aspect-ratio: 10/14.5;
        overflow: hidden;
        border-radius: 25px;
        background: #0a0a0a;
        position: relative;
        box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.8s var(--smooth-ease);
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.2s var(--smooth-ease);
    }

    .book-card:hover .img-container {
        box-shadow: 0 25px 50px rgba(99, 102, 241, 0.2);
        border-color: rgba(99, 102, 241, 0.3);
    }
    
    .book-card:hover img { 
        transform: scale(1.1) rotate(1deg); 
    }

    /* 3. STATUS & CATEGORY BADGES */
    .status-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        padding: 6px 14px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.1);
        font-weight: 900;
        font-size: 8px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: rgba(255,255,255,0.8);
        transition: all 0.4s var(--smooth-ease);
    }

    .book-card:hover .status-badge {
        background: var(--accent);
        color: white;
        border-color: transparent;
    }

    .category-chip {
        font-size: 9px;
        font-weight: 800;
        padding: 6px 12px;
        border-radius: 10px;
        background: rgba(99, 102, 241, 0.1);
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.15em;
        transition: all 0.4s var(--smooth-ease);
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .book-card:hover .category-chip {
        background: var(--accent);
        color: white;
        transform: scale(1.05);
    }

    /* 4. SEARCH STATION */
    .search-station {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 100px;
        padding: 1.2rem 2.5rem;
        transition: all 0.6s var(--smooth-ease);
    }

    .search-station:focus-within {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.3);
    }

    .outline-text {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255,255,255,0.2);
        transition: all 0.8s var(--smooth-ease);
    }
    .editorial-title:hover .outline-text {
        -webkit-text-stroke: 1px var(--accent);
        text-shadow: 0 0 30px rgba(99, 102, 241, 0.3);
    }

    .btn-premium {
        position: relative;
        overflow: hidden;
        transition: all 0.6s var(--smooth-ease);
    }
    .btn-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.4);
    }
</style>

@auth
<a href="{{ route('bukus.create') }}" class="fab-add group">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform group-hover:rotate-90 duration-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
</a>
@endauth

<div class="reveal-up">
    <header class="pt-24 pb-16">
        <div class="flex items-center gap-4 mb-8">
            <div class="h-[1px] w-12 bg-indigo-500/50"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-white/40">
                @auth Halo, {{ strtoupper(Auth::user()->name) }} // Akses Diterima @else Akses Tamu // Selamat Datang @endauth
            </span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-12">
            <h1 class="editorial-title text-6xl lg:text-9xl font-black leading-[0.8] tracking-tighter">
                KOLEKSI <br> <span class="outline-text">PRIBADI.</span>
            </h1>
            
            <div class="w-full lg:max-w-md">
                <div class="search-station flex items-center gap-4">
                    <input type="text" id="searchInput" onkeyup="filterBooks()"
                        placeholder="CARI BUKU KESUKAANMU..."
                        class="w-full bg-transparent outline-none text-[10px] font-bold tracking-[0.3em] text-white placeholder:text-white/10 uppercase">
                    <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/5 group-hover:border-indigo-500/30 transition-all">
                         <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-12">
        <div class="flex items-center justify-between mb-16 border-b border-white/5 pb-8">
            <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-white/40 italic">Rak Buku / Koleksi Tersimpan</h2>
            <div class="text-[9px] font-black text-indigo-400 bg-indigo-400/10 px-6 py-2 rounded-full border border-indigo-500/20">
                Ada {{ count($bukus) }} Buku Favoritmu
            </div>
        </div>

        <div id="bookGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-14">
            @forelse($bukus as $index => $buku)
            <div class="book-card group">
                <div class="status-badge">TERSIMPAN</div>
                <a href="{{ route('bukus.show', $buku->id) }}" class="block">
                    <div class="img-container mb-8">
                        <img src="{{ $buku->image_url ?? asset('storage/' . $buku->cover) }}" 
                             onerror="this.src='https://via.placeholder.com/600x900/0a0a0a/ffffff?text=TANPA_COVER'"
                             alt="{{ $buku->judul }}" loading="lazy">
                        
                        <div class="absolute inset-0 bg-indigo-950/40 opacity-0 group-hover:opacity-100 transition-all duration-700 backdrop-blur-[3px] flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full border border-white/30 flex items-center justify-center bg-white/10 text-white transform scale-50 group-hover:scale-100 transition-all duration-500 ease-out">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-5">
                        <div class="category-chip w-fit">
                            ✨ {{ $buku->kategori->nama_kategori ?? 'Kategori Umum' }}
                        </div>
                        <div>
                            <h3 class="text-base font-black text-white uppercase tracking-tight line-clamp-1 group-hover:text-indigo-400 transition-colors duration-500">
                                {{ $buku->judul }}
                            </h3>
                            <p class="text-[10px] font-bold text-white/20 uppercase tracking-[0.3em] mt-2 group-hover:text-white/40 transition-colors duration-500">
                                Penulis: <span class="text-white/40 group-hover:text-indigo-300">{{ $buku->penulis }}</span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-full py-32 text-center opacity-10 text-[12px] font-black tracking-[1.5em] uppercase">Belum ada buku yang disimpan</div>
            @endforelse
        </div>
    </section>

    <section class="mt-32 p-12 lg:p-24 rounded-[60px] border border-white/5 bg-gradient-to-br from-white/[0.03] to-transparent">
        <div class="flex items-center justify-between mb-20">
            <h2 class="text-[11px] font-black uppercase tracking-[1em] text-white/20">Eksplorasi Global</h2>
            <div class="h-[1px] flex-1 mx-12 bg-white/5"></div>
        </div>
        <div id="apiBooks" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12"></div>
        
        <div class="mt-24 flex justify-center">
            <button onclick="fetchTrendingBooks()" id="loadMoreBtn" 
                class="btn-premium group px-20 py-7 rounded-2xl border border-white/10 text-[10px] font-black uppercase tracking-[0.6em] transition-all bg-transparent text-white">
                <span class="relative z-10 group-hover:opacity-0 transition-all duration-300">Lihat Lebih Banyak</span>
                <div class="absolute inset-0 bg-indigo-600 translate-y-full group-hover:translate-y-0 transition-transform duration-700 var(--smooth-ease)"></div>
                <span class="text-hover absolute inset-0 z-20 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 font-black">
                    MENCARI BUKU...
                </span>
            </button>
        </div>
    </section>
</div>
<script>
    const SYSTEM_CONFIG = {
        resultsPerPage: 8,
        apiKey: "AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk",
        defaultQuery: "subject:fiction+bestseller",
        placeholder: "https://via.placeholder.com/600x900?text=COVER_NOT_FOUND"
    };

    let startIndex = 0;

    async function fetchTrendingBooks() {
        const container = document.getElementById('apiBooks');
        const loadBtn = document.getElementById('loadMoreBtn');
        if (!container || !loadBtn) return;

        loadBtn.innerHTML = '<span class="animate-pulse">MENGHUBUNGKAN...</span>';

        try {
            const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${SYSTEM_CONFIG.defaultQuery}&startIndex=${startIndex}&maxResults=${SYSTEM_CONFIG.resultsPerPage}&key=${SYSTEM_CONFIG.apiKey}`);
            const data = await response.json();

            if (data.items) {
                data.items.forEach(item => {
                    const info = item.volumeInfo;
                    const thumb = info.imageLinks ? info.imageLinks.thumbnail.replace('http:', 'https:') : SYSTEM_CONFIG.placeholder;

                    const card = document.createElement('div');
                    card.className = "book-card group";
                    card.innerHTML = `
                        <div class="status-badge !text-indigo-400">DATA DUNIA</div>
                        <div class="img-container mb-6">
                            <img src="${thumb}" alt="${info.title}" loading="lazy">
                        </div>
                        <div class="space-y-4">
                            <div class="category-chip !bg-white/5 !text-white/40 w-fit">Eksternal</div>
                            <div>
                                <h3 class="text-sm font-black text-white uppercase truncate group-hover:text-indigo-400 transition-colors">${info.title}</h3>
                                <p class="text-[9px] font-medium text-white/30 uppercase tracking-widest mt-1">Oleh ${info.authors ? info.authors[0] : 'Rahasia'}</p>
                            </div>
                        </div>
                    `;
                    container.appendChild(card);
                });
                startIndex += SYSTEM_CONFIG.resultsPerPage;
            }
        } catch (e) {
            console.error("API Error:", e);
        } finally {
            loadBtn.innerHTML = 'Lihat Lebih Banyak';
        }
    }

    function filterBooks() {
        const val = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('#bookGrid .book-card');
        cards.forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(val) ? "block" : "none";
        });
    }

    document.addEventListener('DOMContentLoaded', fetchTrendingBooks);
</script>
@endsection