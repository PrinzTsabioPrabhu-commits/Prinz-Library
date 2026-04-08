<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUDUT BACA | Ruang Inspirasi Pribadi</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bg-dark: #050505;
            --accent: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.4);
            --glass: rgba(255, 255, 255, 0.005);
            --border: rgba(255, 255, 255, 0.02);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            margin: 0;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        /* 1. EFEK AMBIENT */
        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            pointer-events: none;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.04;
            mix-blend-mode: overlay;
        }

        .ambient-aura {
            position: fixed;
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(120px);
            opacity: 0.12;
            pointer-events: none;
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
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1);
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

        .loaded #preloader {
            opacity: 0;
            pointer-events: none;
        }

        /* 3. NAVIGASI HOVER */
        .nav-link {
            position: relative;
            padding: 0.5rem 0;
            color: rgba(255, 255, 255, 0.3);
            transition: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 1px;
            background: var(--accent);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* 4. UTAMA */
        .main-container {
            background: var(--glass);
            backdrop-filter: blur(50px) saturate(150%);
            border: 1px solid var(--border);
            border-radius: 64px;
            box-shadow: 0 60px 120px -30px rgba(0, 0, 0, 0.9);
            position: relative;
            transition: all 1s ease;
        }

        /* 5. MODAL */
        #logoutModal {
            visibility: hidden;
            pointer-events: none;
        }

        #logoutModal.modal-visible {
            visibility: visible;
            pointer-events: auto;
        }

        .modal-content {
            transform: scale(0.95) translateY(20px);
            opacity: 0;
            filter: blur(10px);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal-visible .modal-content {
            transform: scale(1) translateY(0);
            opacity: 1;
            filter: blur(0px);
        }

        .animate-marquee {
            display: flex;
            animation: marquee 40s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* 6. INPUT */
        .input-luxe {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 1.25rem 1.75rem;
            color: white;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            font-size: 11px;
            width: 100%;
        }

        .input-luxe:focus {
            background: rgba(255, 255, 255, 0.03);
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.1);
        }
    </style>
</head>

<body class="antialiased opacity-0 transition-opacity duration-1000">
    <div class="noise-overlay"></div>
    <div class="ambient-aura top-[-20%] left-[-10%]"></div>
    <div class="ambient-aura bottom-[-20%] right-[-10%]"></div>

    {{-- PRELOADER --}}
    <div id="preloader">
        <div class="flex flex-col items-center gap-6">
            <div class="loader-line" style="width: 120px;"></div>
            <span class="text-[8px] font-bold tracking-[1em] text-white/30 uppercase">Membuka Pintu Koleksi</span>
        </div>
    </div>

    {{-- LOGOUT MODAL --}}
    <div id="logoutModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 sm:p-12 overflow-hidden">
        <div class="fixed inset-0 bg-[#030303]/90 backdrop-blur-[40px] transition-opacity duration-1000" onclick="closeLogoutModal()"></div>

        <div class="modal-content relative bg-[#0a0a0a] border border-white/[0.05] w-full max-w-[650px] rounded-[3.5rem] p-8 md:p-12 text-center overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,1)] my-auto transition-all duration-700">

            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

                <div class="md:col-span-5 flex flex-col items-center md:items-end gap-6 md:border-right md:border-white/5 md:pr-8">
                    <div class="group relative w-16 h-16 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full border border-white/5 bg-white/[0.02] group-hover:bg-white/[0.05] transition-all duration-700"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/20 group-hover:text-white transition-all duration-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.084.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.084.477-4.5 1.253" />
                        </svg>
                    </div>

                    <div class="text-center md:text-right space-y-2">
                        <p class="text-[9px] text-white/30 leading-relaxed font-light tracking-wide italic">
                            "Bintang takkan hilang, ia hanya menunggu pagi untuk kembali disapa."
                        </p>
                        <p class="text-[6px] uppercase tracking-[0.4em] text-white/10 italic">The Librarian</p>
                    </div>
                </div>

                <div class="md:col-span-7 flex flex-col gap-10 items-center md:items-start text-left relative group/right selection:bg-white/10">

                    <div class="space-y-2 relative w-full group/title">
                        <div class="h-3 overflow-hidden">
                            <span class="block text-[5px] text-white/0 group-hover/right:text-white/20 uppercase tracking-[1.5em] transition-all duration-[1500ms] ease-out translate-y-full group-hover/right:translate-y-0 font-extralight italic">
                                Menyimpan Kenangan
                            </span>
                        </div>

                        <p class="text-[7px] text-white/5 uppercase tracking-[0.8em] font-medium transition-all duration-1000 group-hover/right:text-white/30 group-hover/right:tracking-[1em]">Sesi Berakhir</p>

                        <div class="relative inline-block">
                            <h3 class="text-2xl font-black text-white/80 tracking-[0.15em] uppercase italic transition-all duration-[1200ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover/right:text-white group-hover/right:tracking-[0.25em]">
                                Sudah Cukup?
                            </h3>
                            <span class="absolute -right-8 top-1/2 -translate-y-1/2 w-[2px] h-[2px] rounded-full bg-white/0 group-hover/right:bg-white/40 group-hover/right:shadow-[0_0_8px_white] transition-all duration-[1500ms] delay-300"></span>
                        </div>

                        <div class="relative h-[1px] w-0 bg-white/5 mt-4 transition-all duration-[1800ms] ease-[cubic-bezier(0.23,1,0.32,1)] group-hover/right:w-full overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/right:translate-x-full transition-transform duration-[2500ms] delay-700"></div>
                        </div>
                    </div>

                    <div class="flex gap-12 opacity-0 group-hover/right:opacity-100 transition-all duration-[2000ms] delay-[400ms] translate-y-1 group-hover/right:translate-y-0">
                        <div class="flex flex-col gap-1.5 group/meta">
                            <span class="text-[5px] text-white/10 uppercase tracking-[0.5em] transition-colors duration-1000 group-hover/meta:text-white/30">Status Rak</span>
                            <span class="text-[8px] text-white/30 font-light italic tracking-[0.2em] leading-none">Tertata Rapi</span>
                        </div>
                        <div class="w-[1px] h-3 bg-white/5 self-center rotate-[20deg]"></div>
                        <div class="flex flex-col gap-1.5 group/meta">
                            <span class="text-[5px] text-white/10 uppercase tracking-[0.5em] transition-colors duration-1000 group-hover/meta:text-white/30">Waktu Rehat</span>
                            <span class="text-[8px] text-white/30 font-light italic tracking-[0.2em] leading-none">Senja Hari</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 w-full">
                        <form action="{{ route('logout') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="group relative w-full py-4 rounded-2xl bg-white border border-white transition-all duration-500 overflow-hidden active:scale-95">
                                <span class="relative z-10 text-[9px] font-black text-black uppercase tracking-[0.2em] group-hover:text-white transition-colors duration-500">Tutup Lembaran</span>
                                <div class="absolute inset-0 bg-[#0a0a0a] translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                            </button>
                        </form>

                        <button onclick="closeLogoutModal()" class="flex-1 py-4 rounded-2xl border border-white/5 text-[8px] font-bold text-white/20 uppercase tracking-[0.2em] hover:text-white/60 hover:bg-white/[0.02] transition-all">
                            Lanjutkan
                        </button>
                    </div>

                    <p class="text-[6px] text-white/5 uppercase tracking-[0.3em] italic">Digitally Crafted in Malang</p>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        {{-- TOP ANNOUNCEMENT --}}
        <div class="border-b border-white/5 bg-white/[0.01] py-4 overflow-hidden relative group">
            <div class="absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-[#050505] to-transparent z-10"></div>
            <div class="absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-[#050505] to-transparent z-10"></div>

            <div class="animate-marquee whitespace-nowrap flex items-center">
                @for ($i = 0; $i < 6; $i++)
                    <span class="mx-12 text-[7px] font-black text-white/10 uppercase tracking-[0.6em] transition-colors group-hover:text-white/20">
                    Ruang ini hanya untukmu
                    </span>

                    <span class="text-indigo-500/40 text-[10px]">✦</span>

                    <span class="mx-12 text-[7px] font-black text-indigo-400/30 uppercase tracking-[0.6em] italic transform group-hover:scale-110 transition-transform">
                        Setiap buku punya cerita sendiri
                    </span>

                    <span class="text-white/10 text-[10px]">✧</span>

                    <span class="mx-12 text-[7px] font-black text-white/15 uppercase tracking-[0.6em]">
                        Terima kasih sudah merawat koleksi ini,
                        <span class="text-white/40 group-hover:text-indigo-400 transition-colors">{{ Auth::user()->name }}</span>
                    </span>

                    <span class="mx-12 text-[7px] font-black text-white/5 uppercase tracking-[0.6em] italic">
                        — Rehat sejenak, baca perlahan —
                    </span>

                    <span class="text-indigo-500/40 text-[10px]">✦</span>
                    @endfor
            </div>
        </div>
    </div>

    {{-- NAVIGATION --}}
    <nav class="container mx-auto px-8 lg:px-24 py-16 flex justify-between items-center relative">

        {{-- Decorative Side Label (Kiri Luar) --}}
        <div class="absolute left-6 top-1/2 -rotate-90 origin-left hidden xl:block">
            <span class="text-[5px] font-black tracking-[1em] text-white/5 uppercase">Halaman Utama — Koleksi No. 01</span>
        </div>

        {{-- Branding: Prinz Library --}}
        <a href="{{ route('beranda') }}" class="group flex items-center gap-6 relative">
            <div class="relative">
                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center transition-all group-hover:rotate-[-12deg] group-hover:scale-90 duration-1000 shadow-2xl relative z-10">
                    <span class="text-black font-black text-2xl italic">P</span>
                </div>
                {{-- Ghost Element --}}
                <div class="absolute inset-0 bg-indigo-500 rounded-2xl opacity-0 group-hover:opacity-20 group-hover:rotate-12 group-hover:scale-110 transition-all duration-1000"></div>
            </div>

            <div class="hidden sm:block relative">
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="w-1 h-px bg-indigo-500/40 group-hover:w-4 transition-all duration-700"></span>
                    <span class="text-[6px] font-black text-indigo-400 uppercase tracking-[0.5em] opacity-40">Est. 2026</span>
                </div>
                <h1 class="text-sm font-black uppercase tracking-[0.6em] group-hover:tracking-[0.8em] transition-all duration-1000 leading-none">
                    Prinz <span class="text-white/40 group-hover:text-white transition-colors">Library</span>
                </h1>
                <div class="flex items-center gap-3 mt-2">
                    <p class="text-[7px] text-white/10 uppercase tracking-[0.3em] italic">Ruang Baca Personal</p>
                    <span class="text-[7px] text-white/5">•</span>
                    <span class="text-[7px] text-white/10 uppercase tracking-[0.2em] group-hover:text-indigo-400/40 transition-colors">v2.0.4</span>
                </div>
            </div>
        </a>

        {{-- Main Menu: Floating Capsule --}}
        <div class="hidden lg:flex items-center gap-1 bg-white/[0.01] border border-white/[0.04] p-1.5 rounded-full backdrop-blur-3xl group/nav hover:border-white/10 transition-all duration-1000 shadow-2xl shadow-black/50">

            <a href="{{ route('beranda') }}" class="relative px-8 py-4 rounded-full group/item overflow-hidden transition-all {{ request()->routeIs('beranda') ? 'bg-white/5' : '' }}">
                <div class="relative z-10 flex flex-col items-center">
                    <span class="text-[5px] font-bold text-indigo-400/0 group-hover/item:text-indigo-400 uppercase tracking-[0.4em] mb-1 transition-all duration-500 transform -translate-y-1 group-hover/item:translate-y-0">Mulai</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] {{ request()->routeIs('beranda') ? 'text-white' : 'text-white/20' }} group-hover/item:text-white transition-colors">Beranda</span>
                </div>
            </a>

            <div class="w-px h-4 bg-white/5"></div>

            <a href="{{ route('bukus.index') }}" class="relative px-8 py-4 rounded-full group/item overflow-hidden transition-all {{ request()->routeIs('bukus.*') ? 'bg-white/5' : '' }}">
                <div class="relative z-10 flex flex-col items-center">
                    <span class="text-[5px] font-bold text-indigo-400/0 group-hover/item:text-indigo-400 uppercase tracking-[0.4em] mb-1 transition-all duration-500 transform -translate-y-1 group-hover/item:translate-y-0">Jelajah</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] {{ request()->routeIs('bukus.*') ? 'text-white' : 'text-white/20' }} group-hover/item:text-white transition-colors">Rak Buku</span>
                </div>
            </a>

            <div class="w-px h-4 bg-white/5"></div>

            <a href="{{ route('kategori.index') }}" class="relative px-8 py-4 rounded-full group/item overflow-hidden transition-all {{ request()->routeIs('kategori.*') ? 'bg-white/5' : '' }}">
                <div class="relative z-10 flex flex-col items-center">
                    <span class="text-[5px] font-bold text-indigo-400/0 group-hover/item:text-indigo-400 uppercase tracking-[0.4em] mb-1 transition-all duration-500 transform -translate-y-1 group-hover/item:translate-y-0">Pilah</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] {{ request()->routeIs('kategori.*') ? 'text-white' : 'text-white/20' }} group-hover/item:text-white transition-colors">Genre</span>
                </div>
            </a>
        </div>

        {{-- User & System Status --}}
        <div class="flex items-center gap-10">
            {{-- Profile Section --}}
            <div class="hidden md:flex items-center gap-6 group/profile relative">
                <div class="text-right flex flex-col justify-center">
                    <div class="flex items-center justify-end gap-2 mb-1">
                        <span class="w-1 h-1 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[6px] font-black text-white/20 uppercase tracking-[0.3em]">Sesi Aktif</span>
                    </div>
                    <span class="block text-[10px] font-black text-white tracking-[0.1em] uppercase italic group-hover/profile:text-indigo-400 transition-all duration-500">
                        {{ Auth::user()->name ?? 'Prinz' }}
                    </span>
                    <a href="{{ route('profile.edit') }}" class="text-[7px] text-white/10 font-bold uppercase tracking-[0.1em] hover:text-white transition-all mt-1">
                        Pengaturan Profil
                    </a>
                </div>

                <div class="relative">
                    {{-- Decorative Circle around Profile --}}
                    <svg class="absolute inset-[-8px] w-[calc(100%+16px)] h-[calc(100%+16px)] rotate-[-90deg] opacity-0 group-hover/profile:opacity-100 transition-all duration-1000">
                        <circle cx="50%" cy="50%" r="48%" stroke="rgba(99, 102, 241, 0.2)" stroke-width="1" fill="none" stroke-dasharray="100" stroke-dashoffset="100" class="group-hover/profile:stroke-dashoffset-0 transition-all duration-1000"></circle>
                    </svg>

                    <div class="w-12 h-12 rounded-2xl border border-white/5 overflow-hidden bg-white/5 p-1 group-hover/profile:border-indigo-500/30 transition-all duration-700">
                        <div class="w-full h-full rounded-[10px] overflow-hidden grayscale group-hover/profile:grayscale-0 transition-all duration-1000">
                            <img src="{{ (Auth::check() && Auth::user()->profile_photo_path) ? asset('storage/'.Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'P').'&background=000&color=fff' }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logout --}}
            <div class="relative group/logout">
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover/logout:opacity-100 transition-all duration-500 translate-y-2 group-hover/logout:translate-y-0">
                    <span class="text-[5px] font-black text-white/30 uppercase tracking-[0.5em] whitespace-nowrap">Selesai Baca</span>
                </div>
                <button onclick="openLogoutModal()" class="w-12 h-12 rounded-2xl border border-white/5 flex items-center justify-center hover:bg-white hover:text-black hover:scale-90 transition-all duration-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-20 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Decorative Bottom Line (Kanan Bawah Nav) --}}
        <div class="absolute bottom-4 right-24 hidden lg:block">
            <p class="text-[5px] font-bold text-white/5 uppercase tracking-[1.5em]">System Secure • Malang, ID • {{ date('Y') }}</p>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="container mx-auto px-6 lg:px-24 pb-40">
        <div class="main-container min-h-[70vh] p-10 md:p-20 relative group/main overflow-hidden">
            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute -top-20 -right-20 p-20 opacity-[0.02] pointer-events-none rotate-12 group-hover/main:rotate-0 transition-all duration-1000">
                <svg width="400" height="400" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="48" stroke="white" stroke-width="0.3" fill="none" stroke-dasharray="2 2" />
                </svg>
            </div>

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="relative bg-[#050505] border-t border-white/[0.03] pt-32 pb-16 overflow-hidden group/footer">
        {{-- Garis cahaya halus di bagian atas --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent transition-all duration-1000 group-hover/footer:via-indigo-500/40"></div>

        <div class="container mx-auto px-8 lg:px-24 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-24">

                {{-- Bagian Identitas & Salam --}}
                <div class="md:col-span-6 space-y-10">
                    <div class="group/logo flex items-center gap-6 relative">
                        {{-- Tulisan Melayang: Dibuat sangat kecil & subtle --}}
                        <span class="absolute -top-5 left-20 text-[4px] font-medium text-indigo-500/0 group-hover/logo:text-indigo-500/30 uppercase tracking-[1em] transition-all duration-1000 italic">
                            Terima Kasih Telah Bertamu
                        </span>

                        <div class="w-12 h-12 bg-white text-black rounded-2xl flex items-center justify-center transform group-hover/logo:rotate-[10deg] transition-all duration-700 shadow-2xl relative">
                            <span class="text-xl font-black italic">P</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black uppercase tracking-widest leading-none text-white transition-all duration-700">
                                Prinz Library<span class="text-indigo-500 opacity-40">.</span>
                            </h2>
                            <span class="text-[7px] font-bold tracking-[0.6em] text-white/5 uppercase mt-2 block group-hover/logo:text-white/20 transition-colors">Tempat Berpulang Setiap Cerita</span>
                        </div>
                    </div>

                    {{-- Deskripsi: Ukuran teks dikecilkan (text-sm -> text-[13px]) --}}
                    <div class="relative group/text pl-6">
                        <p class="text-[13px] text-white/20 leading-relaxed font-light max-w-sm italic transition-colors group-hover/text:text-white/40">
                            "Terima kasih sudah mampir. Semoga setiap lembar yang kamu buka di sini memberikan ketenangan untuk hari-harimu."
                        </p>
                        <span class="absolute left-0 top-0 h-full w-[1px] bg-white/5 group-hover/text:bg-indigo-500/20 transition-all duration-700"></span>
                    </div>

                    {{-- Social Buttons: Lebih compact --}}
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Instagram', 'Pinterest', 'Unsplash'] as $social)
                        <a href="#" class="group relative px-6 py-3 overflow-hidden rounded-xl border border-white/[0.03] transition-all duration-700 hover:border-white/10">
                            <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                            <span class="relative text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 group-hover:text-black transition-colors">
                                {{ $social }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Menu Navigasi --}}
                <div class="md:col-span-3 space-y-8">
                    <div class="flex items-center gap-3">
                        <h4 class="text-[8px] font-black uppercase tracking-[0.5em] text-indigo-500/40">Pintu Masuk</h4>
                        <div class="h-px w-6 bg-white/5"></div>
                    </div>
                    <ul class="space-y-5 text-[10px] font-medium text-white/10 uppercase tracking-widest">
                        @foreach(['Rak Buku Utama', 'Telusuri Judul', 'Kabar Terbaru', 'Tentang Ruang Ini'] as $item)
                        <li class="group/item flex items-center gap-0 group-hover/item:gap-3 transition-all duration-500">
                            <span class="text-indigo-500 opacity-0 group-hover/item:opacity-100 transition-all text-[6px]">✦</span>
                            <a href="#" class="hover:text-white/60 transition-all duration-500 inline-block">{{ $item }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kartu Suasana: Dibuat lebih slim --}}
                <div class="md:col-span-3">
                    <div class="relative p-8 rounded-[2.5rem] bg-white/[0.01] border border-white/[0.02] overflow-hidden group/card hover:border-white/5 transition-all duration-1000 shadow-2xl">
                        <div class="relative z-10 space-y-8">
                            <div class="flex justify-between items-center">
                                <span class="text-[7px] font-bold uppercase tracking-[0.3em] text-white/10">Suasana</span>
                                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/5 border border-indigo-500/10">
                                    <span class="w-1 h-1 bg-indigo-500 rounded-full animate-pulse"></span>
                                    <span class="text-[7px] font-bold text-indigo-400/80 uppercase tracking-tighter">Teduh</span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between text-[8px] font-medium tracking-widest uppercase text-white/10">
                                    <span>Kerapihan</span>
                                    <span class="text-indigo-400/50 group-hover/card:text-indigo-400 transition-colors">Baik</span>
                                </div>
                                <div class="w-full bg-white/5 h-[1px] rounded-full overflow-hidden">
                                    <div class="bg-indigo-500/30 w-3/4 h-full transition-all duration-1000 group-hover/card:w-full"></div>
                                </div>
                            </div>

                            <div class="pt-5 border-t border-white/[0.03]">
                                <p class="text-[7px] font-medium text-white/5 uppercase tracking-[0.3em] leading-loose">
                                    Kunjungan Terakhir: <br>
                                    <span class="text-white/20 group-hover/card:text-indigo-400/60 transition-colors">{{ date('d F Y') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Baris Penutup --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 pt-12 border-t border-white/[0.02] relative">
                <span class="absolute -top-px left-1/2 -translate-x-1/2 text-[4px] font-bold text-white/5 uppercase tracking-[1.5em] bg-[#050505] px-4">End of Page</span>

                <div class="flex flex-col gap-2 group/copy text-center md:text-left">
                    <p class="text-[7px] font-bold text-white/10 uppercase tracking-[0.6em]">
                        &copy; {{ date('Y') }} Dibuat untuk <span class="text-white/20 hover:text-indigo-400/50 transition-colors cursor-default">Kamu</span>
                    </p>
                    <div class="flex gap-3 items-center opacity-10 justify-center md:justify-start">
                        <span class="text-[5px] font-bold uppercase tracking-[0.2em]">Malang</span>
                        <div class="w-3 h-px bg-white/20"></div>
                        <span class="text-[5px] font-bold uppercase tracking-[0.2em]">Prinz</span>
                    </div>
                </div>

                <div class="flex items-center gap-10">
                    <div class="flex gap-8">
                        @foreach(['Ruang Aman', 'Janji Teman'] as $link)
                        <a href="#" class="relative group/link text-[7px] font-bold text-white/10 uppercase tracking-[0.3em] hover:text-white/40 transition-all">
                            {{ $link }}
                            <span class="absolute -bottom-1 left-0 w-0 h-px bg-indigo-500/30 group-hover/link:w-full transition-all duration-700"></span>
                        </a>
                        @endforeach
                    </div>

                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        class="w-10 h-10 flex items-center justify-center border border-white/5 rounded-full hover:border-indigo-500/30 transition-all duration-700 group/top">
                        <svg class="w-2.5 h-2.5 text-white/10 group-hover/top:text-indigo-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M5 15l7-7 7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.add('loaded');
                document.body.classList.remove('opacity-0');
            }, 500);
        });

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.add('modal-visible');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.remove('modal-visible');
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLogoutModal();
        });
    </script>
</body>

</html>