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

    /* Animasi Muncul untuk API Books */
    .reveal-card {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
        transition: opacity 1s var(--smooth-ease), transform 1s var(--smooth-ease);
    }

    .reveal-card.active {
        opacity: 1;
        transform: translateY(0) scale(1);
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
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.05);
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
        padding: 6px 14px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-weight: 900;
        font-size: 8px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.4s var(--smooth-ease);
    }

    .book-card:hover .status-badge {
        background: var(--accent);
        color: white;
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
    }

    /* 4. UI COMPONENTS */
    .search-station {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 100px;
        padding: 1.2rem 2.5rem;
    }

    .outline-text {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.2);
    }

    .btn-premium {
        position: relative;
        overflow: hidden;
        transition: all 0.6s var(--smooth-ease);
    }



    /* --- UNIVERSAL INFINITY SYSTEM --- */
    .marquee-wrapper,
    .category-text-wrapper {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        width: 100%;
        /* Fade effect di pinggir */
        mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
    }

    .marquee-content,
    .category-marquee-content {
        display: inline-flex;
        /* Gunakan inline-flex agar lebar mengikuti isi */
        animation: universal-marquee linear infinite;
        will-change: transform;
    }

    /* Item teks */
    .marquee-item,
    .category-item {
        /* Berikan jarak minimal 100% dari container atau pixel yang besar */
        /* Ini memastikan teks kedua selalu mulai dari luar box */
        padding-right: 15vw;
        flex-shrink: 0;
        display: flex;
        align-items: center;
    }

    .book-card:hover .marquee-content,
    .book-card:hover .category-marquee-content {
        animation-play-state: running;
    }

    @keyframes universal-marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }

        /* Geser tepat ke awal teks kedua */
    }

    /* Dekorasi Kategori */
    .category-line {
        transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .book-card:hover .category-line {
        width: 32px;
        background-color: #6366f1;
    }


    .btn-premium {
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Efek Glow di Belakang */
    .btn-premium::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, var(--accent), transparent 70%);
        opacity: 0;
        transform: scale(0.5);
        transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: -1;
    }

    /* Hover State */
    .btn-premium:hover {
        border-color: rgba(99, 102, 241, 0.5);
        letter-spacing: 0.8em;
        /* Teks merenggang sedikit (luxury feel) */
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5),
            0 0 20px rgba(99, 102, 241, 0.2);
        transform: translateY(-5px);
    }

    .btn-premium:hover::before {
        opacity: 0.15;
        transform: scale(1.5);
    }

    /* Efek Cahaya Lewat (Shimmer) */
    .btn-premium::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.05),
                transparent);
        transition: all 0.8s;
    }

    .btn-premium:hover::after {
        left: 100%;
        transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Transisi Teks */
    #btnText {
        display: inline-block;
        transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-premium:hover #btnText {
        transform: scale(1.05);
        color: #ffffff;
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
    <header class="pt-24 pb-16 relative overflow-hidden group/header">
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-10 right-10 w-64 h-64 bg-indigo-500/10 blur-[120px] rounded-full animate-pulse"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-indigo-500/5 blur-[150px] rounded-full"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px)] bg-[size:100px_100%] opacity-20"></div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-6 mb-12 relative z-10">
            <div class="flex items-center gap-4">
                <div class="h-[1px] w-12 bg-gradient-to-r from-indigo-500/80 to-transparent"></div>
                <span class="text-[9px] font-black uppercase tracking-[0.6em] text-white/50 flex items-center gap-3">
                    @auth
                    <span class="hover:text-indigo-400 transition-colors duration-500 cursor-default">MILIK {{ strtoupper(explode(' ', Auth::user()->name)[0]) }}</span>
                    <span class="w-1 h-1 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.8)] animate-pulse"></span>
                    <span class="opacity-40">EST. 2026</span>
                    @else
                    <span>TAMU TERHORMAT</span>
                    <span class="w-1 h-1 rounded-full bg-white/20"></span>
                    <span>GALERI TERBUKA</span>
                    @endauth
                </span>
            </div>

            <div class="hidden md:flex items-center gap-8 text-[8px] font-black tracking-[0.4em] text-white/20 uppercase">
                <div class="flex flex-col items-end group/coord cursor-default">
                    <span class="group-hover/coord:text-white/60 transition-colors duration-500">INDONESIA</span>
                    <span class="font-light opacity-50">7.2504° S, 112.7688° E</span>
                </div>
                <div class="h-8 w-[1px] bg-white/5"></div>
                <div class="flex flex-col group/status cursor-default">
                    <span class="group-hover/status:text-indigo-400 transition-colors duration-500">SUASANA</span>
                    <span class="font-light opacity-50">HENING & NYAMAN</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-16 relative z-10">
            <div class="relative">
                <div class="absolute -top-6 left-2 overflow-hidden h-4">
                    <span class="block text-[8px] font-black tracking-[0.5em] text-indigo-500/60 uppercase animate-bracket-in">
                        [ MASTER ARCHIVE ]
                    </span>
                </div>

                <h1 class="editorial-title text-7xl lg:text-[10rem] font-black leading-[0.8] tracking-[ -0.05em] transition-all duration-700">
                    <span class="hover:tracking-normal transition-all duration-1000 cursor-default">KOLEKSI</span> <br>
                    <span class="outline-text hover:text-white/30 transition-all duration-700 cursor-default inline-block hover:translate-x-4">PILIHAN.</span>
                </h1>

                <div class="flex items-center gap-4 mt-6 pl-2 group/desc">
                    <div class="w-8 h-[1px] bg-indigo-500/30 group-hover/desc:w-16 transition-all duration-700"></div>
                    <p class="text-[10px] font-bold text-white/30 tracking-[0.4em] uppercase group-hover/desc:text-white/60 transition-colors duration-500">
                        Temukan ketenangan di setiap baris kalimat
                    </p>
                </div>
            </div>

            <div class="w-full lg:max-w-md group/search">
                <div class="relative">
                    <div class="absolute -top-2 -left-2 w-4 h-4 border-t border-l border-white/10 group-hover/search:border-indigo-500/50 transition-all duration-700"></div>

                    <div class="search-station relative flex items-center gap-6 p-7 border border-white/5 hover:border-indigo-500/20 transition-all duration-700 bg-white/[0.01] backdrop-blur-md rounded-xl overflow-hidden shadow-2xl shadow-black/50">

                        <div class="relative w-6 h-6 flex items-center justify-center">
                            <span class="absolute inset-0 bg-indigo-500/20 rounded-full blur-md opacity-0 group-hover/search:opacity-100 transition-opacity duration-700"></span>
                            <span class="text-sm opacity-20 group-hover/search:opacity-100 group-hover/search:scale-125 group-hover/search:rotate-12 transition-all duration-500">✨</span>
                        </div>

                        <input type="text" id="searchInput" onkeyup="filterBooks()"
                            placeholder="CARI JUDUL ATAU PENULIS..."
                            class="w-full bg-transparent outline-none text-[11px] font-black tracking-[0.3em] text-white placeholder:text-white/10 uppercase transition-all">

                        <div class="absolute bottom-0 left-0 h-[1px] w-0 bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent group-hover/search:w-full transition-all duration-1000 ease-in-out"></div>
                    </div>
                </div>

                <div class="flex justify-between mt-4 px-2">
                    <div class="flex items-center gap-3">
                        <span class="w-1.5 h-[1px] bg-indigo-500"></span>
                        <span class="text-[8px] font-black tracking-[0.3em] text-white/20 uppercase">PrinzLib.</span>
                    </div>
                    <span class="text-[8px] font-black tracking-[0.3em] text-indigo-500/0 group-hover/search:text-indigo-500/60 transition-all duration-700 uppercase">
                        Klik untuk mencari
                    </span>
                </div>
            </div>
        </div>
    </header>

    <style>
        @keyframes bracket-in {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-bracket-in {
            animation: bracket-in 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>

    <section class="py-12 relative">
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-16 border-b border-white/5 pb-10 gap-6">
            <div class="space-y-2">
                <h2 class="text-[10px] font-black uppercase tracking-[0.6em] text-white/40 italic flex items-center gap-3">
                    <span class="w-8 h-[1px] bg-indigo-500/30"></span>
                    Arsip Pilihan / Koleksi Pribadi
                </h2>
                <p class="text-[9px] text-white/20 tracking-[0.3em] uppercase pl-11">Kurasi literasi untuk ketenangan pikiran</p>
            </div>

            <div class="group cursor-default">
                <div class="text-[9px] font-black text-indigo-400 bg-indigo-400/5 px-8 py-3 rounded-full border border-indigo-500/10 group-hover:border-indigo-500/40 transition-all duration-700 tracking-[0.2em] uppercase flex items-center gap-3">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    Tersemat {{ count($bukus) }} Karya Favorit
                </div>
            </div>
        </div>

        {{-- Grid --}}
        <div id="bookGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-10 gap-y-20 lg:gap-x-14">
            @forelse($bukus as $index => $buku)
            <div class="book-card group relative" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                <div class="absolute -top-6 -left-4 text-[4rem] font-black text-white/[0.03] italic pointer-events-none group-hover:text-indigo-500/10 transition-all duration-1000 z-0">
                    {{ sprintf('%02d', $index + 1) }}
                </div>

                <a href="{{ route('bukus.show', $buku->id) }}" class="block relative z-10">
                    {{-- Cover --}}
                    <div class="img-container mb-8 relative overflow-hidden rounded-sm transition-all duration-1000 group-hover:shadow-[0_30px_60px_rgba(79,70,229,0.2)] group-hover:-translate-y-4">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-70 group-hover:opacity-40 transition-opacity duration-1000"></div>
                        <img src="{{ $buku->image_url ?? asset('storage/' . $buku->cover) }}"
                            onerror="this.src='https://via.placeholder.com/600x900/0a0a0a/ffffff?text=MENANTI_SAMPUL'"
                            alt="{{ $buku->judul }}"
                            class="w-full aspect-[2/3] object-cover grayscale-[0.4] group-hover:grayscale-0 scale-100 group-hover:scale-110 transition-all duration-[2s] cubic-bezier(0.15, 1, 0.3, 1)"
                            loading="lazy">
                    </div>

                    <div class="space-y-4 px-1">
                        {{-- Kategori (Infinity Marquee) --}}
                        <div class="flex items-center gap-3">
                            <span class="category-line h-[1px] min-w-[16px] w-4 bg-indigo-500/30"></span>
                            <div class="category-text-wrapper">
                                <div class="category-marquee-content js-marquee text-[9px] font-bold text-indigo-400/80 uppercase tracking-[0.3em]">
                                    <span class="category-item">{{ $buku->kategori->nama_kategori ?? 'Umum' }} &nbsp; •</span>
                                    <span class="category-item">{{ $buku->kategori->nama_kategori ?? 'Umum' }} &nbsp; •</span>
                                </div>
                            </div>
                        </div>

                        {{-- Judul (Infinity Marquee) --}}
                        <div class="space-y-1">
                            <div class="marquee-wrapper">
                                <h3 class="marquee-content js-marquee text-sm lg:text-base font-black text-white/90 uppercase tracking-tight italic">
                                    <span class="marquee-item">{{ $buku->judul }} &nbsp; •</span>
                                    <span class="marquee-item">{{ $buku->judul }} &nbsp; •</span>
                                </h3>
                            </div>
                            <p class="text-[9px] font-medium text-white/20 uppercase tracking-[0.2em] group-hover:text-white/50 transition-colors duration-700">
                                {{ $buku->penulis ?? 'PRINZ_ARCHIVE' }}
                            </p>
                        </div>

                        <div class="pt-3 flex items-center justify-between border-t border-white/5">
                            <span class="text-[7px] font-black text-white/10 group-hover:text-indigo-400 transition-all duration-700 tracking-[0.4em] uppercase italic">Open_Log</span>
                            <svg class="w-3 h-3 text-white/5 group-hover:text-indigo-400 group-hover:translate-x-1 transition-all duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-full py-40 text-center relative">
                <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] text-[10vw] font-black select-none italic uppercase">Kosong</div>
                <p class="relative z-10 text-[11px] font-black tracking-[1.2em] text-white/20 uppercase italic">Belum ada karya yang tersemat</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- SCRIPT DURATION DYNAMIC --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const marquees = document.querySelectorAll('.js-marquee');
            const velocity = 50; // Kecepatan pixel per detik

            marquees.forEach(marquee => {
                const fullWidth = marquee.scrollWidth;
                // Durasi dihitung dari setengah lebar total (teks asli + duplikat)
                const duration = (fullWidth / 2) / velocity;
                marquee.style.animationDuration = `${duration}s`;
            });
        });
    </script>
    <section class="mt-32 p-12 lg:p-24 rounded-[60px] border border-white/5 bg-gradient-to-br from-white/[0.03] to-transparent">
        <div class="flex items-center justify-between mb-20">
            <h2 class="text-[11px] font-black uppercase tracking-[1em] text-white/20">Eksplorasi Global</h2>
            <div class="h-[1px] flex-1 mx-12 bg-white/5"></div>
        </div>

        <div id="apiBooks" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        </div>

        <div class="mt-24 flex justify-center">
            <button onclick="fetchTrendingBooks()" id="loadMoreBtn"
                class="btn-premium group px-20 py-7 rounded-2xl border border-white/10 text-[10px] font-black uppercase tracking-[0.6em] transition-all bg-transparent text-white">
                <span id="btnText">Lihat Lebih Banyak</span>
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
        const btnText = document.getElementById('btnText');

        if (!container || !loadBtn) return;

        btnText.innerHTML = 'MENGHUBUNGKAN...';
        loadBtn.disabled = true;

        try {
            const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${SYSTEM_CONFIG.defaultQuery}&startIndex=${startIndex}&maxResults=${SYSTEM_CONFIG.resultsPerPage}&key=${SYSTEM_CONFIG.apiKey}`);
            const data = await response.json();

            if (data.items) {
                data.items.forEach((item, index) => {
                    const info = item.volumeInfo;
                    const thumb = info.imageLinks ? info.imageLinks.thumbnail.replace('http:', 'https:') : SYSTEM_CONFIG.placeholder;

                    const card = document.createElement('div');
                    card.className = "book-card group cursor-pointer reveal-card";
                    card.onclick = () => {
                        window.location.href = `/reader/${item.id}`;
                    };

                    card.innerHTML = `
                        <div class="status-badge !text-indigo-400">PDF PREVIEW</div>
                        <div class="img-container mb-6">
                            <img src="${thumb}" alt="${info.title}" loading="lazy">
                            <div class="absolute inset-0 bg-indigo-950/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
                                <span class="text-[9px] font-black text-white tracking-[0.3em]">BACA PDF</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="category-chip !bg-white/5 !text-white/40 w-fit">External Data</div>
                            <h3 class="text-sm font-black text-white uppercase truncate group-hover:text-indigo-400 transition-colors">${info.title}</h3>
                            <p class="text-[9px] font-medium text-white/30 uppercase tracking-widest mt-1">Oleh ${info.authors ? info.authors[0] : 'Rahasia'}</p>
                        </div>
                    `;

                    container.appendChild(card);

                    // Efek Muncul Berurutan (Stagger)
                    setTimeout(() => {
                        card.classList.add('active');
                    }, index * 100);
                });
                startIndex += SYSTEM_CONFIG.resultsPerPage;
            }
        } catch (e) {
            console.error("API Error:", e);
        } finally {
            btnText.innerHTML = 'Lihat Lebih Banyak';
            loadBtn.disabled = false;
        }
    }

    function filterBooks() {
        const val = document.getElementById('searchInput').value.toLowerCase();
        const localCards = document.querySelectorAll('#bookGrid .book-card');
        localCards.forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(val) ? "block" : "none";
        });
    }

    document.addEventListener('DOMContentLoaded', fetchTrendingBooks);
</script>
@endsection