@extends('app')

@section('content')
<style>
    :root {
        --accent: #6366f1;
        --glass: rgba(255, 255, 255, 0.03);
        --border: rgba(255, 255, 255, 0.08);
    }

    /* 1. MARQUEE ATAS */
    .marquee-container {
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 14px 0;
        overflow: hidden;
        margin-bottom: 5rem;
        background: rgba(255, 255, 255, 0.01);
    }

    .marquee-text {
        display: inline-block;
        white-space: nowrap;
        animation: marquee 40s linear infinite;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.15);
        letter-spacing: 5px;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* 2. CARD DESIGN */
    .book-card {
        position: relative;
        background: var(--glass);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 0.8rem;
        transition: all 0.7s cubic-bezier(0.15, 1, 0.3, 1);
    }

    .book-card:hover {
        border-color: var(--accent);
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.05);
    }

    .image-container {
        position: relative;
        aspect-ratio: 3/4.5;
        border-radius: 18px;
        overflow: hidden;
        background: #0a0a0a;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 1s ease;
    }

    /* 3. HOVER ACTIONS (GANTI MODAL) */
    .hover-actions {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        display: flex;
        gap: 8px;
        transform: translateY(100%);
        transition: transform 0.5s cubic-bezier(0.15, 1, 0.3, 1);
    }

    .book-card:hover .hover-actions {
        transform: translateY(0);
    }

    .btn-action {
        flex: 1;
        padding: 8px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        text-align: center;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-ubah {
        background: white;
        color: black;
    }

    .btn-ubah:hover {
        background: var(--accent);
        color: white;
    }

    .btn-hapus {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-hapus:hover {
        background: #ef4444;
        border-color: #ef4444;
    }

    .info-area {
        padding: 1.2rem 0.5rem 0.5rem;
    }
</style>

<div class="py-10">
    {{-- Marquee Cantik --}}
    <div class="marquee-container">
        <div class="marquee-text">
            SELAMAT DATANG DI RUANG BACA PRIBADI // SEMUA BUKU KESAYANGANMU ADA DI SINI // NYAMAN & RAPI // TERIMA KASIH SUDAH BERKUNJUNG // {{ date('d F Y') }}
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-8">
        {{-- Header --}}
        <header class="mb-24 flex flex-col md:flex-row justify-between items-start md:items-end gap-10">
            <div class="relative">
                {{-- Indikator Status Mikro --}}
                <div class="flex items-center gap-3 mb-6 group cursor-default">
                    <div class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </div>
                    <span class="text-[7px] font-black text-white/40 uppercase tracking-[0.4em] group-hover:text-indigo-400 transition-colors duration-500">
                        Sistem Siap Menemani
                    </span>
                    <span class="h-[1px] w-8 bg-white/5"></span>
                    <span class="text-[7px] font-medium text-white/20 uppercase tracking-widest italic">
                        {{ date('H:i') }} WIB
                    </span>
                </div>

                {{-- Judul Utama --}}
                <div class="group">
                    <div class="relative group/title inline-block">
                        {{-- Label Melayang Kiri Atas --}}
                        <div class="absolute -top-6 left-1 overflow-hidden h-4">
                            <p class="text-[7px] font-black uppercase tracking-[0.5em] text-indigo-500/0 group-hover/title:text-indigo-500 group-hover/title:translate-y-0 translate-y-4 transition-all duration-700 ease-out">
                                Terpilih & Terkurasi
                            </p>
                        </div>

                        {{-- Judul Utama --}}
                        <h1 class="text-7xl md:text-8xl font-black uppercase italic tracking-tighter text-white leading-none selection:bg-indigo-500 transition-all duration-700 group-hover/title:tracking-[-0.05em]">
                            Koleksiku<span class="text-indigo-500 inline-block hover:rotate-12 hover:scale-125 transition-transform duration-300 cursor-default">.</span>
                        </h1>

                        {{-- Baris Dekoratif Bawah --}}
                        <div class="absolute -bottom-2 left-0 w-full flex items-center gap-3 opacity-0 group-hover/title:opacity-100 transition-all duration-1000">
                            <span class="text-[6px] font-bold text-white/20 uppercase tracking-[1em] whitespace-nowrap">Est. 2026</span>
                            <div class="h-[1px] w-full bg-gradient-to-r from-indigo-500/50 to-transparent scale-x-0 group-hover/title:scale-x-100 transition-transform duration-1000 origin-left"></div>
                        </div>

                        {{-- Catatan Kecil di Samping --}}
                        <div class="absolute -right-16 top-1/2 -translate-y-1/2 rotate-90 hidden lg:block">
                            <p class="text-[6px] font-black uppercase tracking-[0.4em] text-white/5 group-hover/title:text-white/20 transition-colors duration-700">
                                Privat & Personal
                            </p>
                        </div>
                    </div>
                    {{-- Sub-teks dengan Garis Dekoratif --}}
                    <div class="flex items-center gap-4 mt-6">
                        <div class="flex flex-col gap-1">
                            <div class="h-[2px] w-12 bg-indigo-500/50"></div>
                            <div class="h-[1px] w-6 bg-white/10"></div>
                        </div>
                        <p class="text-[9px] text-white/30 tracking-[0.5em] uppercase font-medium">
                            Tempat ternyaman untuk menyimpan inspirasi
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tombol Tambah dengan Detail Ekstra --}}
            <div class="flex flex-col items-end gap-4">
                <div class="flex items-center gap-3 opacity-20 group-hover:opacity-100 transition-opacity">
                    <span class="text-[6px] font-black text-white uppercase tracking-[0.3em]">Punya Bacaan Baru?</span>
                </div>

                <a href="{{ route('bukus.create') }}"
                    class="group relative px-8 py-5 bg-white rounded-2xl overflow-hidden transition-all duration-700 hover:pr-14 active:scale-95 shadow-[0_20px_40px_rgba(255,255,255,0.05)]">

                    {{-- Efek Hover Background --}}
                    <div class="absolute inset-0 bg-indigo-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>

                    <div class="relative flex items-center gap-5">
                        <div class="text-right">
                            <span class="block text-[11px] font-black uppercase tracking-widest text-black group-hover:text-white transition-colors duration-500">
                                Tambah Baru
                            </span>
                            <span class="block text-[6px] font-bold uppercase tracking-[0.2em] text-black/30 group-hover:text-white/40 transition-colors duration-500">
                                Perluas Wawasanmu
                            </span>
                        </div>

                        <div class="w-10 h-10 rounded-xl bg-black/5 flex items-center justify-center group-hover:bg-white/10 transition-all duration-500">
                            <svg class="w-5 h-5 text-black group-hover:text-white group-hover:rotate-180 transition-all duration-700"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="square" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </header>
        {{-- Grouping Berdasarkan Kategori --}}
        <div class="space-y-24 mb-32">
            @forelse($bukus as $kategori => $daftarBuku)
            <div class="reveal-up">
                <div class="flex items-center gap-6 mb-12">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-white/40 italic">{{ $kategori }}</h2>
                    <div class="h-[1px] flex-grow bg-white/5"></div>
                    <span class="text-[9px] font-medium text-white/20 uppercase tracking-widest">{{ count($daftarBuku) }} Buku</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                    @foreach($daftarBuku as $buku)
                    <div class="book-card">
                        <div class="image-container">
                            <img src="{{ $buku->image_url ?? asset('storage/' . $buku->cover) }}"
                                onerror="this.src='https://via.placeholder.com/600x900/0a0a0a/ffffff?text=BELUM_ADA_SAMPUL'"
                                alt="{{ $buku->judul }}">

                            {{-- Tombol Melayang Saat Hover --}}
                            <div class="hover-actions">
                                <a href="{{ route('bukus.edit', $buku->id) }}" class="btn-action btn-ubah">Ubah</a>

                                <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-hapus w-full" onclick="return confirm('Hapus buku ini dari koleksi?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="info-area">
                            <p class="text-[8px] font-bold text-indigo-400 uppercase tracking-widest mb-2">
                                {{ $buku->kategori->nama_kategori ?? 'Umum' }}
                            </p>
                            <h3 class="text-xs font-black text-white uppercase italic leading-snug tracking-wide">
                                {{ Str::limit($buku->judul, 35) }}
                            </h3>
                            <p class="text-[9px] text-white/20 mt-1 font-medium uppercase tracking-tight">
                                {{ $buku->penulis ?? 'Penulis Anonim' }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            {{-- Jika Benar-benar Kosong --}}
            <div class="py-40 text-center border border-dashed border-white/5 rounded-[40px]">
                <p class="text-[9px] font-black text-white/20 uppercase tracking-[1em]">Belum ada buku yang disimpan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const controlModal = document.getElementById('controlModal');
        const modalBukuTitle = document.getElementById('modalBukuTitle');
        const modalEditLink = document.getElementById('modalEditLink');
        const modalDeleteForm = document.getElementById('modalDeleteForm');

        document.addEventListener('click', function(e) {
            const card = e.target.closest('.book-card');
            if (card && !e.target.closest('a') && !e.target.closest('button')) {
                const title = card.getAttribute('data-title');
                const editUrl = card.getAttribute('data-edit-url');
                const deleteUrl = card.getAttribute('data-delete-url');

                modalBukuTitle.innerText = title;
                modalEditLink.href = editUrl;
                modalDeleteForm.action = deleteUrl;

                controlModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });

        window.closeControlModal = function() {
            controlModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        controlModal.addEventListener('click', function(e) {
            if (e.target === controlModal) closeControlModal();
        });
    });
</script>
@endsection