@extends('app')

@section('content')
<style>
    /* 1. LUXE PROFILE STATION */
    .profile-card {
        background: rgba(255, 255, 255, 0.005);
        backdrop-filter: blur(80px) saturate(150%);
        border: 1px solid rgba(255, 255, 255, 0.02);
        border-radius: 64px;
        transition: all 1.2s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 80px 160px -40px rgba(0, 0, 0, 0.8);
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

    .photo-preview-box:hover {
        border-color: var(--accent);
        transform: scale(1.05);
    }

    /* 2. CUSTOM MODAL OVERRIDE */
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

    .modal-content-luxe {
        background: rgba(10, 10, 10, 0.9);
        backdrop-filter: blur(80px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 56px;
        padding: 4rem;
        max-width: 450px;
        width: 100%;
        text-align: center;
        transform: scale(0.9) translateY(40px);
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-luxe-status.active .modal-content-luxe {
        transform: scale(1) translateY(0);
    }
</style>

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
                    <h1 class="editorial-title text-6xl lg:text-7xl mb-10 leading-[0.85]">
                        UBAH <br> <span class="outline-text">PROFIL.</span>
                    </h1>
                    <p class="text-[11px] text-white/30 uppercase tracking-[0.3em] leading-loose max-w-sm">Sesuaikan identitas digital `kamu` di sini. Pastikan semuanya sudah pas agar pengalaman di <span class="text-white font-black">PRINZ LIBRARY</span> makin personal.</p>
                </div>
            </div>
            
            <div class="pt-10">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                    </div>
                    <div class="text-[9px] font-black uppercase tracking-widest text-white/20">
                        Koneksi Aman Terjalin <br>
                        <span class="text-indigo-500 italic">Enkripsi v2.0 Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-16 lg:p-20">
            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="space-y-10">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required class="input-luxe" placeholder="NAMA KAMU">
                        </div>
                        <div class="space-y-1 group">
                            <label class="luxe-label">Username</label>
                            <input type="text" name="username" value="{{ Auth::user()->username }}" required class="input-luxe" placeholder="USERNAME">
                        </div>
                    </div>

                    <div class="space-y-1 group border-t border-white/5 pt-10">
                        <label class="luxe-label">Foto Profil Baru</label>
                        <div class="flex items-center gap-8">
                            <div id="previewContainer" class="{{ Auth::user()->profile_photo_path ? '' : 'hidden' }} photo-preview-box">
                                <img id="imagePreview" src="{{ Auth::user()->profile_photo_path ? asset('storage/'.Auth::user()->profile_photo_path) : '' }}" class="w-full h-full object-cover">
                                <button type="button" onclick="removePhoto()" class="absolute inset-0 bg-black/80 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <span class="text-[8px] font-black text-red-500 italic">HAPUS</span>
                                </button>
                            </div>
                            
                            <div class="flex-1">
                                <button type="button" onclick="document.getElementById('fileInput').click()" 
                                        class="w-full input-luxe flex items-center justify-between group">
                                    <span id="fileName" class="text-white/20 text-[10px] font-black uppercase tracking-widest truncate">Pilih Foto...</span>
                                    <span class="text-[8px] font-black text-indigo-400 border border-indigo-500/20 px-4 py-2 rounded-xl group-hover:bg-indigo-500 group-hover:text-white transition-all">CARI</span>
                                </button>
                            </div>
                        </div>
                        <input type="file" id="fileInput" name="profile_photo" class="hidden" accept="image/*">
                    </div>

                    <div class="space-y-10 border-t border-white/5 pt-10">
                        <div class="space-y-1 group">
                            <label class="luxe-label">Alamat Email (Permanen)</label>
                            <input type="email" value="{{ Auth::user()->email }}" readonly class="input-luxe opacity-30 cursor-not-allowed" placeholder="EMAIL@KAMU.COM">
                        </div>

                        <div class="space-y-1 group">
                            <label class="luxe-label">Bio Singkat</label>
                            <textarea name="bio" class="input-luxe min-h-[140px] resize-none" placeholder="CERITAKAN SEDIKIT TENTANG DIRIMU...">{{ Auth::user()->bio }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-white/5">
                    <button type="submit" class="btn-premium !rounded-3xl italic">Simpan Perubahan Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- STATUS MODAL --}}
<div id="statusModal" class="modal-luxe-status">
    <div class="modal-content-luxe">
        <div id="modalIconBox" class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-10 border"></div>
        <h3 id="modalTitle" class="text-3xl font-black mb-4 uppercase tracking-tighter italic text-white"></h3>
        <p id="modalDesc" class="text-[11px] text-white/30 uppercase tracking-[0.3em] leading-loose mb-12 italic"></p>
        <button onclick="closeModal()" class="w-full btn-premium">Mengerti</button>
    </div>
</div>

<script>
    const modal = document.getElementById('statusModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalIconBox = document.getElementById('modalIconBox');

    @if(session('success'))
        showModal(true, "{{ session('success') }}");
    @endif

    function showModal(isSuccess, message = "") {
        modal.classList.add('active');
        if (isSuccess) {
            modalTitle.textContent = "BERHASIL DISIMPAN";
            modalDesc.textContent = message || "Profil kamu sudah berhasil diperbarui dengan sempurna.";
            modalIconBox.className = "w-24 h-24 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-10 border border-green-500/20";
            modalIconBox.innerHTML = '<span class="text-3xl text-green-500">✓</span>';
        } else {
            modalTitle.textContent = "ADA KESALAHAN";
            modalDesc.textContent = message || "Gagal memperbarui profil. Coba cek kembali data yang kamu masukkan.";
            modalIconBox.className = "w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-10 border border-red-500/20";
            modalIconBox.innerHTML = '<span class="text-3xl text-red-500">✕</span>';
        }
    }

    function closeModal() {
        modal.classList.remove('active');
        if (modalTitle.textContent === "BERHASIL DISIMPAN") {
            window.location.href = "{{ route('beranda') }}";
        }
    }

    document.getElementById('fileInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                showModal(false, "FOTO TERLALU BESAR (MAKSIMAL 2MB)");
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => { 
                document.getElementById('imagePreview').src = e.target.result; 
                document.getElementById('previewContainer').classList.remove('hidden'); 
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileName').classList.replace('text-white/20', 'text-white');
            };
            reader.readAsDataURL(file);
        }
    });

    function removePhoto() {
        document.getElementById('fileInput').value = '';
        document.getElementById('imagePreview').src = '';
        document.getElementById('previewContainer').classList.add('hidden');
        document.getElementById('fileName').textContent = 'Pilih foto...';
        document.getElementById('fileName').classList.replace('text-white', 'text-white/20');
    }
</script>
@endsection