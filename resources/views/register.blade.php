<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THE ARCHIVE | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        /* REFINED INPUT SYSTEM */
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

        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .loaded .reveal-up {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="opacity-0 transition-opacity duration-1000">
    <div class="noise-overlay"></div>
    <div class="ambient-aura top-[-20%] left-[-10%]"></div>
    <div class="ambient-aura bottom-[-20%] right-[-10%]"></div>

    <div class="w-full max-w-[1200px] p-6">
        <div class="glass-bento grid lg:grid-cols-2">
            <!-- Branding Side -->
            <div class="p-20 flex flex-col justify-between border-r border-white/5 bg-white/[0.01]">
                <div>
                    <div class="flex items-center gap-4 mb-16 reveal-up" style="transition-delay: 100ms">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center font-black text-black italic text-xl animate-float">P</div>
                        <div class="text-[9px] font-black uppercase tracking-[0.5em] leading-none text-white/40">Prinz Library // Registration</div>
                    </div>
                    <h1 class="editorial-title text-6xl lg:text-7xl mb-10 reveal-up" style="transition-delay: 200ms">THE <br> <span class="outline-text">ASCENSION.</span></h1>
                    <p class="text-[11px] text-white/40 uppercase tracking-[0.3em] leading-loose max-w-sm reveal-up" style="transition-delay: 300ms">Mulai preservasi digital Anda sekarang. Buat identitas unik untuk mengakses koleksi literatur <span class="text-white font-bold">premium</span> kami.</p>
                </div>
                <div class="pt-10 reveal-up" style="transition-delay: 400ms">
                    <div class="text-[10vw] font-black text-white/[0.02] select-none leading-none absolute -bottom-10 left-10 pointer-events-none">JOIN</div>
                    <div class="flex items-center gap-4 text-white/20 text-[9px] font-black uppercase tracking-widest">
                        <span>Luxe Identity Initialization</span>
                        <span class="w-1 h-1 bg-indigo-500 rounded-full"></span>
                        <span>v2.0 Protocol</span>
                    </div>
                </div>
            </div>

            <!-- Form Side -->
            <div class="p-16 lg:p-20 overflow-y-auto max-h-[90vh]">
                <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-6 reveal-up" style="transition-delay: 400ms">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Nama Lengkap</label>
                            <input type="text" name="name" required class="input-luxe" placeholder="NAMA">
                        </div>
                        <div class="space-y-1 group">
                            <label class="luxe-label">Username</label>
                            <input type="text" name="username" required class="input-luxe" placeholder="USERNAME">
                        </div>
                    </div>

                    <div class="space-y-1 group reveal-up" style="transition-delay: 500ms">
                        <label class="luxe-label">Alamat Email Kamu</label>
                        <input type="email" name="email" required class="input-luxe" placeholder="EMAIL">
                    </div>

                    <div class="grid grid-cols-2 gap-6 reveal-up" style="transition-delay: 600ms">
                        <div class="space-y-1 group relative">
                            <label class="luxe-label">Password</label>
                            <input type="password" name="password" id="password" required class="input-luxe" placeholder="••••••••">
                            <button type="button" onclick="togglePass('password', 'eye-1')" class="absolute right-4 top-[32px] text-white/20 hover:text-white transition-colors">
                                <span id="eye-1-text" class="text-[8px] font-black uppercase tracking-widest leading-none">Show</span>
                            </button>
                        </div>
                        <div class="space-y-1 group relative">
                            <label class="luxe-label">confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirm" required class="input-luxe" placeholder="••••••••">
                            <button type="button" onclick="togglePass('password_confirm', 'eye-2')" class="absolute right-4 top-[32px] text-white/20 hover:text-white transition-colors">
                                <span id="eye-2-text" class="text-[8px] font-black uppercase tracking-widest leading-none">Show</span>
                            </button>
                        </div>
                    </div>

                    <div class="pt-6 reveal-up" style="transition-delay: 700ms">
                        <button type="submit" class="btn-premium !rounded-3xl">Daftar Sekarang</button>
                    </div>

                    <div class="pt-6 text-center reveal-up" style="transition-delay: 800ms">
                        <a href="{{ route('login') }}" class="text-[9px] font-black uppercase tracking-[0.3em] text-white/30 hover:text-indigo-400 transition-all duration-500">Already registered? <span class="text-white">Verify Entry</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => { 
            setTimeout(() => { 
                document.body.classList.remove('opacity-0'); 
                document.body.classList.add('loaded');
            }, 100); 
        });

        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const iconText = document.getElementById(iconId + '-text');
            if (input.type === "password") {
                input.type = "text";
                iconText.textContent = "Hide";
            } else {
                input.type = "password";
                iconText.textContent = "Show";
            }
        }
    </script>
</body>
</html>
