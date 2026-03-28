@extends('app')

@section('content')
<style>
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.3);
        --card-bg: rgba(255, 255, 255, 0.02);
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    /* 1. LAYOUT & MARQUEE */
    .marquee-container {
        border-top: 1px solid var(--glass-border);
        border-bottom: 1px solid var(--glass-border);
        padding: 12px 0;
        overflow: hidden;
        margin-bottom: 4rem;
        background: rgba(255,255,255,0.01);
    }

    .marquee-text {
        display: inline-block;
        white-space: nowrap;
        animation: marquee 25s linear infinite;
        font-family: 'Monaco', monospace;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        color: rgba(255,255,255,0.15);
        letter-spacing: 6px;
    }

    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }

    /* 2. GRID SYSTEM */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 2.5rem;
    }

    /* 3. CARD REFINEMENT */
    .boutique-card {
        position: relative;
        background: var(--card-bg);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        padding: 0.8rem;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
        overflow: hidden;
    }

    .boutique-card:hover {
        border-color: var(--accent);
        transform: translateY(-12px);
        box-shadow: 0 40px 80px -15px rgba(0, 0, 0, 0.9);
    }

    .image-wrapper {
        position: relative;
        aspect-ratio: 3/4.2;
        border-radius: 20px;
        overflow: hidden;
        background: #080808;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.7;
        transition: 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .boutique-card:hover img {
        opacity: 1;
        transform: scale(1.08);
    }

    .info-block {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 2.5rem 1.5rem 1.5rem;
        background: linear-gradient(to top, rgba(0,0,0,1) 30%, transparent);
        pointer-events: none;
    }

    /* 4. MODAL */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(15px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
        opacity: 0;
        pointer-events: none;
        transition: 0.4s;
    }

    .modal-overlay.modal-visible {
        opacity: 1;
        pointer-events: auto;
    }

    .action-modal-content {
        background: #0a0a0a;
        border: 1px solid var(--glass-border);
        border-radius: 40px;
        width: 95%;
        max-width: 420px;
        padding: 3.5rem 2.5rem;
        transform: scale(0.9);
        transition: 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-visible .action-modal-content { transform: scale(1); }

    .opt-btn-hex {
        padding: 1.5rem;
        border-radius: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        color: #fff;
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        border: 1px solid var(--glass-border);
        background: rgba(255,255,255,0.02);
        transition: 0.3s;
    }

    .opt-btn-hex:hover { 
        background: var(--accent); 
        transform: translateY(-5px);
        box-shadow: 0 15px 30px var(--accent-glow);
    }
</style>


<div class="reveal-up">
    <div class="marquee-container">
        <div class="marquee-text">
            SELAMAT DATANG DI KOLEKSI PRIBADI // TEMPAT BUKU-BUKU TERBAIKMU // DIKELOLA DENGAN CINTA // {{ date('Y-m-d H:i') }} // E-LIBRARY MODERN // SISTEM AMAN & CEPAT
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-8">
        <header class="mb-20 flex justify-between items-end">
            <div>
                <h1 class="text-7xl font-black uppercase italic tracking-tighter text-white">Ini adalah Rak Kamu<span class="text-indigo-500">.</span></h1>
                <p class="text-[7px] text-white/30 tracking-[0.5em] uppercase mt-2">Arsip Buku Pribadi Kamu</p>
            </div>
            
            <a href="{{ route('bukus.create') }}" class="px-8 py-5 bg-white rounded-2xl group hover:bg-indigo-600 transition-all duration-500 flex items-center gap-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-black group-hover:text-white">Tambah Buku.</span>
                <svg class="w-4 h-4 text-black group-hover:text-white group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg>
            </a>
        </header>

        <div class="space-y-24 mb-24">
            @forelse($bukus as $kategori => $group)
            <div class="reveal-up">
                <div class="flex items-center gap-6 mb-10">
                    <h2 class="text-xs font-black uppercase tracking-[0.5em] text-white/40 italic whitespace-nowrap">{{ $kategori }}</h2>
                    <div class="h-[1px] w-full bg-white/5"></div>
                    <span class="text-[8px] font-black text-indigo-500/50 uppercase tracking-tighter whitespace-nowrap">{{ count($group) }} items</span>
                </div>

                <div class="book-grid">
                    @foreach($group as $buku)
                    <div class="boutique-card" onclick="openControlModal('{{ route('bukus.edit', $buku->id) }}', '{{ route('bukus.destroy', $buku->id) }}', '{{ addslashes($buku->judul) }}')">
                        <div class="image-wrapper">
                            <img src="{{ $buku->image_url ?? 'https://via.placeholder.com/400x560/0a0a0a/ffffff?text=TANPA_COVER' }}" alt="">
                            <div class="info-block">
                                <span class="text-[7px] font-black text-indigo-400 uppercase tracking-widest mb-1 block">{{ $buku->kategori->nama ?? 'Umum' }}</span>
                                <h3 class="text-[11px] font-black text-white uppercase italic leading-tight">{{ Str::limit($buku->judul, 25) }}</h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="py-32 border border-dashed border-white/10 rounded-[40px] text-center">
                <p class="text-[9px] font-black text-white/10 uppercase tracking-[1.5em]">Belum Ada Koleksi Disini</p>
            </div>
            @endforelse
        </div>

    </div>
</div>

<div id="controlModal" class="modal-overlay">
    <div class="action-modal-content">
        <div class="text-center mb-10">
            <p id="modalBukuTitle" class="text-2xl font-black text-white uppercase italic tracking-tighter"></p>
            <p class="text-[7px] text-white/20 uppercase tracking-[0.4em] mt-2">Pilihan_Aksi_Buku</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <a id="modalEditLink" href="#" class="opt-btn-hex">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                <span>Edit Data</span>
            </a>

            <form id="modalDeleteForm" method="POST" action="" class="w-full">
                @csrf @method('DELETE')
                <button type="submit" class="opt-btn-hex w-full hover:bg-red-600" onclick="return confirm('Apakah kamu yakin ingin menghapus buku ini?')">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
        
        <button onclick="closeControlModal()" class="w-full mt-8 text-[8px] font-black text-white/20 uppercase tracking-[0.5em] hover:text-white transition-colors">Batalkan</button>
    </div>
</div>

<script>
    const controlModal = document.getElementById('controlModal');

    function openControlModal(editUrl, deleteUrl, title) {
        document.getElementById('modalBukuTitle').innerText = title;
        document.getElementById('modalEditLink').href = editUrl;
        document.getElementById('modalDeleteForm').action = deleteUrl;
        controlModal.classList.add('modal-visible');
    }

    function closeControlModal() {
        controlModal.classList.remove('modal-visible');
    }

    window.onclick = function(e) {
        if (e.target == controlModal) closeControlModal();
    }
</script>
@endsection