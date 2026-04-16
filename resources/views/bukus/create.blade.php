@extends('app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    :root {
        --accent: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.3);
        --bg: #030303;
        --card-bg: rgba(255, 255, 255, 0.015);
        --border-light: rgba(255, 255, 255, 0.08);
    }

    body {
        background: var(--bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #e0e0e0;
        letter-spacing: -0.01em;
    }

    /* Elegant Mesh Background */
    .bg-mesh {
        position: fixed;
        inset: 0;
        background: 
            radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.08) 0%, transparent 40%),
            radial-gradient(circle at 100% 100%, rgba(168, 85, 247, 0.05) 0%, transparent 40%),
            radial-gradient(circle at 50% 50%, rgba(15, 15, 15, 1) 0%, transparent 100%);
        pointer-events: none;
        z-index: -1;
    }

    /* Reader-Style Animations */
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(40px) scale(0.98); filter: blur(20px); }
        to { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
    }

    @keyframes shine {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .reader-reveal {
        animation: slideInUp 1.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Container & Panels */
    .reader-layout {
        display: grid;
        grid-template-columns: 420px 1fr;
        gap: 30px;
        align-items: start;
    }

    .luxury-sidebar {
        background: var(--card-bg);
        backdrop-filter: blur(40px);
        border: 1px solid var(--border-light);
        border-radius: 35px;
        padding: 45px;
        position: sticky;
        top: 40px;
        transition: all 0.5s ease;
    }

    .luxury-sidebar:hover {
        border-color: rgba(255, 255, 255, 0.15);
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }

    .luxury-main {
        background: var(--card-bg);
        backdrop-filter: blur(60px);
        border: 1px solid var(--border-light);
        border-radius: 45px;
        padding: 80px;
        position: relative;
        overflow: hidden;
    }

    /* Modern Input Styling */
    .input-wrapper {
        position: relative;
        margin-bottom: 35px;
    }

    .input-reader {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 18px;
        padding: 1.3rem 1.8rem;
        color: white;
        font-size: 14px;
        font-weight: 300;
        width: 100%;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .input-reader:focus {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--accent);
        outline: none;
        box-shadow: 0 0 30px var(--accent-glow);
        transform: translateY(-2px);
    }

    .label-reader {
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4em;
        color: rgba(255, 255, 255, 0.2);
        margin-left: 10px;
        margin-bottom: 12px;
        display: block;
    }

    /* Custom Dropdown Luxury */
    #optionsPanel {
        background: rgba(8, 8, 8, 0.98);
        backdrop-filter: blur(30px);
        border: 1px solid var(--border-light);
        border-radius: 25px;
        margin-top: 15px;
        opacity: 0;
        transform: translateY(15px);
        pointer-events: none;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 100;
        box-shadow: 0 30px 100px rgba(0,0,0,0.8);
    }

    #optionsPanel.active {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .option-item {
        padding: 18px 25px;
        margin: 5px;
        border-radius: 15px;
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .option-item:hover {
        background: rgba(255, 255, 255, 0.05);
        padding-left: 35px;
    }

    /* Result Cards Animation */
    .book-card-item {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 20px;
        border: 1px solid transparent;
        transition: all 0.4s ease;
        animation: slideInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .book-card-item:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--border-light);
        transform: translateX(10px);
    }

    /* Button Luxury */
    .btn-submit-reader {
        position: relative;
        background: white;
        color: black;
        padding: 22px 50px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.5em;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-submit-reader:hover {
        transform: scale(1.05) translateY(-5px);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
    }

    .btn-submit-reader::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
        animation: shine 3s infinite;
    }
</style>

<div class="bg-mesh"></div>

<div class="max-w-[1400px] mx-auto px-10 py-20 reader-reveal">
    
    <header class="flex justify-between items-end mb-24">
        <div>
            <div class="flex items-center gap-5 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_15px_#6366f1]"></span>
                <span class="text-[10px] font-black tracking-[0.6em] text-white/40 uppercase">Penambahan Koleksi</span>
            </div>
            <h1 class="text-7xl font-black tracking-tighter leading-[0.8]">
                TUANGKAN <br>
                <span style="-webkit-text-stroke: 1px rgba(255,255,255,0.2); color: transparent; font-style: italic;">INSPIRASI.</span>
            </h1>
        </div>

        <a href="{{ route('bukus.index') }}" class="group flex items-center gap-6 pb-2 border-b border-white/5 hover:border-white/20 transition-all duration-700">
            <span class="text-[10px] font-bold tracking-[0.4em] uppercase text-white/30 group-hover:text-white">Kembali Menjelajah</span>
            <svg class="w-4 h-4 group-hover:-translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </header>

    <div class="reader-layout">
        
        <aside class="luxury-sidebar">
            <div class="mb-10">
                <label class="label-reader text-indigo-400">Temukan Karya</label>
                <div class="relative group">
                    <input type="text" id="apiSearchInput" class="input-reader !pr-16" placeholder="Ketik sesuatu yang indah...">
                    <button type="button" onclick="performApiSearch()" class="absolute right-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-2xl flex items-center justify-center bg-white/5 hover:bg-white hover:text-black transition-all duration-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </div>

            <div id="apiResults" class="hidden space-y-3 max-h-[400px] overflow-y-auto custom-scroll pr-3"></div>

            <div id="previewContainer" class="hidden mt-10 pt-10 border-t border-white/5 transition-all duration-1000 opacity-0 scale-95">
                <div class="relative aspect-[3/4] rounded-[30px] overflow-hidden shadow-2xl group">
                    <img id="imagePreview" src="" class="w-full h-full object-cover transition-all duration-1000 group-hover:scale-110 group-hover:rotate-2">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 left-6">
                        <span class="text-[8px] font-black tracking-widest text-white/50 uppercase">Visual Terpilih</span>
                    </div>
                    <button type="button" onclick="clearPreview()" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-black/40 backdrop-blur-xl flex items-center justify-center text-white/40 hover:text-red-400 transition-all">×</button>
                </div>
            </div>
        </aside>

        <main class="luxury-main">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-12 p-8 bg-red-600/10 border border-red-600/20 rounded-[30px] reader-reveal">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                        <span class="text-[10px] font-black uppercase tracking-[0.5em] text-red-500 italic">Data Entry Invalid</span>
                    </div>
                    <ul class="space-y-3">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-3 text-[11px] font-bold uppercase tracking-widest text-white/50">
                                <span class="w-1 h-1 rounded-full bg-white/10"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="mainForm" action="{{ route('bukus.store') }}" method="POST">
                @csrf
                <input type="hidden" name="image_url" id="image_url">
                <input type="hidden" name="google_id" id="google_id">
                
                <div class="grid grid-cols-2 gap-x-12">
                    <div class="input-wrapper">
                        <label class="label-reader">Nama Karya</label>
                        <input type="text" name="judul" id="judul" required class="input-reader" placeholder="Judul yang memikat...">
                    </div>
                    <div class="input-wrapper">
                        <label class="label-reader">Sang Pencipta</label>
                        <input type="text" name="penulis" id="penulis" required class="input-reader" placeholder="Nama penulis...">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-12">
                    <div class="input-wrapper">
                        <label class="label-reader">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" required class="input-reader" placeholder="Rumah karya...">
                    </div>
                    <div class="input-wrapper">
                        <label class="label-reader">Waktu Terbit</label>
                        <input type="number" name="tahun_terbit" id="tahun_terbit" required class="input-reader" placeholder="Tahun...">
                    </div>
                </div>

                <div class="input-wrapper">
                    <label class="label-reader">Kategori Koleksi</label>
                    
                    <div class="relative" id="customSelect">
                        <input type="hidden" name="kategori_id" id="kategori_value" required>
                        <div class="input-reader flex justify-between items-center cursor-pointer" id="selectTrigger">
                            <span id="selectedLabel" class="opacity-30 uppercase tracking-[0.3em] text-[11px]">Pilih suasana koleksi...</span>
                            <svg class="arrow-icon w-3 h-3 opacity-20 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        
                        <div id="optionsPanel" class="absolute w-full p-4 max-h-[300px] overflow-y-auto custom-scroll">
                            @forelse($kategoris as $index => $kat)
                                <div class="option-item group" onclick="selectOption('{{ $kat->nama_kategori }}', '{{ $kat->id }}', '{{ $index + 1 }}')">
                                    <div class="flex items-center gap-4">
                                        <span class="text-[9px] font-mono opacity-20 group-hover:text-indigo-400 group-hover:opacity-100 transition-all">0{{ $index + 1 }}</span>
                                        <span class="text-[11px] font-bold uppercase tracking-widest text-white/40 group-hover:text-white transition-all">{{ $kat->nama_kategori }}</span>
                                    </div>
                                    <div class="w-1 h-1 rounded-full bg-white/5 group-hover:bg-indigo-500 group-hover:scale-[3] transition-all"></div>
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

                <div class="input-wrapper">
                    <label class="label-reader">Intisari Cerita</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" class="input-reader resize-none" placeholder="Gambarkan keindahan isi buku ini..."></textarea>
                </div>

                <div class="pt-10 flex justify-end">
                    <button type="submit" class="btn-submit-reader">
                        Simpan ke Koleksi
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    const apiKey = "AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk";
    const selectContainer = document.getElementById('customSelect');
    const trigger = document.getElementById('selectTrigger');
    const optionsPanel = document.getElementById('optionsPanel');

    // Dropdown Logic
    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        optionsPanel.classList.toggle('active');
        const arrow = trigger.querySelector('.arrow-icon');
        arrow.style.transform = optionsPanel.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        arrow.style.opacity = optionsPanel.classList.contains('active') ? '1' : '0.2';
    });

    function selectOption(name, id, index) {
        const label = document.getElementById('selectedLabel');
        label.innerHTML = `<span class="text-indigo-500 font-mono mr-3 text-[10px] tracking-normal">[0${index}]</span> ${name.toUpperCase()}`;
        label.classList.remove('opacity-30');
        document.getElementById('kategori_value').value = id;
        optionsPanel.classList.remove('active');
        trigger.querySelector('.arrow-icon').style.transform = 'rotate(0deg)';
    }

    window.addEventListener('click', (e) => {
        if (!selectContainer.contains(e.target)) {
            optionsPanel.classList.remove('active');
            trigger.querySelector('.arrow-icon').style.transform = 'rotate(0deg)';
        }
    });

    // API Logic
    async function performApiSearch() {
        const query = document.getElementById('apiSearchInput').value.trim();
        const results = document.getElementById('apiResults');
        if (!query) return;

        results.classList.remove('hidden');
        results.innerHTML = '<div class="py-10 text-[10px] text-center italic animate-pulse tracking-[0.5em] text-white/20 uppercase">Mencari Jejak Karya...</div>';

        try {
            const res = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(query)}&maxResults=6&key=${apiKey}`);
            const data = await res.json();
            results.innerHTML = '';

            if (!data.items) {
                results.innerHTML = '<div class="py-10 text-[10px] text-center text-red-400 tracking-[0.5em] uppercase">Karya tidak ditemukan</div>';
                return;
            }

            data.items.forEach((item, i) => {
                const info = item.volumeInfo;
                const thumb = info.imageLinks ? info.imageLinks.thumbnail.replace('http:', 'https:') : '';
                const div = document.createElement('div');
                div.className = "book-card-item flex items-center gap-5 p-4 cursor-pointer";
                div.style.animationDelay = `${i * 0.1}s`;
                div.onclick = () => fillForm(item, thumb);
                div.innerHTML = `
                    <img src="${thumb || 'https://via.placeholder.com/60x90'}" class="w-12 h-16 rounded-xl object-cover shadow-2xl">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-[11px] font-bold text-white uppercase truncate tracking-widest">${info.title}</h4>
                        <p class="text-[9px] text-white/30 uppercase tracking-widest truncate mt-1">${info.authors ? info.authors[0] : 'Penulis Anonim'}</p>
                    </div>`;
                results.appendChild(div);
            });
        } catch (e) {
            results.innerHTML = '<div class="py-10 text-[10px] text-center text-red-400 uppercase">Gangguan Jaringan</div>';
        }
    }

    function fillForm(item, thumb) {
        const info = item.volumeInfo;
        document.getElementById('google_id').value = item.id;
        document.getElementById('image_url').value = thumb;
        document.getElementById('judul').value = info.title || '';
        document.getElementById('penulis').value = info.authors ? info.authors.join(', ') : '';
        document.getElementById('penerbit').value = info.publisher || '';
        document.getElementById('tahun_terbit').value = info.publishedDate ? info.publishedDate.substring(0, 4) : '';
        document.getElementById('deskripsi').value = info.description ? info.description.replace(/<[^>]*>/g, '') : '';

        if (thumb) {
            const container = document.getElementById('previewContainer');
            document.getElementById('imagePreview').src = thumb;
            container.classList.remove('hidden');
            setTimeout(() => {
                container.classList.replace('opacity-0', 'opacity-100');
                container.classList.replace('scale-95', 'scale-100');
            }, 100);
        }
        document.getElementById('apiResults').classList.add('hidden');
    }

    function clearPreview() {
        const container = document.getElementById('previewContainer');
        container.classList.replace('opacity-100', 'opacity-0');
        container.classList.replace('scale-100', 'scale-95');
        setTimeout(() => { container.classList.add('hidden'); }, 800);
    }
</script>
@endsection