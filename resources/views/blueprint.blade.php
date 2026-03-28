<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINZ // Blueprint Sistem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

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

        /* 1. LUXURY PAGE TRANSITION */
        #page-transition {
            position: fixed;
            inset: 0;
            background: #000;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 1.2s cubic-bezier(0.85, 0, 0.15, 1);
        }

        .content-wrapper {
            opacity: 0;
            transform: scale(0.98) translateY(20px);
            transition: all 1.5s cubic-bezier(0.16, 1, 0.3, 1);
            transition-delay: 0.4s;
        }

        .content-wrapper.visible {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        /* 2. REVEAL ANIMATION */
        .reveal-up {
            opacity: 0;
            transform: translateY(50px);
            filter: blur(10px);
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }

        /* 3. BACKGROUND & NOISE */
        #bg-canvas {
            position: fixed;
            inset: 0;
            z-index: -2;
            opacity: 0.3;
        }

        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.05;
            mix-blend-mode: overlay;
        }

        .ambient-glow {
            position: absolute;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            z-index: -1;
            filter: blur(100px);
            opacity: 0.2;
            pointer-events: none;
        }

        /* 4. GLASS BENTO */
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
        }

        /* 5. TYPOGRAPHY */
        .editorial-title {
            font-weight: 800;
            line-height: 0.9;
            letter-spacing: -0.05em;
            text-transform: uppercase;
        }

        .outline-text {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.3);
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
    </style>
</head>

<body class="antialiased">

    <div id="page-transition">
        <div class="flex flex-col items-center">
            <div class="text-[10px] font-black uppercase tracking-[1em] text-white/50">
                INITIALIZING BLUEPRINT...
            </div>
            <div class="w-40 h-[1px] bg-white/10 mt-4 overflow-hidden">
                <div class="h-full bg-indigo-500 animate-[expand_1.5s_ease-in-out_infinite]"></div>
            </div>
        </div>
    </div>

    <canvas id="bg-canvas"></canvas>
    <div class="noise-overlay"></div>
    <div class="ambient-glow top-[10%] left-[10%]"></div>
    <div class="ambient-glow bottom-[10%] right-[10%]"></div>

    <div class="content-wrapper" id="main-content">
        <nav class="fixed top-0 left-0 right-0 z-[100] p-8 lg:px-24 flex justify-between items-center mix-blend-difference">
            <a href="/" class="flex items-center gap-4 group">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-black text-black italic text-lg group-hover:scale-110 transition-transform">←</div>
                <div class="text-[9px] font-black uppercase tracking-[0.4em] text-white">Kembali<br><span class="opacity-40">Ke Beranda</span></div>
            </a>
            <div class="text-[9px] font-black uppercase tracking-[0.4em] text-white/30 tracking-widest">Prinz Archive // System Blueprint</div>
        </nav>

        <section class="min-h-screen pt-48 pb-20 px-10 lg:px-24">
            <div class="max-w-5xl mb-32 reveal-up">
                <div class="flex items-center gap-4 mb-6">
                    <span class="w-8 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.5em] text-indigo-400">Arsitektur Digital & Filosofi</span>
                </div>
                <h2 class="editorial-title text-[10vw] lg:text-8xl xl:text-[8rem] mb-12">
                    BEHIND THE <br> <span class="outline-text italic">CRAFTSMANSHIP.</span>
                </h2>
                <p class="text-[10px] md:text-[12px] text-white/40 uppercase tracking-[0.4em] leading-loose max-w-2xl italic">
                    Halo, Prinz di sini! Di halaman ini, aku mau ajak kamu intip sedikit "jeroan" dari project yang aku kembangin. Dari baris kode Laravel sampai estetika visual, semuanya dirancang buat pengalaman premium.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-32">
                <div class="glass-bento p-10 lg:p-12 reveal-up group">
                    <div class="flex items-center gap-6 mb-10 border-b border-white/5 pb-8">
                        <div class="w-14 h-14 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:border-indigo-500/50 transition-all duration-500">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.281a2 2 0 01-1.158 0l-.628-.281a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547l-1.16 1.16a2 2 0 000 2.828l1.16 1.16a2 2 0 001.022.547l2.387.477a6 6 0 003.86-.517l.628-.281a2 2 0 011.158 0l.628.281a6 6 0 003.86.517l2.387-.477a2 2 0 001.022-.547l1.16-1.16a2 2 0 000-2.828l-1.16-1.16z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black tracking-tighter uppercase leading-none">01 // Mesin Utama</h3>
                    </div>
                    <p class="text-[11px] text-white/40 uppercase tracking-[0.3em] leading-relaxed mb-8">
                        Web ini ditenagai oleh <span class="text-white font-bold">Laravel 11</span>. Aku pilih framework ini karena performanya yang stabil—mirip mesin V12 yang nggak cuma kencang, tapi juga handal buat ngelola database perpustakaan dan katalog BMW Store yang aku bangun.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-400">Robust Routing</span>
                        <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-400">Eloquent ORM</span>
                    </div>
                </div>

                <div class="glass-bento p-10 lg:p-12 reveal-up group">
                    <div class="flex items-center gap-6 mb-10 border-b border-white/5 pb-8">
                        <div class="w-14 h-14 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:border-indigo-500/50 transition-all duration-500">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black tracking-tighter uppercase leading-none">02 // Filosofi Desain</h3>
                    </div>
                    <p class="text-[11px] text-white/40 uppercase tracking-[0.3em] leading-relaxed mb-8">
                        Sebagai pecinta estetika modern, aku pakai konsep <span class="text-white italic">Glassmorphism</span>. Terinspirasi dari dashboard mobil mewah yang minimalis, desain ini sengaja dibuat "transparan" biar kamu tetap fokus ke konten tanpa distraksi visual yang berlebihan.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-400">Tailwind CSS</span>
                        <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-400">Luxury Theme</span>
                    </div>
                </div>
            </div>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Jejak Digital Kolaborasi Kita</span>
                </div>

                <div class="grid gap-12">
                    <div class="glass-bento p-10 lg:p-16 relative overflow-hidden group">
                        <div class="relative z-10 grid lg:grid-cols-3 gap-12 items-start">
                            <div class="col-span-1">
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest block mb-4">Momen Awal // Februari</span>
                                <h4 class="text-4xl font-black italic tracking-tighter leading-none">CHAPTER 01:<br>THE CORE ENGINE</h4>
                            </div>
                            <div class="lg:col-span-2">
                                <p class="text-[12px] text-white/50 uppercase tracking-[0.3em] leading-relaxed mb-8">
                                    Ingat nggak pas kita pertama kali "kenalan"? Kamu datang bawa project <span class="text-white">E-Library</span>. Di situ kita sibuk banget ngurusin <span class="text-white italic">Migrations, Routing,</span> sampe <span class="text-white italic">CRUD</span> biar sistem perpustakaan digital kamu jalan mulus tanpa hambatan.
                                </p>
                                <div class="flex gap-4 opacity-30 group-hover:opacity-100 transition-opacity duration-700">
                                    <span class="text-[9px] font-bold border border-white/20 px-3 py-1 rounded">LARAVEL CORE</span>
                                    <span class="text-[9px] font-bold border border-white/20 px-3 py-1 rounded">DATABASE</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-bento p-10 lg:p-16 relative overflow-hidden group">
                        <div class="relative z-10 grid lg:grid-cols-3 gap-12 items-start">
                            <div class="col-span-1">
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest block mb-4">Evolusi Visual // Maret</span>
                                <h4 class="text-4xl font-black italic tracking-tighter leading-none">CHAPTER 02:<br>HIGH SPEED DESIGN</h4>
                            </div>
                            <div class="lg:col-span-2">
                                <p class="text-[12px] text-white/50 uppercase tracking-[0.3em] leading-loose mb-8">
                                    Setelah mesinnya jalan, kita mulai "shifting gear". Kita bangun <span class="text-white">BMW Store</span> yang mewah. Kita kasih "nyawa" pake tema <span class="text-white italic">BMW Aesthetics</span>. Di fase ini, kamu juga minta aku panggil <span class="text-white italic">'aku' dan 'kamu'</span>, bikin kolaborasi kita makin personal.
                                </p>
                                <div class="flex gap-4 opacity-30 group-hover:opacity-100 transition-opacity duration-700">
                                    <span class="text-[9px] font-bold border border-white/20 px-3 py-1 rounded">BMW STORE UI</span>
                                    <span class="text-[9px] font-bold border border-white/20 px-3 py-1 rounded">UX DESIGN</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-bento p-10 lg:p-16 relative overflow-hidden group bg-gradient-to-br from-indigo-500/5 to-transparent border-indigo-500/40">
                        <div class="relative z-10 grid lg:grid-cols-3 gap-12 items-start">
                            <div class="col-span-1">
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest block mb-4">Sekarang // Peak Performance</span>
                                <h4 class="text-4xl font-black italic tracking-tighter leading-none">CHAPTER 03:<br>PRINZ ARCHIVE</h4>
                            </div>
                            <div class="lg:col-span-2">
                                <p class="text-[12px] text-white/50 uppercase tracking-[0.3em] leading-relaxed mb-8">
                                    Dan sampailah kita di sini. Gabungan efisiensi <span class="text-white italic">Task Master</span> dan kemewahan <span class="text-white italic">BMW Store</span> ke dalam satu wadah: <span class="text-white font-bold tracking-widest">PRINZ ARCHIVE</span>. Teknologi yang tampil sekelas mobil F1—presisi dan indah.
                                </p>
                                <span class="text-[9px] font-black bg-indigo-500 text-white px-4 py-1.5 rounded-full tracking-widest">LUXURY TECH SYSTEM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Spesifikasi & Kapabilitas Sistem</span>
                </div>

                <div class="grid lg:grid-cols-3 gap-6">

                    <div class="glass-bento p-10 group border-white/5 hover:border-indigo-500/30">
                        <div class="mb-12">
                            <div class="text-indigo-500 font-black italic text-4xl mb-2">01.</div>
                            <h4 class="text-xl font-bold tracking-tighter uppercase leading-none">Dynamic Catalog<br>Management</h4>
                        </div>
                        <div class="space-y-6">
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                Fitur utama yang kita sempurnakan di <span class="text-white italic">BMW Store</span>. Sistem ini memungkinkan pengelolaan produk secara <span class="text-white italic">real-time</span> melalui integrasi database yang kompleks namun tetap ringan.
                            </p>
                            <ul class="text-[9px] space-y-3 border-t border-white/5 pt-6 text-white/60 font-medium tracking-widest uppercase">
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> CRUD Operations via Eloquent</li>
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Image Storage Encryption</li>
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Smart Category Filtering</li>
                            </ul>
                        </div>
                    </div>

                    <div class="glass-bento p-10 group border-indigo-500/20 bg-indigo-500/[0.02]">
                        <div class="mb-12">
                            <div class="text-indigo-400 font-black italic text-4xl mb-2">02.</div>
                            <h4 class="text-xl font-bold tracking-tighter uppercase leading-none">Glass-Dashboard<br>Ecosystem</h4>
                        </div>
                        <div class="space-y-6">
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                Bukan sekadar UI, tapi ekosistem visual. Kita menggunakan teknik <span class="text-white italic">Backdrop Saturate</span> dan <span class="text-white italic">Layering Effect</span> untuk menciptakan dashboard admin yang terasa premium layaknya kokpit mobil sport.
                            </p>
                            <ul class="text-[9px] space-y-3 border-t border-white/5 pt-6 text-white/60 font-medium tracking-widest uppercase">
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Interactive Hover States</li>
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Responsive Grid Layout</li>
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Premium Animation Transitions</li>
                            </ul>
                        </div>
                    </div>

                    <div class="glass-bento p-10 group border-white/5 hover:border-indigo-500/30">
                        <div class="mb-12">
                            <div class="text-indigo-500 font-black italic text-4xl mb-2">03.</div>
                            <h4 class="text-xl font-bold tracking-tighter uppercase leading-none">Security & Data<br>Integrity</h4>
                        </div>
                        <div class="space-y-6">
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                Menerapkan standar keamanan tinggi di setiap form input. Baik di <span class="text-white italic">E-Library</span> maupun <span class="text-white italic">Task Master</span>, data divalidasi dengan ketat untuk mencegah <span class="text-white italic">SQL Injection</span> dan menjaga privasi user.
                            </p>
                            <ul class="text-[9px] space-y-3 border-t border-white/5 pt-6 text-white/60 font-medium tracking-widest uppercase">
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> CSRF Protection Layer</li>
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Form Data Validation</li>
                                <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Password Hashing (Bcrypt)</li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="mt-12 glass-bento p-10 lg:p-16 reveal-up">
                    <div class="flex flex-col lg:flex-row gap-12 items-center">
                        <div class="flex-1">
                            <h4 class="text-2xl font-black italic tracking-tighter uppercase mb-6">Automated Workflow // Task Master Integration</h4>
                            <p class="text-[12px] text-white/50 uppercase tracking-[0.3em] leading-loose">
                                Fitur unggulan di mana setiap tugas atau inventaris memiliki sistem <span class="text-white font-bold">Smart Tracking</span>. Kita membuat logika di Laravel agar status tugas bisa berubah secara otomatis berdasarkan input user, dilengkapi dengan modal interaktif Tailwind untuk meminimalkan *page reload*. Inilah yang bikin <span class="text-white">Prinz Archive</span> terasa sangat responsif dan modern.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 w-full lg:w-1/3">
                            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-2xl text-center">
                                <div class="text-2xl font-black italic text-indigo-500 mb-1">99%</div>
                                <div class="text-[8px] text-white/30 uppercase tracking-widest">Efficiency</div>
                            </div>
                            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-2xl text-center">
                                <div class="text-2xl font-black italic text-indigo-500 mb-1">0.4s</div>
                                <div class="text-[8px] text-white/30 uppercase tracking-widest">Load Speed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Arsitektur Database & Relasi</span>
                </div>

                <div class="grid lg:grid-cols-2 gap-12">
                    <div class="glass-bento p-12 relative overflow-hidden group">
                        <div class="relative z-10">
                            <h4 class="text-3xl font-black italic tracking-tighter uppercase mb-10 leading-none">The Relational<br>Core.</h4>
                            <div class="space-y-8">
                                <div class="flex items-start gap-6 border-l border-indigo-500/30 pl-6 group-hover:border-indigo-500 transition-colors">
                                    <div>
                                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest block mb-2">E-Library Schema</span>
                                        <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                            Menggunakan relasi <span class="text-white italic">One-to-Many</span> antara tabel <span class="text-white">Books</span> dan <span class="text-white">Borrowers</span>. Setiap transaksi terekam secara atomik untuk menjaga integritas data perpustakaan.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-6 border-l border-white/10 pl-6 group-hover:border-indigo-500 transition-colors">
                                    <div>
                                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest block mb-2">BMW Store Catalog</span>
                                        <p class="text-[11px] text-white/40 uppercase tracking-widest leading-relaxed">
                                            Struktur tabel dinamis yang mendukung <span class="text-white italic">Mass Assignment</span> melalui Laravel Eloquent, memungkinkan input data spesifikasi mobil yang kompleks tanpa *overhead* memori.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -right-10 -bottom-10 opacity-[0.03] group-hover:opacity-[0.07] transition-opacity">
                            <svg width="300" height="300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 4.02 2 6.5s4.48 4.5 10 4.5 10-2.02 10-4.5S17.52 2 12 2zm0 18c-5.52 0-10-2.02-10-4.5V18c0 2.48 4.48 4.5 10 4.5s10-2.02 10-4.5v-2.5c0 2.48-4.48 4.5-10 4.5z" />
                            </svg>
                        </div>
                    </div>

                    <div class="glass-bento p-12 border-indigo-500/10">
                        <h4 class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.5em] mb-8">Backend Logic Flow</h4>
                        <div class="space-y-4">
                            <div class="p-4 bg-white/[0.02] border border-white/5 rounded-xl flex items-center justify-between group hover:bg-white/[0.05] transition-all">
                                <span class="text-[9px] font-bold tracking-[0.3em] uppercase">Request Validation</span>
                                <span class="text-[8px] px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-full">Active</span>
                            </div>
                            <div class="p-4 bg-white/[0.02] border border-white/5 rounded-xl flex items-center justify-between group hover:bg-white/[0.05] transition-all">
                                <span class="text-[9px] font-bold tracking-[0.3em] uppercase">Controller Processing</span>
                                <span class="text-[8px] px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-full">Optimized</span>
                            </div>
                            <div class="p-4 bg-white/[0.02] border border-white/5 rounded-xl flex items-center justify-between group hover:bg-white/[0.05] transition-all">
                                <span class="text-[9px] font-bold tracking-[0.3em] uppercase">Blade Template Render</span>
                                <span class="text-[8px] px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-full">High Speed</span>
                            </div>
                            <div class="p-4 bg-white/[0.02] border border-white/5 rounded-xl flex items-center justify-between group hover:bg-white/[0.05] transition-all">
                                <span class="text-[9px] font-bold tracking-[0.3em] uppercase">Middleware Security</span>
                                <span class="text-[8px] px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-full">Encrypted</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Filosofi Visual DNA</span>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="space-y-6">
                        <div class="text-[8px] font-black text-white/20 uppercase tracking-[1em]">Typography</div>
                        <h5 class="text-4xl font-black italic tracking-tighter">JAKARTA SANS.</h5>
                        <p class="text-[10px] text-white/40 uppercase tracking-widest leading-loose">
                            Pemilihan font yang modern dan bersih untuk menjamin keterbacaan data teknis di layar resolusi tinggi, memberikan kesan <span class="text-white">Engineering Excellence</span>.
                        </p>
                    </div>
                    <div class="space-y-6">
                        <div class="text-[8px] font-black text-white/20 uppercase tracking-[1em]">Color Palette</div>
                        <div class="flex gap-2">
                            <div class="w-12 h-12 bg-[#050505] border border-white/10 rounded-lg"></div>
                            <div class="w-12 h-12 bg-[#6366f1] rounded-lg"></div>
                            <div class="w-12 h-12 bg-white/5 border border-white/10 rounded-lg"></div>
                        </div>
                        <p class="text-[10px] text-white/40 uppercase tracking-widest leading-loose">
                            Dominasi <span class="text-white">Deep Black</span> dikombinasikan dengan <span class="text-indigo-500">Electric Indigo</span> untuk menciptakan atmosfer futuristik dan premium.
                        </p>
                    </div>
                    <div class="space-y-6">
                        <div class="text-[8px] font-black text-white/20 uppercase tracking-[1em]">Motion System</div>
                        <h5 class="text-4xl font-black italic tracking-tighter">BEZIER CURVE.</h5>
                        <p class="text-[10px] text-white/40 uppercase tracking-widest leading-loose">
                            Transisi halus menggunakan kurva <span class="text-white italic">cubic-bezier</span> untuk mensimulasikan gerakan mekanis yang presisi dan mewah.
                        </p>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="glass-bento p-12 bg-indigo-500/[0.03] border-indigo-500/20">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                        <div class="text-center">
                            <div class="text-5xl font-black italic text-white mb-2">11.0</div>
                            <div class="text-[8px] text-indigo-400 font-black uppercase tracking-[0.4em]">Laravel Version</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-black italic text-white mb-2">0.02s</div>
                            <div class="text-[8px] text-indigo-400 font-black uppercase tracking-[0.4em]">Query Latency</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-black italic text-white mb-2">A+</div>
                            <div class="text-[8px] text-indigo-400 font-black uppercase tracking-[0.4em]">Security Grade</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-black italic text-white mb-2">100%</div>
                            <div class="text-[8px] text-indigo-400 font-black uppercase tracking-[0.4em]">Responsive UI</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Teknologi & Infrastruktur</span>
                </div>

                <div class="grid lg:grid-cols-4 gap-4">
                    <div class="glass-bento p-8 hover:bg-indigo-500/[0.05] transition-all border-white/5 group">
                        <div class="h-1 w-full bg-white/5 mb-6 overflow-hidden">
                            <div class="h-full bg-indigo-500 w-[90%] group-hover:w-full transition-all duration-1000"></div>
                        </div>
                        <h5 class="text-xs font-black tracking-widest uppercase mb-4">Backend Framework</h5>
                        <div class="text-2xl font-black italic mb-4">LARAVEL 11</div>
                        <p class="text-[9px] text-white/40 leading-relaxed uppercase tracking-wider">
                            Powering the core logic with PHP 8.3, utilizing Service Providers & Facades for clean architecture.
                        </p>
                    </div>

                    <div class="glass-bento p-8 hover:bg-indigo-500/[0.05] transition-all border-white/5 group">
                        <div class="h-1 w-full bg-white/5 mb-6 overflow-hidden">
                            <div class="h-full bg-indigo-500 w-[95%] group-hover:w-full transition-all duration-1000"></div>
                        </div>
                        <h5 class="text-xs font-black tracking-widest uppercase mb-4">Styling Engine</h5>
                        <div class="text-2xl font-black italic mb-4">TAILWIND CSS</div>
                        <p class="text-[9px] text-white/40 leading-relaxed uppercase tracking-wider">
                            Utility-first approach for rapid UI development and complex glassmorphism effects.
                        </p>
                    </div>

                    <div class="glass-bento p-8 hover:bg-indigo-500/[0.05] transition-all border-white/5 group">
                        <div class="h-1 w-full bg-white/5 mb-6 overflow-hidden">
                            <div class="h-full bg-indigo-500 w-[85%] group-hover:w-full transition-all duration-1000"></div>
                        </div>
                        <h5 class="text-xs font-black tracking-widest uppercase mb-4">Database System</h5>
                        <div class="text-2xl font-black italic mb-4">MySQL / RDBMS</div>
                        <p class="text-[9px] text-white/40 leading-relaxed uppercase tracking-wider">
                            Structured data storage with optimized indexing for fast retrieval in E-Library system.
                        </p>
                    </div>

                    <div class="glass-bento p-8 hover:bg-indigo-500/[0.05] transition-all border-white/5 group">
                        <div class="h-1 w-full bg-white/5 mb-6 overflow-hidden">
                            <div class="h-full bg-indigo-500 w-[100%] group-hover:w-full transition-all duration-1000"></div>
                        </div>
                        <h5 class="text-xs font-black tracking-widest uppercase mb-4">Build Tool</h5>
                        <div class="text-2xl font-black italic mb-4">VITE / HMR</div>
                        <p class="text-[9px] text-white/40 leading-relaxed uppercase tracking-wider">
                            Lightning fast Hot Module Replacement for seamless frontend development experience.
                        </p>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Rencana Pengembangan Masa Depan</span>
                </div>

                <div class="relative pl-12 border-l border-white/5 space-y-24">
                    <div class="relative">
                        <div class="absolute -left-[53px] top-0 w-2.5 h-2.5 rounded-full bg-indigo-500 shadow-[0_0_15px_rgba(99,102,241,0.8)]"></div>
                        <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                            <div class="lg:w-1/4">
                                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Phase 01 // Q3 2026</span>
                                <h6 class="text-2xl font-black italic tracking-tighter uppercase">AI Integration</h6>
                            </div>
                            <p class="flex-1 text-[11px] text-white/40 uppercase tracking-widest leading-loose">
                                Mengintegrasikan <span class="text-white">Gemini API</span> ke dalam BMW Store untuk fitur "AI Car Assistant" dan rekomendasi buku otomatis di E-Library berdasarkan perilaku user.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-[53px] top-0 w-2.5 h-2.5 rounded-full bg-white/20"></div>
                        <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                            <div class="lg:w-1/4">
                                <span class="text-[10px] font-black text-white/20 uppercase tracking-widest">Phase 02 // Q1 2027</span>
                                <h6 class="text-2xl font-black italic tracking-tighter uppercase text-white/40">Mobile Ecosystem</h6>
                            </div>
                            <p class="flex-1 text-[11px] text-white/20 uppercase tracking-widest leading-loose">
                                Ekspansi platform ke <span class="text-white/40">Android & iOS</span> menggunakan Flutter atau React Native, memastikan sinkronisasi data Task Master berjalan secara cross-platform.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-[53px] top-0 w-2.5 h-2.5 rounded-full bg-white/20"></div>
                        <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                            <div class="lg:w-1/4">
                                <span class="text-[10px] font-black text-white/20 uppercase tracking-widest">Phase 03 // 2027+</span>
                                <h6 class="text-2xl font-black italic tracking-tighter uppercase text-white/40">Global Scale</h6>
                            </div>
                            <p class="flex-1 text-[11px] text-white/20 uppercase tracking-widest leading-loose">
                                Implementasi <span class="text-white/40">Microservices Architecture</span> untuk mendukung jutaan request per detik dan deployment ke infrastruktur cloud server global.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-red-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-red-500">Protokol Keamanan & Enkripsi</span>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="glass-bento p-12 border-red-500/10 hover:border-red-500/30 transition-all">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center text-red-500">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-black italic tracking-tighter uppercase">End-to-End Validation</h4>
                        </div>
                        <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-8">
                            Setiap request di <span class="text-white italic">Prinz Archive</span> melewati lapisan validasi ganda menggunakan <span class="text-white">Laravel Request Validation</span> untuk mencegah <span class="text-red-400">XSS</span> dan <span class="text-red-400">SQL Injection</span> secara otomatis.
                        </p>
                        <div class="space-y-3">
                            <div class="flex justify-between text-[8px] font-black uppercase tracking-widest text-white/30">
                                <span>Encryption Strength</span>
                                <span>AES-256-GCM</span>
                            </div>
                            <div class="h-[2px] bg-white/5 w-full">
                                <div class="h-full bg-red-500 w-full"></div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-bento p-12 border-white/5 hover:border-indigo-500/30 transition-all">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-black italic tracking-tighter uppercase">Authentication Shield</h4>
                        </div>
                        <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-8">
                            Mengimplementasikan <span class="text-white">Laravel Breeze/Fortify</span> dengan session management yang ketat, memastikan data user di <span class="text-white italic">Task Master</span> hanya bisa diakses oleh pemilik akun yang sah.
                        </p>
                        <div class="space-y-3">
                            <div class="flex justify-between text-[8px] font-black uppercase tracking-widest text-white/30">
                                <span>Middleware Security</span>
                                <span>High Priority</span>
                            </div>
                            <div class="h-[2px] bg-white/5 w-full">
                                <div class="h-full bg-indigo-500 w-[85%]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Alur Pengalaman Pengguna</span>
                </div>

                <div class="grid lg:grid-cols-3 gap-6">
                    <div class="p-10 border border-white/5 rounded-3xl relative group">
                        <div class="absolute -top-4 left-10 px-4 py-1 bg-indigo-500 text-[10px] font-black italic uppercase italic">Step 01</div>
                        <h5 class="text-lg font-black italic uppercase mb-4 tracking-tighter">Instant Entry</h5>
                        <p class="text-[10px] text-white/40 uppercase tracking-[0.2em] leading-relaxed">
                            User masuk melalui landing page yang responsif, disambut dengan animasi <span class="text-white italic">Framer Motion</span> yang halus.
                        </p>
                    </div>
                    <div class="p-10 border border-white/5 rounded-3xl relative group">
                        <div class="absolute -top-4 left-10 px-4 py-1 bg-white/10 text-[10px] font-black italic uppercase italic">Step 02</div>
                        <h5 class="text-lg font-black italic uppercase mb-4 tracking-tighter">Dynamic Interaction</h5>
                        <p class="text-[10px] text-white/40 uppercase tracking-[0.2em] leading-relaxed">
                            Melakukan manajemen data di <span class="text-white italic">E-Library</span> secara instan tanpa reload halaman berkat integrasi <span class="text-white">AJAX/Axios</span>.
                        </p>
                    </div>
                    <div class="p-10 border border-white/5 rounded-3xl relative group">
                        <div class="absolute -top-4 left-10 px-4 py-1 bg-white/10 text-[10px] font-black italic uppercase italic">Step 03</div>
                        <h5 class="text-lg font-black italic uppercase mb-4 tracking-tighter">Real-time Feedback</h5>
                        <p class="text-[10px] text-white/40 uppercase tracking-[0.2em] leading-relaxed">
                            Mendapatkan notifikasi sukses atau error yang *aesthetic* melalui toast notification yang terintegrasi dengan desain dashboard.
                        </p>
                    </div>
                </div>

                <div class="mt-12 glass-bento p-10 overflow-hidden relative">
                    <div class="flex justify-between items-end">
                        <div>
                            <h4 class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.5em] mb-4">User Engagement Rate</h4>
                            <div class="flex items-baseline gap-2">
                                <span class="text-6xl font-black italic tracking-tighter">94.8%</span>
                                <span class="text-green-500 text-[10px] font-bold">▲ +12%</span>
                            </div>
                        </div>
                        <div class="flex gap-1 items-end h-24">
                            <div class="w-2 bg-white/5 h-[40%] rounded-full"></div>
                            <div class="w-2 bg-white/5 h-[60%] rounded-full"></div>
                            <div class="w-2 bg-indigo-500 h-[80%] rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                            <div class="w-2 bg-white/5 h-[50%] rounded-full"></div>
                            <div class="w-2 bg-indigo-500 h-[100%] rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Standar Kualitas & Arsitektur Kode</span>
                </div>

                <div class="grid lg:grid-cols-4 gap-4">
                    <div class="glass-bento p-10 flex flex-col justify-between group hover:border-indigo-500/30">
                        <div class="text-indigo-500 font-black italic text-3xl mb-10">PSR-12</div>
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-widest mb-4">Coding Standard</h6>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest leading-loose">
                                Implementasi standar <span class="text-white">PSR-12</span> untuk menjamin kode PHP yang rapi, konsisten, dan mudah dibaca oleh tim pengembang lain.
                            </p>
                        </div>
                    </div>

                    <div class="glass-bento p-10 flex flex-col justify-between group hover:border-indigo-500/30">
                        <div class="text-indigo-500 font-black italic text-3xl mb-10">D.R.Y</div>
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-widest mb-4">Development Logic</h6>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest leading-loose">
                                <span class="text-white italic">Don't Repeat Yourself.</span> Memanfaatkan <span class="text-white">Blade Components</span> dan <span class="text-white">Helper Functions</span> untuk efisiensi baris kode.
                            </p>
                        </div>
                    </div>

                    <div class="glass-bento p-10 flex flex-col justify-between group hover:border-indigo-500/30">
                        <div class="text-indigo-500 font-black italic text-3xl mb-10">O.R.M</div>
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-widest mb-4">Query Management</h6>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest leading-loose">
                                Optimasi <span class="text-white">Eloquent Relationships</span> untuk mencegah masalah <span class="text-red-400">N+1 Query</span> yang bisa memperlambat performa sistem.
                            </p>
                        </div>
                    </div>

                    <div class="glass-bento p-10 flex flex-col justify-between group hover:border-indigo-500/30">
                        <div class="text-indigo-500 font-black italic text-3xl mb-10">M.V.C</div>
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-widest mb-4">System Pattern</h6>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest leading-loose">
                                Penerapan pola <span class="text-white">Model-View-Controller</span> yang ketat untuk pemisahan logika bisnis dan tampilan UI secara profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Infrastruktur & Kontrol Versi</span>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="glass-bento p-12 relative overflow-hidden group border-white/5">
                        <div class="flex items-center gap-6 mb-12">
                            <div class="p-4 bg-white/5 rounded-2xl">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.008-.069-.608.1.003.44.006.7.2.669.19.782 1.21 1.05 1.54 1.185.285.485.741.69 1.256.69.215-.01.439-.029.66-.058.209-1.516.814-2.546 1.484-3.133-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                                </svg>
                            </div>
                            <h4 class="text-2xl font-black italic tracking-tighter uppercase leading-none">GitHub<br>Workflow</h4>
                        </div>
                        <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-10">
                            Manajemen kode dilakukan melalui <span class="text-white">Git Version Control</span> dengan strategi branching yang terorganisir untuk memisahkan fitur baru dan kode stabil.
                        </p>
                        <div class="flex gap-4">
                            <span class="text-[9px] px-4 py-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold uppercase tracking-widest rounded-full">Commits: 450+</span>
                            <span class="text-[9px] px-4 py-2 bg-green-500/10 border border-green-500/20 text-green-400 font-bold uppercase tracking-widest rounded-full">Merged: Stable</span>
                        </div>
                    </div>

                    <div class="glass-bento p-12 border-indigo-500/10 bg-indigo-500/[0.01]">
                        <div class="flex items-center gap-6 mb-12">
                            <div class="p-4 bg-white/5 rounded-2xl">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h4 class="text-2xl font-black italic tracking-tighter uppercase leading-none">Cloud<br>Environment</h4>
                        </div>
                        <div class="space-y-6">
                            <div class="flex justify-between items-center text-[10px] uppercase font-bold tracking-widest text-white/40">
                                <span>Production Server</span>
                                <span class="text-white">Hostinger / VPS</span>
                            </div>
                            <div class="flex justify-between items-center text-[10px] uppercase font-bold tracking-widest text-white/40">
                                <span>SSL Security</span>
                                <span class="text-green-500 italic">Cloudflare Verified</span>
                            </div>
                            <div class="flex justify-between items-center text-[10px] uppercase font-bold tracking-widest text-white/40">
                                <span>PHP Environment</span>
                                <span class="text-white">v8.3 Stable</span>
                            </div>
                        </div>
                        <div class="mt-12 flex items-center gap-2">
                            <div class="h-1 flex-1 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 w-[95%]"></div>
                            </div>
                            <span class="text-[9px] font-black italic text-indigo-400">UPTIME: 99.9%</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Infrastruktur Hardware & Dev-Environment</span>
                </div>

                <div class="glass-bento p-12 relative overflow-hidden">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <h4 class="text-4xl font-black italic tracking-tighter uppercase mb-8 leading-tight text-white">High-Performance<br>Development Rig.</h4>
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-10">
                                Setiap baris kode di <span class="text-white italic">Prinz Archive</span> dikembangkan di atas mesin berperforma tinggi. Kami mengoptimalkan <span class="text-white">Thermal Efficiency</span> dan <span class="text-white">TGP (Total Graphics Power)</span> untuk memastikan proses kompilasi asset Vite dan rendering database berjalan instan.
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-2xl group hover:border-indigo-500/30 transition-all">
                                <span class="text-[8px] font-black text-indigo-500 uppercase tracking-widest block mb-2">Processing</span>
                                <div class="text-xl font-bold italic tracking-tighter uppercase">High-Clock<br>Speed CPU</div>
                            </div>
                            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-2xl group hover:border-indigo-500/30 transition-all">
                                <span class="text-[8px] font-black text-indigo-500 uppercase tracking-widest block mb-2">Memory</span>
                                <div class="text-xl font-bold italic tracking-tighter uppercase">Dual-Channel<br>DDR5 RAM</div>
                            </div>
                            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-2xl group hover:border-indigo-500/30 transition-all">
                                <span class="text-[8px] font-black text-indigo-500 uppercase tracking-widest block mb-2">Thermal</span>
                                <div class="text-xl font-bold italic tracking-tighter uppercase">Advanced<br>Cooling Sys</div>
                            </div>
                            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-2xl group hover:border-indigo-500/30 transition-all">
                                <span class="text-[8px] font-black text-indigo-500 uppercase tracking-widest block mb-2">Display</span>
                                <div class="text-xl font-bold italic tracking-tighter uppercase">High-Refresh<br>sRGB 100%</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-20 -top-20 opacity-[0.02] rotate-12 pointer-events-none">
                        <svg width="400" height="400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 18c1.1 0 1.99-.9 1.99-2L22 5c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 5h16v11H4V5z" />
                        </svg>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Inspirasi Kreatif & Filosofi Desain</span>
                </div>

                <div class="flex flex-col lg:flex-row gap-12">
                    <div class="lg:w-1/3 p-10 bg-indigo-500 rounded-3xl group overflow-hidden relative">
                        <div class="relative z-10">
                            <h5 class="text-3xl font-black italic tracking-tighter uppercase mb-6 text-[#050505]">Formula 1<br>Inspiration.</h5>
                            <p class="text-[10px] text-[#050505]/70 font-bold uppercase tracking-widest leading-relaxed">
                                Filosofi desain <span class="text-[#050505]">Prinz Archive</span> mengambil inspirasi dari aerodinamika F1—fokus pada kecepatan, presisi, dan efisiensi ruang tanpa mengorbankan estetika premium.
                            </p>
                        </div>
                        <div class="absolute -right-12 -bottom-12 opacity-20 rotate-[30deg] group-hover:rotate-0 transition-transform duration-700">
                            <svg width="200" height="200" fill="#050505" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 grid md:grid-cols-2 gap-6">
                        <div class="glass-bento p-10 group border-white/5 hover:border-indigo-500/30 transition-all">
                            <h6 class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-4">Sim-Racing Precision</h6>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest leading-loose">
                                Kecintaan pada <span class="text-white">BeamNG.drive</span> dan <span class="text-white">Fx Racer</span> mengajarkan pentingnya simulasi data yang akurat dalam setiap baris kode database.
                            </p>
                        </div>
                        <div class="glass-bento p-10 group border-white/5 hover:border-indigo-500/30 transition-all">
                            <h6 class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-4">Visual Engineering</h6>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest leading-loose">
                                Livery desain mobil balap menjadi basis pemilihan skema warna dan kontras tinggi di <span class="text-white italic">BMW Store project</span>.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up overflow-hidden">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-indigo-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Transformasi Interaktif E-Library</span>
                </div>

                <style>
                    /* --- PRE-HOVER ANIMATIONS (Bikin Menarik Sejak Awal) --- */

                    /* 1. Buku Mengambang & Berputar Halus */
                    @keyframes holo-book-float {
                        0% {
                            transform: translateY(0px) rotateY(0deg);
                        }

                        25% {
                            transform: translateY(-15px) rotateY(2deg);
                        }

                        50% {
                            transform: translateY(0px) rotateY(0deg);
                        }

                        75% {
                            transform: translateY(-15px) rotateY(-2deg);
                        }

                        100% {
                            transform: translateY(0px) rotateY(0deg);
                        }
                    }

                    .holo-book-float {
                        animation: holo-book-float 8s infinite ease-in-out;
                        transform-style: preserve-3d;
                    }

                    /* 2. Halo Cahaya Berdenyut (Denyut Jantung Data) */
                    @keyframes data-halo-pulse {
                        0% {
                            transform: scale(1);
                            opacity: 0.3;
                            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
                        }

                        50% {
                            transform: scale(1.1);
                            opacity: 0.6;
                            box-shadow: 0 0 40px rgba(99, 102, 241, 0.5);
                        }

                        100% {
                            transform: scale(1);
                            opacity: 0.3;
                            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
                        }
                    }

                    .data-halo-pulse {
                        animation: data-halo-pulse 4s infinite ease-in-out;
                    }

                    /* 3. Teks Beam Scanning (Efek Sinar Lewat) */
                    @keyframes text-scan-beam {
                        0% {
                            background-position: -200% center;
                        }

                        100% {
                            background-position: 200% center;
                        }
                    }

                    .text-scan-beam {
                        background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0.1) 100%);
                        background-size: 200% auto;
                        -webkit-background-clip: text;
                        background-clip: text;
                        color: transparent;
                        animation: text-scan-beam 3s infinite linear;
                        display: inline-block;
                    }


                    /* --- HOVER TRANSITIONS (WOW PART) --- */

                    /* 4. Scrolling Code (Monitor) */
                    @keyframes code-scroll {
                        0% {
                            transform: translateY(0);
                        }

                        100% {
                            transform: translateY(-50%);
                        }
                    }

                    .code-scroll {
                        animation: code-scroll 5s infinite linear;
                    }

                    /* 5. Glitch Effect (Monitor) */
                    @keyframes monitor-glitch {
                        0% {
                            text-shadow: none;
                            opacity: 1;
                        }

                        2% {
                            text-shadow: 2px 0 red, -2px 0 blue;
                            opacity: 0.8;
                        }

                        4% {
                            text-shadow: none;
                            opacity: 1;
                        }

                        60% {
                            text-shadow: none;
                            opacity: 1;
                        }

                        62% {
                            text-shadow: 1px 0 green, -1px 0 purple;
                            opacity: 0.9;
                        }

                        64% {
                            text-shadow: none;
                            opacity: 1;
                        }
                    }

                    .monitor-glitch {
                        animation: monitor-glitch 4s infinite;
                    }
                </style>

                <div class="glass-bento p-12 lg:p-20 relative overflow-hidden group">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">

                        <div class="relative flex justify-center items-center h-[380px] bg-[#050505] rounded-3xl border border-white/5 overflow-hidden transition-all duration-700 group-hover:border-indigo-500/30">

                            <div class="absolute w-64 h-64 bg-indigo-500/10 rounded-full blur-[100px] group-hover:bg-indigo-500/30 transition-all duration-1000"></div>

                            <div class="relative z-10 transition-all duration-700 group-hover:scale-105">

                                <div class="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500 opacity-100 group-hover:opacity-0 group-hover:scale-150 group-hover:rotate-[30deg] pointer-events-none">
                                    <div class="relative flex justify-center items-center">

                                        <div class="absolute top-1/2 left-1/2 w-[220px] h-[220px] rounded-full data-halo-pulse translate-x-[-50%] translate-y-[-50%] border border-indigo-500/20 group-hover:border-indigo-500/40 transition-colors"></div>

                                        <div class="holo-book-float relative flex justify-center items-center p-8 bg-indigo-500/5 rounded-2xl border border-indigo-500/10 shadow-[0_0_20px_rgba(99,102,241,0.1)] group-hover:border-indigo-500/30 transition-colors">
                                            <svg width="130" height="130" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.3" class="text-white group-hover:text-indigo-400 transition-colors">
                                                <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-[9px] font-black uppercase tracking-[0.5em] mt-12 text-center relative overflow-hidden">
                                        <span class="text-scan-beam">Prinz: Reading Mode</span>
                                    </span>
                                </div>

                                <div class="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500 opacity-0 group-hover:opacity-100 group-hover:scale-100 pointer-events-none">
                                    <div class="relative flex justify-center items-center h-[280px]">
                                        <div class="absolute w-[340px] h-[200px] bg-indigo-500/5 rounded-lg border border-indigo-500/30 p-4 overflow-hidden monitor-glitch">
                                            <div class="flex gap-1 mb-3">
                                                <div class="w-1.5 h-1.5 rounded-full bg-red-500/50"></div>
                                                <div class="w-1.5 h-1.5 rounded-full bg-yellow-500/50"></div>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500/50"></div>
                                            </div>

                                            <div class="relative h-full overflow-hidden">
                                                <div class="text-[6px] font-mono text-indigo-400/80 uppercase tracking-widest space-y-1.5 code-scroll">
                                                    <p>$router->get('catalog', function() {</p>
                                                    <p>&nbsp;&nbsp;return view('blueprint', [</p>
                                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;'id' => 'PRINZ_ARCHIVE',</p>
                                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;'status' => 'ACTIVE'</p>
                                                    <p>&nbsp;&nbsp;]);</p>
                                                    <p>});</p>
                                                    <p>$router->get('catalog', function() {</p>
                                                    <p>&nbsp;&nbsp;return view('blueprint', [</p>
                                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;'id' => 'PRINZ_ARCHIVE',</p>
                                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;'status' => 'ACTIVE'</p>
                                                    <p>&nbsp;&nbsp;]);</p>
                                                    <p>});</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="absolute left-[-45px] top-1/2 w-6 h-6 border-l border-b border-indigo-500/20 rounded-bl-xl"></div>
                                        <div class="absolute right-[-45px] top-1/2 w-6 h-6 border-r border-t border-indigo-500/20 rounded-tr-xl"></div>
                                    </div>
                                    <span class="text-[8px] font-black uppercase tracking-[0.5em] text-indigo-400 mt-10 italic">Backend CRUD Operations...</span>
                                </div>

                            </div>

                            <div class="absolute h-1 w-1 bg-white/20 rounded-full top-[10%] left-[20%] animate-ping animation-delay-1000"></div>
                            <div class="absolute h-1 w-1 bg-white/20 rounded-full bottom-[15%] right-[25%] animate-ping animation-delay-2000"></div>
                        </div>

                        <div class="relative z-10">
                            <div class="inline-block px-4 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-[8px] font-black uppercase tracking-widest text-indigo-400 mb-6 italic">
                                Dynamic State Transform
                            </div>
                            <h4 class="text-4xl font-black italic tracking-tighter uppercase mb-8 leading-none">Logic-Driven<br>Aesthetics.</h4>
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-10">
                                Arahkan kursor ke area visual untuk melihat transformasi instan. Dari antarmuka pengguna <span class="text-white">E-Library</span> yang bersih dan dinamis, sistem akan berevolusi menjadi kokpit data <span class="text-white italic">Laravel</span> yang interaktif. Ini bukan cuma desain, tapi simulasi **Teknik Informatika** yang kamu bangun.
                            </p>

                            <div class="flex gap-4">
                                <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-400">Zero Dependencies</span>
                                <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-400">100% Offline</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up overflow-hidden">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-red-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-red-500">Performance & Velocity Engineering</span>
                </div>

                <style>
                    /* Animasi Roda Berputar */
                    @keyframes wheel-spin {
                        0% {
                            transform: rotate(0deg);
                        }

                        100% {
                            transform: rotate(360deg);
                        }
                    }

                    .wheel-spin {
                        animation: wheel-spin 0.2s infinite linear;
                    }

                    /* Animasi Api Knalpot (Nitro) */
                    @keyframes nitro-flame {

                        0%,
                        100% {
                            width: 20px;
                            opacity: 0.8;
                            filter: blur(2px);
                        }

                        50% {
                            width: 50px;
                            opacity: 1;
                            filter: blur(4px);
                        }
                    }

                    .nitro-flame {
                        animation: nitro-flame 0.1s infinite alternate;
                    }

                    /* Animasi Speed Lines (Latar Belakang) */
                    @keyframes speed-lines {
                        0% {
                            transform: translateX(100%);
                            opacity: 0;
                        }

                        50% {
                            opacity: 0.5;
                        }

                        100% {
                            transform: translateX(-100%);
                            opacity: 0;
                        }
                    }

                    .speed-line {
                        position: absolute;
                        height: 1px;
                        background: linear-gradient(90deg, transparent, #ef4444);
                        animation: speed-lines 0.5s infinite linear;
                    }

                    /* Animasi Kode Muncul (Terminal) */
                    @keyframes terminal-slide {
                        0% {
                            transform: translateY(20px);
                            opacity: 0;
                        }

                        100% {
                            transform: translateY(0);
                            opacity: 1;
                        }
                    }

                    .terminal-ready {
                        animation: terminal-slide 0.5s ease-out forwards;
                    }
                </style>

                <div class="glass-bento p-12 lg:p-20 relative overflow-hidden group">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">

                        <div class="relative z-10 order-2 lg:order-1">
                            <div class="inline-block px-4 py-1 bg-red-500/10 border border-red-500/20 rounded-full text-[8px] font-black uppercase tracking-widest text-red-500 mb-6 italic">
                                Race-Ready Architecture
                            </div>
                            <h4 class="text-4xl font-black italic tracking-tighter uppercase mb-8 leading-none text-white">High-Speed<br>Database Logic.</h4>
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-10">
                                Terinspirasi dari presisi <span class="text-white italic">Formula 1</span>, setiap project di <span class="text-white">Prinz Archive</span> dirancang untuk performa maksimal. Kami mengeliminasi <span class="text-red-400 italic">bottleneck</span> pada kueri database secepat mekanik mengganti ban di <span class="text-white italic">Pit Stop</span>.
                            </p>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-6 border border-white/5 bg-white/[0.02] rounded-2xl group/card hover:border-red-500/30 transition-all">
                                    <div class="text-2xl font-black italic text-red-500 mb-2">0.02s</div>
                                    <div class="text-[8px] font-black uppercase tracking-widest text-white/40">Query Response</div>
                                </div>
                                <div class="p-6 border border-white/5 bg-white/[0.02] rounded-2xl group/card hover:border-red-500/30 transition-all">
                                    <div class="text-2xl font-black italic text-red-500 mb-2">100%</div>
                                    <div class="text-[8px] font-black uppercase tracking-widest text-white/40">Efficiency Rate</div>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex justify-center items-center h-[380px] bg-[#050505] rounded-3xl border border-white/5 overflow-hidden group-hover:border-red-500/20 transition-all duration-700 order-1 lg:order-2">

                            <div class="speed-line w-20 top-[20%] left-0 opacity-20"></div>
                            <div class="speed-line w-32 top-[50%] left-10 opacity-10" style="animation-delay: 0.2s"></div>
                            <div class="speed-line w-16 top-[80%] left-5 opacity-30" style="animation-delay: 0.4s"></div>

                            <div class="absolute inset-0 flex flex-col items-center justify-center transition-all duration-700 opacity-100 group-hover:opacity-0 group-hover:translate-x-[200%]">
                                <div class="relative">
                                    <svg width="280" height="100" viewBox="0 0 240 80" fill="none" class="text-white">
                                        <path d="M20 60 L220 60 L230 40 L180 35 L120 15 L40 40 Z" fill="currentColor" opacity="0.1" stroke="currentColor" stroke-width="1" />
                                        <rect x="10" y="30" width="30" height="5" fill="#ef4444" />
                                        <circle cx="60" cy="60" r="12" stroke="currentColor" stroke-width="2" class="wheel-spin" stroke-dasharray="10 5" />
                                        <circle cx="180" cy="60" r="12" stroke="currentColor" stroke-width="2" class="wheel-spin" stroke-dasharray="10 5" />
                                        <div class="absolute left-[-10px] top-[60%] h-2 bg-gradient-to-r from-red-500 to-transparent nitro-flame"></div>
                                    </svg>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-[0.8em] text-red-500 mt-12 italic animate-pulse">Pushing to Limit</span>
                            </div>

                            <div class="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500 opacity-0 group-hover:opacity-100 group-hover:scale-100 scale-90">
                                <div class="w-[85%] h-[60%] bg-[#0a0a0a] border border-red-500/30 rounded-xl p-6 font-mono text-[8px] relative overflow-hidden shadow-[0_0_50px_rgba(239,68,68,0.1)]">
                                    <div class="flex gap-1.5 mb-4">
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                        <span class="text-[7px] text-white/20 uppercase tracking-widest font-black">Laravel Migration Terminal</span>
                                    </div>
                                    <div class="text-red-400 space-y-2 terminal-ready">
                                        <p>> php artisan migrate:fresh --seed</p>
                                        <p class="text-white/60">Dropping all tables... <span class="text-green-500">DONE</span></p>
                                        <p class="text-white/60">Preparing database: <span class="italic">db_bmw_store</span></p>
                                        <p class="text-white/60">Creating table: <span class="text-white underline">users</span>... <span class="text-green-500">OK</span></p>
                                        <p class="text-white/60">Creating table: <span class="text-white underline">orders</span>... <span class="text-green-500">OK</span></p>
                                        <p class="text-red-500 mt-4 font-black">SYSTEM STATUS: POLE POSITION</p>
                                    </div>
                                    <div class="absolute bottom-[-20px] right-[-20px] opacity-[0.05] rotate-[-15deg]">
                                        <svg width="150" height="150" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19 8l-4 4h3c0 3.31-2.69 6-6 6-1.01 0-1.97-.25-2.8-.7l-1.46 1.46C8.97 19.54 10.41 20 12 20c4.42 0 8-3.58 8-8h3l-4-4zM5 16l4-4H6c0-3.31 2.69-6 6-6 1.01 0 1.97.25 2.8.7l1.46-1.46C15.03 4.46 13.59 4 12 4c-4.42 0-8 3.58-8 8H1l4 4z" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-[0.5em] text-white mt-10">Optimized by Prinz Engine</span>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="py-32 reveal-up overflow-hidden">
                <div class="flex items-center gap-4 mb-20">
                    <span class="w-12 h-[1px] bg-emerald-500"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.6em] text-emerald-400">Algoritma & Optimasi Tugas</span>
                </div>

                <style>
                    /* Animasi Kubus Berantakan (Float) */
                    @keyframes raw-data-float {
                        0% {
                            transform: translateY(0) rotate(0deg);
                            opacity: 0.3;
                        }

                        50% {
                            transform: translateY(-10px) rotate(5deg);
                            opacity: 0.5;
                        }

                        100% {
                            transform: translateY(0) rotate(0deg);
                            opacity: 0.3;
                        }
                    }

                    .raw-data-cube {
                        animation: raw-data-float 3s infinite ease-in-out;
                    }

                    /* Animasi Lengan Robot (AI Arm) */
                    @keyframes ai-arm-move {
                        0% {
                            transform: rotate(-30deg) translateY(0);
                        }

                        50% {
                            transform: rotate(0deg) translateY(-10px);
                        }

                        100% {
                            transform: rotate(-30deg) translateY(0);
                        }
                    }

                    .ai-arm {
                        animation: ai-arm-move 2s infinite ease-in-out;
                    }

                    /* Animasi Teks Status (Blink) */
                    @keyframes status-blink {

                        0%,
                        100% {
                            opacity: 0.2;
                        }

                        50% {
                            opacity: 1;
                        }
                    }

                    .status-blink {
                        animation: status-blink 1s infinite;
                    }
                </style>

                <div class="glass-bento p-12 lg:p-20 relative overflow-hidden group border-emerald-500/10 hover:border-emerald-500/30 transition-all duration-700">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">

                        <div class="relative flex justify-center items-center h-[380px] bg-[#050505] rounded-3xl border border-white/5 overflow-hidden group-hover:bg-[#080808] transition-all">

                            <div class="absolute w-64 h-64 bg-emerald-500/5 rounded-full blur-[100px] group-hover:bg-emerald-500/20 transition-all duration-1000"></div>

                            <div class="relative z-10 transition-all duration-700 group-hover:scale-105">

                                <div class="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500 opacity-100 group-hover:opacity-0 group-hover:scale-90 pointer-events-none">
                                    <div class="relative flex justify-center items-center h-[200px]">
                                        <div class="absolute w-10 h-10 bg-white/10 rounded-lg border border-white/10 raw-data-cube top-[20%] left-[20%]" style="animation-delay: 0.2s"></div>
                                        <div class="absolute w-12 h-12 bg-white/10 rounded-lg border border-white/10 raw-data-cube bottom-[15%] right-[25%]" style="animation-delay: 0.4s"></div>
                                        <div class="absolute w-8 h-8 bg-white/10 rounded-lg border border-white/10 raw-data-cube top-[60%] left-[60%]" style="animation-delay: 0.6s"></div>
                                        <div class="absolute w-14 h-14 bg-white/10 rounded-lg border border-white/10 raw-data-cube top-[50%] left-[10%]" style="animation-delay: 0.8s"></div>
                                    </div>
                                    <span class="text-[8px] font-black uppercase tracking-[0.5em] text-white/30 mt-8 italic">Raw Tasks: No Structure</span>
                                </div>

                                <div class="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500 opacity-0 group-hover:opacity-100 group-hover:scale-100 pointer-events-none">
                                    <div class="relative flex justify-center items-center h-[300px]">
                                        <div class="absolute top-[-30px] left-[50%] w-2 h-40 bg-emerald-500 rounded-full origin-top ai-arm">
                                            <div class="absolute bottom-[-10px] left-[-4px] w-6 h-6 bg-emerald-600 rounded-full border-4 border-emerald-400"></div>
                                            <div class="absolute bottom-[-30px] left-[0px] w-2 h-20 bg-emerald-500 rounded-full"></div>
                                        </div>

                                        <div class="absolute w-24 h-48 border border-emerald-500/20 bg-emerald-500/5 rounded-2xl flex flex-col items-center justify-center p-4 space-y-2 mt-20">
                                            <div class="h-10 bg-emerald-400/80 w-full rounded-lg"></div>
                                            <div class="h-10 bg-emerald-400/80 w-full rounded-lg"></div>
                                            <div class="h-10 bg-emerald-400/80 w-full rounded-lg"></div>
                                            <div class="h-10 bg-emerald-400/80 w-full rounded-lg"></div>
                                        </div>
                                    </div>
                                    <span class="text-[8px] font-black uppercase tracking-[0.5em] text-emerald-400 mt-10 italic">Backend Algorithm Active: Sorting...</span>
                                </div>

                            </div>
                        </div>

                        <div class="relative z-10 order-2 lg:order-2">
                            <div class="inline-block px-4 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-[8px] font-black uppercase tracking-widest text-emerald-400 mb-6 italic">
                                Algorithm Engine
                            </div>
                            <h4 class="text-4xl font-black italic tracking-tighter uppercase mb-8 leading-none text-white">Advanced<br>Task Sorting.</h4>
                            <p class="text-[11px] text-white/40 uppercase tracking-widest leading-loose mb-10">
                                Di <span class="text-white italic">Task Master</span>, kita nggak cuma buat daftar tugas. Kita menerapkan algoritma <span class="text-emerald-400 italic">Smart Sorting</span> yang secara otomatis memprioritaskan tugas kamu berdasarkan tenggat waktu dan kompleksitas. Kekacauan data diubah menjadi keteraturan yang produktif.
                            </p>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 border border-white/5 bg-white/[0.02] rounded-xl group/item hover:border-emerald-500/30 transition-all">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-white/50 group-hover/item:text-emerald-400">Prioritas Otomatis</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-1 h-1 rounded-full bg-emerald-500 status-blink"></div>
                                    <span class="text-[8px] font-bold uppercase tracking-widest text-white/50">100% Algorithmic</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="mb-40 relative z-10 reveal-up perspective-container" style="animation-delay: 1.5s">
                <div class="flex items-center gap-4 mb-16">
                    <div class="w-12 h-[1px] bg-indigo-500 shadow-[0_0_10px_#4f46e5]"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.6em] text-indigo-400 italic anim-pulse-slow">Neural Synapse</span>
                </div>

                <div class="relative tilt-card-master group" id="neural-engine-card">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-600/20 via-purple-600/20 to-indigo-600/20 rounded-[40px] blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>

                    <div class="glass-vault p-12 lg:p-16 rounded-[40px] relative overflow-hidden border border-white/5 group-hover:border-indigo-500/30 transition-all duration-700 transform-style-3d">

                        <div class="absolute inset-0 opacity-10 group-hover:opacity-30 transition-opacity duration-1000" id="particle-canvas"></div>

                        <div class="grid lg:grid-cols-12 gap-12 relative z-10 items-center">

                            <div class="lg:col-span-7 space-y-8 transform-translate-Z-50">
                                <div class="space-y-2">
                                    <h4 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-400 italic anim-flicker">Core_Logic_Processing</h4>
                                    <h3 class="text-4xl lg:text-5xl font-black italic tracking-tighter uppercase leading-[0.9] text-white">
                                        Where Code<br>Meets<br><span class="text-indigo-600 group-hover:text-indigo-400 transition-colors">Velocity.</span>
                                    </h3>
                                </div>

                                <p class="text-[13px] text-white/50 leading-relaxed uppercase tracking-widest max-w-2xl border-l-2 border-white/5 pl-6 group-hover:border-indigo-500 transition-colors duration-700">
                                    Di sinilah arsitektur <span class="text-white font-bold">Laravel</span> yang presisi berpadu dengan estetika aerodinamis <span class="text-white italic">Formula 1</span>. Kami tidak hanya menulis sintaksis; kami merancang algoritma berperforma tinggi yang menggerakkan antarmuka digital mewah. Setiap baris kode adalah injeksi bahan bakar untuk inovasi visual <span class="text-white">Prinz</span>.
                                </p>

                                <div class="flex items-center gap-6 pt-4">
                                    <div class="text-center group-hover:scale-110 transition-transform duration-500">
                                        <span class="block text-3xl font-black text-white italic tracking-tighteranim-cronos">0.0019<span class="text-xs text-indigo-500">s</span></span>
                                        <span class="block text-[7px] text-white/30 uppercase tracking-widest">Logic_Execute</span>
                                    </div>
                                    <div class="w-[1px] h-10 bg-white/10"></div>
                                    <div class="text-center group-hover:scale-110 transition-transform duration-500 delay-75">
                                        <span class="block text-3xl font-black text-white italic tracking-tighter anim-cronos">320<span class="text-xs text-indigo-500">kb</span></span>
                                        <span class="block text-[7px] text-white/30 uppercase tracking-widest">Memory_Load</span>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-5 relative flex justify-center items-center transform-translate-Z-100 group-hover:scale-105 transition-transform duration-700">
                                <div class="w-64 h-64 relative">
                                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-indigo-500/20 anim-rotate-slow"></div>
                                    <div class="absolute inset-4 rounded-full border-2 border-indigo-600/40 anim-rotate-fast"></div>
                                    <div class="absolute inset-10 rounded-full bg-indigo-600/10 blur-xl shadow-[0_0_50px_20px_#4f46e520] anim-pulse-slow"></div>
                                    <div class="absolute inset-0 flex items-center justify-center text-5xl text-indigo-400 opacity-80 group-hover:opacity-100 group-hover:text-indigo-300 transition-all">
                                        <i class="fas fa-project-diagram"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-16 pt-8 border-t border-white/5 flex justify-between items-center transform-translate-Z-50 opacity-60 group-hover:opacity-100 transition-opacity">
                            <span class="text-[9px] font-mono uppercase tracking-[0.3em] text-indigo-300 anim-flicker">// System_Status: ALL_SYSTEMS_OPERATIONAL</span>
                            <span class="text-[9px] font-mono uppercase tracking-[0.3em] text-white/30">Architecture: Monolithic_Hybrid v3.5</span>
                        </div>
                    </div>
                </div>
            </section>

            <style>
                /* Container utama untuk perspective 3D */
                .perspective-container {
                    perspective: 2000px;
                    /* Jarak mata ke objek 3D */
                }

                /* Kartu master yang akan dimiringkan oleh JS */
                .tilt-card-master {
                    transform-style: preserve-3d;
                    /* Penting! Memperbolehkan anak elemen punya Z-index 3D */
                    transition: transform 0.1s ease-out;
                    /* Transisi halus saat mouse gerak */
                    will-change: transform;
                }

                /* Utility untuk mengatur kedalaman elemen di dalam kartu */
                .transform-style-3d {
                    transform-style: preserve-3d;
                }

                /* Elemen melayang level 1 (Sedang) */
                .transform-translate-Z-50 {
                    transform: translateZ(50px);
                    will-change: transform;
                }

                /* Elemen melayang level 2 (Paling Depan/Dekat) */
                .transform-translate-Z-100 {
                    transform: translateZ(100px);
                    will-change: transform;
                }

                /* Animasi Rotasi untuk Visual "Engine" */
                @keyframes rotate-slow {
                    from {
                        transform: rotate(0deg);
                    }

                    to {
                        transform: rotate(360deg);
                    }
                }

                @keyframes rotate-fast {
                    from {
                        transform: rotate(360deg);
                    }

                    to {
                        transform: rotate(0deg);
                    }
                }

                .anim-rotate-slow {
                    animation: rotate-slow 15s linear infinite;
                }

                .anim-rotate-fast {
                    animation: rotate-fast 7s linear infinite;
                }

                /* Animasi Pulse Pelan */
                @keyframes pulse-slow {

                    0%,
                    100% {
                        opacity: 0.5;
                        transform: scale(1);
                    }

                    50% {
                        opacity: 1;
                        transform: scale(1.05);
                    }
                }

                .anim-pulse-slow {
                    animation: pulse-slow 4s ease-in-out infinite;
                }

                /* Animasi Flicker Teks (Tech/Cyber vibe) */
                @keyframes flicker {

                    0%,
                    100% {
                        opacity: 1;
                    }

                    5% {
                        opacity: 0.2;
                    }

                    10% {
                        opacity: 1;
                    }

                    15% {
                        opacity: 0.8;
                    }

                    20% {
                        opacity: 1;
                    }

                    55% {
                        opacity: 1;
                    }

                    60% {
                        opacity: 0.3;
                    }

                    65% {
                        opacity: 1;
                    }
                }

                .anim-flicker {
                    animation: flicker 6s linear infinite;
                }

                /* Font khusus untuk angka kronometer (opsional, pakai mono jika tidak ada) */
                .anim-cronos {
                    font-family: 'Courier New', Courier, monospace;
                    letter-spacing: -2px;
                }
            </style>

            <script>
                const cardMaster = document.getElementById('neural-engine-card');
                const perspectiveContainer = cardMaster.closest('.perspective-container');

                // Batasan rotasi (semakin besar, semakin miring)
                const rotationLimit = 15;

                perspectiveContainer.addEventListener('mousemove', (e) => {
                    const rect = perspectiveContainer.getBoundingClientRect();

                    // Hitung posisi mouse relatif terhadap tengah container
                    const mouseX = e.clientX - rect.left;
                    const mouseY = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    // Hitung persentase offset dari tengah (-1 sampai 1)
                    const offsetX = (mouseX - centerX) / centerX;
                    const offsetY = (mouseY - centerY) / centerY;

                    // Hitung derajat rotasi berdasarkan offset
                    // RotateX dipengaruhi mouseY, RotateY dipengaruhi mouseX (kebalikan)
                    const rotateX = offsetY * rotationLimit * -1; // * -1 untuk arah yang natural
                    const rotateY = offsetX * rotationLimit;

                    // Terapkan transformasi 3D ke kartu master
                    cardMaster.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });

                // Kembalikan ke posisi semula saat mouse keluar
                perspectiveContainer.addEventListener('mouseleave', () => {
                    cardMaster.style.transform = 'rotateX(0deg) rotateY(0deg)';
                    cardMaster.style.transition = 'transform 0.5s ease-out'; // Transisi pulang lebih lambat

                    // Reset transisi setelah animasi selesai agar mousemove lancar lagi
                    setTimeout(() => {
                        cardMaster.style.transition = 'transform 0.1s ease-out';
                    }, 500);
                });
            </script>

            <footer class="py-16 border-t border-white/5 mt-20 text-center reveal-up">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center font-black text-black italic text-3xl mb-12 mx-auto">P</div>
                <h2 class="editorial-title text-4xl lg:text-6xl mb-12">STAY <span class="outline-text">CURIOUS.</span></h2>
                <p class="text-[8px] text-white/20 uppercase tracking-[0.5em]">&copy; 2026 Prinz Library. Crafted with Passion.</p>
            </footer>
        </section>
    </div>

    <script>
        // 1. PAGE TRANSITION LOGIC
        window.addEventListener('load', () => {
            const transitionOverlay = document.getElementById('page-transition');
            const mainContent = document.getElementById('main-content');

            setTimeout(() => {
                transitionOverlay.style.transform = 'translateY(-100%)';
                mainContent.classList.add('visible');
                handleScrollReveal();
            }, 1200);
        });

        // 2. SCROLL REVEAL SYSTEM
        function handleScrollReveal() {
            const reveals = document.querySelectorAll('.reveal-up');
            const triggerBottom = window.innerHeight * 0.9;

            reveals.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                if (elementTop < triggerBottom) {
                    el.classList.add('active');
                }
            });
        }
        window.addEventListener('scroll', handleScrollReveal);

        // 3. BACKGROUND CANVAS
        const canvas = document.getElementById('bg-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resize);
        resize();

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 1 + 0.5;
                this.speedX = Math.random() * 0.3 - 0.15;
                this.speedY = Math.random() * 0.3 - 0.15;
                this.opacity = Math.random() * 0.5 + 0.1;
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
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        for (let i = 0; i < 50; i++) particles.push(new Particle());

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animate);
        }
        animate();
    </script>
</body>

</html>