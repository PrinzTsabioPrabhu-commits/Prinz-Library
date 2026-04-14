@extends('app')

@section('content')
<style>
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.4);
        --card-bg: rgba(255, 255, 255, 0.015);
        --glass-border: rgba(255, 255, 255, 0.06);
    }

    @keyframes smoothReveal {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Animasi Denyut untuk Card Kosong */
    @keyframes waitingPulse {
        0% {
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0px rgba(99, 102, 241, 0);
        }

        50% {
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.05);
        }

        100% {
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0px rgba(99, 102, 241, 0);
        }
    }

    .reveal-card {
        animation: smoothReveal 1.4s cubic-bezier(0.19, 1, 0.22, 1) both;
    }

    .koleksi-card {
        background: var(--card-bg);
        backdrop-filter: blur(40px) saturate(200%);
        border: 1px solid var(--glass-border);
        border-radius: 44px;
        padding: 4rem 3rem 3rem 3rem;
        transition: all 0.9s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
        overflow: hidden;
    }

    .koleksi-card:hover {
        background: rgba(255, 255, 255, 0.04);
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateY(-12px);
        box-shadow: 0 50px 100px -30px rgba(0, 0, 0, 0.6);
    }

    .card-empty {
        animation: waitingPulse 3s infinite ease-in-out;
    }

    .mini-book-item {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 26px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 24px;
        border: 1px solid transparent;
        transition: 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mini-book-item:hover {
        background: rgba(255, 255, 255, 0.07);
        border-color: rgba(255, 255, 255, 0.1);
        transform: translateX(12px) scale(1.02);
    }

    .btn-tambah-soft {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 14px 28px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.4);
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        transition: all 0.5s ease;
    }

    .btn-tambah-soft:hover {
        background: var(--accent);
        color: white;
        border-color: var(--accent);
        transform: translateY(-4px);
        box-shadow: 0 15px 30px var(--accent-glow);
    }


    .footer-premium {
        opacity: 0.2;
        /* Lebih redup saat diam agar fokus ke konten utama */
        transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        border-top: 1px solid rgba(255, 255, 255, 0.03);
    }

    .footer-premium:hover {
        opacity: 1;
        background: linear-gradient(to top, rgba(99, 102, 241, 0.02), transparent);
    }

    /* Garis tipis yang menyatu */
    .footer-line-minimal {
        width: 30px;
        height: 1px;
        background: rgba(255, 255, 255, 0.05);
        transition: all 1s ease;
    }

    .group\/pesan:hover .footer-line-minimal {
        width: 60px;
        background: var(--accent);
        box-shadow: 0 0 15px var(--accent);
    }

    /* Hover Teks: Mainkan Opacity, bukan cuma jarak */
    .footer-text-soft {
        transition: all 1s ease;
        letter-spacing: 0.8em;
    }

    .footer-premium:hover .footer-text-soft {
        letter-spacing: 1em;
        /* Cuma nambah sedikit biar nggak "rusak" layoutnya */
        color: rgba(255, 255, 255, 0.9);
    }
</style>

<div class="py-24 lg:py-36 max-w-7xl mx-auto px-10">
    <header class="flex flex-col lg:flex-row lg:items-end justify-between gap-16 mb-40 relative">
        <div class="relative">
            <div class="flex items-center gap-4 mb-8 group cursor-default">
                <div class="w-10 h-[1px] bg-indigo-500/30 group-hover:w-16 group-hover:bg-indigo-500 transition-all duration-1000"></div>
                <span class="text-[9px] font-black tracking-[1em] uppercase text-indigo-400/50 italic">Personal Reading Space</span>
            </div>

            <h1 class="text-9xl font-black italic tracking-tighter text-white uppercase leading-[0.75] transition-all duration-1000 group cursor-default">
                Arsip<br>
                <span class="relative">
                    <span style="-webkit-text-stroke: 1px rgba(255,255,255,0.15); color: transparent;">Kenangan.</span>
                    <span class="absolute -right-20 bottom-4 text-[8px] tracking-[0.5em] text-indigo-500/40 font-black animate-pulse uppercase">Curated</span>
                </span>
            </h1>

            <div class="mt-12 flex items-center gap-12">
                <div class="flex flex-col gap-1.5 border-l-2 border-indigo-500/20 pl-6 hover:border-indigo-500 transition-colors duration-700">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-[0.5em]">Kolektor</span>
                    <span class="text-[10px] font-bold text-white/50 uppercase tracking-[0.2em]">{{Auth::user()->name}}</span>
                </div>
                <div class="flex flex-col gap-1.5 border-l-2 border-white/5 pl-6">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-[0.5em]">Status Rak</span>
                    <span class="text-[10px] font-bold text-white/50 uppercase tracking-[0.2em]">Terorganisir</span>
                </div>
                <div class="flex flex-col gap-1.5 border-l-2 border-white/5 pl-6">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-[0.5em]">Wilayah</span>
                    <span class="text-[10px] font-bold text-white/50 uppercase tracking-[0.2em]">Malang, ID</span>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex flex-col items-end gap-6 text-right">
            <div class="group cursor-default">
                <span class="text-[8px] font-black text-white/10 uppercase tracking-[0.6em] group-hover:text-indigo-400 transition-colors duration-700">Digital Library Interface</span>
                <div class="flex items-center justify-end gap-3 mt-2">
                    <span class="text-[10px] font-bold text-white/30 uppercase tracking-[0.3em]">Aktif & Nyaman</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_15px_var(--accent)]"></div>
                </div>
            </div>
            <div class="p-6 bg-white/[0.02] border border-white/5 rounded-3xl backdrop-blur-sm">
                <p class="text-[7px] leading-relaxed text-white/20 uppercase tracking-[0.3em] max-w-[180px]">
                    Setiap buku adalah jendela, simpan ia dengan rasa hormat di sini.
                </p>
            </div>
        </div>
    </header>

    <div class="grid lg:grid-cols-2 gap-14">
        @forelse($kategoris as $index => $kategori)
        <div class="koleksi-card group reveal-card {{ $kategori->bukus->count() == 0 ? 'card-empty' : '' }}" style="animation-delay: {{ $index * 0.2 }}s;">

            <span class="absolute top-8 right-12 text-[6px] font-black text-white/5 uppercase tracking-[1em] group-hover:text-indigo-500/20 transition-colors">
                Ref.0{{ $index + 1 }}
            </span>

            <div class="flex justify-between items-start relative z-10 mb-14">
                <div>
                    <div class="flex items-center gap-3 mb-5 opacity-40 group-hover:opacity-100 transition-all duration-700">
                        <div class="w-2 h-2 border border-indigo-500 group-hover:rotate-45 transition-transform duration-700"></div>
                        <span class="text-[8px] font-black text-indigo-400 uppercase tracking-[0.5em]">Koleksi {{ sprintf('%02d', $index + 1) }}</span>
                    </div>
                    <h3 class="text-4xl font-black text-white italic uppercase tracking-tighter leading-none group-hover:translate-x-2 transition-transform duration-700">
                        {{ $kategori->nama_kategori }}
                    </h3>
                </div>
                <div class="px-5 py-2 rounded-full bg-white/[0.03] border border-white/5 text-[8px] font-black text-white/40 uppercase tracking-widest group-hover:bg-indigo-500 group-hover:text-white transition-all duration-700">
                    {{ $kategori->bukus->count() }} Items
                </div>
            </div>

            @if($kategori->bukus->count() > 0)
            <div class="flex flex-col gap-5 relative z-10">
                @foreach($kategori->bukus->take(3) as $buku)
                <div class="mini-book-item group/item">
                    <img src="{{ $buku->image_url ?? 'https://via.placeholder.com/100x140/0a0a0a/ffffff?text=?' }}" class="w-12 h-16 rounded-xl object-cover shadow-2xl grayscale group-hover/item:grayscale-0 transition-all duration-700">
                    <div class="flex-grow">
                        <h4 class="text-[14px] font-black text-white/90 uppercase tracking-tight leading-tight">{{ Str::limit($buku->judul, 40) }}</h4>
                        <div class="flex items-center gap-3 mt-2.5">
                            <span class="w-4 h-px bg-white/10 group-hover/item:bg-indigo-500 transition-all"></span>
                            <p class="text-[8px] text-white/30 uppercase tracking-[0.2em] font-bold italic">{{ $buku->penulis ?? 'Anonim' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('bukus.edit', $buku->id) }}" class="w-10 h-10 rounded-2xl flex items-center justify-center border border-white/5 opacity-0 group-hover/item:opacity-100 transition-all hover:bg-white hover:text-black hover:-rotate-12">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2.5" />
                        </svg>
                    </a>
                </div>
                @endforeach

                <div class="mt-8">
                    <a href="{{ route('bukus.create', ['kategori_id' => $kategori->id]) }}" class="btn-tambah-soft group/btn">
                        <svg class="w-3 h-3 group-hover/btn:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" stroke-width="3" />
                        </svg>
                        Tambahkan Karya Baru
                    </a>
                </div>
            </div>
            @else
            <div class="mt-4 p-14 border border-dashed border-white/5 rounded-[44px] bg-white/[0.01] text-center relative z-10 transition-all group-hover:border-indigo-500/30 group-hover:bg-indigo-500/[0.02]">
                <div class="w-12 h-12 rounded-full border border-white/5 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-700">
                    <svg class="w-5 h-5 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="1.5" />
                    </svg>
                </div>
                <p class="text-[9px] text-white/20 uppercase tracking-[0.4em] mb-8 italic">Belum ada jejak di sudut ini.</p>
                <a href="{{ route('bukus.create') }}" class="btn-tambah-soft">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-width="3" />
                    </svg>
                    Mulai Menulis
                </a>
            </div>
            @endif

            <div class="mt-14 pt-10 border-t border-white/5 flex justify-between items-center relative z-10 opacity-0 group-hover:opacity-100 transition-all duration-1000 translate-y-6 group-hover:translate-y-0">
                <span class="text-[8px] font-black text-white/10 uppercase tracking-[0.5em]">Terjaga Selamanya</span>
                <a href="{{ route('kategoris.show', $kategori->id) }}" class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.3em] hover:tracking-[0.5em] transition-all italic flex items-center gap-3">
                    Buka Sudut Baca
                    <span class="text-indigo-500">→</span>
                </a>
            </div>
        </div>
        @empty
        <div class="koleksi-card card-empty reveal-card">
            <span class="absolute top-8 right-12 text-[6px] font-black text-white/5 uppercase tracking-[1em]">Ref.00</span>
            <div class="text-center py-20 px-10">
                <div class="w-16 h-16 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-10">
                    <svg class="w-6 h-6 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="1.5" />
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-white italic uppercase tracking-tighter mb-4">Ruang Hampa</h3>
                <p class="text-[9px] text-white/20 uppercase tracking-[0.4em] mb-10 leading-relaxed">
                    Belum ada kategori yang dikoleksi.<br>Buat struktur bacaanmu sendiri sekarang.
                </p>
                <a href="{{ route('bukus.create') }}" class="btn-tambah-soft inline-flex">
                    Sematkan Karya Pertama
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Global Discovery Archives --}}
    @if(count($apiCategories) > 0)
    <div class="mt-40">
        <div class="flex items-center gap-6 mb-20 animate-pulse">
            <div class="h-[1px] w-20 bg-indigo-500/30"></div>
            <h2 class="text-[11px] font-black uppercase tracking-[1.2em] text-white/30 italic">Global Discovery Mode</h2>
            <div class="h-[1px] flex-grow bg-white/5"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-14 opacity-60 hover:opacity-100 transition-opacity duration-1000">
            @foreach($apiCategories as $item)
            <div class="koleksi-card group border-dashed border-indigo-500/20 hover:border-indigo-500/40">
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <div class="flex items-center gap-3 mb-5 opacity-40">
                            <span class="text-[8px] font-black text-indigo-400 uppercase tracking-[0.5em]">Global Archives</span>
                        </div>
                        <h3 class="text-4xl font-black text-white italic uppercase tracking-tighter">{{ $item['name'] }}</h3>
                    </div>
                    @if($item['sample_thumb'])
                    <img src="{{ $item['sample_thumb'] }}" class="w-16 h-20 rounded-xl object-cover grayscale opacity-30 group-hover:opacity-60 transition-all duration-700">
                    @endif
                </div>
                
                <p class="text-[10px] text-white/20 uppercase tracking-[0.1em] leading-relaxed mb-10 line-clamp-3">
                    {{ $item['description'] }}
                </p>

                <div class="flex justify-between items-center border-t border-white/5 pt-8">
                    <span class="text-[8px] font-black text-white/10 uppercase tracking-[0.3em]">{{ $item['totalItems'] }} Volumes Detected</span>
                    <a href="{{ route('reader', $item['google_id'] ?? '') }}" class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.3em] hover:tracking-[0.5em] transition-all">
                        Eksplorasi →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    </div>

    <footer class="footer-premium mt-32 py-16 flex flex-col md:flex-row justify-between items-center gap-8 cursor-default relative">

        <div class="flex flex-col gap-1.5 items-center md:items-start group/identitas">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-white/5 group-hover/identitas:bg-indigo-500 group-hover/identitas:shadow-[0_0_12px_rgba(99,102,241,0.8)] transition-all duration-700"></div>
                <span class="text-[10px] font-black uppercase tracking-[1em] text-white/20 group-hover/identitas:text-indigo-400 footer-text-soft">
                    Selasar {{Auth::user()->name}}
                </span>
            </div>
            <span class="text-[8px] font-bold text-white/5 uppercase tracking-[0.4em] ml-4 group-hover/identitas:text-white/20 transition-all duration-1000">
                Kenangan Menetap &bull; Malang {{ date('Y') }}
            </span>
        </div>

        <div class="flex items-center gap-6 group/pesan">
            <div class="footer-line-minimal"></div>
            <div class="flex flex-col items-end gap-1">
                <span class="text-[9px] font-black uppercase tracking-[0.6em] italic text-white/5 group-hover/pesan:text-white/40 transition-all">
                    Terima kasih telah berkunjung
                </span>
                <span class="text-[7px] font-medium uppercase tracking-[0.3em] text-white/0 group-hover/pesan:text-indigo-400/30 transition-all">
                    Semoga harimu penuh inspirasi
                </span>
            </div>
            <div class="h-6 w-px bg-white/5 group-hover/pesan:bg-indigo-500/40 transition-all"></div>
        </div>

        <div class="absolute -bottom-2 right-4 opacity-0 group-hover/header:opacity-[0.02] pointer-events-none transition-opacity duration-1000">
            <span class="text-[60px] font-black italic tracking-tighter">PRINZ</span>
        </div>
    </footer>
</div>
@endsection