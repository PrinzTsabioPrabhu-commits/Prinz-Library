@extends('app')

@section('content')
<style>
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.4);
        --card-bg: rgba(255, 255, 255, 0.015);
        --glass-border: rgba(255, 255, 255, 0.06);
    }

    .cluster-node {
        background: var(--card-bg);
        backdrop-filter: blur(30px) saturate(180%);
        border: 1px solid var(--glass-border);
        border-radius: 40px;
        padding: 3.5rem 3rem 2.5rem 3rem;
        transition: all 0.6s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
        overflow: hidden;
    }

    .cluster-node:hover {
        background: rgba(255, 255, 255, 0.035);
        border-color: rgba(99, 102, 241, 0.6);
        transform: translateY(-12px) scale(1.01);
        box-shadow: 0 50px 100px -20px rgba(0,0,0,0.7), 0 0 30px rgba(99, 102, 241, 0.1);
    }

    .mini-book-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-top: 2.5rem;
    }

    .mini-book-item {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 24px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        border: 1px solid transparent;
        transition: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mini-book-item:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--accent);
        transform: translateX(12px);
    }

    .mini-cover {
        width: 44px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.05);
    }

    .status-badge {
        font-size: 8px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 6px 14px;
        border-radius: 100px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.5);
    }

    .btn-add-more {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 2rem;
        padding: 12px 24px;
        border-radius: 18px;
        background: rgba(99, 102, 241, 0.05);
        border: 1px dashed rgba(99, 102, 241, 0.4);
        color: var(--accent);
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: 0.4s ease;
    }

    .btn-add-more:hover {
        background: var(--accent);
        color: white;
        border-style: solid;
        box-shadow: 0 15px 30px var(--accent-glow);
    }

    .fab-add {
        position: fixed;
        bottom: 50px;
        right: 50px;
        z-index: 100;
        background: #fff;
        color: #000;
        width: 72px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 26px;
        box-shadow: 0 35px 70px -15px rgba(0, 0, 0, 0.6);
        transition: 0.6s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .fab-add:hover {
        transform: scale(1.15) rotate(180deg);
        background: var(--accent);
        color: #fff;
    }
</style>

<div class="reveal-up">
    @auth
    <a href="{{ route('bukus.create') }}" class="fab-add group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
        </svg>
    </a>
    @endauth

    <div class="py-20 lg:py-32 max-w-7xl mx-auto px-8">
        <header class="flex flex-col lg:flex-row lg:items-end justify-between gap-12 mb-32">
            <div>
                <span class="text-[10px] font-black tracking-[1.2em] uppercase text-indigo-500/60 block mb-6 italic underline decoration-indigo-500/20 underline-offset-[12px]">Intelligence_Nodes</span>
                <h1 class="text-8xl lg:text-9xl font-black italic tracking-tighter text-white uppercase leading-[0.8]">
                    Vault<br><span class="text-indigo-500 opacity-90">Clusters.</span>
                </h1>
            </div>
            <div class="text-right">
                <div class="flex items-center justify-end gap-3 mb-4">
                    <span class="text-[9px] font-black text-white/40 uppercase tracking-[0.4em]">Network_Stable</span>
                    <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 shadow-[0_0_15px_var(--accent)] animate-pulse"></div>
                </div>
                <p class="text-[8px] font-mono text-white/5 uppercase tracking-[0.6em]">Active_Protocol: V2.4.0_PRINZ</p>
            </div>
        </header>

        <div class="grid lg:grid-cols-2 gap-12">
            @foreach($kategoris as $index => $kategori)
            <div class="cluster-node group">
                <div class="absolute -top-32 -right-32 w-64 h-64 bg-indigo-600/10 blur-[120px] rounded-full group-hover:bg-indigo-600/20 transition-all"></div>

                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <span class="w-10 h-px bg-indigo-500/30"></span>
                            <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.5em] italic">Node_{{ sprintf('%02d', $index + 1) }}</span>
                        </div>
                        <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter leading-none">{{ $kategori->nama_kategori }}</h3>
                    </div>
                    <div class="status-badge">
                        {{ $kategori->bukus->count() }} Assets
                    </div>
                </div>

                @if($kategori->bukus->count() > 0)
                    <div class="mini-book-list relative z-10">
                        @foreach($kategori->bukus->take(3) as $buku)
                        <div class="mini-book-item group/item">
                            <img src="{{ $buku->image_url ?? 'https://via.placeholder.com/100x140/0a0a0a/ffffff?text=?' }}" class="mini-cover">
                            <div class="flex-grow">
                                <h4 class="text-[13px] font-black text-white/95 uppercase tracking-tight leading-tight">{{ Str::limit($buku->judul, 38) }}</h4>
                                <p class="text-[9px] text-white/30 uppercase tracking-[0.2em] font-bold mt-2">{{ $buku->penulis ?? 'Classified_Author' }}</p>
                            </div>
                            <a href="{{ route('bukus.edit', $buku->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center border border-white/5 opacity-0 group-hover/item:opacity-100 transition-all hover:bg-white hover:text-black hover:rotate-12">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2.5"/></svg>
                            </a>
                        </div>
                        @endforeach
                        
                        <a href="{{ route('bukus.create', ['kategori_id' => $kategori->id]) }}" class="btn-add-more">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg>
                            Tambah Lagi yuk !!
                        </a>
                    </div>
                @else
                    <div class="mt-10 p-10 border border-dashed border-white/5 rounded-[32px] bg-white/[0.01] text-center relative z-10">
                        <h4 class="text-white/60 text-xs font-black uppercase tracking-widest mb-2">Registry Empty</h4>
                        <p class="text-[9px] text-white/20 uppercase tracking-[0.2em] mb-6 italic">Belum ada aset terdaftar di cluster ini.</p>
                        <a href="{{ route('bukus.create', ['kategori_id' => $kategori->id]) }}" class="btn-add-more !mt-0">Isi Data Cluster</a>
                    </div>
                @endif

                <div class="mt-14 pt-8 border-t border-white/5 flex justify-between items-center relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-indigo-500/50"></div>
                        <span class="text-[8px] font-black text-white/10 uppercase tracking-[0.4em]">Archive_Safe</span>
                    </div>
                    <a href="{{ route('kategoris.show', $kategori->id) }}" class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] hover:text-indigo-400 transition-all italic flex items-center gap-2 group/link">
                        View_Full_Node
                        <span class="group-hover/link:translate-x-2 transition-transform italic text-indigo-500">→</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <footer class="mt-40 py-16 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8 opacity-20 group">
            <span class="text-[10px] font-black uppercase tracking-[1em] text-indigo-500">Node_User: PRINZ</span>
            <span class="text-[10px] font-black uppercase tracking-[0.5em]">2026_VAULT_SYSTEM_CORE</span>
        </footer>
    </div>
</div>
@endsection