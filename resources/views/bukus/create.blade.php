@extends('app')

@section('content')
<style>
    /* 1. ARCHIVE GRID STATION */
    .create-node {
        background: rgba(255, 255, 255, 0.005);
        backdrop-filter: blur(100px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.03);
        border-radius: 64px;
        transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 80px 160px -40px rgba(0, 0, 0, 1),
            inset 0 0 80px rgba(255, 255, 255, 0.01);
    }

    /* 2. CUSTOM SELECT SYSTEM */
    .custom-select-container.active #optionsPanel {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0);
        scale: 1;
    }

    .custom-select-container.active .arrow-icon {
        transform: translateY(-50%) rotate(180deg);
        color: var(--accent);
        opacity: 1;
    }

    #optionsPanel {
        background: rgba(10, 10, 10, 0.98);
        backdrop-filter: blur(80px) saturate(200%);
        box-shadow: 0 60px 120px -20px rgba(0, 0, 0, 1);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-20px) scale(0.98);
        transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 32px;
        margin-top: 15px;
    }

    .option-item {
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        margin: 6px;
        border-radius: 18px;
        border: 1px solid transparent;
    }

    .option-item:hover {
        transform: translateX(10px);
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(255, 255, 255, 0.06);
        box-shadow: -10px 10px 30px rgba(0, 0, 0, 0.2);
    }

    /* REFINED INPUT SYSTEM */
    .input-luxe {
        background: rgba(255, 255, 255, 0.01);
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
        background: rgba(255, 255, 255, 0.025);
        border-color: var(--accent);
        outline: none;
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.15),
            inset 0 0 10px rgba(255, 255, 255, 0.01);
        transform: translateY(-2px);
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

    @keyframes revealUp {
        0% {
            opacity: 0;
            transform: translateY(30px) scale(0.98);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .reveal-up {
        opacity: 0;
        animation: revealUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* 3. API RESULT CARDS */
    .api-results-container {
        background: rgba(255, 255, 255, 0.002);
        border: 1px solid rgba(255, 255, 255, 0.015);
        border-radius: 48px;
        padding: 2rem;
        /* Reduced container padding to give cards more width */
        position: relative;
        box-shadow: inset 0 0 60px rgba(255, 255, 255, 0.01);
        margin-top: 2.5rem;
    }

    .api-results-container::before {
        content: 'DATA_STREAM_INCOMING';
        position: absolute;
        top: -12px;
        left: 40px;
        background: #050505;
        padding: 0 16px;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 0.5em;
        color: var(--accent);
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 10px;
        z-index: 10;
    }

    .api-result-node {
        background: rgba(255, 255, 255, 0.008);
        border: 1px solid rgba(255, 255, 255, 0.01);
        border-radius: 36px;
        /* Smoother corners */
        transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        /* More space between cards */
    }

    .api-result-node:hover {
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.6);
    }

    .api-result-node::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, transparent, rgba(99, 102, 241, 0.05), transparent);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .api-result-node:hover::after {
        opacity: 1;
    }

    /* 3. API RESULT CARDS REFINED */
    .api-results-container {
        background: rgba(255, 255, 255, 0.002);
        border: 1px solid rgba(255, 255, 255, 0.015);
        border-radius: 40px;
        padding: 1.5rem;
        position: relative;
        box-shadow: inset 0 0 60px rgba(255, 255, 255, 0.01);
        margin-top: 2rem;
    }

    .api-result-node {
        background: rgba(255, 255, 255, 0.01);
        border: 1px solid rgba(255, 255, 255, 0.03);
        border-radius: 28px;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.25rem;
    }

    .api-result-node:hover {
        background: rgba(255, 255, 255, 0.03);
        border-color: rgba(99, 102, 241, 0.5);
        transform: translateX(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    /* Scrollbar minimalis agar tetap rapi di zoom 100% */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(99, 102, 241, 0.2);
        border-radius: 10px;
    }

    /* 4. PREVIEW HUB & HUD */
    .hud-line {
        position: absolute;
        background: linear-gradient(to bottom, transparent, rgba(99, 102, 241, 0.2), transparent);
        width: 1px;
    }

    .preview-box {
        aspect-ratio: 3/4.5;
        border-radius: 24px;
        overflow: hidden;
        background: #000;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 1);
        transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
        transform-style: preserve-3d;
    }

    .preview-box:hover {
        transform: rotateY(15deg) rotateX(5deg) scale(1.05);
        box-shadow: -20px 40px 100px -20px rgba(99, 102, 241, 0.2);
    }

    .scan-line {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent, var(--accent), transparent);
        height: 100%;
        opacity: 0;
        pointer-events: none;
    }

    .scanning .scan-line {
        animation: scannerLine 2s linear infinite;
        opacity: 0.4;
    }

    @keyframes scannerLine {
        0% {
            transform: translateY(-100%);
        }

        100% {
            transform: translateY(100%);
        }
    }
</style>

<div class="reveal-up py-20 lg:py-32">
    <div class="create-node grid lg:grid-cols-12 min-h-[800px]">
        <!-- Branding & Search Side (40%) -->
        <div class="lg:col-span-5 p-12 lg:p-20 flex flex-col gap-y-12 border-r border-white/5 bg-white/[0.005] relative overflow-hidden">
            <!-- HUD Lines -->
            <div class="hud-line h-full left-10 opacity-20"></div>
            <div class="hud-line h-full left-12 opacity-10"></div>
            <div class="space-y-16">
                <div>
                    <a href="{{ route('bukus.index') }}" class="inline-flex items-center gap-4 text-[9px] font-black uppercase tracking-[0.4em] text-white/20 hover:text-white transition-all mb-10">
                        <span class="w-8 h-8 flex items-center justify-center rounded-full border border-white/10 italic">←</span>
                        Return to Vault
                    </a>

                    <h1 class="editorial-title text-5xl lg:text-6xl mb-8 leading-[0.85] tracking-tighter">
                        INITIALIZE <br> <span class="outline-text">ARCHIVE.</span>
                    </h1>
                    <p class="text-[10px] text-white/20 uppercase tracking-[0.2em] leading-loose max-w-sm">Sinkronisasi metadata buku baru ke dalam repositori <span class="text-white font-black">THE ARCHIVE</span>. Hubungkan dengan database global untuk pemetaan instan.</p>
                </div>

                <!-- API Search Section -->
                <div class="space-y-6 relative">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[8px] font-black uppercase tracking-[0.4em] text-indigo-500/50">Node_Scanner</label>
                        <span class="text-[7px] font-black text-white/10 uppercase tracking-[0.3em] flex items-center gap-2">
                            <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                            Standby
                        </span>
                    </div>
                    <div class="relative group">
                        <input type="text" id="apiSearchInput"
                            class="input-luxe !pl-14 !pr-24 border-white/5 focus:border-indigo-500/50 !rounded-2xl"
                            placeholder="SCAN_GLOBAL_NETWORK..."
                            onkeyup="if(event.key==='Enter') performApiSearch()">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-white/10 group-focus-within:text-indigo-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" />
                            </svg>
                        </div>
                        <button onclick="performApiSearch()" class="absolute right-2 top-1/2 -translate-y-1/2 h-8 px-4 bg-white/5 hover:bg-white text-[8px] font-black text-white/40 hover:text-black uppercase tracking-widest rounded-xl transition-all border border-white/10">
                            Trigger
                        </button>
                    </div>

                    <div id="apiResults" class="hidden api-results-container space-y-5 max-h-[500px] overflow-y-auto custom-scrollbar pr-4">
                        <!-- API results will appear here -->
                    </div>
                </div>
            </div>

            <div class="pt-10">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                    </div>
                    <div class="text-[9px] font-black uppercase tracking-widest text-white/20">
                        System Ready <br>
                        <span class="text-indigo-500">Awaiting Record Deployment</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Side (60%) -->
        <div class="lg:col-span-7 p-16 lg:p-24 bg-black/20">
            <form id="mainForm" action="{{ route('bukus.store') }}" method="POST" class="space-y-12">
                @csrf
                <div class="space-y-10">
                    <!-- Section: Visual & Identity -->
                    <div class="space-y-8">
                        <!-- Live Preview Area -->
                        <div id="previewContainer" class="hidden opacity-0 scale-95 transition-all duration-1000 flex justify-center mb-16">
                            <div class="preview-box w-56 relative group shadow-indigo-500/10">
                                <img id="imagePreview" src="" class="w-full h-full object-cover">
                                <div class="scan-line"></div>
                                <div class="absolute inset-0 bg-indigo-500/20 opacity-0 group-[.scanning]:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                    <span class="text-[8px] font-black text-white uppercase tracking-[0.5em] animate-pulse">Neural_Sync_Active</span>
                                </div>
                                <button type="button" onclick="clearPreview()" class="absolute top-4 right-4 w-10 h-10 bg-black/60 backdrop-blur-md rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity border border-red-500/20 hover:bg-red-500 hover:text-white">
                                    <span class="text-xs">✕</span>
                                </button>
                            </div>
                        </div>
                        {{-- image_url hidden input is OUTSIDE previewContainer so it always submits --}}
                        <input type="hidden" name="image_url" id="image_url">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                            <div class="space-y-1 group">
                                <label class="luxe-label">Archive_Title</label>
                                <input type="text" name="judul" id="judul" required class="input-luxe" placeholder="BOOK TITLE">
                            </div>
                            <div class="space-y-1 group">
                                <label class="luxe-label">Creator_Name</label>
                                <input type="text" name="penulis" id="penulis" required class="input-luxe" placeholder="AUTHOR NAME">
                            </div>
                        </div>
                    </div>

                    <!-- Section: Metadata -->
                    <div class="grid grid-cols-2 gap-8 border-t border-white/5 pt-10">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Publisher_Node</label>
                            <input type="text" name="penerbit" id="penerbit" required class="input-luxe" placeholder="PUBLISHER">
                        </div>
                        <div class="space-y-1 group">
                            <label class="luxe-label">Temporal_Stamp</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" required class="input-luxe" placeholder="e.g. 2024">
                        </div>
                    </div>

                    <!-- Section: Registry -->
                    <div class="space-y-10 border-t border-white/5 pt-10">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Taxonomy_Classification</label>
                            <div class="custom-select-container relative" id="customSelect">
                                <input type="hidden" name="kategori" id="kategori_value" required>
                                <div class="input-luxe flex items-center justify-between cursor-pointer group relative !py-6" id="selectTrigger">
                                    <span id="selectedLabel" class="text-white/20 tracking-[0.4em] text-[10px] font-black uppercase">-- Select Classification --</span>
                                    <div class="arrow-icon transition-all duration-500 opacity-20">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 4.5L6 8.5L10 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>

                                <div id="optionsPanel" class="absolute z-50 w-full p-2">
                                    <div class="max-h-[280px] overflow-y-auto custom-scrollbar">
                                        @foreach($kategori as $index => $kat)
                                        <div class="option-item flex items-center justify-between p-5 cursor-pointer"
                                            onclick="selectOption('{{ $kat->nama_kategori }}', '{{ $kat->id }}', '{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}')">
                                            <span class="text-[10px] font-black tracking-widest uppercase">
                                                <span class="text-indigo-500/50 mr-4 font-mono text-[9px]">[{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}]</span>
                                                {{ $kat->nama_kategori }}
                                            </span>
                                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500/0 group-hover:bg-indigo-500 transition-all"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1 group">
                            <label class="luxe-label">Manifesto_Abstract</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="input-luxe min-h-[140px] resize-none" placeholder="ARCHIVE DESCRIPTION..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-white/5">
                    <button type="submit" class="btn-premium w-full !rounded-3xl relative overflow-hidden group/btn">
                        <span class="relative z-10 italic">Deploy New Archive Node</span>
                        <div class="absolute inset-0 bg-indigo-600 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-500"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== GENRE DISCOVERY SECTION ===== --}}
<style>
    .genre-discovery-card {
        background: rgba(255, 255, 255, 0.004);
        border: 1px solid rgba(255, 255, 255, 0.025);
        border-radius: 32px;
        overflow: hidden;
        transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        aspect-ratio: 1/1.4;
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .genre-discovery-card:hover {
        transform: translateY(-12px) scale(1.02);
        border-color: rgba(99, 102, 241, 0.4);
        box-shadow: 0 50px 100px -30px rgba(0, 0, 0, 0.9), 0 0 30px rgba(99, 102, 241, 0.1);
    }

    .genre-discovery-card .gdc-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        filter: blur(20px) saturate(0.2) brightness(0.2);
        transform: scale(1.2);
        transition: all 1s ease;
    }

    .genre-discovery-card:hover .gdc-bg {
        filter: blur(8px) saturate(0.6) brightness(0.4);
        transform: scale(1);
    }

    .genre-discovery-card .gdc-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.5) 40%, transparent 100%);
        transition: opacity 0.5s ease;
    }

    .genre-discovery-card .gdc-content {
        position: relative;
        z-index: 10;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2rem;
    }
</style>

<div class="mt-24 reveal-up">
    <div class="flex items-center gap-6 mb-10">
        <h2 class="text-[9px] font-black tracking-[0.6em] uppercase text-white/30 whitespace-nowrap">Explore By Genre</h2>
        <div class="h-px flex-grow bg-gradient-to-r from-white/10 to-transparent"></div>
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
            <span class="text-[8px] font-black uppercase tracking-widest text-indigo-400">Global Archive</span>
        </div>
    </div>
    <div id="genreGrid" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6">
        {{-- Loaded via JS --}}
        @for($i = 0; $i < 6; $i++)
            <div class="genre-discovery-card animate-pulse bg-white/[0.01] border-white/5">
    </div>
    @endfor
</div>
</div>

<script>
    const apiKey = "AIzaSyAlbY4ey6mjpkNYnIFvEIRNDkRnk6fLyrk";

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
        label.classList.replace('text-white/20', 'text-white');
        hiddenInput.value = id;
        selectContainer.classList.remove('active');
    }

    window.addEventListener('click', () => selectContainer.classList.remove('active'));

    // Global Archive Search (Google Books API)
    async function performApiSearch() {
        const query = document.getElementById('apiSearchInput').value.trim();
        const results = document.getElementById('apiResults');
        if (!query) return;

        results.classList.remove('hidden');
        results.innerHTML = '<div class="p-10 text-[9px] text-center italic animate-pulse tracking-[0.4em] text-white/20">Establishing Link...</div>';

        try {
            const res = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(query)}&maxResults=6&key=${apiKey}`);
            const data = await res.json();
            results.innerHTML = '';

            if (!data.items) {
                results.innerHTML = '<div class="p-10 text-[9px] text-center text-red-500 tracking-[0.4em] uppercase italic">Zero Records Found</div>';
                return;
            }

            data.items.forEach((item, index) => {
                const info = item.volumeInfo;
                const thumb = info.imageLinks ? info.imageLinks.thumbnail.replace('http:', 'https:') : '';
                const hexId = Math.random().toString(16).slice(2, 6).toUpperCase();
                const div = document.createElement('div');

                div.className = "api-result-node group";
                div.style.animation = `revealUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) ${index * 0.1}s forwards`;
                div.onclick = () => fillForm(info, thumb);

                div.innerHTML = `
            <div class="absolute top-3 right-6 text-[7px] font-mono text-white/5 tracking-[0.3em] group-hover:text-indigo-500/40 transition-colors">
                REF_IDX#${hexId}
            </div>

            <div class="w-14 h-20 lg:w-20 lg:h-28 rounded-xl overflow-hidden border border-white/5 flex-shrink-0 shadow-2xl transition-transform duration-500 group-hover:scale-105 group-hover:rotate-[-2deg]">
                <img src="${thumb || 'https://via.placeholder.com/150x200?text=NO_COVER'}" 
                     class="w-full h-full object-cover">
            </div>

            <div class="flex-1 min-w-0 pr-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[7px] px-2 py-0.5 rounded-md bg-indigo-500/10 text-indigo-400 font-black uppercase tracking-tighter border border-indigo-500/20">
                        Data_Verified
                    </span>
                    <span class="text-[7px] text-white/10 font-mono italic">
                        ${info.publishedDate ? info.publishedDate.substring(0, 4) : 'N/A'}
                    </span>
                </div>
                
                <h4 class="text-xs lg:text-sm font-black text-white/90 group-hover:text-white truncate uppercase italic tracking-tight mb-1">
                    ${info.title}
                </h4>
                
                <p class="text-[9px] font-bold text-white/20 uppercase tracking-[0.2em] truncate group-hover:text-indigo-400/60 transition-colors">
                    BY: ${info.authors ? info.authors[0] : 'UNKNOWN_AUTHOR'}
                </p>
            </div>

            <div class="hidden lg:flex w-8 h-8 rounded-full border border-white/5 items-center justify-center opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0 bg-indigo-500/10">
                <svg class="w-3 h-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
        `;
                results.appendChild(div);
            });
        } catch (e) {
            results.innerHTML = '<div class="p-10 text-[9px] text-center text-red-500 tracking-[0.4em] uppercase">Connection Error</div>';
        }
    }

    function fillForm(info, thumb) {
        document.getElementById('judul').value = info.title || '';
        document.getElementById('penulis').value = info.authors ? info.authors.join(', ') : '';
        document.getElementById('penerbit').value = info.publisher || '';
        document.getElementById('tahun_terbit').value = info.publishedDate ? info.publishedDate.substring(0, 4) : '';
        document.getElementById('deskripsi').value = info.description ? info.description.replace(/<[^>]*>/g, '') : '';

        if (thumb) {
            const container = document.getElementById('previewContainer');
            const box = container.querySelector('.preview-box');
            const img = document.getElementById('imagePreview');
            const hiddenUrl = document.getElementById('image_url');
            hiddenUrl.value = thumb;
            img.src = thumb;
            container.classList.remove('hidden');

            // Trigger Scanning Animation
            box.classList.add('scanning');
            setTimeout(() => {
                container.classList.remove('opacity-0', 'scale-95');
                container.classList.add('opacity-100', 'scale-100');
            }, 100);

            // Turn off scan line after 2s
            setTimeout(() => box.classList.remove('scanning'), 2500);
        }

        // Hide results after selection
        document.getElementById('apiResults').classList.add('hidden');
    }

    function clearPreview() {
        const container = document.getElementById('previewContainer');
        container.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            container.classList.add('hidden');
            document.getElementById('image_url').value = '';
            document.getElementById('imagePreview').src = '';
        }, 700);
    }

    // ===== GENRE DISCOVERY LOADER =====
    const GENRES = ['Science Fiction', 'Fantasy', 'Mystery', 'Romance', 'Biography', 'History', 'Self-Help', 'Business', 'Technology', 'Philosophy', 'Psychology', 'Art'];

    async function loadGenres() {
        const grid = document.getElementById('genreGrid');
        if (!grid) return;
        grid.innerHTML = '';

        for (let i = 0; i < GENRES.length; i++) {
            const genre = GENRES[i];
            try {
                const res = await fetch(`https://www.googleapis.com/books/v1/volumes?q=subject:${encodeURIComponent(genre)}&maxResults=1&key=${apiKey}`);
                const data = await res.json();
                const totalItems = data.totalItems || 0;
                let thumb = '';
                if (data.items && data.items[0]?.volumeInfo?.imageLinks?.thumbnail) {
                    thumb = data.items[0].volumeInfo.imageLinks.thumbnail.replace('http:', 'https:');
                }

                const card = document.createElement('div');
                card.className = 'genre-discovery-card group';
                card.style.animation = `revealUp 1s cubic-bezier(0.16, 1, 0.3, 1) ${i * 0.05}s forwards`;
                card.innerHTML = `
                    ${thumb ? `<div class="gdc-bg" style="background-image:url('${thumb}')"></div>` : '<div class="absolute inset-0 bg-gradient-to-br from-indigo-900/30 to-black/80"></div>'}
                    <div class="gdc-overlay"></div>
                    <div class="absolute top-4 right-4">
                        <span class="text-[8px] font-black text-indigo-400 bg-black/60 backdrop-blur-md border border-indigo-500/20 px-3 py-1 rounded-full uppercase tracking-widest shadow-xl">
                            ${Math.round(totalItems/1000)}K+
                        </span>
                    </div>
                    <div class="gdc-content">
                        <h3 class="text-base font-black text-white italic uppercase tracking-tighter leading-[0.9] group-hover:text-indigo-300 transition-colors duration-500 mb-1">${genre}</h3>
                        <p class="text-[8px] font-bold text-white/30 uppercase tracking-widest mb-4 opacity-0 group-hover:opacity-100 transition-all duration-700">Explore Collection</p>
                        <div class="flex items-center gap-3">
                            <div class="h-[2px] w-8 bg-indigo-500/0 group-hover:w-12 group-hover:bg-indigo-500 transition-all duration-700"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white/20 group-hover:text-white transition-colors translate-x-[-10px] group-hover:translate-x-0 opacity-0 group-hover:opacity-100 transition-all duration-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="3"/></svg>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            } catch (e) {
                // Skip failed genre
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadGenres();
    });
</script>
@endsection