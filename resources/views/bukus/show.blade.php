@extends('app')

@section('content')
<style>
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.4);
        --card-bg: rgba(255, 255, 255, 0.03);
        --glass-border: rgba(255, 255, 255, 0.08);
        --smooth-ease: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .bg-mesh {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at 15% 15%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                    radial-gradient(circle at 85% 85%, rgba(99, 102, 241, 0.15) 0%, transparent 40%);
        pointer-events: none; z-index: -1;
    }

    /* Link Kembali yang Lebih Smooth */
    .header-link-premium {
        position: relative; overflow: hidden;
        transition: all 0.6s var(--smooth-ease);
        display: inline-flex; align-items: center;
    }
    .header-link-premium:hover { 
        color: white !important; 
        letter-spacing: 0.5em; 
        transform: translateX(15px);
        opacity: 1;
    }

    /* Judul Besar dengan Glow Halus */
    .big-title-glow {
        transition: all 0.8s var(--smooth-ease);
    }
    .big-title-glow:hover {
        text-shadow: 0 0 40px var(--accent-glow);
        transform: translateY(-5px) scale(1.02);
    }

    /* Glass Panel */
    .glass-panel {
        background: var(--card-bg);
        backdrop-filter: blur(30px);
        border: 1px solid var(--glass-border);
        border-radius: 50px;
        padding: 60px;
        box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.5);
    }

    /* Hover Gambar yang Lebih Dinamis */
    .cover-shadow {
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.6);
        transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .cover-shadow:hover { 
        transform: scale(1.08) rotate(-2deg); 
        box-shadow: 0 40px 80px -15px rgba(99, 102, 241, 0.3);
    }

    /* Info Box dengan Border Glow */
    .info-box {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.5s var(--smooth-ease);
    }
    .info-box:hover {
        background: rgba(255, 255, 255, 0.07);
        border-color: var(--accent);
        transform: translateY(-8px);
        box-shadow: 0 15px 30px -10px rgba(99, 102, 241, 0.2);
    }

    /* Badge Kecil */
    .meta-badge {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.5);
        transition: all 0.4s var(--smooth-ease);
    }
    .meta-badge:hover {
        background: rgba(255, 255, 255, 0.12);
        color: white;
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.3);
    }

    /* Button Shimmer Premium */
    .btn-shimmer {
        position: relative; overflow: hidden;
        transition: all 0.5s var(--smooth-ease);
    }
    .btn-shimmer::after {
        content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: 0.6s;
    }
    .btn-shimmer:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3);
    }
    .btn-shimmer:hover::after { left: 100%; }
</style>

<div class="bg-mesh"></div>

<div class="book-container max-w-7xl mx-auto px-8 py-24">
    <a href="{{ url()->previous() }}" class="header-link-premium text-[10px] font-black uppercase tracking-[0.3em] text-white/20 mb-12 py-2 pr-4">
        <span class="text-lg mr-3">←</span> Kembali ke Koleksi
    </a>

    <div class="glass-panel grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
        <div class="lg:col-span-4">
            <div class="relative group">
                <div class="absolute -inset-4 bg-indigo-500/10 rounded-[40px] blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <img src="{{ $buku->image_url ?? asset('storage/' . $buku->cover) }}"
                    onerror="this.src='https://via.placeholder.com/600x900/0a0a0a/ffffff?text=No+Cover'"
                    class="relative w-full aspect-[3/4.5] object-cover rounded-[35px] cover-shadow border border-white/10">
            </div>
        </div>

        <div class="lg:col-span-8">
            <div class="flex flex-wrap gap-3 mb-8">
                <span class="meta-badge text-emerald-400 border-emerald-500/20">Status: Tersedia</span>
                
                <span class="meta-badge text-indigo-400 border-indigo-500/20 italic">
                    @php
                        $cekKategori = \App\Models\Kategori::find($buku->kategori_id);
                    @endphp
                    @if($cekKategori)
                        ✨ {{ $cekKategori->nama_kategori }} 
                    @else
                        ⚠️ ID: {{ $buku->kategori_id ?? '?' }}
                    @endif
                </span>

                <span class="meta-badge">REF-{{ str_pad($buku->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>

            <h1 class="big-title-glow text-5xl lg:text-7xl font-black text-white italic uppercase tracking-tighter leading-tight mb-4 cursor-default">
                {{ $buku->judul }}
            </h1>

            <p class="text-xl font-bold text-white/40 uppercase tracking-[0.3em] mb-12">
                Karya: <span class="text-white hover:text-indigo-400 transition-colors duration-500">{{ $buku->penulis }}</span>
            </p>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-12">
                <div class="info-box p-6 rounded-3xl group">
                    <span class="text-[8px] font-black text-white/20 uppercase tracking-widest block mb-2">Penerbit</span>
                    <span class="text-xl font-black text-white italic group-hover:text-indigo-400 transition-colors duration-500">{{ $buku->penerbit ?? '-' }}</span>
                </div>
                <div class="info-box p-6 rounded-3xl group">
                    <span class="text-[8px] font-black text-white/20 uppercase tracking-widest block mb-2">Tahun Terbit</span>
                    <span class="text-xl font-black text-white italic group-hover:text-indigo-400 transition-colors duration-500">{{ $buku->tahun_terbit ?? '-' }}</span>
                </div>
                <div class="info-box p-6 rounded-3xl group">
                    <span class="text-[8px] font-black text-white/20 uppercase tracking-widest block mb-2">Jumlah Stok</span>
                    <span class="text-xl font-black text-white italic group-hover:text-indigo-400 transition-colors duration-500">{{ $buku->stok ?? '0' }} <small class="text-[10px] opacity-30 italic">PCS</small></span>
                </div>
            </div>

            @if($buku->deskripsi)
            <div class="mb-12 p-8 rounded-[30px] bg-white/[0.02] border border-white/5 hover:border-white/10 transition-all duration-700">
                <span class="text-[8px] font-black text-white/20 uppercase tracking-widest block mb-4">Sinopsis / Catatan</span>
                <p class="text-white/60 leading-relaxed font-medium italic">
                    "{{ $buku->deskripsi }}"
                </p>
            </div>
            @endif

            <div class="flex flex-wrap gap-4 pt-8 border-t border-white/10">
                <a href="{{ route('bukus.edit', $buku->id) }}"
                    class="btn-shimmer px-10 py-5 bg-white text-black rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-indigo-600 hover:text-white transition-all">
                    Ubah Data Buku
                </a>

                <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus buku ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="btn-shimmer px-10 py-5 bg-white/5 border border-white/10 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-red-500 transition-all">
                        Hapus dari Rak
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection