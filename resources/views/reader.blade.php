<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $buku->judul }} | PRINZ</title>

   <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent: #6366f1;
            --bg: #050505;
        }

        /* --- Animations --- */
        @keyframes pageIn {
            from {
                opacity: 0;
                transform: translateY(20px);
                filter: blur(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        @keyframes errorEntry {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
                filter: blur(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        /* --- Global Styles --- */
        body {
            background: var(--bg);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            animation: pageIn 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        .bg-mesh {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 10% 10%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(168, 85, 247, 0.1) 0%, transparent 40%);
            pointer-events: none;
            z-index: -1;
        }

        /* --- Layout Containers --- */
        .luxury-container {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 24px;
            min-height: 75vh;
        }

        .info-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 40px;
            padding: 32px;
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.8s ease;
        }

        .info-panel.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .luxury-frame {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 48px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 1);
            min-height: 600px;
        }

        .viewer-wrapper,
        #bookIframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        #status-overlay {
            position: absolute;
            inset: 0;
            z-index: 50;
            background: #080808;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.6s ease;
        }

        /* --- Components --- */
        .btn-premium {
            display: inline-block;
            background: white;
            color: black;
            padding: 18px 42px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.4em;
            border-radius: 20px;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-premium:hover {
            background: var(--accent);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.2);
        }

        .detail-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 16px;
            transition: 0.3s;
        }

        /* --- Scrollbars --- */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #050505;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, transparent, var(--accent), transparent);
            border-radius: 10px;
        }

        .animate-error-entry {
            animation: errorEntry 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<body class="selection:bg-indigo-500/30">
    <div class="bg-mesh"></div>

    <div class="max-w-[1400px] mx-auto w-full flex-grow flex flex-col px-4 md:px-8 py-6 relative z-10">
        <header class="mb-16 flex flex-col md:flex-row justify-between items-start md:items-end gap-8 relative group/header p-2">
            <div class="absolute -top-6 left-0 w-0 h-[1px] bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent group-hover/header:w-full transition-all duration-1000 ease-in-out"></div>
            <div class="absolute -top-[25px] left-1/2 -translate-x-1/2 text-[6px] font-black tracking-[1em] text-white/5 uppercase opacity-0 group-hover/header:opacity-100 group-hover/header:top-[-20px] transition-all duration-1000">
                Authentic Digital Space
            </div>

            <div class="relative">
                <div class="flex items-center gap-6 mb-6">
                    <div class="flex items-center gap-3 group/label cursor-default">
                        <div class="relative flex items-center justify-center">
                            <span class="w-1 h-1 rounded-full bg-indigo-500 group-hover/label:scale-[2.5] transition-all duration-500"></span>
                            <span class="absolute w-3 h-3 rounded-full border border-indigo-500/0 group-hover/label:border-indigo-500/50 group-hover/label:scale-150 transition-all duration-500"></span>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-[0.4em] text-indigo-400 group-hover/label:text-white group-hover/label:tracking-[0.5em] transition-all duration-500">Koleksi Pribadi</span>
                    </div>

                    <div class="h-[1px] w-8 bg-white/5"></div>

                    <div class="flex items-center gap-2 group/loc cursor-default">
                        <span class="text-[8px] font-medium uppercase tracking-[0.2em] text-white/20 group-hover/loc:text-white/60 transition-colors">
                            Lokasi: <span class="text-white/40 group-hover/loc:text-indigo-300 transition-colors">Malang, ID</span>
                        </span>
                        <span class="text-[7px] text-indigo-500/0 group-hover/loc:text-indigo-500/100 transition-all duration-500 translate-x-[-10px] group-hover/loc:translate-x-0">●</span>
                    </div>
                </div>

                <div class="flex items-start gap-8 group/title cursor-default">
                    <div class="hidden sm:block border-l-2 border-white/5 group-hover/title:border-indigo-500/50 pl-5 py-2 transition-all duration-700 overflow-hidden">
                        <p class="text-[9px] font-black text-white/10 tracking-[0.3em] uppercase mb-1 group-hover/title:translate-y-[-2px] transition-transform">Seri.</p>
                        <p class="text-[18px] font-light text-white/20 group-hover/title:text-white leading-none tracking-tighter">025</p>
                    </div>

                    <div class="relative">
                        <h1 class="text-6xl sm:text-7xl font-black uppercase tracking-tighter leading-[0.8] mb-4 transition-all duration-700 group-hover/title:tracking-[-0.04em]">
                            <span class="block group-hover/title:translate-x-2 transition-transform duration-700 group-hover/title:text-indigo-50 transition-colors">PRIVATE</span>
                            <span class="relative inline-block" style="-webkit-text-stroke: 1px rgba(255,255,255,0.2); color: transparent; font-style: italic;">
                                COLLECTION.
                                <span class="absolute inset-0 w-0 group-hover/title:w-full transition-all duration-1000 bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent skew-x-[30deg]"></span>
                            </span>
                        </h1>
                        <div class="flex items-center gap-3 opacity-60 group-hover/title:opacity-100 transition-opacity duration-700">
                            <span class="w-2 h-[1px] bg-indigo-500"></span>
                            <p class="text-[10px] font-medium text-white/40 tracking-wider group-hover/title:text-white/70 transition-colors uppercase">
                                Kurasi digital <span class="italic text-indigo-400/80">oleh Prinz</span> untuk kenyamanan membaca.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-10">
                <div class="text-right border-r border-white/5 group-hover/header:border-indigo-500/30 pr-8 transition-all duration-700 relative py-1">
                    <div class="absolute top-0 right-0 w-1 h-1 border-t border-r border-white/0 group-hover/header:border-indigo-500/50 transition-all duration-700"></div>

                    <p class="text-[8px] font-bold text-white/10 uppercase tracking-[0.4em] mb-2 group-hover/header:text-indigo-400/50 transition-colors">Akses Terverifikasi</p>
                    <p class="text-md font-black text-white/90 tracking-tight uppercase mb-1 group-hover/header:tracking-widest transition-all duration-500">
                        <span class="text-white/40 font-light">Halo,</span> {{Auth::user()->name}}  
                    </p>
                    <div class="flex items-center justify-end gap-2 overflow-hidden">
                        <p class="text-[9px] font-medium text-indigo-300/40 italic group-hover/header:text-indigo-300 transition-colors duration-700 truncate max-w-[200px]">
                            sedang meninjau: "{{ $buku->judul }}"
                        </p>
                        <span class="w-1 h-1 bg-indigo-500/50 rounded-full animate-pulse"></span>
                    </div>
                </div>

                <div class="relative group/btn">
                    <a href="{{ route('beranda') }}" class="relative px-10 py-4 bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden transition-all duration-500 group-hover/btn:border-indigo-500/50 group-hover/btn:shadow-[0_0_40px_rgba(99,102,241,0.2)] group-hover/btn:-translate-y-1.5 block">
                        <div class="absolute inset-0 bg-white translate-y-full group-hover/btn:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1)"></div>

                        <div class="relative z-10 flex items-center gap-3">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-white group-hover/btn:text-black transition-colors duration-500">Kembali</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white group-hover/btn:text-black transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-3/4 h-4 bg-indigo-500/0 group-hover/btn:bg-indigo-500/10 blur-xl transition-all duration-700"></div>
                </div>
            </div>
        </header>

        <div class="luxury-container mb-12">
            <aside id="infoPanel" class="info-panel flex flex-col gap-8 opacity-0 translate-x-[-20px] transition-all duration-1000 ease-out h-full overflow-hidden group/panel">

                <div class="flex items-center justify-between border-b border-white/5 pb-4 group/head cursor-default relative overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-indigo-500/5 to-transparent -translate-x-full group-hover/head:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                    <div class="flex items-center gap-3 relative z-10">
                        <div class="relative">
                            <span class="absolute inset-0 bg-indigo-500 rounded-full blur-md opacity-0 group-hover/head:opacity-100 group-hover/head:scale-150 transition-all duration-500"></span>
                            <span class="relative block w-1.5 h-1.5 bg-indigo-500 rounded-full shadow-[0_0_10px_#6366f1] group-hover/head:bg-white transition-all duration-500"></span>
                        </div>

                        <p class="text-[9px] font-black uppercase tracking-[0.4em] text-white/30 group-hover/head:text-indigo-400 group-hover/head:tracking-[0.5em] transition-all duration-500 ease-out">
                            Detail Koleksi
                        </p>
                    </div>

                    <div class="relative overflow-hidden z-10">
                        <span class="block text-[7px] font-bold text-white/10 uppercase tracking-widest italic transform transition-all duration-500 group-hover/head:-translate-y-full group-hover/head:opacity-0">
                            Pilihan Prinz
                        </span>
                        <span class="absolute inset-0 text-[7px] font-bold text-indigo-400 uppercase tracking-widest italic transform translate-y-full opacity-0 transition-all duration-500 group-hover/head:translate-y-0 group-hover/head:opacity-100">
                            Exclusive
                        </span>
                    </div>
                </div>

                <div class="space-y-3">
                    <h2 class="text-4xl font-black tracking-tighter leading-[0.9] text-white italic uppercase transition-all duration-700 group-hover/panel:tracking-[-0.02em]">
                        {{ $buku->judul }}
                    </h2>
                    <div class="flex items-center gap-2">
                        <div class="h-[1px] w-4 bg-indigo-500/50 group-hover/panel:w-8 transition-all duration-700"></div>
                        <p class="text-[10px] font-medium text-indigo-400/60 tracking-[0.2em] uppercase">
                            Karya: {{ $buku->penulis }}
                        </p>
                    </div>
                </div>

                <div class="relative flex-grow overflow-hidden flex flex-col gap-2">
                    <p class="text-[8px] font-bold text-white/20 uppercase tracking-[0.3em]">Tentang Buku Ini</p>

                    <div class="relative group/scroll flex-grow overflow-hidden flex flex-col">
                        <div class="custom-scrollbar overflow-y-auto pr-6 h-full max-h-[280px] scroll-smooth relative z-10 bg-transparent">
                            <p class="text-[11px] leading-[1.8] text-white/30 text-justify italic font-light hover:text-white/70 transition-colors duration-700">
                                "{{ $buku->deskripsi }}"
                            </p>

                            <div class="mt-8 mb-4 flex items-center justify-between opacity-[0.07]">
                                <div class="flex items-center gap-3">
                                    <span class="w-4 h-[1px] bg-white"></span>
                                    <span class="text-[7px] font-bold uppercase tracking-[0.4em]">Detail Arsip</span>
                                </div>
                                <p class="text-[6px] font-mono tracking-widest uppercase italic italic">Ref. {{ date('Y') }}</p>
                            </div>
                        </div>

                        <div class="absolute right-0 top-4 bottom-4 w-[1px] bg-white/[0.03]"></div>
                    </div>

                    <style>
                        /* Scrollbar yang hampir tidak terlihat kecuali digunakan */
                        .custom-scrollbar::-webkit-scrollbar {
                            width: 2px;
                        }

                        .custom-scrollbar::-webkit-scrollbar-track {
                            background: transparent;
                        }

                        .custom-scrollbar::-webkit-scrollbar-thumb {
                            background: rgba(255, 255, 255, 0.05);
                            border-radius: 20px;
                        }

                        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
                            background: rgba(255, 255, 255, 0.15);
                            transition: background 0.5s ease;
                        }
                    </style>

                    <div class="absolute bottom-0 left-0 w-full h-8 bg-gradient-to-t from-[#050505] to-transparent pointer-events-none"></div>
                </div>

                <div class="mt-auto space-y-4 pt-6 border-t border-white/5 relative">
                    <div class="flex justify-between items-center group/item cursor-default">
                        <span class="text-[8px] font-bold text-white/20 uppercase tracking-widest group-hover/item:text-indigo-400 group-hover/item:translate-x-1 transition-all duration-500">Kategori</span>
                        <div class="flex-grow mx-4 h-[1px] border-b border-dashed border-white/10"></div>
                        <span class="text-[10px] font-black text-white/60 tracking-tighter uppercase group-hover/item:text-white transition-colors">{{ $buku->kategori }}</span>
                    </div>

                    <div class="flex justify-between items-center group/item cursor-default">
                        <span class="text-[8px] font-bold text-white/20 uppercase tracking-widest group-hover/item:text-indigo-400 group-hover/item:translate-x-1 transition-all duration-500">Penerbit</span>
                        <div class="flex-grow mx-4 h-[1px] border-b border-dashed border-white/10"></div>
                        <span class="text-[10px] font-black text-white/60 tracking-tighter uppercase group-hover/item:text-white transition-colors">{{ $buku->penerbit }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-white/5 group/footer-info cursor-default relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/0 via-indigo-500/[0.03] to-transparent -translate-x-full group-hover/footer-info:translate-x-full transition-transform duration-[1.5s] ease-in-out"></div>

                    <div class="space-y-1 relative z-10">
                        <p class="text-[7px] font-bold tracking-[0.5em] text-white/20 group-hover/panel:text-indigo-500/40 group-hover/footer-info:text-indigo-400 group-hover/footer-info:tracking-[0.6em] transition-all duration-700 uppercase">
                            Ruang Pribadi
                        </p>
                        <div class="flex items-center gap-2">
                            <span class="w-0 h-[1px] bg-indigo-500/40 group-hover/footer-info:w-3 transition-all duration-700"></span>
                            <p class="text-[6px] text-white/10 uppercase tracking-widest group-hover/footer-info:text-white/40 transition-colors duration-700">
                                Pengalaman Digital
                            </p>
                        </div>
                    </div>

                    <div class="text-right relative z-10">
                        <p class="text-[7px] font-mono text-white/20 group-hover/footer-info:text-white/60 group-hover/footer-info:-translate-y-0.5 transition-all duration-500">
                            Edisi. 2026
                        </p>
                        <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full border border-transparent group-hover/footer-info:border-indigo-500/20 group-hover/footer-info:bg-indigo-500/[0.02] transition-all duration-700">
                            <span class="w-1 h-1 rounded-full bg-indigo-500/20 group-hover/footer-info:bg-indigo-400 group-hover/footer-info:shadow-[0_0_5px_#818cf8] transition-all"></span>
                            <p class="text-[6px] text-indigo-500/30 font-bold uppercase tracking-tighter group-hover/footer-info:text-indigo-300 transition-colors">
                                Bacaan Terverifikasi
                            </p>
                        </div>
                    </div>
                </div>
            </aside>


            <main class="luxury-frame group relative">
                <div id="status-overlay">
                    <div id="loading-content" class="text-center">
                        <div class="w-24 h-24 mb-8 mx-auto relative">
                            <div class="absolute inset-0 border-t-[2px] border-indigo-500 rounded-full animate-spin"></div>
                        </div>

                        <div class="h-6 overflow-hidden flex items-center justify-center">
                            <p id="changing-text" class="text-[11px] font-black text-white/80 uppercase tracking-[0.6em] transition-all duration-700 transform translate-y-0 opacity-100">
                                Membuka Koleksi
                            </p>
                        </div>
                    </div>

                    <div id="error-content" class="hidden text-center px-12 max-w-xl animate-error-entry">
                        <div class="relative w-24 h-24 mb-10 mx-auto group/icon">
                            <div class="absolute inset-0 bg-indigo-500/10 rounded-full blur-2xl animate-pulse"></div>
                            <div class="group/icon relative w-full h-full border-2 border-white/10 rounded-full flex items-center justify-center backdrop-blur-md transition-all duration-700 hover:border-indigo-500/40 hover:bg-indigo-500/[0.03] overflow-hidden">

                                <div class="absolute inset-0 opacity-0 group-hover/icon:opacity-100 transition-opacity duration-1000">
                                    <div class="absolute inset-[-50%] bg-[conic-gradient(from_0deg,transparent_0deg,rgba(99,102,241,0.1)_180deg,transparent_360deg)] animate-[spin_4s_linear_infinite]"></div>
                                </div>

                                <div class="absolute inset-2 border border-white/5 rounded-full scale-100 group-hover/icon:scale-110 group-hover/icon:border-indigo-500/20 transition-all duration-700"></div>

                                <div class="relative z-10 transition-all duration-500 group-hover/icon:scale-125 group-hover/icon:drop-shadow-[0_0_15px_rgba(255,255,255,0.4)]">
                                    <span class="text-3xl opacity-40 group-hover/icon:opacity-100 transition-opacity duration-500">✨</span>
                                </div>

                                <div class="absolute -inset-full bg-gradient-to-r from-transparent via-white/[0.05] to-transparent -rotate-45 translate-x-[-100%] group-hover/icon:translate-x-[100%] transition-transform duration-[1.2s] ease-in-out"></div>
                            </div>
                        </div>
                        <h2 class="text-4xl font-black uppercase tracking-tighter mb-6 text-white italic">Layanan Terbatasi</h2>
                        <p class="text-white/40 text-sm mb-12 font-light max-w-md mx-auto">
                            Mohon maaf, <span class="text-indigo-400 font-black">{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Pembaca' }}</span>, buku ini berada di bawah perlindungan hak cipta premium. Pustaka kami hanya menyediakan pratinjau, silakan lanjutkan perjalanan membaca kamu secara legal melalui mitra penyedia layanan kami.".
                        </p>
                        <a href="https://books.google.com/books?id={{ $id }}" target="_blank" class="btn-premium">LANJUTKAN MEMBACA</a>
                    </div>
                </div>

                <div class="viewer-wrapper">
                    <iframe id="bookIframe" src="" style="opacity: 0; transition: opacity 1s ease;"></iframe>
                </div>
            </main>
        </div>
    </div>

    <footer class="pt-16 pb-12 border-t border-white/5 relative group w-full overflow-hidden bg-black/20 transition-all duration-1000 hover:bg-black/60 group/footer">
        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-500/10 to-transparent"></div>
        <div class="absolute top-0 left-0 w-0 h-[1px] bg-gradient-to-r from-indigo-500 via-purple-400 to-indigo-500 group-hover:w-full transition-all duration-[1.5s] ease-in-out"></div>

        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-full h-48 bg-indigo-500/[0.03] blur-[120px] opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>

        <div class="px-10 md:px-20 w-full flex flex-col gap-12 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center w-full gap-10">
                <div class="flex-1 space-y-4 group/brand cursor-default">
                    <p class="text-[11px] font-black text-white/20 uppercase tracking-[0.6em] transition-all duration-700 group-hover/brand:text-indigo-400 group-hover/brand:tracking-[0.8em]">
                        © 2026 <span class="text-white/40 group-hover/brand:text-white transition-colors">Prinz Personal Space</span>
                    </p>
                    <div class="overflow-hidden">
                        <p class="text-[9px] text-white/10 uppercase tracking-[0.2em] italic transition-all duration-1000 translate-y-full group-hover/brand:translate-y-0 group-hover/brand:text-white/30">
                            "Terima kasih sudah berkunjung. Semoga ruang ini memberikan ketenangan."
                        </p>
                    </div>
                </div>

                <div class="flex-1 flex justify-center">
                    <div class="flex items-center gap-5 px-12 py-3 bg-white/[0.01] border border-white/5 rounded-full transition-all duration-700 hover:bg-indigo-500/[0.05] hover:border-indigo-500/40 hover:scale-105 group/status cursor-help shadow-inner">
                        <div class="relative flex items-center justify-center">
                            <span class="absolute w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping opacity-20"></span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_12px_#10b981]"></span>
                        </div>
                        <span class="text-[9px] font-black text-white/30 uppercase tracking-[0.5em] transition-all duration-500 group-hover/status:text-white group-hover/status:tracking-[0.6em]">Suasana Aman</span>
                    </div>
                </div>

                <div class="flex-1 text-right group/loc space-y-2">
                    <p class="text-[8px] font-black text-white/10 uppercase tracking-[0.4em] transition-all duration-700 group-hover/loc:text-indigo-400 group-hover/loc:tracking-[0.5em]">
                        Terverifikasi di Malang, Indonesia
                    </p>
                    <div class="flex items-center justify-end gap-3 opacity-20 group-hover/loc:opacity-100 transition-all duration-1000">
                        <span class="w-8 h-[1px] bg-white/10 group-hover/loc:w-12 transition-all"></span>
                        <p class="text-[10px] font-bold text-white uppercase tracking-[0.3em]">
                            Rilisan <span class="text-indigo-400">v2.5.0</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 py-12 border-y border-white/[0.03]">
                <div class="space-y-3 group/item cursor-default transition-all duration-700">
                    <h4 class="text-[8px] font-black text-white/20 uppercase tracking-[0.5em] group-hover/item:text-indigo-400 transition-all">Kenyamanan</h4>
                    <p class="text-[8px] text-white/10 leading-relaxed uppercase tracking-widest transition-all duration-700 group-hover/item:text-white/40">Visual dirancang untuk sesi baca panjang agar mata tetap rileks.</p>
                </div>
                <div class="space-y-3 group/item cursor-default transition-all duration-700">
                    <h4 class="text-[8px] font-black text-white/20 uppercase tracking-[0.5em] group-hover/item:text-indigo-400 transition-all">Privasi</h4>
                    <p class="text-[8px] text-white/10 leading-relaxed uppercase tracking-widest transition-all duration-700 group-hover/item:text-white/40">Kami menghargai ruang pribadimu tanpa pelacakan pihak ketiga.</p>
                </div>
                <div class="space-y-3 group/item cursor-default transition-all duration-700">
                    <h4 class="text-[8px] font-black text-white/20 uppercase tracking-[0.5em] group-hover/item:text-indigo-400 transition-all">Teknologi</h4>
                    <p class="text-[8px] text-white/10 leading-relaxed uppercase tracking-widest transition-all duration-700 group-hover/item:text-white/40">Dibangun dengan dedikasi menggunakan optimasi performa terbaru.</p>
                </div>
                <div class="space-y-3 lg:text-right group/item cursor-default transition-all duration-700">
                    <h4 class="text-[8px] font-black text-white/20 uppercase tracking-[0.5em] group-hover/item:text-indigo-400 transition-all">Hubungi</h4>
                    <p class="text-[8px] text-white/10 leading-relaxed uppercase tracking-widest italic transition-all duration-700 group-hover/item:text-white/40">Punya masukan? Kami senang mendengar ceritamu.</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center w-full opacity-20 group-hover:opacity-60 transition-all duration-[1.5s] ease-out">
                <p class="text-[6.5px] font-black text-white uppercase tracking-[0.8em] hover:text-indigo-400 transition-all duration-500 cursor-default">Prinz Premium Project 2026</p>

                <div class="flex items-center gap-8 my-4 md:my-0">
                    <div class="h-[1px] w-8 bg-white/10 group-hover:w-20 group-hover:bg-indigo-500/30 transition-all duration-[1.2s]"></div>
                    <p class="text-[7.5px] font-medium text-white uppercase tracking-[1em] italic text-center">Menghadirkan kehangatan dalam setiap kode</p>
                    <div class="h-[1px] w-8 bg-white/10 group-hover:w-20 group-hover:bg-indigo-500/30 transition-all duration-[1.2s]"></div>
                </div>

                <p class="text-[6.5px] font-black text-white uppercase tracking-[0.8em] hover:text-indigo-400 transition-all duration-500 cursor-default">&copy; 2026 Prinz.</p>
            </div>
        </div>

        <div class="absolute -bottom-32 left-1/4 w-96 h-96 bg-indigo-600/0 group-hover:bg-indigo-600/[0.07] rounded-full blur-[120px] transition-all duration-[2s]"></div>
        <div class="absolute -bottom-32 right-1/4 w-96 h-96 bg-purple-600/0 group-hover:bg-purple-600/[0.07] rounded-full blur-[120px] transition-all duration-[2s]"></div>
    </footer>
   <script>
        const googleId = "{{ $id }}";
        const apiKey = "AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk";

        let isBookReady = false;
        let hasError = false;
        let isFinished = false;

        const loadingTexts = [
            "Menyiapkan suasana tenang",
            "Menata rak buku favoritmu",
            "Merapikan halaman bacaan",
            "Mencari posisi terbaik",
            "Sedang mencoba mencari...",
            "Hampir siap, {{ Auth::user()->name }}"
        ];

        let currentDisplayIndex = -1;

        function updateTextSmoothly(index) {
            const textElement = document.getElementById('changing-text');
            if (!textElement) return;

            textElement.style.opacity = '0';
            textElement.style.transform = 'translateY(-12px)';

            setTimeout(() => {
                textElement.innerText = loadingTexts[index];
                textElement.style.transform = 'translateY(12px)';
                setTimeout(() => {
                    textElement.style.opacity = '1';
                    textElement.style.transform = 'translateY(0)';
                }, 50);
            }, 600);
        }

        function processLoadingSequence() {
            if (isFinished) return;
            currentDisplayIndex++;

            if (currentDisplayIndex <= 3) {
                updateTextSmoothly(currentDisplayIndex);
                setTimeout(processLoadingSequence, 2800);
            } else {
                if (hasError) forceFinishError();
                else if (isBookReady) forceFinishSuccess();
                else {
                    currentDisplayIndex = 3;
                    setTimeout(processLoadingSequence, 1000);
                }
            }
        }

        function showInfoPanel() {
            const panel = document.getElementById('infoPanel');
            if (panel) {
                panel.classList.add('visible');
                panel.style.opacity = "1";
                panel.style.transform = "translateX(0)";
            }
        }

        function forceFinishSuccess() {
            if (isFinished) return;
            isFinished = true;
            updateTextSmoothly(5);

            setTimeout(() => {
                const overlay = document.getElementById('status-overlay');
                const iframe = document.getElementById('bookIframe');
                if (overlay) overlay.style.opacity = "0";
                if (iframe) iframe.style.opacity = "1";

                showInfoPanel(); 
                setTimeout(() => {
                    if (overlay) overlay.style.display = "none";
                }, 600);
            }, 2000);
        }

        function forceFinishError() {
            if (isFinished) return;
            isFinished = true;
            updateTextSmoothly(4); // Menampilkan "Sedang mencoba mencari..."

            setTimeout(() => {
                const loading = document.getElementById('loading-content');
                const error = document.getElementById('error-content');
                if (loading) loading.style.display = "none";
                if (error) error.classList.remove('hidden');

                showInfoPanel(); 
            }, 2000);
        }

        function checkAndLoad() {
            processLoadingSequence();

            // EMERGENCY TIMER: Jika 10 detik tidak ada kabar dari Google, paksa Error.
            const emergencyTimer = setTimeout(() => {
                if (!isBookReady && !isFinished) {
                    console.warn("Request timeout atau diblokir Google (429).");
                    hasError = true;
                    forceFinishError();
                }
            }, 10000);

            fetch(`https://www.googleapis.com/books/v1/volumes/${googleId}?key=${apiKey}`)
                .then(res => {
                    if (res.status === 429) throw new Error("Limit");
                    return res.json();
                })
                .then(data => {
                    // ISI DATA PANEL (Judul & Deskripsi)
                    const info = data.volumeInfo;
                    if (info) {
                        if (document.getElementById('book-title')) document.getElementById('book-title').innerText = info.title;
                        if (document.getElementById('book-authors')) document.getElementById('book-authors').innerText = info.authors ? info.authors.join(', ') : 'Anonim';
                        if (document.getElementById('book-description')) {
                            document.getElementById('book-description').innerHTML = info.description || "Tidak ada deskripsi tersedia.";
                        }
                    }

                    const access = data.accessInfo;
                    // Cek jika buku tidak bisa di-embed
                    if (access && (access.viewability === "NO_PAGES" || access.embeddable === false)) {
                        hasError = true;
                    } else {
                        const iframe = document.getElementById('bookIframe');
                        iframe.src = `https://books.google.com/books?id=${googleId}&hl=id&printsec=frontcover&output=embed`;
                        
                        iframe.onload = () => {
                            clearTimeout(emergencyTimer);
                            isBookReady = true;
                        };

                        // Jika iframe memicu error (biasanya dialihkan ke halaman 'sorry' Google)
                        iframe.onerror = () => {
                            hasError = true;
                        };
                    }
                })
                .catch(() => {
                    hasError = true;
                });
        }

        window.addEventListener('load', checkAndLoad);
    </script>
</body>

</html>