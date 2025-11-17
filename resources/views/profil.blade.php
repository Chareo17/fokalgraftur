@extends('layouts.app')

@section('content')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: "Profile Berhasil di Update",
            icon: "success",
            draggable: true
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: "Error",
            text: "{{ session('error') }}",
            icon: "error",
            draggable: true
        });
    });
</script>
@endif

<!-- Profile Header dengan desain modern -->
<div class="profile-hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div class="hero-pattern"></div>
    
    <div class="container position-relative" style="padding: 120px 0 60px; margin-bottom: -50px;">
        <div class="row align-items-center">
            <!-- Profile Image & Info -->
            <div class="col-lg-8">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start">
                    <!-- Enhanced Avatar -->
                    <div class="profile-avatar-wrapper mb-4 mb-md-0 me-md-4">
                        <div class="profile-avatar">
                            <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/img/avatar-1.webp') }}"
                                 alt="Foto Profil" class="avatar-img">
                            <div class="avatar-status"></div>
                        </div>
                        <div id="profile-image-preview" class="d-none" style="margin-top: 1rem;">
                            <div class="form-section-title" style="font-size: 0.95rem; margin-bottom: 0.75rem;">
                                <i class="bi bi-eye me-1"></i>
                                Preview Foto Profil
                            </div>
                            <img id="profile-image-preview-img" src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/img/avatar-1.webp') }}" alt="Profile Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="profile-info text-center text-md-start">
                        <h1 class="profile-name text-white">{{ $profile->name ?? '' }}</h1>
                        <div class="profile-meta">
                            <span class="meta-item">
                                <i class="bi"></i>
                                {{ $profile->username ?? '' }}
                            </span>
                            @if($profile->alamat)
                            <span class="meta-item">
                                <i class="bi bi-geo-alt"></i>
                                {{ $profile->alamat }}
                            </span>
                            @endif
                            @if($profile->tanggal_lahir)
                            <span class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($profile->tanggal_lahir)->translatedFormat('d F Y') }}
                            </span>
                            @endif
                        </div>
                        
                        @if($profile->role === 'alumni')
                        <div class="profile-badge">
                            <span class="badge bg-gradient-success">
                                <i class="bi bi-mortarboard me-1"></i>
                                Alumni {{ $profile->tahun_lulusan ?? '' }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="col-lg-4">
                <div class="profile-actions text-center text-lg-end">
                    <a href="{{ route('edit-profile') }}" class="btn btn-modern btn-edit mb-2 mb-lg-0 me-2">
                        <i class="bi bi-pencil-square me-2 "></i>
                        Edit Profil
                    </a>
                    @if($profile->role === 'alumni')
                    <a href="#" id="kartuDigitalLink" class="btn btn-modern btn-primary mb-2 mb-lg-0 me-2" data-bs-toggle="modal" data-bs-target="#kartuDigitalModal">
                        <i class="bi bi-credit-card-2-front me-2"></i>
                        Kartu Digital
                    </a>
                    @if($profile->ijazah)
                    <a href="#" class="btn btn-modern btn-success mb-2 mb-lg-0 me-2 bt-2" data-bs-toggle="modal" data-bs-target="#ijazahModal">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Lihat Ijazah
                    </a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal Kartu Digital - Only for Alumni -->
@if($profile->role === 'alumni')
<div class="modal fade" id="kartuDigitalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Kartu Digital Alumni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="digital-card mx-auto">
                    <!-- Card Header -->
                    <div class="card-header-modern">
                        <div class="card-logo">
                            <img src="{{ asset('assets/img/grafika1.png') }}" alt="Logo USNI">
                        </div>
                        <div class="card-title">
                            <h6 >ALUMNI</h6>
                            <small style="color:rgb(0, 0, 0);">DIGITAL CARD</small>
                        </div>
                        <div class="card-chip"></div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body-modern">
                        {{-- <div class="photo-section">
                            <div class="photo-frame">
                                <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/img/avatar-1.webp') }}"
                                     alt="Foto Profil"
                                     class="img-fluid rounded-circle"
                                     style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                        </div>
                         --}}

                        <div class="info-section">
                            <div class="info-row">
                                <span class="info-label">Nama</span>
                                <span class="info-value">{{ $profile->name ?? '' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Jurusan</span>
                                <span class="info-value">{{ $profile->jurusan ?? '' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Nomor Induk Alumni</span>
                                <span class="info-value">{{ $profile->nia ?? '' }}</span>
                            </div>
                             <div class="info-row">
                                <span class="info-label">Tahun Kelulusan</span>
                                <span class="info-value">{{ $profile->tahun_lulusan ?? '' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer-modern">
                        <div class="card-pattern"></div>
                        {{-- <small class="text-muted">Valid Until: Lifetime</small> --}}
                    </div>
                </div>
                
                <button type="button" class="btn btn-modern btn-secondary mt-4 me-2" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="button" class="btn btn-modern btn-primary mt-4" id="downloadDigitalCard">
                    Unduh
                </button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.getElementById('downloadDigitalCard').addEventListener('click', function() {
    const card = document.querySelector('.digital-card');
    if (!card) {
        alert('Digital card element not found.');
        return;
    }
    html2canvas(card).then(canvas => {
        canvas.toBlob(function(blob) {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Kartu_Digital_Alumni.png';
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        });
    }).catch(error => {
        alert('Download failed: ' + error.message);
    });
});

// Function to download ijazah
function downloadIjazah() {
    fetch('{{ route("download-ijazah") }}', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.error || 'Download failed');
            });
        }
        return response.blob();
    })
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = '{{ $profile->name ?? "Alumni" }}_ijazah_' + new Date().getTime() + '.' + blob.type.split('/')[1];
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        Swal.fire({
            title: "Error",
            text: error.message,
            icon: "error",
            draggable: true
        });
    });
}

// Image preview functionality
document.addEventListener('DOMContentLoaded', function() {
    const avatarImg = document.querySelector('.avatar-img');
    const previewDiv = document.getElementById('profile-image-preview');
    const previewImg = document.getElementById('profile-image-preview-img');

    if (avatarImg && previewDiv && previewImg) {
        avatarImg.style.cursor = 'pointer';

        avatarImg.addEventListener('click', function() {
            const imgSrc = this.src;
            previewImg.src = imgSrc;
            previewDiv.classList.toggle('d-none');
        });

        // Close preview when clicking outside
        document.addEventListener('click', function(e) {
            if (!avatarImg.contains(e.target) && !previewDiv.contains(e.target)) {
                previewDiv.classList.add('d-none');
            }
        });
    }
});
</script>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Ijazah Modal - Only for Alumni -->
@if($profile->role === 'alumni' && $profile->ijazah)
<div class="modal fade" id="ijazahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modern-modal">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Ijazah - {{ $profile->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="ijazah-container mx-auto mb-4">
                    @php
                        $ijazahFiles = $profile->ijazah;
                        $ijazahPath = '';

                        // Check if it's a JSON string and decode it
                        if (is_string($ijazahFiles) && strpos($ijazahFiles, '[') === 0) {
                            $decodedFiles = json_decode($ijazahFiles, true);
                            if (is_array($decodedFiles) && !empty($decodedFiles)) {
                                $ijazahFiles = $decodedFiles;
                            }
                        }

                        // Handle both single file path and array of file paths
                        if (is_array($ijazahFiles) && !empty($ijazahFiles)) {
                            $ijazahPath = $ijazahFiles[0];
                        } elseif (is_string($ijazahFiles)) {
                            $ijazahPath = $ijazahFiles;
                        }

                        $fileExtension = strtolower(pathinfo($ijazahPath, PATHINFO_EXTENSION));
                        $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        $isPdf = $fileExtension === 'pdf';
                    @endphp

                    @if($ijazahPath && $isImage)
                        <img src="{{ asset('storage/' . $ijazahPath) }}"
                             alt="Ijazah {{ $profile->name }}"
                             class="img-fluid rounded shadow"
                             style="max-width: 100%; max-height: 70vh; object-fit: contain;"
                             onerror="this.style.display='none'; document.getElementById('ijazah-error').style.display='block';">
                    @elseif($ijazahPath && $isPdf)
                        <div class="pdf-preview">
                            <iframe src="{{ asset('storage/' . $ijazahPath) }}"
                                    style="width: 100%; height: 70vh; border: none; border-radius: 10px;"
                                    onerror="this.style.display='none'; document.getElementById('ijazah-error').style.display='block';">
                            </iframe>
                        </div>
                    @elseif($ijazahPath)
                        <div class="file-preview-fallback">
                            <i class="bi bi-file-earmark-text" style="font-size: 4rem; color: #6c757d;"></i>
                            <p class="mt-3">File: {{ basename($ijazahPath) }}</p>
                        </div>
                    @else
                        <div class="file-preview-fallback">
                            <i class="bi bi-exclamation-triangle" style="font-size: 4rem; color: #dc3545;"></i>
                            <p class="mt-3 text-danger">File ijazah tidak tersedia</p>
                        </div>
                    @endif

                    <div id="ijazah-error" style="display: none; color: #dc3545; margin-top: 20px;">
                        <i class="bi bi-exclamation-triangle" style="font-size: 2rem;"></i>
                        <p class="mt-2">File ijazah tidak dapat ditampilkan. Pastikan file tersedia di storage.</p>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-modern btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>
                        Tutup
                    </button>
                    <a href="#" onclick="downloadIjazah()" class="btn btn-modern btn-success">
                        <i class="bi bi-download me-2"></i>
                        Unduh Ijazah
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Profile Details Section -->
<div class="profile-details">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-12">
                <div class="details-grid">
                    <!-- Program Studi -->
                    <div class="detail-card">
                        <div class="card-icon bg-info">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <div class="card-content">
                            <h6>Jurusan</h6>
                            <p>{{ $profile->jurusan ?? '-' }}</p>
                        </div>
                    </div>

                    @if($profile->role === 'alumni')
                    <!-- Universitas -->
                    <div class="detail-card">
                        <div class="card-icon bg-primary">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div class="card-content">
                            <h6>Universitas</h6>
                            <p>
                                @if($profile->status === 'Bekerja' || $profile->status === 'Tidak Bekerja')
                                    -
                                @else
                                    {{ $profile->nama_universitas ?? '-' }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Tahun Lulusan -->
                    <div class="detail-card">
                        <div class="card-icon bg-success">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="card-content">
                            <h6>Tahun Lulusan</h6>
                            <p>{{ $profile->tahun_lulusan ?? '-' }}</p>
                        </div>
                    </div>
                    @endif

@if($profile->role === 'alumni')
<!-- Nomor HP -->
<div class="detail-card">
    <div class="card-icon bg-warning">
        <i class="bi bi-telephone"></i>
    </div>
    <div class="card-content">
        <h6>No HP / WhatsApp</h6>
        <p>{{ $profile->no_hp ?? '-' }}</p>
    </div>
</div>
@endif

                    @if($profile->role === 'alumni')
                    <!-- Status -->
                    <div class="detail-card">
                        <div class="card-icon bg-danger">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="card-content">
                            <h6>Status</h6>
                            <div class="status-input">
                                <input type="text" class="form-control modern-input" name="status" 
                                       placeholder="Isi status pekerjaan Anda" value="{{ $profile->status ?? '-' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Nama Perusahaan -->
                    <div class="detail-card">
                        <div class="card-icon bg-secondary">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="card-content">
                            <h6>Nama Perusahaan</h6>
                            <p>
                                @if($profile->status === 'Studi Lanjut' || $profile->status === 'Tidak Bekerja')
                                    -
                                @else
                                    {{ $profile->nama_perusahaan ?? '-' }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($profile->role === 'siswa')
                    <!-- NIS untuk siswa -->
                    <div class="detail-card">
                        <div class="card-icon bg-info">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <div class="card-content">
                            <h6>NIS</h6>
                            <p>{{ $profile->nis ?? '-' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            {{-- <div class="col-lg-4">
                <div class="profile-sidebar">
                    <div class="sidebar-card">
                        <h6 class="sidebar-title">Informasi Kontak</h6>
                        <div class="contact-info"> --}}
                            {{-- <div class="contact-item">
                                <i class="bi bi-envelope"></i>
                                <span>{{ $profile->email ?? 'Email tidak tersedia' }}</span>
                            </div> --}}
                            {{-- <div class="contact-item">
                                <i class="bi bi-telephone"></i>
                                <span>{{ $profile->no_hp ?? 'Nomor tidak tersedia' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Modern Variables */
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --card-shadow: 0 10px 40px rgba(0,0,0,0.1);
    --card-shadow-hover: 0 20px 60px rgba(0,0,0,0.15);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Profile Hero Section */
.profile-hero {
    position: relative;
    min-height: 400px;
}

.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
}

/* Enhanced Avatar */
.profile-avatar-wrapper {
    position: relative;
}

.profile-avatar {
    position: relative;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    padding: 6px;
    background: linear-gradient(45deg, #fff, rgba(255,255,255,0.8));
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.avatar-status {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 24px;
    height: 24px;
    background: #10b981;
    border: 4px solid #fff;
    border-radius: 50%;
}

/* Profile Info */
.profile-info {
    color: white;
}

.profile-name {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.profile-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1rem;
    justify-content: center;
}

@media (min-width: 768px) {
    .profile-meta {
        justify-content: flex-start;
    }
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
    opacity: 0.9;
}

.profile-badge {
    margin-top: 1rem;
}

.bg-gradient-success {
    background: linear-gradient(45deg, #10b981, #34d399) !important;
}

/* Modern Buttons */
.btn-modern {
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-modern:hover::before {
    left: 100%;
}

.btn-edit {
    background: rgba(255,255,255,0.2);
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
}

.btn-edit:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.btn-primary {
    background: linear-gradient(45deg, #3b82f6, #1d4ed8);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #1d4ed8, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
}

/* Enhanced Modal */
.modern-modal {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    backdrop-filter: blur(20px);
}

.modern-modal .modal-header {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: var(--border-radius) var(--border-radius) 0 0;
}

/* Digital Card Design */
.digital-card {
    width: 350px;
    max-width: 100%;
    background: linear-gradient(135deg, #1e293b, #334155);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    position: relative;
}

.card-header-modern {
    background: white;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.card-logo {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.card-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-title {
    color: white;
    text-align: center;
}

.card-title h6 {
    margin: 0;
    font-weight: 700;
    font-size: 1.2rem;
}

.card-title small {
    opacity: 0.8;
    font-size: 0.75rem;
}

.card-chip {
    width: 35px;
    height: 25px;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    border-radius: 6px;
    position: relative;
}

.card-chip::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 12px;
    background: rgba(0,0,0,0.2);
    border-radius: 2px;
}

.card-body-modern {
    padding: 25px;
    color: white;
}

.photo-section {
    text-align: center;
    margin-bottom: 20px;
}

.photo-frame {
    width: 80px;
    height: 100px;
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: rgba(255,255,255,0.6);
}

.info-section {
    space-y: 12px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.info-value {
    font-weight: 600;
    font-size: 0.95rem;
}

.card-footer-modern {
    background: rgba(0,0,0,0.2);
    padding: 15px 25px;
    text-align: center;
    position: relative;
}

.card-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #1d4ed8, #3b82f6);
}

/* Profile Details */
.profile-details {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}

.detail-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 30px;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    border: 1px solid rgba(255,255,255,0.8);
    display: flex;
    align-items: center;
    gap: 20px;
}

.detail-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--card-shadow-hover);
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.card-content h6 {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-content p {
    color: #1e293b;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.modern-input {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: var(--transition);
    background: #f8fafc;
}

.modern-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: white;
}

/* Sidebar */
.profile-sidebar {
    position: sticky;
    top: 100px;
}

.sidebar-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 30px;
    box-shadow: var(--card-shadow);
    margin-bottom: 30px;
}

.sidebar-title {
    color: #1e293b;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e2e8f0;
}

.contact-info {
    space-y: 15px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
}

.contact-item i {
    color: #3b82f6;
    font-size: 1.2rem;
}

.contact-item span {
    color: #64748b;
    font-size: 0.95rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-name {
        font-size: 2rem;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .detail-card {
        padding: 20px;
    }
    
    .profile-details {
        padding: 40px 0;
    }
    
    .digital-card {
        width: 300px;
    }
    
    .card-header-modern, .card-body-modern {
        padding: 20px;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.detail-card {
    animation: fadeInUp 0.6s ease forwards;
}

.detail-card:nth-child(1) { animation-delay: 0.1s; }
.detail-card:nth-child(2) { animation-delay: 0.2s; }
.detail-card:nth-child(3) { animation-delay: 0.3s; }
.detail-card:nth-child(4) { animation-delay: 0.4s; }
.detail-card:nth-child(5) { animation-delay: 0.5s; }
.detail-card:nth-child(6) { animation-delay: 0.6s; }
</style>




@endsection
