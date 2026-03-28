<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINZ LIBRARY | Premium Digital Library</title>

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

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            margin: 0;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        /* 1. PREMIUM AMBIENT EFFECTS */
        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            pointer-events: none;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.05;
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
            opacity: 0.15;
            pointer-events: none;
        }

        /* 2. REFINED PRELOADER */
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
            0% { width: 0; opacity: 1; }
            100% { width: 100%; opacity: 0; }
        }

        .loaded #preloader {
            opacity: 0;
            pointer-events: none;
        }

        /* 3. EDITORIAL DESIGN SYSTEM */
        .glass-bento {
            background: var(--glass);
            backdrop-filter: blur(50px) saturate(150%);
            border: 1px solid var(--border);
            border-radius: 48px;
            transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
            position: relative;
            overflow: hidden;
        }

        .glass-bento:hover {
            background: rgba(255, 255, 255, 0.015);
            border-color: rgba(255, 255, 255, 0.06);
            transform: translateY(-4px) scale(1.005);
            box-shadow: 0 40px 80px -40px rgba(0, 0, 0, 0.8),
                        inset 0 0 20px rgba(255, 255, 255, 0.01);
        }

        /* Subtle Inner Glow on Hover */
        .glass-bento::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), 
                        rgba(99, 102, 241, 0.04) 0%, 
                        transparent 70%);
            opacity: 0;
            transition: opacity 1.5s ease;
            pointer-events: none;
        }

        .glass-bento:hover::after {
            opacity: 1;
        }

        .editorial-title {
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.06em;
            text-transform: uppercase;
        }

        .outline-text {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.35);
            transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
        }
        
        .glass-bento:hover .outline-text {
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.6);
        }

        .btn-premium {
            background: #fff;
            color: #000;
            padding: 1.5rem 3rem;
            border-radius: 20px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            font-size: 11px;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-block;
            text-align: center;
        }

        .btn-premium:hover {
            transform: scale(1.05) translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.15);
        }

        /* 4. NAVIGATION ELEGANCE */
        .nav-link {
            position: relative;
            padding: 0.5rem 0;
            color: rgba(255, 255, 255, 0.4);
            transition: 0.4s;
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--accent);
            transition: width 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* 5. CONTENT CONTAINER */
        .main-container {
            background: var(--glass);
            backdrop-filter: blur(50px) saturate(150%);
            border: 1px solid var(--border);
            border-radius: 64px;
            box-shadow: 0 60px 120px -30px rgba(0, 0, 0, 0.9);
            position: relative;
            transition: all 1s ease;
        }

        /* 5. MODAL ANIMATION */
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
            animation: marquee 30s linear infinite;
        }

        /* 6. REFINED INPUT SYSTEM */
        .input-luxe {
            background: rgba(255, 255, 255, 0.005);
            border: 1px solid rgba(255, 255, 255, 0.03);
            border-radius: 24px;
            padding: 1.25rem 1.75rem;
            color: white;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            font-size: 11px;
            width: 100%;
            font-weight: 500;
            letter-spacing: 0.05em;
        }

        .input-luxe:focus {
            background: rgba(255, 255, 255, 0.02);
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.08),
                        inset 0 0 10px rgba(255, 255, 255, 0.01);
            transform: translateY(-1px);
        }

        .input-luxe::placeholder {
            color: rgba(255, 255, 255, 0.15);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 9px;
            font-weight: 800;
        }

        .luxe-label {
            display: block;
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.4em;
            color: rgba(255, 255, 255, 0.2);
            margin-left: 0.5rem;
            margin-bottom: 0.75rem;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .group:focus-within .luxe-label {
            color: var(--accent);
            transform: translateX(4px);
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
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
            <div class="loader-line" style="width: 100px;"></div>
            <span class="text-[9px] font-bold tracking-[0.8em] text-white/20 uppercase">Prinz Library</span>
        </div>
    </div>

    {{-- LOGOUT MODAL --}}
    <div id="logoutModal" class="fixed inset-0 z-[100] flex items-center justify-center px-6">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" onclick="closeLogoutModal()"></div>
        <div class="modal-content relative bg-[#0a0a0a] border border-white/10 w-full max-w-sm rounded-[3rem] p-10 text-center">
            <div class="w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-8 border border-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Sign Out?</h3>
            <p class="text-xs text-white/40 leading-relaxed mb-10">Kamu akan mengakhiri sesi kurasi literatur premium di platform ini.</p>
            <div class="flex flex-col gap-3">
                <form action="{{ route('logout') }}" method="POST" onsubmit="localStorage.removeItem('userProfile')">
                    @csrf
                    <button type="submit" class="w-full bg-white text-black py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all duration-500">Confirm Logout</button>
                </form>
                <button onclick="closeLogoutModal()" class="w-full py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest hover:text-white transition-all">Cancel</button>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        {{-- TOP ANNOUNCEMENT --}}
        <div class="border-b border-white/5 bg-white/[0.01] py-3 overflow-hidden">
            <div class="animate-marquee whitespace-nowrap">
                @for ($i = 0; $i < 4; $i++)
                    <span class="mx-10 text-[8px] font-medium text-white/20 uppercase tracking-[0.4em]">Curated by Aku for Kamu</span>
                    <span class="mx-10 text-[8px] font-bold text-indigo-400/40 uppercase tracking-[0.4em]">● Digital Integrity Verified</span>
                    <span class="mx-10 text-[8px] font-medium text-white/20 uppercase tracking-[0.4em]">Private Collection Access v2.0</span>
                    @endfor
            </div>
        </div>

        {{-- NAVIGATION --}}
        <nav class="container mx-auto px-8 lg:px-20 py-10 flex justify-between items-center">
            <a href="{{ route('beranda') }}" class="group flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center transition-transform group-hover:scale-95 duration-500">
                    <span class="text-black font-black text-xl italic">P</span>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-xs font-black uppercase tracking-[0.4em]">Prinz Library</h1>
                    <p class="text-[9px] text-white/30 uppercase tracking-[0.2em]">Premium Library</p>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-12 bg-white/[0.03] border border-white/5 px-10 py-4 rounded-full backdrop-blur-md">
                <a href="{{ route('beranda') }}" class="nav-link text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('beranda') ? 'active' : '' }}">Home</a>
                <a href="{{ route('bukus.index') }}" class="nav-link text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('bukus.*') ? 'active' : '' }}">Catalog</a>
                <a href="{{ route('kategori.index') }}" class="nav-link text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('kategori.*') ? 'active' : '' }}">Categories</a>
            </div>

            <div class="flex items-center gap-6">
                {{-- Profile Action Group --}}
                <div class="hidden md:flex items-center gap-4">
                    <div class="text-right">
                        {{-- PERBAIKAN: ID 'navUserName' untuk sinkronisasi --}}
                        <span id="navUserName" class="block text-[10px] font-bold text-white/80">{{ Auth::user()->name ?? 'Guest User' }}</span>
                        <a href="{{ route('edit-profile') }}" class="block text-[8px] text-indigo-400 font-black uppercase tracking-widest hover:text-white transition-colors">Edit Profile</a>
                    </div>

                    {{-- PERBAIKAN: Foto Profil dengan ID 'navUserPhoto' --}}
                    <div class="w-10 h-10 rounded-xl border border-white/10 overflow-hidden bg-white/5 relative">
                        <img id="navUserPhoto"
                            src="{{ (Auth::check() && Auth::user()->profile_photo_path) ? asset('storage/'.Auth::user()->profile_photo_path) : '' }}"
                            class="w-full h-full object-cover {{ !(Auth::check() && Auth::user()->profile_photo_path) ? 'hidden' : '' }}">

                        <div id="navUserInitials" class="w-full h-full flex items-center justify-center text-[8px] text-white/20 uppercase {{ (Auth::check() && Auth::user()->profile_photo_path) ? 'hidden' : '' }}">
                            Me
                        </div>
                    </div>
                </div>

                <button onclick="openLogoutModal()" class="w-12 h-12 rounded-2xl border border-white/10 flex items-center justify-center hover:bg-red-500 hover:border-red-500 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </div>
        </nav>

        {{-- MAIN CONTENT --}}
        <main class="container mx-auto px-6 lg:px-20 pb-32">
            <div class="main-container min-h-[60vh] p-8 md:p-16 relative">
                <div class="absolute top-0 right-0 p-10 opacity-[0.03] pointer-events-none">
                    <svg width="300" height="300" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" stroke="white" stroke-width="0.5" fill="none" />
                    </svg>
                </div>
                @yield('content')
            </div>
        </main>

        {{-- ENHANCED FOOTER --}}
        <footer class="relative bg-[#050505] border-t border-white/[0.03] pt-32 pb-16 overflow-hidden">
            {{-- Ambient Light Background --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-indigo-600/5 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="container mx-auto px-8 lg:px-24 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-24">

                    {{-- Brand Identity --}}
                    <div class="md:col-span-5 space-y-12">
                        <div class="group flex items-center gap-5">
                            <div class="relative">
                                <div class="absolute inset-0 bg-indigo-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                                <div class="relative w-12 h-12 bg-white text-black rounded-2xl flex items-center justify-center transform group-hover:rotate-[10deg] transition-transform duration-500">
                                    <span class="text-xl font-black italic">A</span>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black uppercase tracking-tighter leading-none">PRINZ LIBRARY<span class="text-indigo-500">.</span></h2>
                                <span class="text-[8px] font-bold tracking-[0.6em] text-white/20 uppercase">Knowledge Preservation</span>
                            </div>
                        </div>

                        <p class="text-sm text-white/40 leading-relaxed font-medium max-w-sm italic">
                            "Manifestasi digital untuk preservasi pengetahuan. Platform kurasi eksklusif yang dirancang untuk kecepatan dan makna."
                        </p>

                        <div class="flex gap-3">
                            @foreach(['Instagram', 'Twitter', 'LinkedIn'] as $social)
                            <a href="#" class="group relative px-6 py-3 overflow-hidden rounded-xl border border-white/5 transition-all duration-500 hover:border-indigo-500/50">
                                <div class="absolute inset-0 bg-indigo-500 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                                <span class="relative text-[9px] font-black uppercase tracking-widest text-white/30 group-hover:text-white transition-colors">
                                    {{ $social }}
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div class="md:col-span-2 space-y-8">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-white/80 flex items-center gap-2">
                            <span class="w-2 h-[1px] bg-indigo-500"></span> Navigation
                        </h4>
                        <ul class="space-y-4 text-[11px] font-bold text-white/30 uppercase tracking-widest">
                            <li><a href="#" class="hover:text-indigo-400 hover:translate-x-2 transition-all inline-block">Digital Vault</a></li>
                            <li><a href="#" class="hover:text-indigo-400 hover:translate-x-2 transition-all inline-block">Global Search</a></li>
                            <li><a href="#" class="hover:text-indigo-400 hover:translate-x-2 transition-all inline-block">User Protocol</a></li>
                            <li><a href="#" class="hover:text-indigo-400 hover:translate-x-2 transition-all inline-block">System Logs</a></li>
                        </ul>
                    </div>

                    {{-- Infrastructure --}}
                    <div class="md:col-span-2 space-y-8">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-white/80 flex items-center gap-2">
                            <span class="w-2 h-[1px] bg-indigo-500"></span> Infrastructure
                        </h4>
                        <div class="grid gap-3">
                            @foreach(['Laravel 11', 'Tailwind CSS', 'MySQL Cloud', 'Google API'] as $tech)
                            <div class="flex items-center gap-3 group">
                                <span class="text-[8px] text-indigo-500/50 group-hover:text-indigo-400 transition-colors">●</span>
                                <span class="text-[11px] font-bold text-white/30 uppercase tracking-widest group-hover:text-white/60 transition-colors">{{ $tech }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Status Card --}}
                    <div class="md:col-span-3">
                        <div class="relative p-8 rounded-[2.5rem] bg-white/[0.01] border border-white/[0.05] overflow-hidden group hover:border-indigo-500/20 transition-all duration-700">
                            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-20 transition-opacity">
                                <svg class="w-16 h-16 text-indigo-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L1 21h22L12 2zm0 3.45l8.27 14.3H3.73L12 5.45z" />
                                </svg>
                            </div>

                            <div class="relative z-10 space-y-8">
                                <div class="flex justify-between items-center">
                                    <span class="text-[9px] font-black uppercase tracking-widest text-white/30">System Status</span>
                                    <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 border border-green-500/20">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_#22c55e]"></span>
                                        <span class="text-[8px] font-black text-green-500 uppercase tracking-tighter">Active</span>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex justify-between text-[10px] font-bold italic tracking-tighter">
                                        <span class="text-white/40">Preservation Node: 021-X</span>
                                        <span class="text-indigo-400">75%</span>
                                    </div>
                                    <div class="w-full bg-white/5 h-[3px] rounded-full overflow-hidden p-[1px]">
                                        <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 w-3/4 h-full rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-white/[0.03]">
                                    <p class="text-[9px] font-bold text-white/20 uppercase tracking-widest leading-loose">
                                        Last Sync: {{ date('D, d M Y') }} <br>
                                        Region: ID_WEST_STATION
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bottom Bar --}}
                <div class="flex flex-col md:flex-row justify-between items-center gap-8 pt-12 border-t border-white/[0.03]">
                    <div class="flex items-center gap-6">
                        <p class="text-[9px] font-bold text-white/10 uppercase tracking-[0.5em]">
                            &copy; {{ date('Y') }} Crafted for <span class="text-white/20 hover:text-indigo-500 transition-colors cursor-default">Kamu</span>
                        </p>
                    </div>

                    <div class="flex items-center gap-10">
                        <div class="flex gap-8">
                            <a href="#" class="text-[9px] font-bold text-white/10 uppercase tracking-widest hover:text-white transition-colors">Privacy_Policy</a>
                            <a href="#" class="text-[9px] font-bold text-white/10 uppercase tracking-widest hover:text-white transition-colors">Terms_of_Sync</a>
                        </div>

                        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                            class="group relative w-12 h-12 flex items-center justify-center border border-white/5 rounded-full hover:border-indigo-500 transition-all duration-500">
                            <span class="absolute inset-0 bg-indigo-500 scale-0 group-hover:scale-100 opacity-0 group-hover:opacity-10 transition-all duration-500 rounded-full"></span>
                            <span class="text-white/20 group-hover:text-indigo-500 transition-colors">↑</span>
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
                }, 600);
            });

            // Global Mouse Tracking for Glass Bento Glow
            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth) * 100;
                const y = (e.clientY / window.innerHeight) * 100;
                document.documentElement.style.setProperty('--mouse-x', `${x}%`);
                document.documentElement.style.setProperty('--mouse-y', `${y}%`);
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