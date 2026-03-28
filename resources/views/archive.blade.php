<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINZ | THE ARCHIVE VAULT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,800;1,200;1,800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #030303;
            color: white;
            overflow-x: hidden;
        }

        /* Luxury Glassmorphism */
        .glass-vault {
            background: rgba(255, 255, 255, 0.005);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.03);
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .glass-vault:hover {
            background: rgba(99, 102, 241, 0.05);
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.6), 0 0 40px rgba(99, 102, 241, 0.1);
        }

        /* Reveal Animation */
        @keyframes reveal-up {
            from {
                transform: translateY(40px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .reveal-up {
            opacity: 0;
            animation: reveal-up 1s ease-out forwards;
        }

        /* Terminal Scrolling */
        @keyframes terminal-scroll {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        .animate-terminal-scroll {
            animation: terminal-scroll 20s linear infinite;
        }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #4f46e5; border-radius: 10px; }
    </style>
</head>

<body class="p-6 lg:p-20 relative min-h-screen">

    <div class="fixed inset-0 opacity-[0.03] pointer-events-none"
        style="background-image: linear-gradient(#4f46e5 0.5px, transparent 0.5px), linear-gradient(90deg, #4f46e5 0.5px, transparent 0.5px); background-size: 32px 32px;"></div>

   <header class="relative z-10 flex flex-col lg:flex-row justify-between items-start mb-48 gap-16">
        
        <div class="reveal-up relative group" style="animation-delay: 0.1s">
            <div class="flex items-center gap-6 mb-10">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-ping"></div>
                    <span class="text-[9px] font-black uppercase tracking-[0.5em] text-indigo-400 italic">Core_Vault_Live</span>
                </div>
                <div class="h-[1px] w-20 bg-white/10"></div>
                <span class="text-[8px] font-mono text-white/20 uppercase tracking-[0.4em]">Protocol: AES-256_Encrypted</span>
            </div>
            
            <h1 class="text-7xl lg:text-[11rem] font-black italic tracking-tighter uppercase leading-[0.7] mb-12 hover:text-indigo-500 transition-all duration-500 cursor-default">
                Data<br><span class="text-indigo-600 group-hover:tracking-widest transition-all duration-700">Vault.</span>
            </h1>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 border-t border-white/5 pt-10">
                <div class="space-y-1">
                    <span class="block text-[7px] text-white/20 uppercase tracking-[0.4em]">User_Auth</span>
                    <span class="block text-[11px] font-mono text-white italic uppercase tracking-wider">PRINZ_ADMIN</span>
                </div>
                <div class="space-y-1 border-l border-white/5 pl-6">
                    <span class="block text-[7px] text-white/20 uppercase tracking-[0.4em]">System_Latency</span>
                    <span class="block text-[11px] font-mono text-emerald-500 italic uppercase">0.002ms_Stable</span>
                </div>
                <div class="space-y-1 border-l border-white/5 pl-6">
                    <span class="block text-[7px] text-white/20 uppercase tracking-[0.4em]">Node_Region</span>
                    <span class="block text-[11px] font-mono text-indigo-400 italic uppercase italic">IDN // SUB_03</span>
                </div>
                <div class="space-y-1 border-l border-white/5 pl-6">
                    <span class="block text-[7px] text-white/20 uppercase tracking-[0.4em]">Environment</span>
                    <span class="block text-[11px] font-mono text-white/40 italic uppercase italic">Production_v3.5</span>
                </div>
            </div>
        </div>

        <div class="reveal-up flex flex-col gap-4 w-full lg:w-auto" style="animation-delay: 0.3s">
            <a href="{{route('welcome')}}" class="glass-vault px-10 py-8 rounded-[35px] border-indigo-500/30 bg-indigo-600/5 group relative overflow-hidden flex flex-col items-start min-w-[320px] hover:border-indigo-400/60 transition-all duration-700">
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-50 group-hover:animate-[scan_2s_linear_infinite]"></div>
                
                <div class="flex justify-between w-full items-center mb-6">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 group-hover:animate-bounce"></span>
                        <span class="text-[9px] font-black uppercase tracking-[0.6em] text-indigo-400">Exit_Portal</span>
                    </div>
                    <div class="p-2 rounded-full bg-white/5 group-hover:bg-indigo-500/20 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="group-hover:-translate-x-2 transition-transform duration-500">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </div>
                
                <h4 class="text-3xl font-black italic uppercase tracking-tighter text-white group-hover:italic transition-all">Back to Base</h4>
                <div class="flex items-center gap-3 mt-3">
                    <p class="text-[8px] text-white/20 uppercase tracking-[0.3em] font-mono group-hover:text-white/60 transition-colors italic">Redirecting_to_Home.exe</p>
                    <div class="h-[1px] w-8 bg-white/10 group-hover:w-16 group-hover:bg-indigo-500 transition-all duration-700"></div>
                </div>
            </a>

            <div class="flex items-center justify-between px-8 text-[8px] font-black uppercase tracking-[0.4em] text-white/10 italic">
                <span>Direct Access Only</span>
                <span class="text-indigo-500/30">Level_01_Clearance</span>
            </div>
        </div>
    </header>

    <main id="vault-container" class="grid lg:grid-cols-3 gap-12 relative z-10 mb-32">
    </main>

    <section class="relative z-10 reveal-up mb-12" style="animation-delay: 0.8s">
        <div class="flex items-center gap-4 mb-12">
            <div class="w-12 h-[1px] bg-indigo-500"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-indigo-400 italic">System Capabilities</span>
        </div>

        <div class="grid lg:grid-cols-4 gap-6">
            <div class="glass-vault p-8 rounded-[32px] border-l-2 border-l-indigo-600">
                <div class="text-[8px] font-black text-white/20 uppercase tracking-widest mb-4 text-indigo-400">Core Engine</div>
                <div class="text-2xl font-black italic tracking-tighter uppercase mb-2">Laravel 10</div>
                <div class="w-full bg-white/5 h-1 rounded-full overflow-hidden">
                    <div class="bg-indigo-600 h-full w-[90%] shadow-[0_0_10px_#4f46e5]"></div>
                </div>
            </div>
            <div class="glass-vault p-8 rounded-[32px]">
                <div class="text-[8px] font-black text-white/20 uppercase tracking-widest mb-4">Database Ops</div>
                <div class="text-2xl font-black italic tracking-tighter uppercase mb-2">MySQL Expert</div>
                <div class="flex gap-1">
                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    <div class="w-2 h-2 rounded-full bg-indigo-500/20"></div>
                </div>
            </div>
            <div class="glass-vault p-8 rounded-[32px]">
                <div class="text-[8px] font-black text-white/20 uppercase tracking-widest mb-4">Styling Unit</div>
                <div class="text-2xl font-black italic tracking-tighter uppercase mb-2">Tailwind</div>
                <div class="text-[9px] font-mono text-indigo-400 uppercase">Modern_Interface</div>
            </div>
            <div class="glass-vault p-8 rounded-[32px]">
                <div class="text-[8px] font-black text-white/20 uppercase tracking-widest mb-4">UI/UX Kit</div>
                <div class="text-2xl font-black italic tracking-tighter uppercase mb-2">Premium Design</div>
                <div class="text-[9px] font-mono text-emerald-500 animate-pulse uppercase">Glassmorphism_Active</div>
            </div>
        </div>
    </section>

    <section class="mt-40 mb-40 relative z-10 reveal-up" style="animation-delay: 1.2s">
        <div class="flex items-center gap-4 mb-16">
            <div class="w-12 h-[1px] bg-indigo-500"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-indigo-400 italic">Personal Narrative</span>
        </div>

        <div class="grid lg:grid-cols-12 gap-16 items-start">
            <div class="lg:col-span-5">
                <h2 class="text-6xl lg:text-8xl font-black italic tracking-tighter uppercase leading-[0.85] text-white">
                    Code<br>with<br><span class="text-indigo-600">Passion.</span>
                </h2>
            </div>

            <div class="lg:col-span-7 space-y-12">
                <div class="glass-vault p-10 lg:p-14 rounded-[40px] relative overflow-hidden group">
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <h4 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-400 italic">Halo, Aku Prinz!</h4>
                            <p class="text-[13px] text-white/60 leading-relaxed tracking-widest uppercase">
                                Sebagai mahasiswa <span class="text-white italic">Teknik Informatika</span>, bagiku baris kode bukan cuma instruksi, tapi seni untuk memecahkan masalah. Aku senang membangun fondasi logika yang kuat melalui manajemen data yang presisi.
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-400 italic">Laravel & Aesthetics</h4>
                            <p class="text-[13px] text-white/60 leading-relaxed tracking-widest uppercase">
                                Dunia web development adalah tempat bermainku. Menggunakan <span class="text-white">Laravel</span>, aku mentransformasi logika menjadi solusi nyata, seperti sistem inventory <span class="text-white italic">BMW Store</span> yang rapi dan fungsional.
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-400 italic">F1 Inspired Design</h4>
                            <p class="text-[13px] text-white/60 leading-relaxed tracking-widest uppercase">
                                Terinspirasi dari kecepatan <span class="text-white italic">Formula 1</span> dan elegansi <span class="text-white italic">BMW</span>, aku selalu menerapkan standar desain premium. Kecepatan eksekusi bertemu dengan visual yang elegan—itulah identitas digitalku.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-60 pb-20 relative z-10 reveal-up border-t border-white/5 pt-24" style="animation-delay: 1.6s">
        <div class="grid lg:grid-cols-12 gap-16 mb-24">

            <div class="lg:col-span-4 space-y-8">
                <div>
                    <h3 class="text-4xl font-black italic tracking-tighter uppercase mb-4">
                        Prinz<span class="text-indigo-600">.</span>Vault
                    </h3>
                    <p class="text-[10px] text-white/30 uppercase tracking-[0.4em] leading-relaxed max-w-xs italic">
                        Digital Architect & Information Technology Specialist based in Indonesia.
                    </p>
                </div>
                <div class="inline-flex items-center gap-4 px-6 py-3 glass-vault rounded-full border-indigo-500/20">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></div>
                    <span class="text-[8px] font-black uppercase tracking-[0.3em] text-indigo-400">Global_Server_Online</span>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <h4 class="text-[10px] font-black uppercase tracking-[0.5em] text-white/20 italic">Navigation</h4>
                <ul class="space-y-4 text-[11px] font-bold uppercase tracking-widest text-white/50 italic">
                    <li><a href="#" class="hover:text-indigo-500 transition-colors">Archive</a></li>
                    <li><a href="#" class="hover:text-indigo-500 transition-colors">Capabilities</a></li>
                    <li><a href="#" class="hover:text-indigo-500 transition-colors">Narrative</a></li>
                    <li><a href="#" class="hover:text-indigo-500 transition-colors">Hardware</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <h4 class="text-[10px] font-black uppercase tracking-[0.5em] text-white/20 italic">Connectivity</h4>
                <ul class="space-y-4 text-[11px] font-bold uppercase tracking-widest text-white/50 italic">
                    <li><a href="#" class="hover:text-indigo-500 transition-colors flex items-center gap-3">
                            <span class="w-1.5 h-[1px] bg-indigo-500"></span> Instagram
                        </a></li>
                    <li><a href="#" class="hover:text-indigo-500 transition-colors flex items-center gap-3">
                            <span class="w-1.5 h-[1px] bg-indigo-500"></span> LinkedIn
                        </a></li>
                    <li><a href="#" class="hover:text-indigo-500 transition-colors flex items-center gap-3">
                            <span class="w-1.5 h-[1px] bg-indigo-500"></span> GitHub
                        </a></li>
                </ul>
            </div>

            <div class="lg:col-span-3 space-y-6 text-right lg:text-left">
                <h4 class="text-[10px] font-black uppercase tracking-[0.5em] text-white/20 italic">Local Node</h4>
                <div class="space-y-1">
                    <span class="block text-2xl font-black italic text-white uppercase tracking-tighter" id="footer-time">00:00:00</span>
                    <span class="block text-[9px] text-indigo-500 uppercase tracking-[0.3em] font-mono italic">Surabaya, East Java // IDN</span>
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-white/5 flex flex-col lg:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-12">
                <div class="flex flex-col">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-[0.5em] mb-1">Architecture</span>
                    <span class="text-[9px] font-mono text-indigo-500 uppercase italic">V3.5_Stable_Build</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-[0.5em] mb-1">Last Update</span>
                    <span class="text-[9px] font-mono text-indigo-500 uppercase italic">March_2026</span>
                </div>
            </div>

            <div class="order-first lg:order-last">
                <span class="text-[10px] font-black uppercase tracking-[0.6em] text-white/10 italic">
                    &copy; MMXXVI Prinz. All Data Encrypted.
                </span>
            </div>
        </div>
    </footer>

    <script>
        function updateFooterTime() {
            const timeElement = document.getElementById('footer-time');
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-GB', {
                hour12: false
            });
            timeElement.textContent = timeString;
        }
        setInterval(updateFooterTime, 1000);
        updateFooterTime();
    </script>

    <script>
        // Projects Data with Narrative Descriptions
        const projects = [
            {
                id: '01',
                title: 'BMW Store',
                desc: 'Bukan sekadar toko digital. Ini adalah eksperimen UI premium untuk mengelola database kendaraan dengan performa tinggi.',
                tags: ['Laravel', 'MySQL', 'Automotive'],
            },
            {
                id: '02',
                title: 'E-Library',
                desc: 'Solusi cerdas untuk literasi digital. Aku membangun sistem CRUD yang kompleks untuk mempermudah manajemen data buku.',
                tags: ['Full-Stack', 'PHP', 'Database'],
            },
            {
                id: '03',
                title: 'Task Master',
                desc: 'Lahir dari kebutuhan manajemen waktu. Aplikasi produktivitas dengan sorting algoritma yang presisi dan cepat.',
                tags: ['JS Logic', 'Tailwind', 'Productivity'],
            }
        ];

        const container = document.getElementById('vault-container');

        projects.forEach((p, index) => {
            const card = `
                <div class="glass-vault p-12 rounded-[50px] group relative overflow-hidden reveal-up" style="animation-delay: ${0.4 + (index * 0.2)}s">
                    <div class="absolute -top-10 -right-4 text-[160px] font-black italic text-white/[0.02] group-hover:text-indigo-500/[0.05] transition-colors pointer-events-none">
                        ${p.id}
                    </div>
                    <div class="w-16 h-16 bg-white/[0.03] border border-white/5 rounded-2xl flex items-center justify-center mb-12 group-hover:border-indigo-500/30 transition-all duration-500">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-indigo-500 group-hover:rotate-[10deg] transition-transform">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black italic uppercase mb-6 tracking-tighter group-hover:text-indigo-400 transition-colors">
                        ${p.title}
                    </h3>
                    <p class="text-[12px] text-white/40 uppercase tracking-[0.2em] leading-loose mb-12">
                        ${p.desc}
                    </p>
                    <div class="flex flex-wrap gap-3 mb-16">
                        ${p.tags.map(tag => `
                            <span class="text-[9px] font-black px-5 py-2 border border-white/10 rounded-full uppercase tracking-widest bg-white/[0.02] group-hover:border-indigo-500/20">
                                ${tag}
                            </span>
                        `).join('')}
                    </div>
                    <button class="w-full py-6 bg-white/5 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-[0.4em] hover:bg-indigo-600 hover:border-indigo-500 hover:text-white transition-all duration-500 group-hover:shadow-[0_20px_40px_rgba(79,70,229,0.2)]">
                        View Project
                    </button>
                </div>
            `;
            container.innerHTML += card;
        });
    </script>
</body>
</html>