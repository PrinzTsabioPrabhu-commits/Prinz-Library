@extends('app')

@section('content')
<style>
    /* --- FONTS & TYPOGRAPHY --- */
    .editorial-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        /* Sesuaikan dengan nama font di app.blade kamu */
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .outline-text {
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.2);
        color: transparent;
    }

    .luxe-label {
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        color: rgba(255, 255, 255, 0.3);
        margin-bottom: 12px;
        display: block;
        transition: all 0.4s ease;
    }

    .input-luxe {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 18px 24px;
        color: white;
        font-size: 11px;
        font-weight: 500;
        width: 100%;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .input-luxe:focus {
        outline: none;
        border-color: #6366f1;
        /* Indigo-500 */
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 40px -10px rgba(99, 102, 241, 0.2);
    }

    /* --- ANIMASI BACKGROUND (HUJAN BUKU) --- */
    .book-rain-internal {
        position: fixed;
        inset: 0;
        z-index: 0;
        display: flex;
        gap: 20px;
        padding: 20px;
        opacity: 0.1;
        pointer-events: none;
        overflow: hidden;
    }

    .book-col {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 140px;
        flex-shrink: 0;
    }

    .book-col.up {
        animation: scrollUp 40s linear infinite;
    }

    .book-col.down {
        animation: scrollDown 45s linear infinite;
    }

    @keyframes scrollUp {
        from {
            transform: translateY(0);
        }

        to {
            transform: translateY(-50%);
        }
    }

    @keyframes scrollDown {
        from {
            transform: translateY(-50%);
        }

        to {
            transform: translateY(0);
        }
    }

    .book-card-mini {
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
    }

    .book-card-mini img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* --- PROFILE CARD --- */
    .profile-card {
        background: rgba(255, 255, 255, 0.005);
        backdrop-filter: blur(80px) saturate(150%);
        border: 1px solid rgba(255, 255, 255, 0.02);
        border-radius: 64px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 80px 160px -40px rgba(0, 0, 0, 0.8);
        z-index: 10;
    }

    .photo-preview-box {
        width: 80px;
        height: 80px;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
        background: rgba(255, 255, 255, 0.02);
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }

    .modal-luxe-status {
        position: fixed;
        inset: 0;
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        opacity: 0;
        pointer-events: none;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-luxe-status.active {
        opacity: 1;
        pointer-events: auto;
    }

    /* --- STYLE TOMBOL PREMIUM DENGAN HOVER --- */
    .btn-premium {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        color: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
        /* Samakan dengan heading */
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.05em;
        padding: 18px 36px;
        border: none;
        box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.4);
        cursor: pointer;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn-premium:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 30px 60px -12px rgba(168, 85, 247, 0.5);
        letter-spacing: 0.15em;
        /* Efek teks merenggang saat hover */
    }

    .btn-premium:active {
        transform: translateY(0) scale(0.98);
    }

    /* Efek Kilatan Cahaya (Shimmer) */
    .btn-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent);
        transition: 0.6s;
    }

    .btn-premium:hover::before {
        left: 100%;
    }
</style>

<div class="book-rain-internal">
    <div id="col-1" class="book-col up"></div>
    <div id="col-2" class="book-col down"></div>
    <div id="col-3" class="book-col up hidden lg:flex"></div>
    <div id="col-4" class="book-col down hidden xl:flex"></div>
</div>

<div class="reveal-up py-20 lg:py-32">
    <div class="profile-card grid lg:grid-cols-2">
        <div class="p-20 flex flex-col justify-between border-r border-white/5 bg-white/[0.01]">
            <div>
                <a href="{{ route('beranda') }}" class="inline-flex items-center gap-4 text-[9px] font-black uppercase tracking-[0.4em] text-white/20 hover:text-white transition-all mb-16">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full border border-white/10 italic">←</span>
                    Kembali Ke Beranda
                </a>
                <div>
                    <span class="text-[9px] font-black tracking-[0.8em] uppercase text-indigo-500/80 block mb-6 italic">Pengaturan Profil // Personalisasi</span>
                    <h1 class="editorial-title text-6xl lg:text-8xl mb-10 leading-[0.85] text-white">
                        UBAH <br> <span class="outline-text">PROFIL.</span>
                    </h1>
                    <p class="text-[11px] text-white/30 uppercase tracking-[0.3em] leading-loose max-w-sm">Sesuaikan identitas digital kamu di sini agar tetap relevan.</p>
                </div>
            </div>
        </div>

        <div class="p-16 lg:p-20">
            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="space-y-10">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="space-y-1 group">
                            <label class="luxe-label group-hover:text-white/60 transition-colors">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required class="input-luxe">
                        </div>
                        <div class="space-y-1 group">
                            <label class="luxe-label group-hover:text-white/60 transition-colors">Username</label>
                            <input type="text" name="username" value="{{ Auth::user()->username }}" required class="input-luxe">
                        </div>
                    </div>

                    <div class="space-y-1 group border-t border-white/5 pt-10">
                        <label class="luxe-label group-hover:text-white/60 transition-colors">Foto Profil Baru</label>
                        <div class="flex items-center gap-8">
                            <div id="previewContainer" class="{{ Auth::user()->profile_photo_path ? '' : 'hidden' }} photo-preview-box">
                                @php
                                    $photoPath = Auth::user()->profile_photo_path;
                                    $photoUrl = $photoPath ? (Str::startsWith($photoPath, ['http://', 'https://']) ? $photoPath : asset('storage/' . $photoPath)) : '';
                                @endphp
                                <img id="imagePreview" src="{{ $photoUrl }}" class="w-full h-full object-cover">
                                <button type="button" onclick="removePhoto()" class="absolute inset-0 bg-black/80 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <span class="text-[8px] font-black text-red-500 italic">HAPUS</span>
                                </button>
                            </div>
                            <div class="flex-1">
                                <button type="button" onclick="document.getElementById('fileInput').click()" class="w-full input-luxe flex items-center justify-between group">
                                    <span id="fileName" class="text-white/20 text-[10px] font-black uppercase tracking-widest truncate">Pilih Foto...</span>
                                    <span class="text-[8px] font-black text-indigo-400 border border-indigo-500/20 px-4 py-2 rounded-xl group-hover:bg-indigo-500 group-hover:text-white transition-all">CARI</span>
                                </button>
                            </div>
                        </div>
                        <input type="file" id="fileInput" name="profile_photo" class="hidden" accept="image/*">
                    </div>

                    <div class="space-y-1 group">
                        <label class="luxe-label group-hover:text-white/60 transition-colors">Bio Singkat</label>
                        <textarea name="bio" class="input-luxe min-h-[140px] resize-none">{{ Auth::user()->bio }}</textarea>
                    </div>
                </div>

                <div class="pt-10 border-t border-white/5">
                    <button type="submit" class="btn-premium !rounded-3xl italic">
                        <span class="text-[10px] font-black uppercase tracking-[0.05em]">Simpan Perubahan Profil</span>
                    </button>
                </div>
                {{-- MODAL --}}
                <div id="statusModal" class="modal-luxe-status" data-success="{{ session('success') }}" data-error="{{ $errors->first() }}">
                    <div class="modal-content-luxe">
                        <div id="modalIconBox" class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-10 border"></div>
                        <h3 id="modalTitle" class="text-3xl font-black mb-4 uppercase tracking-tighter italic text-white"></h3>
                        <p id="modalDesc" class="text-[11px] text-white/30 uppercase tracking-[0.3em] leading-loose mb-12 italic"></p>
                        <button onclick="closeModal()" class="w-full btn-premium">Mengerti</button>
                    </div>
                </div>

                <script>
                    // --- ANIMASI BACKGROUND ---
                    const fallbacks = [
                        'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300',
                        'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=300',
                        'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300',
                        'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=300'
                    ];

                    async function initProfileBackground() {
                        const columns = [document.getElementById('col-1'), document.getElementById('col-2'), document.getElementById('col-3'), document.getElementById('col-4')];
                        try {
                            const res = await fetch('https://www.googleapis.com/books/v1/volumes?q=subject:art+OR+subject:design&maxResults=15');
                            const data = await res.json();
                            const images = data.items ? data.items.map(i => i.volumeInfo.imageLinks?.thumbnail?.replace('http:', 'https:')) : fallbacks;

                            columns.forEach((col) => {
                                if (!col) return;
                                let html = '';
                                for (let i = 0; i < 12; i++) {
                                    const img = images[i % images.length] || fallbacks[i % fallbacks.length];
                                    html += `<div class="book-card-mini"><img src="${img}" onerror="this.src='${fallbacks[0]}'"></div>`;
                                }
                                col.innerHTML = html + html;
                            });
                        } catch (e) {
                            columns.forEach(col => {
                                if (col) col.innerHTML = "";
                            });
                        }
                    }

                    // --- MODAL & PHOTO LOGIC ---
                    const modal = document.getElementById('statusModal');
                    const modalTitle = document.getElementById('modalTitle');
                    const modalDesc = document.getElementById('modalDesc');
                    const modalIconBox = document.getElementById('modalIconBox');

                    const successMessage = modal ? modal.getAttribute('data-success') : '';
                    const errorMessage = modal ? modal.getAttribute('data-error') : '';

                    if (successMessage) {
                        showModal(true, successMessage);
                    } else if (errorMessage) {
                        showModal(false, errorMessage);
                    }

                    function showModal(isSuccess, message = "") {
                        if (!modal) return;
                        modal.classList.add('active');
                        modalTitle.textContent = isSuccess ? "BERHASIL DISIMPAN" : "ADA KESALAHAN";
                        modalDesc.textContent = message;
                        modalIconBox.className = isSuccess ? "w-24 h-24 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-10 border border-green-500/20" : "w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-10 border border-red-500/20";
                        modalIconBox.innerHTML = isSuccess ? '<span class="text-3xl text-green-500">✓</span>' : '<span class="text-3xl text-red-500">✕</span>';
                    }

                    function closeModal() {
                        modal.classList.remove('active');
                        if (modalTitle.textContent === "BERHASIL DISIMPAN") window.location.href = "{{ route('beranda') }}";
                    }

                    document.getElementById('fileInput').addEventListener('change', function() {
                        const file = this.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = e => {
                                document.getElementById('imagePreview').src = e.target.result;
                                document.getElementById('previewContainer').classList.remove('hidden');
                                document.getElementById('fileName').textContent = file.name.toUpperCase();
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    function removePhoto() {
                        document.getElementById('fileInput').value = '';
                        document.getElementById('previewContainer').classList.add('hidden');
                        document.getElementById('fileName').textContent = 'Pilih foto...';
                    }

                    document.addEventListener('DOMContentLoaded', initProfileBackground);
                </script>
                @endsection