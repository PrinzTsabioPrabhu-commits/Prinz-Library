<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore — Discovery Mode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,800;1,800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #050505;
            color: white;
            overflow-x: hidden;
        }

        .font-heavy {
            font-weight: 800;
        }

        /* Smooth Entrance */
        @keyframes revealUp {
            from {
                opacity: 0;
                transform: translateY(20px);
                filter: blur(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0px);
            }
        }

        .reveal {
            animation: revealUp 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            opacity: 0;
        }

        /* Luxury Hover Effect */
        .explore-card {
            transition: all 0.8s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .img-wrapper {
            position: relative;
            overflow: hidden;
            background: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.03);
            transition: border-color 0.8s ease;
        }

        .explore-card:hover .img-wrapper {
            border-color: rgba(99, 102, 241, 0.3);
        }

        .explore-card img {
            transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);
            filter: grayscale(100%) contrast(1.1);
        }

        .explore-card:hover img {
            filter: grayscale(0%) contrast(1);
            transform: scale(1.08);
        }

        /* Back Button Interaction */
        .btn-back {
            transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .btn-back:hover {
            letter-spacing: 0.3em;
            color: #818cf8;
        }

        /* Spotlight Decor */
        .spotlight-top {
            position: fixed;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 80vw;
            height: 60vh;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.05) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>

<body class="antialiased">

    <div class="spotlight-top"></div>

    <header class="fixed top-0 left-0 w-full z-50 px-8 py-10 flex justify-between items-center mix-blend-difference">
        <a href="/" class="btn-back flex items-center gap-4 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-2 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="text-[10px] font-heavy uppercase tracking-[0.2em]">Beranda</span>
        </a>

        <div class="text-[9px] font-heavy uppercase tracking-[0.5em] text-white/20">
            Discovery Mode
        </div>
    </header>

    <main class="relative z-10 max-w-7xl mx-auto px-8 pt-48 pb-32">

        <section class="mb-32 reveal" style="animation-delay: 0.2s">
            <div class="max-w-3xl space-y-8">
                <h1 class="text-6xl md:text-8xl font-heavy uppercase tracking-tighter leading-[0.85]">
                    Temukan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white/40 to-white/10 italic">Inspirasi</span>
                </h1>
                <p class="text-[11px] font-heavy uppercase tracking-[0.5em] text-white/20 max-w-sm leading-relaxed">
                    Eksplorasi arsip pilihan untuk menemani waktu luangmu hari ini.
                </p>
            </div>
        </section>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-12 gap-y-24">
            @forelse($apiBukus as $index => $item)
            @php
            $info = $item['volumeInfo'];
            $bookId = $item['id'];
            // Ambil thumbnail dengan resolusi lebih baik jika tersedia
            $cover = $info['imageLinks']['thumbnail'] ?? 'https://via.placeholder.com/600x900/0a0a0a/ffffff?text=NO_COVER';
            @endphp

            <div class="explore-card group reveal" style="animation-delay: {{ 0.3 + ($index * 0.1) }}s">
                <a href="{{ route('reader', $bookId) }}" class="block space-y-8">

                    <div class="img-wrapper aspect-[3/4]">
                        <img src="{{ str_replace('http://', 'https://', $cover) }}"
                            class="w-full h-full object-cover"
                            alt="{{ $info['title'] }}">

                        <div class="absolute inset-0 bg-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="text-[9px] font-heavy text-indigo-400 uppercase tracking-widest">
                                {{ $info['categories'][0] ?? 'Literature' }}
                            </span>
                            <div class="h-[1px] flex-1 bg-white/5 group-hover:bg-indigo-500/20 transition-colors duration-700"></div>
                        </div>

                        <div class="space-y-1">
                            <h2 class="text-lg font-heavy uppercase tracking-tight leading-tight group-hover:text-indigo-400 transition-colors duration-500 line-clamp-2">
                                {{ $info['title'] }}
                            </h2>
                            <p class="text-[10px] font-heavy text-white/15 uppercase tracking-[0.1em] group-hover:text-white/40">
                                {{ $info['authors'][0] ?? 'Unknown Author' }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-full py-40 text-center">
                <p class="text-[11px] font-heavy uppercase tracking-[1.5em] text-white/10 italic">Gagal memuat pustaka digital...</p>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="py-20 px-8 border-t border-white/5">
        <div class="max-w-7xl mx-auto flex justify-between items-center opacity-20">
            <span class="text-[9px] font-heavy uppercase tracking-widest">© 2026 Prinz Library</span>
            <span class="text-[9px] font-heavy uppercase tracking-widest italic">Luxury in Simplicity</span>
        </div>
    </footer>

</body>

</html>