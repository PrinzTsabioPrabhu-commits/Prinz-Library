@extends('app')

@section('content')
<style>
    /* 1. ARCHIVE GRID STATION */
    .edit-node {
        background: rgba(255, 255, 255, 0.005);
        backdrop-filter: blur(80px) saturate(150%);
        border: 1px solid rgba(255, 255, 255, 0.02);
        border-radius: 64px;
        transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 80px 160px -40px rgba(0, 0, 0, 0.8);
    }

    /* 2. CUSTOM SELECT SYSTEM */
    .custom-select-container.active #optionsPanel {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0);
    }

    .custom-select-container.active .arrow-icon {
        transform: translateY(-50%) rotate(180deg);
        color: var(--accent);
    }

    #optionsPanel {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(60px) saturate(150%);
        box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 1);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-15px);
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 32px;
        margin-top: 12px;
    }

    .option-item {
        transition: all 0.4s ease;
        margin: 4px;
        border-radius: 16px;
        border: 1px solid transparent;
    }

    .option-item:hover {
        transform: translateX(10px);
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(255, 255, 255, 0.05);
    }

    /* 3. PREVIEW BOX */
    .preview-box {
        aspect-ratio: 3/4.5;
        border-radius: 32px;
        overflow: hidden;
        background: #000;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.8);
        transition: all 1s cubic-bezier(0.19, 1, 0.22, 1);
        position: sticky;
        top: 40px;
    }

    /* Parallax & Perspective Effect */
    .perspective-1000 {
        perspective: 1000px;
    }

    /* Animasi teks saat masuk */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .edit-node h1 {
        animation: fadeInUp 1s ease-out both;
    }
</style>

<div class="reveal-up py-20 lg:py-32">
    <div class="edit-node grid lg:grid-cols-12 min-h-[800px] bg-[#050505]">
        
        <div class="lg:col-span-5 p-16 lg:p-24 flex flex-col justify-between border-r border-white/5 bg-white/[0.005] relative overflow-hidden group/sidebar">
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-[100px] group-hover/sidebar:bg-indigo-500/10 transition-all duration-1000"></div>

            <div class="space-y-16 relative z-10">
                <div>
                    <a href="{{ route('bukus.index') }}" class="group/back inline-flex items-center gap-4 text-[9px] font-black uppercase tracking-[0.4em] text-white/20 hover:text-white transition-all mb-16">
                        <span class="w-10 h-10 flex items-center justify-center rounded-full border border-white/10 group-hover/back:border-indigo-500 group-hover/back:text-indigo-400 transition-all duration-500 italic">←</span>
                        Kembali Ke Rak Utama
                    </a>

                    <span class="text-[10px] font-black tracking-[0.8em] uppercase text-indigo-500/80 block mb-6 italic animate-pulse">Menata Ulang Cerita</span>
                    
                    <h1 class="text-6xl lg:text-8xl mb-10 leading-[0.8] font-black italic tracking-tighter text-white uppercase cursor-default">
                        Rawat <br>
                        <span style="-webkit-text-stroke: 1px rgba(255,255,255,0.15); color: transparent;"
                            class="hover:text-white transition-all duration-1000 inline-block hover:translate-x-4 cursor-none">
                            Kenangan.
                        </span>
                    </h1>

                    <div class="relative mt-20 perspective-1000 group/cover">
                        <div class="preview-box w-full max-w-[300px] mx-auto lg:mx-0 overflow-hidden rounded-[40px] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.8)] border border-white/5 transition-all duration-1000 group-hover/cover:scale-105 group-hover/cover:-rotate-2 group-hover/cover:shadow-indigo-500/10">
                            <img id="previewImg"
                                src="{{ str_replace('http://', 'https://', $buku->image_url ?? 'https://via.placeholder.com/600x900?text=MEMBACA') }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover/cover:scale-110">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                            <div class="absolute bottom-8 left-8 right-8 transform translate-y-4 group-hover/cover:translate-y-0 transition-transform duration-700">
                                <p class="text-[8px] font-black text-indigo-400 uppercase tracking-[0.4em] mb-2">Sampul Terpilih</p>
                                <h3 id="previewTitle" class="text-sm font-black uppercase italic tracking-tighter text-white leading-tight">
                                    {{ $buku->judul }}
                                </h3>
                            </div>
                        </div>
                        <div class="absolute -inset-4 border border-indigo-500/10 rounded-[48px] -z-10 group-hover/cover:scale-110 group-hover/cover:border-indigo-500/30 transition-all duration-1000"></div>
                    </div>
                </div>
            </div>

            <div class="pt-10 relative z-10">
                <div class="flex items-center gap-6 group/status cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-white/[0.02] border border-white/10 flex items-center justify-center group-hover/status:border-indigo-500/50 transition-colors duration-700">
                        <div class="relative">
                            <div class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-ping absolute inset-0"></div>
                            <div class="w-1.5 h-1.5 bg-indigo-500 rounded-full relative"></div>
                        </div>
                    </div>
                    <div class="text-[9px] font-black uppercase tracking-[0.3em] text-white/20 group-hover/status:text-white/40 transition-colors duration-700">
                        Buku ini siap dirapikan kembali <br>
                        <span class="text-indigo-500/60 italic font-bold">Identitas Unik: #{{ strtoupper(substr(md5($buku->id), 0, 6)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 p-16 lg:p-24 bg-[#080808]">
            <form action="{{ route('bukus.update', $buku->id) }}" method="POST" class="space-y-12 h-full flex flex-col justify-between">
                @csrf
                @method('PUT')

                <div class="space-y-10">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Judul Koleksi</label>
                            <input type="text" name="judul" id="judulInput" value="{{ old('judul', $buku->judul) }}" required class="input-luxe" placeholder="TULIS JUDUL DI SINI">
                        </div>
                        <div class="space-y-1 group">
                            <label class="luxe-label">Nama Penulis</label>
                            <input type="text" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required class="input-luxe" placeholder="SIAPA PENULISNYA?">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-8 border-t border-white/5 pt-10">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Nama Penerbit</label>
                            <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required class="input-luxe" placeholder="PENERBIT BUKU">
                        </div>
                        <div class="space-y-1 group">
                            <label class="luxe-label">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required class="input-luxe" placeholder="CONTOH: 2024">
                        </div>
                    </div>

                    <div class="space-y-10 border-t border-white/5 pt-10">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Pilih Kategori</label>
                            <div class="custom-select-container relative" id="customSelect">
                                <input type="hidden" name="kategori_id" id="kategori_value" value="{{ $buku->kategori_id }}" required>
                                <div class="input-luxe flex items-center justify-between cursor-pointer group relative !py-6" id="selectTrigger">
                                    <span id="selectedLabel" class="text-white tracking-[0.4em] text-[10px] font-black uppercase">
                                        <span class="text-indigo-400 font-mono mr-3 text-[9px]">[ID]</span> {{ strtoupper($buku->kategori->nama_kategori ?? 'PILIH KATEGORI') }}
                                    </span>
                                    <div class="arrow-icon transition-all duration-500 opacity-20">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 4.5L6 8.5L10 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>

                                <div id="optionsPanel" class="absolute z-50 w-full p-2">
                                    <div class="max-h-[280px] overflow-y-auto custom-scrollbar">
                                        @forelse($kategoris as $index => $kat)
                                            <div class="option-item flex items-center justify-between p-5 cursor-pointer"
                                                onclick="selectOption('{{ $kat->nama_kategori }}', '{{ $kat->id }}', '{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}')">
                                                <span class="text-[10px] font-black tracking-widest uppercase">
                                                    <span class="text-indigo-500/50 mr-4 font-mono text-[9px]">[{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}]</span>
                                                    {{ $kat->nama_kategori }}
                                                </span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500/0 group-hover:bg-indigo-500 transition-all"></div>
                                            </div>
                                        @empty
                                            <div class="py-12 text-center group">
                                                <p class="text-[9px] font-black text-white/10 uppercase tracking-[0.5em] group-hover:text-red-500/40 transition-colors">Data Kosong</p>
                                                <p class="text-[7px] text-white/5 uppercase tracking-[0.3em] mt-2 italic">Jalankan Seeder Kategori Terlebih Dahulu</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1 group">
                            <label class="luxe-label">Link Sampul Buku (URL)</label>
                            <input type="url" name="image_url" id="imageInput" value="{{ old('image_url', $buku->image_url) }}" class="input-luxe font-mono text-[10px]" placeholder="https://masukkan-link-gambar.com">
                        </div>

                        <div class="space-y-1 group">
                            <label class="luxe-label">Sinopsis / Deskripsi Singkat</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="input-luxe min-h-[140px] resize-none" placeholder="TULIS DESKRIPSI BUKU DI SINI...">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-white/5">
                    <button type="submit" class="btn-premium w-full !rounded-3xl italic">Simpan Perubahan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Custom Select Implementation
    const selectContainer = document.getElementById('customSelect');
    const trigger = document.getElementById('selectTrigger');

    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        selectContainer.classList.toggle('active');
    });

    function selectOption(name, id, index) {
        const label = document.getElementById('selectedLabel');
        const hiddenInput = document.getElementById('kategori_value');
        label.innerHTML = `<span class="text-indigo-400 font-mono mr-3 text-[9px]">[${index}]</span> ${name.toUpperCase()}`;
        label.classList.add('text-white');
        hiddenInput.value = id;
        selectContainer.classList.remove('active');
    }

    window.addEventListener('click', () => selectContainer.classList.remove('active'));

    // Live Visual Sync
    document.getElementById('imageInput').addEventListener('input', function(e) {
        document.getElementById('previewImg').src = e.target.value || 'https://via.placeholder.com/600x900?text=KOSONG';
    });

    document.getElementById('judulInput').addEventListener('input', function(e) {
        document.getElementById('previewTitle').innerText = e.target.value.toUpperCase() || 'JUDUL_KOSONG';
    });
</script>
@endsection