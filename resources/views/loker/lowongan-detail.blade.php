@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero-section text-white text-center py-5 position-relative overflow-hidden">
    <div class="hero-bg position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);"></div>
    <div class="container position-relative z-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in">
                    <h1 class="display-4 fw-bold mb-3 text-white">Detail Lowongan Kerja</h1>
                    <p class="lead mb-0 opacity-90">Informasi lengkap mengenai posisi yang tersedia di perusahaan kami</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lowongan Detail Section -->
<section id="job-detail" class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%); margin-top: -50px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate-slide-up">
                    <!-- Header Card -->
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            {{-- <span class="badge bg-primary bg-gradient px-3 py-2 rounded-pill">
                                <i class="bi bi-briefcase me-1"></i> Lowongan Aktif
                            </span> --}}
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i> {{ $lowongan->created_at ? $lowongan->created_at->diffForHumans() : 'Baru saja' }}
                            </small>
                        </div>
                        
                        <!-- Job Title -->
                        <h1 class="display-6 fw-bold text-dark mb-4 text-center">{{ $lowongan->judul }}</h1>
                    </div>

                    <div class="card-body p-4 pt-0">
                        <!-- Uploader Info -->
                        <div class="uploader-info bg-light bg-gradient rounded-3 p-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-container me-3">
                                    <div class="avatar bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-person-fill text-white fs-5"></i>
                                    </div>
                                </div>
                                <div class="uploader-details">
                                    <h6 class="fw-semibold text-dark mb-1">Diunggah oleh</h6>
                                    <p class="text-secondary mb-0 fw-medium">{{ $lowongan->name ?? 'Admin' }}</p>
                                </div>
                               
                            </div>
                            <div class="batas-pengumpulan mt-3">
                                <h6 class="fw-semibold text-dark mb-1">Batas Pengumpulan Persyaratan</h6>
                                    <p class="text-secondary mb-0 fw-medium">{{ $lowongan->batas_pengumpulan ? \Carbon\Carbon::parse($lowongan->batas_pengumpulan)->format('d M Y') : '-' }}</p>
                            </div>
                        </div>

                        <!-- Job Image -->
                        <div class="job-image-container text-center mb-4">
                            <div class="image-wrapper d-inline-block position-relative">
                                <img src="{{ $lowongan->gambar ? asset('storage/' . $lowongan->gambar) : asset('assets/img/avatar-1.webp') }}" 
                                     class="img-fluid rounded-4 shadow-sm job-image" 
                                     alt="Ilustrasi Lowongan" 
                                     style="max-width: 100%; max-height: 400px; object-fit: cover;">
                                <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 rounded-4 d-flex align-items-center justify-content-center transition-all">
                                    <i class="bi bi-zoom-in text-white fs-3"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Job Description -->
                        <div class="job-description">
                            <div class="section-header d-flex align-items-center mb-3">
                                <div class="icon-container bg-info bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="bi bi-info-circle-fill text-white"></i>
                                </div>
                                <h4 class="fw-semibold text-dark mb-0">Deskripsi Pekerjaan</h4>
                            </div>
                            <div class="description-content bg-white rounded-3 p-4 border-start border-primary border-4">
                                <p class="text-dark lh-lg mb-0" style="text-align: justify;">{{ $lowongan->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        {{-- <div class="action-buttons mt-4 text-center">
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <button class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
                                    <i class="bi bi-send me-2"></i> Lamar Sekarang
                                </button>
                                <button class="btn btn-outline-secondary btn-lg px-4 py-2 rounded-pill">
                                    <i class="bi bi-bookmark me-2"></i> Simpan
                                </button>
                                <button class="btn btn-outline-info btn-lg px-4 py-2 rounded-pill">
                                    <i class="bi bi-share me-2"></i> Bagikan
                                </button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
    .hero-section {
        min-height: 300px;
        display: flex;
        align-items: center;
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }

    .animate-slide-up {
        animation: slideUp 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .job-image-container:hover .image-overlay {
        opacity: 0.1 !important;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .card {
        backdrop-filter: blur(10px);
    }

    .uploader-info {
        border-left: 4px solid #0d6efd;
    }

    .section-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 10px;
    }

    .description-content {
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .avatar:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    @media (max-width: 768px) {
        .hero-section {
            min-height: 250px;
            padding-top: 120px !important;
        }

        .hero-bg {
            padding-top: 120px !important;
        }

        .display-6 {
            font-size: 1.5rem;
        }

        .action-buttons .btn {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
    }
</style>
@endsection