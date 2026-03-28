<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PRINZ LIBRARY | Authentication Required</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.4);
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
            padding: 4rem 0;
        }

        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            pointer-events: none;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.05;
            mix-blend-mode: overlay;
        }

        @keyframes breathe {
            0%, 100% { transform: scale(1); opacity: 0.15; filter: blur(120px); }
            50% { transform: scale(1.1); opacity: 0.25; filter: blur(100px); }
        }

        .ambient-aura {
            position: fixed;
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(120px);
            opacity: 0.2;
            pointer-events: none;
            animation: breathe 12s ease-in-out infinite;
        }

        .glass-bento {
            background: rgba(255, 255, 255, 0.005);
            backdrop-filter: blur(100px) saturate(150%);
            border: 1px solid rgba(255, 255, 255, 0.03);
            border-radius: 64px;
            transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 80px 160px -40px rgba(0, 0, 0, 0.8),
                        inset 0 0 40px rgba(255, 255, 255, 0.01);
        }

        .editorial-title {
            font-weight: 800;
            line-height: 0.85;
            letter-spacing: -0.06em;
            text-transform: uppercase;
        }

        .outline-text {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.35);
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
            width: 100%;
        }

        .btn-premium:hover {
            transform: scale(1.02) translateY(-2px);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.15);
        }

        .input-luxe {
            background: rgba(255, 255, 255, 0.015);
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
            background: rgba(255, 255, 255, 0.03);
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.15),
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

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* --- ANIMATION SYSTEM --- */
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .loaded .reveal-up {
            opacity: 1;
            transform: translateY(0);
        }

        #loading-modal, #status-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(20px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        #loading-modal.active, #status-modal.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="opacity-0 transition-opacity duration-1000">
    <div class="noise-overlay"></div>
    <div class="ambient-aura top-[-20%] left-[-10%]"></div>
    <div class="ambient-aura bottom-[-20%] right-[-10%]"></div>

    <div class="w-full max-w-[1100px] p-6">
        <div class="glass-bento grid lg:grid-cols-2">
            <div class="p-20 flex flex-col justify-between border-r border-white/5 bg-white/[0.01]">
                <div>
                    <div class="flex items-center gap-4 mb-16 reveal-up" style="transition-delay: 100ms">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center font-black text-black italic text-xl animate-float">P</div>
                        <div class="text-[9px] font-black uppercase tracking-[0.5em] leading-none text-white/40">Prinz Library // Station 01</div>
                    </div>
                    <h1 class="editorial-title text-6xl lg:text-7xl mb-10 reveal-up" style="transition-delay: 200ms">THE <br> <span class="outline-text">GATEWAY.</span></h1>
                    <p class="text-[11px] text-white/40 uppercase tracking-[0.3em] leading-loose max-w-sm reveal-up" style="transition-delay: 300ms">Preservasi digital untuk koleksi literatur <span class="text-white font-bold">eksklusif</span>. Silakan verifikasi identitas Anda untuk melanjutkan.</p>
                </div>
                <div class="pt-10 reveal-up" style="transition-delay: 400ms">
                    <div class="text-[10vw] font-black text-white/[0.02] select-none leading-none absolute -bottom-10 left-10 pointer-events-none">PRZ</div>
                    <div class="flex items-center gap-4 text-white/20 text-[9px] font-black uppercase tracking-widest">
                        <span>Luxe Identity Verified</span>
                        <span class="w-1 h-1 bg-indigo-500 rounded-full"></span>
                        <span>Secured Station</span>
                    </div>
                </div>
            </div>

            <div class="p-20 flex flex-col justify-center">
                <form id="login-form" action="{{ route('login.post') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-1 group reveal-up" style="transition-delay: 500ms">
                        <label class="luxe-label">Masukkan Emailmu disini</label>
                        <input type="email" name="email" required class="input-luxe" placeholder="ACCESS@PRINZLIBRARY.CO">
                    </div>
                    <div class="space-y-1 group reveal-up" style="transition-delay: 600ms">
                        <div class="flex justify-between items-center px-1">
                            <label class="luxe-label !mb-0">Masukkan Passwordmu disini </label>
                            <a href="#" class="text-[8px] font-bold text-white/20 uppercase tracking-widest hover:text-white transition-colors pb-3">Recover?</a>
                        </div>
                        <input type="password" name="password" required class="input-luxe" placeholder="••••••••••••">
                    </div>
                    <div class="pt-4 reveal-up" style="transition-delay: 700ms">
                        <button type="submit" class="btn-premium !rounded-3xl">masuk sekarang</button>
                    </div>
                </form>

                <div class="flex items-center gap-6 my-12 reveal-up" style="transition-delay: 800ms">
                    <div class="h-px flex-1 bg-white/5"></div>
                    <span class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em]">Atau masuk Lewat</span>
                    <div class="h-px flex-1 bg-white/5"></div>
                </div>

                <div class="grid grid-cols-2 gap-4 reveal-up" style="transition-delay: 900ms">
                    <button onclick="googleLogin()" class="py-5 text-[9px] font-black uppercase tracking-[0.3em] bg-white/5 border border-white/5 rounded-2xl hover:bg-white/10 hover:border-white/10 transition-all text-white/60 hover:text-white flex items-center justify-center gap-4">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#fff" opacity="0.4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#fff" opacity="0.2"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#fff" opacity="0.2"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#fff" opacity="0.4"/>
                        </svg>
                        Google
                    </button>
                    <button onclick="appleLogin()" class="py-5 text-[9px] font-black uppercase tracking-[0.3em] bg-white/5 border border-white/5 rounded-2xl hover:bg-white/10 hover:border-white/10 transition-all text-white/60 hover:text-white flex items-center justify-center gap-4">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.05 20.28c-.96.95-2.04 1.87-3.21 1.85-1.15-.02-1.52-.73-2.84-.73-1.32 0-1.74.71-2.84.75-1.13.04-2.31-.96-3.27-1.92-1.95-1.96-3.41-5.54-1.4-8.99 1-1.71 2.76-2.79 4.38-2.82 1.23-.02 2.39.83 3.15.83.75 0 2.15-1.03 3.59-.88 1.44.15 2.53.67 3.24 1.71-2.92 1.76-2.45 5.67.51 6.89-.5 1.23-1.35 2.36-2.31 3.31zm-2.89-16.03c.62-.75 1.04-1.79.92-2.83-.89.04-1.97.6-2.6 1.34-.57.65-1.06 1.73-.94 2.74.99.08 2.01-.5 2.62-1.25z" fill="white" opacity="0.4"/>
                        </svg>
                        Apple
                    </button>
                </div>
                <div class="mt-8 reveal-up" style="transition-delay: 1000ms">
                    <a href="{{ route('register') }}" class="block text-center text-[9px] font-black uppercase tracking-[0.3em] text-white/30 hover:text-indigo-400 transition-all duration-500">Nggak punya akun? <span class="text-white">Daftar Sekarang</span></a>
                </div>
            </div>
        </div>
    </div>

    <div id="loading-modal">
        <div class="text-center">
            <div class="w-12 h-12 border border-indigo-500/30 border-t-indigo-500 rounded-full animate-spin mx-auto mb-10"></div>
            <p class="text-white/20 text-[9px] font-black uppercase tracking-[0.8em]">sedang memuat...</p>
        </div>
    </div>

    <div id="status-modal">
        <div class="glass-bento p-16 w-full max-w-sm text-center">
            <div id="modal-icon" class="w-16 h-16 mx-auto mb-8 flex items-center justify-center rounded-full border text-xl font-bold"></div>
            <h3 id="modal-title" class="text-white font-black uppercase italic text-xl mb-4"></h3>
            <p id="modal-desc" class="text-white/40 text-[10px] uppercase tracking-widest leading-loose mb-10"></p>
            <button onclick="closeModal()" class="w-full py-5 bg-white/5 hover:bg-white/10 rounded-2xl text-[9px] font-black uppercase tracking-widest transition-all border border-white/5">Confirm</button>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth-compat.js"></script>
    <script>
        // Smooth Reveal on Load
        window.addEventListener('load', () => { 
            setTimeout(() => { 
                document.body.classList.remove('opacity-0'); 
                document.body.classList.add('loaded');
            }, 100); 
        });
        
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const firebaseConfig = {
            apiKey: "AIzaSyBILkIE8O6tntd-i4D7YIXgwjBVH4MWUA0",
            authDomain: "e-library-289bd.firebaseapp.com",
            projectId: "e-library-289bd",
            storageBucket: "e-library-289bd.firebasestorage.app",
            messagingSenderId: "951918451187",
            appId: "1:778820364565:web:e7b3b52deb64d8e8e2e11c"
        };
        if (!firebase.apps.length) firebase.initializeApp(firebaseConfig);

        function showModal(title, desc, isSuccess = true) {
            const modal = document.getElementById('status-modal');
            const icon = document.getElementById('modal-icon');
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-desc').innerText = desc;
            icon.innerHTML = isSuccess ? '✓' : '✕';
            icon.className = `w-16 h-16 mx-auto mb-8 flex items-center justify-center rounded-full border ${isSuccess ? 'border-indigo-500/50 text-indigo-400' : 'border-red-500/50 text-red-500'}`;
            modal.classList.add('active');
        }

        function closeModal() { document.getElementById('status-modal').classList.remove('active'); }

        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            document.getElementById('loading-modal').classList.add('active');
            try {
                const response = await axios.post(this.action, new FormData(this));
                document.getElementById('loading-modal').classList.remove('active');
                if (response.data.status === 'success') {
                    showModal("Identitas kamu udah terverifikasi", "Selamat datang kembali !", true);
                    setTimeout(() => { window.location.href = response.data.redirect; }, 1500);
                }
            } catch (err) {
                document.getElementById('loading-modal').classList.remove('active');
                const errorMsg = err.response?.data?.message || "Invalid coordinates provided.";
                showModal("Oops, Ada yang salah.", errorMsg, false);
            }
        });

        // Firebase Google/Apple login handlers remain the same but added the modal toggle
        window.googleLogin = async function() {
            const provider = new firebase.auth.GoogleAuthProvider();
            provider.setCustomParameters({ prompt: 'select_account' });
            try {
                document.getElementById('loading-modal').classList.add('active');
                const result = await firebase.auth().signInWithPopup(provider);
                const idToken = await result.user.getIdToken();
                const response = await axios.post('/login-firebase', { idToken });
                if (response.data.status === 'success') {
                    showModal("Identitas kamu udah terverifikasi", "Selamat datang kembali !", true);
                    setTimeout(() => { window.location.href = response.data.redirect; }, 1500);
                }
            } catch (e) {
                document.getElementById('loading-modal').classList.remove('active');
                showModal("Oops, Ada yang salah.", errorMsg, false);
            }
        };

        window.appleLogin = async function() {
            const provider = new firebase.auth.OAuthProvider('apple.com');
            try {
                document.getElementById('loading-modal').classList.add('active');
                const result = await firebase.auth().signInWithPopup(provider);
                const idToken = await result.user.getIdToken();
                const response = await axios.post('/login-firebase', { idToken });
                if (response.data.status === 'success') {
                    showModal("Identity Verified", "Apple node sync complete.", true);
                    setTimeout(() => { window.location.href = response.data.redirect; }, 1500);
                }
            } catch (e) {
                document.getElementById('loading-modal').classList.remove('active');
                showModal("Sync Error", "Apple authentication failed.", false);
            }
        };
    </script>
</body>
</html>