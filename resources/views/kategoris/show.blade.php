@extends('app')

@section('content')
<style>
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.4);
        --card-bg: rgba(255, 255, 255, 0.02);
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    /* Background & Ornamen Tetap Luxury */
    .bg-mesh {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: 
            radial-gradient(circle at 15% 15%, rgba(99, 102, 241, 0.12) 0%, transparent 40%),
            radial-gradient(circle at 85% 85%, rgba(99, 102, 241, 0.12) 0%, transparent 40%);
        pointer-events: none;
        z-index: -1;
    }

    .bg-mesh::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        mask-image: linear-gradient(to right, black, transparent);
        opacity: 0.2;
    }

    .side-ornament {
        position: fixed;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 40px;
        z-index: 10;
        pointer-events: none;
    }

    .side-line {
        width: 1px;
        height: 150px;
        background: linear-gradient(to bottom, transparent, var(--accent), transparent);
        margin-right: 15px;
    }

    .rotating-text {
        writing-mode: vertical-rl;
        font-size: 8px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: rgba(255,255,255,0.1);
        animation: slideVertical 10s linear infinite;
    }

    @keyframes slideVertical {
        from { transform: translateY(0); }
        to { transform: translateY(50px); }
    }

    /* Header */
    .node-header { padding: 160px 0 100px 0; position: relative; }
    .big-title {
        font-size: clamp(4rem, 10vw, 8.5rem);
        font-weight: 950;
        line-height: 0.8;
        text-transform: uppercase;
        letter-spacing: -0.06em;
        color: white;
    }
    .title-outline {
        -webkit-text-stroke: 1.5px rgba(255,255,255,0.2);
        color: transparent;
        display: block;
        margin-top: 15px;
        font-style: italic;
    }

    .stats-container {
        display: inline-flex;
        align-items: center;
        gap: 30px;
        margin-top: 60px;
        padding: 20px 40px;
        background: rgba(255,255,255,0.02);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 30px;
    }

    /* Card Grid */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 40px;
        padding-bottom: 150px;
    }

    .book-card {
        background: rgba(255, 255, 255, 0.01);
        border: 1px solid var(--glass-border);
        border-radius: 40px;
        padding: 20px;
        transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }
    .book-card:hover {
        transform: translateY(-15px);
        border-color: var(--accent-glow);
        background: rgba(255, 255, 255, 0.03);
    }

    /* Empty State */
    .empty-state { padding: 100px 0; text-align: center; }
    .empty-box {
        background: var(--card-bg);
        border: 1px dashed rgba(255,255,255,0.1);
        border-radius: 40px;
        padding: 80px;
        display: inline-block;
        transition: 0.5s;
        backdrop-filter: blur(10px);
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .btn-premium {
        position: relative;
        overflow: hidden;
        background: white;
        color: black;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow: 0 0 0 rgba(99, 102, 241, 0);
    }

    /* Efek Kilatan Cahaya (Shimmer) */
    .btn-premium::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
        transform: translateX(-100%);
        transition: 0.6s;
    }

    .btn-premium:hover {
        background: var(--accent);
        color: white;
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 30px var(--accent-glow), 0 0 60px rgba(99, 102, 241, 0.2);
    }

    .btn-premium:hover::after {
        animation: shimmer 0.8s infinite;
    }

    .btn-premium:active {
        transform: translateY(-2px) scale(0.98);
    }

    .btn-premium, .header-link-premium {
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }

    /* Efek Kilatan Cahaya (Shimmer) */
    .btn-premium::after, .header-link-premium::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
    }

    .btn-premium:hover::after, .header-link-premium:hover::after {
        left: 100%;
        transition: 0.6s;
    }

    /* Hover Khusus Link Header */
    .header-link-premium:hover {
        color: white !important;
        letter-spacing: 0.4em;
        transform: translateX(10px);
    }

    /* Hover Judul Besar (Glow Effect) */
    .big-title {
        transition: all 0.8s ease;
        cursor: default;
    }
    
    .big-title:hover {
        text-shadow: 0 0 30px var(--accent-glow);
        transform: scale(1.02);
    }

    .title-outline:hover {
        -webkit-text-stroke: 1.5px var(--accent);
        transition: 0.5s;
    }
</style>

<div class="bg-mesh"></div>

<div class="reveal-up">
    <header class="node-header">
        <div class="max-w-7xl mx-auto px-8">
            <a href="{{ route('kategori.index') }}" 
               class="header-link-premium inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.3em] text-white/20 mb-12 py-2 pr-4">
                <span class="text-lg">←</span> Kembali ke Rak Utama
            </a>
            
            <h1 class="big-title group">
                {{ $kategori->nama }}
                <span class="title-outline transition-all duration-500">Koleksi Terpilih Untukmu.</span>
            </h1>

            <div class="stats-container group hover:border-indigo-500/50 transition-all duration-500">
                <div class="flex flex-col">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-widest mb-1">Total Buku</span>
                    <span class="text-3xl font-black text-white italic group-hover:text-indigo-400 transition-colors">
                        {{ $kategori->bukus->count() }} <small class="text-xs opacity-30">BUAH</small>
                    </span>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div class="flex flex-col">
                    <span class="text-[7px] font-black text-white/20 uppercase tracking-widest mb-1">Kondisi Rak</span>
                    <span class="text-[11px] font-black text-emerald-500 uppercase flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Tersusun Rapi
                    </span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8">
        @if($kategori->bukus->count() > 0)
            <div class="book-grid">
                @foreach($kategori->bukus as $buku)
                <div class="book-card group">
                    <div class="cover-wrapper relative rounded-[30px] overflow-hidden aspect-[3/4.2]">
                        <img src="{{ $buku->image_url ?? 'https://via.placeholder.com/400x600/0a0a0a/ffffff?text=No+Cover' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                            <div class="flex flex-col gap-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <a href="{{ route('bukus.edit', $buku->id) }}" class="w-full py-3 bg-white text-black text-[9px] font-black uppercase tracking-widest text-center rounded-xl hover:bg-indigo-500 hover:text-white transition-all">Ubah Data</a>
                                <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="w-full py-3 bg-white/10 text-white text-[9px] font-black uppercase tracking-widest text-center rounded-xl backdrop-blur-md border border-white/10 hover:bg-red-500/80 transition-all">Hapus Buku</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter leading-none mb-3 group-hover:text-indigo-400 transition-colors">{{ Str::limit($buku->judul, 25) }}</h3>
                        <p class="text-[9px] font-bold text-white/30 uppercase tracking-[0.2em]">{{ $buku->penulis ?? 'Penulis Rahasia' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
      @else
            <div class="empty-state">
                <div class="empty-box">
                    <div class="relative w-20 h-20 mx-auto mb-8">
                        <div class="absolute inset-0 bg-indigo-500/20 rounded-3xl animate-ping"></div>
                        <div class="relative w-20 h-20 bg-white/5 rounded-3xl flex items-center justify-center border border-white/10 backdrop-blur-sm">
                            <span class="text-3xl">✨</span>
                        </div>
                    </div>

                    <h2 class="text-2xl font-black text-white uppercase italic mb-3">Wah, Raknya Masih Kosong!</h2>
                    <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.3em] mb-10">Koleksi ini belum ada isinya, yuk tambahin buku pertama kamu!</p>
                    
                    <a href="{{ route('bukus.create', ['kategori_id' => $kategori->id]) }}" 
                       class="btn-premium px-12 py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] inline-block">
                        Tambah Buku Sekarang
                    </a>
                </div>
            </div>
        @endif
    </main>
</div>
@endsection