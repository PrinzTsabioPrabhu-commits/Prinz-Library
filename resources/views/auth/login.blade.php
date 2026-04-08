<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PRINZ LIBRARY | Ruang Baca</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #818cf8;
            --bg-dark: #050505;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            pointer-events: none;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.03;
            mix-blend-mode: overlay;
        }

        .ambient-aura {
            position: fixed;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(100px);
            pointer-events: none;
        }

        .glass-bento {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 48px;
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 10;
        }

        /* --- ANIMASI BACKGROUND (HUJAN BUKU) --- */
        .bg-animation-wrapper {
            position: absolute;
            inset: 0;
            z-index: 1;
            display: flex;
            gap: 20px;
            padding: 20px;
            opacity: 0.15;
            pointer-events: none;
        }

        .book-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            will-change: transform;
        }

        .animate-up {
            animation: scrollUp 40s linear infinite;
        }

        .animate-down {
            animation: scrollDown 45s linear infinite;
        }

        @keyframes scrollUp {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-50%);
            }
        }

        @keyframes scrollDown {
            from {
                transform: translateY(-50%);
            }

            to {
                transform: translateY(0);
            }
        }

        .book-card-mini {
            width: 120px;
            height: 170px;
            border-radius: 12px;
            background: #111;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            flex-shrink: 0;
        }

        .book-card-mini img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(0.4) contrast(1.1);
        }

        .panel-overlay {
            position: absolute;
            inset: 0;
            z-index: 5;
            background: linear-gradient(to right, #050505 15%, transparent 50%, #050505 85%),
                linear-gradient(to bottom, #050505 0%, transparent 20%, transparent 80%, #050505 100%);
            pointer-events: none;
        }

        .editorial-title {
            font-weight: 800;
            line-height: 0.9;
            letter-spacing: -0.05em;
        }

        .outline-text {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.2);
        }

        .input-luxe {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 1.2rem 1.5rem;
            color: white;
            transition: all 0.4s ease;
            font-size: 13px;
        }

        .input-luxe:focus {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.1);
        }

        .btn-premium {
            background: #ffffff;
            color: #000;
            padding: 1.2rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.1em;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 255, 255, 0.1);
            background: #f0f0f0;
        }

        .reveal-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease-out;
        }

        .loaded .reveal-up {
            opacity: 1;
            transform: translateY(0);
        }

        #loading-modal,
        #status-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(15px);
            opacity: 0;
            visibility: hidden;
            transition: 0.4s;
        }

        .active {
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
</head>

<body class="opacity-0 transition-opacity duration-700">
    <div class="noise-overlay"></div>
    <div class="ambient-aura top-[-10%] right-[-5%]"></div>
    <div class="ambient-aura bottom-[-10%] left-[-5%]"></div>

    <div class="w-full max-w-5xl p-6">
        <div class="glass-bento grid lg:grid-cols-2 overflow-hidden">

            <div class="relative p-12 lg:p-20 flex flex-col justify-between border-r border-white/[0.05] overflow-hidden">
                <div class="bg-animation-wrapper">
                    <div id="col-1" class="book-column animate-up"></div>
                    <div id="col-2" class="book-column animate-down"></div>
                </div>

                <div class="panel-overlay"></div>

                <div class="relative z-20 reveal-up" style="transition-delay: 100ms">
                    <div class="flex items-center gap-3 mb-12">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-black italic shadow-lg">P</div>
                        <span class="text-[10px] tracking-[0.4em] text-white/30 uppercase">Lobi Utama</span>
                    </div>

                    <h1 class="editorial-title text-5xl lg:text-7xl mb-8">
                        SELAMAT <br> <span class="outline-text">DATANG.</span>
                    </h1>

                    <div class="space-y-4">
                        <p class="text-xs text-white/40 leading-relaxed max-w-xs">
                            Silakan masuk untuk menikmati koleksi literatur kurasi kami dalam suasana yang tenang.
                        </p>
                        <div class="text-[9px] text-white/20 uppercase tracking-widest inline-block">
                            — Ruang baca privat & eksklusif
                        </div>
                    </div>
                </div>

                <div class="relative z-20 mt-12 reveal-up" style="transition-delay: 200ms">
                    <div class="flex flex-wrap gap-6 items-center">
                        <div class="text-[9px] font-medium text-white/20 uppercase tracking-tighter">Koleksi Terkurasi</div>
                        <div class="w-1 h-1 bg-white/10 rounded-full"></div>
                        <div class="text-[9px] font-medium text-white/20 uppercase tracking-tighter">Lingkungan Nyaman</div>
                    </div>
                </div>
            </div>

            <div class="p-12 lg:p-20 flex flex-col justify-center bg-white/[0.01] relative z-20">
                <form id="login-form" action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2 reveal-up" style="transition-delay: 300ms">
                        <label for="email" class="text-[9px] uppercase tracking-[0.3em] text-white/30 ml-1 block">Surel Anda</label>
                        <input type="email" id="email" name="email" required class="input-luxe w-full" placeholder="nama@email.com">
                    </div>

                    <div class="space-y-2 reveal-up" style="transition-delay: 400ms">
                        <label for="password" class="text-[9px] uppercase tracking-[0.3em] text-white/30 ml-1 block">Kata Sandi</label>
                        <input type="password" id="password" name="password" required class="input-luxe w-full" placeholder="••••••••">
                        <div class="flex justify-end">
                            <a href="#" class="text-[9px] text-white/20 hover:text-white/50 transition-colors uppercase tracking-widest mt-1">Lupa sandi?</a>
                        </div>
                    </div>

                    <div class="pt-4 reveal-up" style="transition-delay: 500ms">
                        <button type="submit" class="btn-premium w-full uppercase">Mulai Membaca</button>
                    </div>
                </form>

                <div class="mt-10 text-center reveal-up" style="transition-delay: 600ms">
                    <p class="text-[10px] text-white/30 uppercase tracking-[0.2em]">
                        Baru di sini?
                        <a href="{{ route('register') }}" class="text-white border-b border-white/20 pb-0.5 ml-1 hover:border-white transition-all">Bergabung Sekarang</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-between items-center px-4 reveal-up" style="transition-delay: 800ms">
            <span class="text-[9px] text-white/10 uppercase tracking-[0.5em]">© 2026 Prinz Library</span>
            <div class="flex gap-4">
                <span class="text-[9px] text-white/10 uppercase tracking-widest cursor-default">Bantuan</span>
                <span class="text-[9px] text-white/10 uppercase tracking-widest cursor-default">Ketentuan</span>
            </div>
        </div>
    </div>

    <div id="loading-modal">
        <div class="text-center">
            <div class="w-8 h-8 border-2 border-white/10 border-t-white rounded-full animate-spin mx-auto mb-6"></div>
            <p class="text-white/30 text-[9px] font-bold uppercase tracking-[0.4em]">Menyiapkan Ruangan...</p>
        </div>
    </div>

    <div id="status-modal">
        <div class="glass-bento p-12 w-full max-w-sm text-center">
            <div id="modal-icon" class="w-12 h-12 mx-auto mb-6 flex items-center justify-center rounded-full border text-sm"></div>
            <h3 id="modal-title" class="text-white font-bold uppercase tracking-widest text-sm mb-2"></h3>
            <p id="modal-desc" class="text-white/40 text-[10px] leading-relaxed mb-8 px-4"></p>
            <button onclick="closeModal()" class="w-full py-4 bg-white/5 hover:bg-white/10 rounded-xl text-[9px] font-bold uppercase tracking-widest transition-all border border-white/5">Kembali</button>
        </div>
    </div>

    <script>
        // --- 1. INISIALISASI HALAMAN ---
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.remove('opacity-0');
                document.body.classList.add('loaded');
            }, 200);
            initBooks();
        });

        // --- 2. SISTEM HUJAN BUKU (API + FALLBACK) ---
        // Link Unsplash yang lebih stabil & pasti tembus HTTPS
        const fallbacks = [
            'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1543004218-ee141104523e?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1516979187457-637abb4f9353?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1553729459-efe14ef6055d?auto=format&fit=crop&w=300&q=80'
        ];

        async function initBooks() {
            const col1 = document.getElementById('col-1');
            const col2 = document.getElementById('col-2');

            try {
                const res = await fetch('https://www.googleapis.com/books/v1/volumes?q=subject:design+OR+subject:art&maxResults=12');

                if (!res.ok) throw new Error('API_LIMIT');

                const data = await res.json();
                if (!data.items) throw new Error('NO_DATA');

                // Map gambar dari API, kalau null langsung ganti ke fallback
                const images = data.items.map((item, i) => {
                    let thumb = item.volumeInfo.imageLinks?.thumbnail;
                    return thumb ? thumb.replace('http:', 'https:') : fallbacks[i % fallbacks.length];
                });

                renderToColumns(images);

            } catch (e) {
                console.warn("Menggunakan full fallback mode.");
                renderToColumns(fallbacks);
            }
        }

        function renderToColumns(images) {
            const col1 = document.getElementById('col-1');
            const col2 = document.getElementById('col-2');
            let h1 = '',
                h2 = '';

            images.forEach((img, i) => {
                // Tambahkan onerror agar jika link mati, otomatis ganti ke gambar pertama fallbacks
                const card = `
                <div class="book-card-mini">
                    <img src="${img}" 
                         alt="book" 
                         loading="lazy" 
                         onerror="this.src='${fallbacks[0]}'; this.onerror=null;">
                </div>`;

                if (i % 2 === 0) h1 += card;
                else h2 += card;
            });

            // Loop konten agar animasi tidak putus
            col1.innerHTML = h1 + h1;
            col2.innerHTML = h2 + h2;
        }

        // --- 3. FORM & MODAL LOGIC ---
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

        function showModal(title, desc, isSuccess = true) {
            const modal = document.getElementById('status-modal');
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-desc').innerText = desc;
            const icon = document.getElementById('modal-icon');
            icon.innerHTML = isSuccess ? '✓' : '✕';
            icon.className = `w-12 h-12 mx-auto mb-6 flex items-center justify-center rounded-full border ${isSuccess ? 'border-indigo-400 text-indigo-400' : 'border-red-400 text-red-400'}`;
            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('status-modal').classList.remove('active');
        }

        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const loading = document.getElementById('loading-modal');
            loading.classList.add('active');

            try {
                const response = await axios.post(this.action, Object.fromEntries(new FormData(this)));
                loading.classList.remove('active');
                if (response.status === 200) {
                    showModal("BERHASIL", "Selamat datang kembali.", true);
                    setTimeout(() => {
                        window.location.href = response.data.redirect || '/beranda';
                    }, 1500);
                }
            } catch (err) {
                loading.classList.remove('active');
                showModal("ADA KENDALA", err.response?.data?.message || "Periksa kembali data login kamu.", false);
            }
        });
    </script>
</body>

</html>