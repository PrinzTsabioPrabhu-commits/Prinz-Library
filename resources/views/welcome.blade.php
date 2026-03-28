<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINZ // Digital Library & Archive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.4);
            --bg-dark: #050505;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        /* 1. LUXURY BACKGROUND ANIMATION */
        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            opacity: 0.4;
        }

        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            pointer-events: none;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.05;
            mix-blend-mode: overlay;
        }

        /* 2. PRELOADER */
        #preloader {
            position: fixed;
            inset: 0;
            background: #000;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader-line {
            width: 0;
            height: 1px;
            background: #fff;
            animation: expand 1.5s cubic-bezier(0.7, 0, 0.3, 1) forwards;
        }

        @keyframes expand {
            0% {
                width: 0;
                opacity: 1;
            }

            100% {
                width: 100%;
                opacity: 0;
            }
        }

        .reveal-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* 3. REFINED GLASS BENTO */
        .glass-bento {
            background: rgba(255, 255, 255, 0.005);
            backdrop-filter: blur(40px) saturate(150%);
            border: 1px solid rgba(255, 255, 255, 0.03);
            border-radius: 40px;
            transition: all 0.8s cubic-bezier(0.19, 1, 0.22, 1);
            position: relative;
            overflow: hidden;
        }

        .glass-bento:hover {
            background: rgba(255, 255, 255, 0.02);
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-8px);
            box-shadow: 0 40px 80px -40px rgba(0, 0, 0, 0.8);
        }

        /* 4. TYPOGRAPHY & CENTER ALIGNMENT */
        .editorial-title {
            font-weight: 800;
            line-height: 0.9;
            letter-spacing: -0.05em;
            text-transform: uppercase;
        }

        .outline-text {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.3);
            transition: all 1s ease;
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .btn-premium {
            background: #fff;
            color: #000;
            padding: 1.2rem 2.5rem;
            border-radius: 100px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 10px;
            transition: all 0.4s ease;
        }

        .btn-premium:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
        }

        .ambient-glow {
            position: absolute;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            z-index: -1;
            filter: blur(100px);
            opacity: 0.3;
            pointer-events: none;
        }
    </style>
</head>

<body class="antialiased opacity-0 transition-opacity duration-1000">
    <canvas id="bg-canvas"></canvas>
    <div class="noise-overlay"></div>
    <div id="preloader">
        <div class="loader-line"></div>
    </div>

    <div class="ambient-glow top-[10%] left-[20%]"></div>
    <div class="ambient-glow bottom-[10%] right-[20%]"></div>

    <div class="content">
        <nav class="fixed top-0 left-0 right-0 z-[100] p-8 lg:px-24 flex justify-between items-center mix-blend-difference">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-black text-black italic text-lg">P</div>
                <div class="text-[9px] font-black uppercase tracking-[0.4em]">Prinz<br><span class="opacity-40">Archive</span></div>
            </div>

            <div class="flex gap-12 items-center">
                <div class="hidden md:flex gap-8 text-[9px] font-black uppercase tracking-[0.3em] text-white/50">
                    <a href="#about" class="hover:text-white transition-colors">Visi Kita</a>
                    <a href="#explore" class="hover:text-white transition-colors">Arsip</a>
                </div>
                @auth
                <a href="{{ route('beranda') }}" class="px-6 py-2 bg-indigo-500 rounded-full text-[9px] font-black uppercase tracking-widest text-white shadow-[0_0_20px_rgba(99,102,241,0.3)] hover:scale-110 transition-all">Buka Konsol</a>
                @else
                <a href="{{ route('login') }}" class="px-6 py-2 border border-white/20 rounded-full text-[9px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition-all">Masuk Yuk</a>
                @endauth
            </div>
        </nav>

        <section class="hero-section px-10 relative">
            <div class="relative z-10 max-w-5xl">
                <div class="flex flex-col items-center gap-6 mb-8 reveal-up">
                    <div class="flex items-center gap-4">
                        <span class="w-8 h-[1px] bg-indigo-500"></span>
                        <span class="text-[9px] font-black uppercase tracking-[0.5em] text-indigo-400">Pusat Kecerdasan Digital</span>
                        <span class="w-8 h-[1px] bg-indigo-500"></span>
                    </div>
                </div>

                <h1 class="editorial-title text-[10vw] lg:text-8xl xl:text-[8.5rem] reveal-up mb-10">
                    KNOWLEDGE <br>
                    <span class="outline-text italic">EVOLUTION.</span>
                </h1>

                <div class="flex flex-col items-center gap-12 reveal-up">
                    <p class="text-[10px] md:text-[12px] text-white/40 uppercase tracking-[0.4em] leading-loose max-w-2xl">
                        Ruang koleksi premium aku buat kamu yang ingin terus <span class="text-white">mengasah pikiran</span>. Didesain spesial untuk hasil yang luar biasa.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <a href="#" class="btn-premium">Gabung Sekarang</a>
                        <a href="#about" class="px-10 py-4 text-[10px] font-black uppercase tracking-widest border border-white/10 rounded-full hover:bg-white/5 transition-all">Kenalan Lebih Jauh</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="py-32 px-10 lg:px-24">
            <div class="grid lg:grid-cols-4 gap-8 auto-rows-[300px] reveal-up">
                <div class="lg:col-span-3 lg:row-span-2 glass-bento p-12 flex flex-col justify-between group">
                    <div class="max-w-3xl">
                        <div class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500 mb-8">01 // MANIFESTO</div>
                        <h2 class="text-5xl lg:text-[6vw] font-black tracking-tighter leading-none uppercase group-hover:translate-x-4 transition-transform duration-700">
                            BUKAN CUMA <br> <span class="text-white">DATA,</span> <br> <span class="outline-text">TAPI MAKNA.</span>
                        </h2>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase tracking-[0.3em] max-w-md leading-relaxed">
                        Aku percaya, kualitas diri kamu bermula dari apa yang kamu baca dan pelajari setiap hari.
                    </p>
                </div>

                <div class="glass-bento p-10 flex flex-col justify-center items-center group">
                    <div class="text-5xl font-black italic mb-2 group-hover:text-indigo-400 transition-colors">24.5K</div>
                    <div class="text-[8px] font-black text-white/30 uppercase tracking-[0.4em]">Koleksi Digital</div>
                </div>

                <div class="glass-bento p-10 flex flex-col justify-between group">
                    <div class="w-10 h-10 bg-indigo-500/10 rounded-lg flex items-center justify-center text-indigo-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-black uppercase tracking-widest">Akses Aman</h3>
                </div>
            </div>
        </section>

        <section id="explore" class="py-20 px-10 lg:px-24">
            <div class="flex items-center gap-4 mb-12 reveal-up">
                <span class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500">02 // KATEGORI ARSIP</span>
                <div class="h-[1px] flex-grow bg-white/10"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 reveal-up">
                <div class="glass-bento p-8 min-h-[250px] flex flex-col justify-between group">
                    <div class="text-indigo-400 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold uppercase tracking-tighter mb-2">Development</h4>
                        <p class="text-[9px] text-white/40 uppercase tracking-widest">Laravel, Tailwind, & Coding</p>
                    </div>
                </div>

                <div class="glass-bento p-8 min-h-[250px] flex flex-col justify-between group">
                    <div class="text-indigo-400 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold uppercase tracking-tighter mb-2">High Speed</h4>
                        <p class="text-[9px] text-white/40 uppercase tracking-widest">Dunia F1 & Aerodinamika</p>
                    </div>
                </div>

                <div class="glass-bento p-8 min-h-[250px] flex flex-col justify-between group">
                    <div class="text-indigo-400 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold uppercase tracking-tighter mb-2">Perpustakaan</h4>
                        <p class="text-[9px] text-white/40 uppercase tracking-widest">Inti Literasi Digital</p>
                    </div>
                </div>

                <div class="glass-bento p-8 min-h-[250px] flex flex-col justify-between group">
                    <div class="text-indigo-400 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold uppercase tracking-tighter mb-2">Simulasi</h4>
                        <p class="text-[9px] text-white/40 uppercase tracking-widest">Otomotif & Fisika Balap</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-10 lg:px-24">
            <div class="glass-bento p-12 overflow-hidden relative reveal-up">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-12">
                    <div class="text-center md:text-left">
                        <div class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500 mb-4">03 // PERFORMA SISTEM</div>
                        <h2 class="text-4xl font-black uppercase tracking-tighter mb-6">Proses Data <br>Secepat Kilat.</h2>
                        <div class="flex gap-4">
                            <div class="px-4 py-2 bg-indigo-500/10 border border-indigo-500/20 rounded-lg">
                                <span class="block text-[8px] uppercase tracking-widest text-white/40">Status</span>
                                <span class="text-[10px] font-bold text-green-400 uppercase">Lancar Jaya</span>
                            </div>
                            <div class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg">
                                <span class="block text-[8px] uppercase tracking-widest text-white/40">Kecepatan</span>
                                <span class="text-[10px] font-bold uppercase">12ms</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full md:w-auto">
                        <div class="p-6 border border-white/5 rounded-3xl bg-white/[0.01] text-center">
                            <div class="text-2xl font-black italic">99.9%</div>
                            <div class="text-[7px] uppercase tracking-[0.3em] text-white/30">Aktif Terus</div>
                        </div>
                        <div class="p-6 border border-white/5 rounded-3xl bg-white/[0.01] text-center">
                            <div class="text-2xl font-black italic">1.2TB</div>
                            <div class="text-[7px] uppercase tracking-[0.3em] text-white/30">Bandwidth</div>
                        </div>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/10 blur-[100px] rounded-full -mr-32 -mt-32"></div>
            </div>
        </section>

        <section class="py-20 px-10 lg:px-24">
            <div class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500 mb-12 reveal-up">04 // BARU SAJA MASUK</div>
            <div class="space-y-4 reveal-up">
                <div class="glass-bento p-6 flex items-center justify-between group cursor-pointer hover:bg-white/5">
                    <div class="flex items-center gap-8">
                        <span class="text-[10px] font-black text-white/20 italic">001</span>
                        <div>
                            <h5 class="text-sm font-bold uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Laravel_E-Library_v2.msi</h5>
                            <p class="text-[8px] text-white/30 uppercase mt-1">Aplikasi Sistem // 42.5 MB</p>
                        </div>
                    </div>
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </div>
                <div class="glass-bento p-6 flex items-center justify-between group cursor-pointer hover:bg-white/5">
                    <div class="flex items-center gap-8">
                        <span class="text-[10px] font-black text-white/20 italic">002</span>
                        <div>
                            <h5 class="text-sm font-bold uppercase tracking-widest group-hover:text-indigo-400 transition-colors">F1_Aero_Dynamics_Study.pdf</h5>
                            <p class="text-[8px] text-white/30 uppercase mt-1">Dokumen Riset // 12.8 MB</p>
                        </div>
                    </div>
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <section id="why-us" class="py-20 px-10 lg:px-24">
            <div class="flex items-center gap-4 mb-12 reveal-up">
                <span class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500">03 // KENAPA HARUS DI SINI?</span>
                <div class="h-[1px] flex-grow bg-white/10"></div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 reveal-up">
                <div class="glass-bento p-10 group relative">
                    <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="text-6xl font-black italic">01</span>
                    </div>
                    <div class="mb-8 w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-indigo-500/50 transition-all duration-500">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-tighter mb-4">Akses Super Cepat</h3>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Aku udah optimalkan semuanya biar kamu nggak perlu nunggu lama buat dapet informasi yang kamu cari.
                    </p>
                </div>

                <div class="glass-bento p-10 group relative">
                    <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="text-6xl font-black italic">02</span>
                    </div>
                    <div class="mb-8 w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-indigo-500/50 transition-all duration-500">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-tighter mb-4">Keamanan Terjamin</h3>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Privasi kamu itu prioritas aku. Semua aset digital di sini dijaga ketat dengan enkripsi tingkat tinggi.
                    </p>
                </div>

                <div class="glass-bento p-10 group relative">
                    <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="text-6xl font-black italic">03</span>
                    </div>
                    <div class="mb-8 w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-indigo-500/50 transition-all duration-500">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-tighter mb-4">Koleksi Terpilih</h3>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Aku nggak cuma simpan data sembarangan. Setiap item dikurasi teliti biar beneran bermanfaat buat kamu.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-20 px-10 lg:px-24">
            <div class="flex items-center gap-4 mb-12 reveal-up">
                <span class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500">05 // CERITA KITA</span>
                <div class="h-[1px] flex-grow bg-white/10"></div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 reveal-up">
                <div class="glass-bento p-10 flex flex-col justify-between group h-[400px]">
                    <div>
                        <div class="text-[9px] font-black uppercase tracking-widest text-indigo-400 mb-4">Awal Mula</div>
                        <h3 class="text-3xl font-black uppercase tracking-tighter leading-none mb-6">Jejak <br>Digital.</h3>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Prinz Premium Library lahir dari kecintaan aku di dunia <span class="text-white">Teknik Informatika</span>, tempat aku menggabungkan data yang rapi dengan tampilan visual yang bikin nyaman di mata.
                    </p>
                </div>

                <div class="glass-bento p-10 flex flex-col justify-between group h-[400px]">
                    <div>
                        <div class="text-[9px] font-black uppercase tracking-widest text-indigo-400 mb-4">Teknologi</div>
                        <h3 class="text-3xl font-black uppercase tracking-tighter leading-none mb-6">Andalan <br>Laravel.</h3>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Aku pakai framework <span class="text-white">Laravel 11</span> buat jagain semua data kamu. Arsitekturnya dibuat teliti banget biar aksesnya tetap cepat dan nggak pakai ribet.
                    </p>
                </div>

                <div class="glass-bento p-10 flex flex-col justify-between group h-[400px]">
                    <div>
                        <div class="text-[9px] font-black uppercase tracking-widest text-indigo-400 mb-4">Harapan</div>
                        <h3 class="text-3xl font-black uppercase tracking-tighter leading-none mb-6">Eksplorasi <br>Tanpa Batas.</h3>
                    </div>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Nggak cuma buku, di sini kamu bisa temuin banyak hal seru mulai dari riset <span class="text-white">F1</span> sampai simulasi balap. Semua disiapin buat nemenin rasa penasaran kamu.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-20 px-10 lg:px-24">
            <div class="flex items-center gap-4 mb-12 reveal-up">
                <span class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500">03 // FITUR ARCHIVE</span>
                <div class="h-[1px] flex-grow bg-white/10"></div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 reveal-up">
                <div class="glass-bento p-10 group relative border-l-2 border-l-indigo-500/50">
                    <div class="mb-8 w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:bg-indigo-500/20 transition-all duration-500">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-tighter mb-4 italic">Neural Search</h3>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Cari aset digital secepat kilat. Algoritma pencarian aku udah dioptimasi buat nemuin file spesifik di ribuan folder dalam hitungan milidetik.
                    </p>
                </div>

                <div class="glass-bento p-10 group relative border-l-2 border-l-white/10 hover:border-l-indigo-500/50">
                    <div class="mb-8 w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:bg-indigo-500/20 transition-all duration-500">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-tighter mb-4 italic">Glassmorphism UI</h3>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Nikmati pengalaman visual premium. Desain web ini pake teknik <span class="text-white italic">layered-frost</span> yang bikin kamu nyaman eksplorasi berjam-jam.
                    </p>
                </div>

                <div class="glass-bento p-10 group relative border-l-2 border-l-white/10 hover:border-l-indigo-500/50">
                    <div class="mb-8 w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:bg-indigo-500/20 transition-all duration-500">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-tighter mb-4 italic">Secure Encryption</h3>
                    <p class="text-[10px] text-white/40 uppercase tracking-widest leading-relaxed">
                        Data kamu aman di balik enkripsi tingkat militer. Di Prinz Archive, privasi bukan sekadar opsi, tapi standar utama.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-20 px-10 lg:px-24">
            <div class="glass-bento p-12 relative overflow-hidden reveal-up bg-gradient-to-r from-indigo-900/10 to-transparent">
                <div class="relative z-10">
                    <div class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500 mb-8">04 // DID YOU KNOW?</div>
                    <div class="grid md:grid-cols-2 gap-12">
                        <div>
                            <h2 class="text-3xl font-black uppercase tracking-tighter leading-tight mb-6">
                                BUKAN SEKADAR <br> <span class="italic text-indigo-400">STORAGE.</span>
                            </h2>
                            <p class="text-[10px] text-white/40 uppercase tracking-[0.3em] leading-loose">
                                Tau nggak? Arsip ini dirancang pake struktur <span class="text-white">Laravel Modern</span> yang bisa nampung puluhan ribu data tanpa bikin *loading* lama. Cocok banget buat kamu yang butuh efisiensi tinggi kayak pit stop F1.
                            </p>
                        </div>
                        <div class="flex flex-col gap-6 justify-center">
                            <div class="flex items-center gap-6 p-4 border border-white/5 rounded-2xl bg-white/[0.02]">
                                <div class="text-2xl font-black italic text-indigo-500">0.02s</div>
                                <div class="text-[8px] uppercase tracking-widest text-white/30">Average Query Speed</div>
                            </div>
                            <div class="flex items-center gap-6 p-4 border border-white/5 rounded-2xl bg-white/[0.02]">
                                <div class="text-2xl font-black italic text-indigo-500">100%</div>
                                <div class="text-[8px] uppercase tracking-widest text-white/30">Mobile Responsive</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-indigo-600/10 blur-[120px] rounded-full"></div>
            </div>
        </section>
        <section class="py-20 px-10 lg:px-24">
            <div class="flex items-center gap-4 mb-12 reveal-up">
                <span class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500">05 // PERFORMA SISTEM</span>
                <div class="h-[1px] flex-grow bg-white/10"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 reveal-up">
                <div class="glass-bento p-12 text-center group relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="text-[4rem] font-black italic leading-none mb-2 group-hover:scale-110 transition-transform duration-700">99.9</div>
                        <div class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.5em]">Sistem Selalu Siap %</div>
                    </div>
                    <div class="absolute inset-0 bg-indigo-500/5 translate-y-full group-hover:translate-y-0 transition-transform duration-700"></div>
                </div>

                <div class="glass-bento p-12 text-center group relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="text-[4rem] font-black italic leading-none mb-2 group-hover:scale-110 transition-transform duration-700">0.08</div>
                        <div class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.5em]">Respon Super Cepat / Detik</div>
                    </div>
                    <div class="absolute inset-0 bg-indigo-500/5 translate-y-full group-hover:translate-y-0 transition-transform duration-700"></div>
                </div>

                <div class="glass-bento p-12 text-center group relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="text-[4rem] font-black italic leading-none mb-2 group-hover:scale-110 transition-transform duration-700">256</div>
                        <div class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.5em]">Keamanan Enkripsi Bit</div>
                    </div>
                    <div class="absolute inset-0 bg-indigo-500/5 translate-y-full group-hover:translate-y-0 transition-transform duration-700"></div>
                </div>
            </div>
        </section>
        

        <section class="py-32 px-10 lg:px-24 relative overflow-hidden">
            <div class="absolute inset-0 bg-indigo-600/5 skew-y-3 transform origin-right"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center max-w-4xl mx-auto reveal-up">
                <div class="w-20 h-[1px] bg-indigo-500 mb-12"></div>
                <h2 class="editorial-title text-5xl lg:text-7xl mb-8">
                    MAU TAHU <br> <span class="outline-text">RAHASIANYA?</span>
                </h2>
                <p class="text-[11px] text-white/40 uppercase tracking-[0.4em] leading-relaxed mb-12 max-w-2xl">
                    Penasaran gimana aku meramu teknologi di balik layar? <br>
                    Yuk, kita intip rahasia dapur, struktur database, sampai konsep desain premium yang bikin <span class="text-white font-bold">Prinz Archive</span> jadi senyaman ini buat kamu pakai.
                </p>
                
                <a href="/blueprint" class="group relative px-12 py-5 overflow-hidden rounded-full bg-white text-black transition-all duration-500 hover:pr-16">
                    <span class="relative z-10 text-[10px] font-black uppercase tracking-[0.3em]">Jelajahi Blueprint Sistem</span>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 group-hover:right-8 transition-all duration-500">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>
            </div>
        </section>

        <section class="py-32 reveal-up overflow-hidden">
            <div class="flex items-center gap-4 mb-20">
                <span class="w-12 h-[1px] bg-indigo-500"></span>
                <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Arsitektur Fullstack Developer</span>
            </div>

            <style>
                /* Animasi Scrolling Code (Backend) */
                @keyframes backend-scroll {
                    0% { transform: translateY(0); opacity: 0.2; }
                    50% { opacity: 0.5; }
                    100% { transform: translateY(-50%); opacity: 0.2; }
                }
                .backend-scroll { animation: backend-scroll 10s infinite linear; }

                /* Animasi UI Floating (Frontend) */
                @keyframes ui-float {
                    0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.5; }
                    50% { transform: translateY(-15px) rotate(5deg); opacity: 1; }
                }
                .ui-float { animation: ui-float 4s infinite ease-in-out; }

                /* Animasi Laser Beam (Transition) */
                @keyframes laser-beam {
                    0%, 100% { width: 0; opacity: 0; }
                    50% { width: 100%; opacity: 1; filter: blur(2px); }
                }
                .laser-beam { animation: laser-beam 1s ease-in-out forwards; }
            </style>

            <div class="glass-bento p-12 lg:p-20 relative overflow-hidden group border-indigo-500/10 hover:border-indigo-500/30 transition-all duration-1000">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    
                    <div class="relative flex justify-center items-center h-[400px] bg-[#050505] rounded-3xl border border-white/5 overflow-hidden transition-all duration-700 group-hover:border-indigo-500/20 order-1 lg:order-2">
                        
                        <div class="absolute w-64 h-64 bg-indigo-500/10 rounded-full blur-[100px] group-hover:bg-indigo-500/30 transition-all duration-1000"></div>
                        
                        <div class="absolute inset-y-0 left-0 w-1/2 flex flex-col items-center justify-center p-6 border-r border-indigo-500/20 transition-all duration-700 group-hover:w-0 group-hover:opacity-0 group-hover:scale-50">
                            <div class="relative flex justify-center items-center h-[200px]">
                                <div class="w-20 h-12 bg-indigo-500 rounded-lg shadow-[0_0_20px_#4f46e5] ui-float" style="animation-delay: 0.2s"></div>
                                <div class="absolute w-12 h-8 bg-white/10 rounded-lg border border-white/10 ui-float top-[20%] right-[10%]" style="animation-delay: 0.4s"></div>
                                <div class="absolute w-8 h-8 bg-indigo-400 rounded-full ui-float bottom-[15%] left-[25%]" style="animation-delay: 0.6s"></div>
                            </div>
                            <span class="text-[9px] font-black uppercase tracking-[0.5em] text-indigo-400 mt-8 italic">Tailwind CSS & UI</span>
                        </div>

                        <div class="absolute inset-y-0 right-0 w-1/2 flex flex-col items-center justify-center p-6 bg-[#080808] transition-all duration-700 group-hover:w-full group-hover:opacity-100 group-hover:scale-110">
                            <div class="w-[90%] h-[70%] bg-[#0a0a0a] border border-indigo-500/30 rounded-xl p-6 font-mono text-[7px] relative overflow-hidden shadow-[0_0_50px_rgba(79,102,241,0.1)] group-hover:opacity-100 opacity-20 transition-opacity">
                                <div class="flex gap-1.5 mb-4">
                                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                    <span class="text-[7px] text-white/20 uppercase tracking-widest font-black">MySQL Terminal / db_bmw_store</span>
                                </div>
                                <div class="text-indigo-400 space-y-2 backend-scroll">
                                    <p>> SELECT * FROM orders WHERE status = 'ACTIVE';</p>
                                    <p class="text-white/60">Dropping all tables... <span class="text-green-500">DONE</span></p>
                                    <p class="text-white/60">Preparing database: <span class="italic">db_bmw_store</span></p>
                                    <p class="text-white/60">Creating table: <span class="text-white underline">users</span>... <span class="text-green-500">OK</span></p>
                                    <p class="text-white/60">Creating table: <span class="text-white underline">orders</span>... <span class="text-green-500">OK</span></p>
                                    <p class="text-red-500 mt-4 font-black">SYSTEM STATUS: FULLSTACK POLE POSITION</p>
                                </div>
                            </div>
                            <span class="text-[9px] font-black uppercase tracking-[0.5em] text-indigo-400 mt-8 italic transition-opacity opacity-20 group-hover:opacity-100">Laravel & MySQL Logic</span>
                        </div>

                        <div class="absolute top-1/2 left-1/2 w-0 h-[1px] bg-white laser-beam group-hover:w-full group-hover:opacity-100 transition-all"></div>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-block px-4 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-[8px] font-black uppercase tracking-widest text-indigo-400 mb-8 italic">
                            Fullstack Dimensions
                        </div>
                        <h4 class="text-5xl font-black italic tracking-tighter uppercase mb-10 leading-[0.9] text-white">The Fullstack<br><span class="text-indigo-500">Synthesizer.</span></h4>
                        
                        <div class="space-y-8">
                            <div class="group/item">
                                <h5 class="text-[10px] font-black uppercase tracking-widest text-white mb-3 flex items-center gap-3">
                                    <span class="text-indigo-500">01.</span> Frontend Dimension
                                                                    </h5>
                                <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                    Menciptakan antarmuka yang responsif, modern, dan intuitif menggunakan <span class="text-white italic">Tailwind CSS</span> & <span class="text-white italic">Vue.js</span>. Di mana estetika visual bertemu dengan pengalaman pengguna yang mulus.
                                </p>
                            </div>

                            <div class="group/item">
                                <h5 class="text-[10px] font-black uppercase tracking-widest text-white mb-3 flex items-center gap-3">
                                    <span class="text-indigo-500">02.</span> Backend Dimension
                                </h5>
                                <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                    Membangun logika bisnis yang kuat dan aman menggunakan <span class="text-white italic">Laravel & PHP</span>. Mengelola database <span class="text-white">MySQL</span> kamu secepat mekanik Pit Stop F1 mengganti ban.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-32 reveal-up overflow-hidden">
            <style>
                /* Animasi Garis Kecepatan (Warp Speed) */
                @keyframes warp-speed {
                    0% { transform: translateY(-100%); opacity: 0; }
                    50% { opacity: 1; }
                    100% { transform: translateY(100%); opacity: 0; }
                }
                .warp-line {
                    position: absolute; width: 1px; height: 100px;
                    background: linear-gradient(to bottom, transparent, #6366f1, transparent);
                    animation: warp-speed 0.5s infinite linear;
                    opacity: 0;
                }

                /* Animasi Tombol Berdenyut */
                @keyframes btn-pulse {
                    0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.2); border-color: rgba(99, 102, 241, 0.2); }
                    50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.5); border-color: rgba(99, 102, 241, 0.6); }
                }
                .btn-gateway { animation: btn-pulse 3s infinite ease-in-out; }
            </style>

            <div class="glass-bento p-1 relative overflow-hidden group rounded-[40px]">
                <div class="bg-[#050505] rounded-[38px] py-24 px-12 relative overflow-hidden flex flex-col items-center justify-center text-center">
                    
                    <div class="absolute inset-0 pointer-events-none">
                        <div class="warp-line left-[10%] group-hover:opacity-100" style="animation-delay: 0.1s"></div>
                        <div class="warp-line left-[30%] group-hover:opacity-100" style="animation-delay: 0.3s"></div>
                        <div class="warp-line left-[50%] group-hover:opacity-100" style="animation-delay: 0.2s"></div>
                        <div class="warp-line left-[70%] group-hover:opacity-100" style="animation-delay: 0.5s"></div>
                        <div class="warp-line left-[90%] group-hover:opacity-100" style="animation-delay: 0.4s"></div>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-block px-4 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-[8px] font-black uppercase tracking-widest text-indigo-400 mb-8 italic">
                            Final Destination
                        </div>
                        <h2 class="text-5xl lg:text-7xl font-black italic tracking-tighter uppercase mb-6 leading-none text-white">
                            Ready to explore<br><span class="text-indigo-500">The Full Archive?</span>
                        </h2>
                        <p class="text-[11px] text-white/30 uppercase tracking-[0.4em] mb-12 max-w-xl mx-auto leading-relaxed">
                            Langkah terakhir untuk melihat seluruh ekosistem <span class="text-white italic">Information Technology</span> dan <span class="text-white">Laravel Ecosystem</span> yang telah aku bangun.
                        </p>

                        <a href="{{ route('archive.hub') }}" class="relative inline-flex items-center justify-center px-12 py-6 group/btn">
                            <div class="absolute inset-0 bg-indigo-600 rounded-xl skew-x-[-12deg] transition-all duration-500 group-hover/btn:bg-white group-hover/btn:scale-110 btn-gateway"></div>
                            
                            <div class="relative flex items-center gap-4 text-white group-hover/btn:text-black transition-colors duration-500">
                                <span class="text-xs font-black uppercase tracking-[0.3em] italic">Enter The Archive</span>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-500 group-hover/btn:translate-x-2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </a>
                    </div>

                    <div class="absolute bottom-8 left-12 text-[7px] font-mono text-white/10 uppercase tracking-[0.5em] hidden lg:block">
                        Status: Secure Connection Established
                    </div>
                    <div class="absolute bottom-8 right-12 text-[7px] font-mono text-white/10 uppercase tracking-[0.5em] hidden lg:block">
                        Node: Prinz_V2.026
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="py-20 px-10 lg:px-24">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16 reveal-up">
                    <div class="text-[9px] font-black uppercase tracking-[0.8em] text-indigo-500 mb-4 text-center">Tanya-Tanya Yuk</div>
                    <h2 class="editorial-title text-4xl lg:text-6xl">BUTUH <span class="outline-text">BANTUAN?</span></h2>
                </div>

                <div class="space-y-4 reveal-up">
                    <div class="glass-bento overflow-hidden transition-all duration-500">
                        <button onclick="toggleFaq(this)" class="w-full p-8 flex justify-between items-center text-left focus:outline-none group">
                            <span class="text-xs font-black uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Gimana sih cara intip koleksi eksklusifnya?</span>
                            <svg class="w-4 h-4 transform transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out opacity-0">
                            <div class="p-8 pt-0 text-[10px] text-white/40 uppercase tracking-[0.2em] leading-relaxed">
                                Gampang kok! Kamu tinggal klik "Identity Claim" atau login aja ke akun Prinz Archive kamu. Begitu beres, semua pintu data bakal langsung terbuka buat kamu.
                            </div>
                        </div>
                    </div>

                    <div class="glass-bento overflow-hidden transition-all duration-500">
                        <button onclick="toggleFaq(this)" class="w-full p-8 flex justify-between items-center text-left focus:outline-none group">
                            <span class="text-xs font-black uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Datanya beneran di-update terus ya?</span>
                            <svg class="w-4 h-4 transform transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out opacity-0">
                            <div class="p-8 pt-0 text-[10px] text-white/40 uppercase tracking-[0.2em] leading-relaxed">
                                Pastinya dong. Aku selalu jagain biar riset-riset terbaru soal coding, desain UI/UX, sampai info dunia balap tetap segar buat kamu pelajari.
                            </div>
                        </div>
                    </div>

                    <div class="glass-bento overflow-hidden transition-all duration-500">
                        <button onclick="toggleFaq(this)" class="w-full p-8 flex justify-between items-center text-left focus:outline-none group">
                            <span class="text-xs font-black uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Format filenya ada apa aja nih?</span>
                            <svg class="w-4 h-4 transform transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out opacity-0">
                            <div class="p-8 pt-0 text-[10px] text-white/40 uppercase tracking-[0.2em] leading-relaxed">
                                Lengkap banget! Ada PDF buat baca santai, MSI buat install aplikasi, sampai file CAD buat kamu yang pengen bedah teknik mobil balap.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <footer class="py-32 px-10 lg:px-24 border-t border-white/5 mt-20">

        <div class="flex flex-col items-center text-center reveal-up">

            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center font-black text-black italic text-3xl mb-12">P</div>

            <h2 class="editorial-title text-4xl lg:text-6xl mb-12">STAY <span class="outline-text">CURIOUS.</span></h2>

            <div class="flex gap-8 text-[9px] font-black uppercase tracking-[0.4em] text-white/30">

                <a href="#" class="hover:text-indigo-400 transition-colors">Instagram</a>

                <a href="#" class="hover:text-indigo-400 transition-colors">Github</a>

                <a href="#" class="hover:text-indigo-400 transition-colors">LinkedIn</a>

            </div>

            <p class="mt-20 text-[8px] text-white/20 uppercase tracking-[0.5em]">&copy; 2026 Prinz Archive Core. All Rights Reserved.</p>

        </div>

    </footer>

    </div>
    <script>
        // PRELOADER & REVEAL
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('preloader').style.display = 'none';
                document.body.classList.add('loaded');
                document.body.classList.remove('opacity-0');
                handleScrollReveal(); // Initial check
            }, 1500);
        });

        // SCROLL REVEAL SYSTEM
        function handleScrollReveal() {
            const reveals = document.querySelectorAll('.reveal-up');
            reveals.forEach(el => {
                const windowHeight = window.innerHeight;
                const elementTop = el.getBoundingClientRect().top;
                const elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    el.classList.add('active');
                }
            });
        }

        function toggleFaq(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector('svg');

            // Menutup FAQ lain (opsional, hapus jika ingin bisa buka banyak sekaligus)
            /*
            document.querySelectorAll('.glass-bento').forEach(item => {
                const otherContent = item.querySelector('div[class*="max-h-"]');
                if(otherContent && otherContent !== content) {
                    otherContent.style.maxHeight = '0';
                    otherContent.style.opacity = '0';
                    item.querySelector('svg').style.transform = 'rotate(0deg)';
                }
            });
            */

            if (content.style.maxHeight === '0px' || content.style.maxHeight === '') {
                content.style.maxHeight = content.scrollHeight + "px";
                content.style.opacity = "1";
                icon.style.transform = "rotate(180deg)";
            } else {
                content.style.maxHeight = "0";
                content.style.opacity = "0";
                icon.style.transform = "rotate(0deg)";
            }
        }

        window.addEventListener('scroll', handleScrollReveal);

        // LUXURY BACKGROUND ANIMATION (Canvas Particles)
        const canvas = document.getElementById('bg-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];

        function initCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 0.5;
                this.speedX = Math.random() * 0.5 - 0.25;
                this.speedY = Math.random() * 0.5 - 0.25;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.x > canvas.width) this.x = 0;
                if (this.x < 0) this.x = canvas.width;
                if (this.y > canvas.height) this.y = 0;
                if (this.y < 0) this.y = canvas.height;
            }
            draw() {
                ctx.fillStyle = 'rgba(99, 102, 241, 0.5)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function createParticles() {
            particles = [];
            for (let i = 0; i < 100; i++) {
                particles.push(new Particle());
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animate);
        }

        window.addEventListener('resize', () => {
            initCanvas();
            createParticles();
        });

        initCanvas();
        createParticles();
        animate();
    </script>
</body>

</html>