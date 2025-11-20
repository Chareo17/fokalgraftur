@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    /* Hero Section */
    .hero-section {
        background: var(--primary-gradient);
        padding: 60px 0;
        margin-top: 80px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        animation: slideInDown 1s ease-out;
        color: white !important;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        animation: slideInUp 1s ease-out 0.3s both;
    }

    @keyframes slideInDown {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Search Section */
    .search-section {
        padding: 40px 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 0 0 30px 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: -30px;
        position: relative;
        z-index: 3;
    }

    .search-container {
        max-width: 600px;
        margin: 0 auto;
        position: relative;
    }

    .search-mentors {
        border: none;
        border-radius: 50px;
        padding: 18px 60px 18px 25px;
        font-size: 1.1rem;
        box-shadow: var(--card-shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }

    .search-mentors:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2), var(--hover-shadow);
        transform: translateY(-2px);
    }

    .search-btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary-gradient);
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .search-btn:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }

    /* Action Bar */
    .action-bar {
        padding: 30px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .stats-info {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .stat-item {
        text-align: center;
        padding: 15px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #667eea;
        display: block;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #666;
        margin-top: 5px;
    }

    .btn-add-mentoring {
        background: var(--success-gradient);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn-add-mentoring::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }

    .btn-add-mentoring:hover::before {
        left: 100%;
    }

    .btn-add-mentoring:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(79, 172, 254, 0.6);
    }

    /* Mentor Cards */
    .mentoring-grid {
        padding: 20px 0 60px;
    }

    .mentor-card {
        background: white;
        border-radius: 25px;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .mentor-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .mentor-card:hover::before {
        transform: scaleX(1);
    }

    .mentor-card:hover {
        transform: translateY(-15px) rotate(1deg);
        box-shadow: var(--hover-shadow);
    }

    .mentor-img-container {
        height: 220px;
        overflow: hidden;
        position: relative;
        border-radius: 25px 25px 0 0;
        flex-shrink: 0;
    }

    .mentor-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mentor-card:hover .mentor-img {
        transform: scale(1.1);
    }

    .mentor-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .mentor-card:hover .mentor-overlay {
        opacity: 1;
    }

    .mentor-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .mentor-name {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 10px;
        line-height: 1.4;
        min-height: 2.8rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .mentor-specialty {
        color: #667eea;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: 1.5rem;
    }

    .mentor-specialty::before {
        content: '👨‍💻';
        font-size: 1.2rem;
    }

    .mentor-bio {
        color: #7f8c8d;
        font-size: 0.95rem;
        margin-bottom: 25px;
        line-height: 1.6;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .mentor-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-top: auto;
    }

    .btn-book {
        background: var(--primary-gradient);
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-book::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-book:hover::before {
        width: 200px;
        height: 200px;
    }

    .btn-book:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        text-decoration: none;
    }

    .mentoring-type {
        display: inline-block;
        padding: 6px 14px;
        background: var(--secondary-gradient);
        color: white;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 15px;
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    /* Modal Enhancements */
    .modal-content {
        border: none;
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .modal-header {
        background: var(--primary-gradient);
        border-radius: 25px 25px 0 0;
        padding: 25px 30px;
    }

    .modal-body {
        padding: 30px;
    }

    .form-control {
        border-radius: 15px;
        border: 2px solid #e8ecf4;
        padding: 12px 20px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-label {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            margin: 0 !important;
            padding-top: 120px !important;
            padding-bottom: 30px !important;
        }

        .hero-title {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-section {
            margin-top: 0;
            border-radius: 0;
        }

        .search-container {
            padding: 0 15px;
            max-width: 100%;
        }

        .search-mentors {
            padding: 15px 50px 15px 20px;
            font-size: 1rem;
        }

        .search-btn {
            width: 40px;
            height: 40px;
        }

        .action-bar {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .stats-info {
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .stat-item {
            padding: 12px 15px;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .btn-add-mentoring {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .mentor-card {
            margin-bottom: 20px;
        }

        .mentor-img-container {
            height: 180px;
        }

        .mentor-content {
            padding: 20px;
        }

        .mentor-name {
            font-size: 1.2rem;
            min-height: auto;
        }

        .mentor-specialty {
            font-size: 0.9rem;
        }

        .mentor-bio {
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .mentor-actions {
            flex-direction: column;
            gap: 10px;
            align-items: stretch;
        }

        .btn-book {
            width: 100%;
            text-align: center;
            padding: 10px 20px;
        }

        .mentoring-type {
            font-size: 0.7rem;
            padding: 4px 10px;
            top: 10px;
            left: 10px;
        }

        .modal-dialog {
            margin: 10px;
            max-width: calc(100% - 20px);
        }

        .modal-header {
            padding: 20px;
        }

        .modal-body {
            padding: 20px;
        }

        .form-control {
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .col-lg-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .hero-subtitle {
            font-size: 0.95rem;
        }

        .search-mentors {
            padding: 12px 45px 12px 15px;
            font-size: 0.95rem;
        }

        .stat-item {
            padding: 10px 12px;
        }

        .stat-number {
            font-size: 1.3rem;
        }

        .mentor-img-container {
            height: 150px;
        }

        .mentor-content {
            padding: 15px;
        }

        .mentor-name {
            font-size: 1.1rem;
        }

        .btn-book {
            padding: 8px 15px;
            font-size: 0.95rem;
        }
    }

    /* Loading Animation */
    .loading-card {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        height: 300px;
        border-radius: 25px;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }


    /* ========== PAGINATION STYLING - CLEAN & MODERN ========== */

    /* Container Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        margin: 40px 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    /* Reset default list style */
    .pagination {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        padding: 0;
        list-style: none;
        background: transparent;
        border-radius: 0;
        box-shadow: none;
    }

    .pagination .page-item {
        list-style: none;
        margin: 0;
    }

    /* Style untuk semua link pagination */
    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 45px;
        height: 45px;
        padding: 10px 15px;
        border: 2px solid transparent;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
    }

    /* Hover effect */
    .pagination .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Active page */
    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        transform: scale(1.05);
    }

    /* Disabled state */
    .pagination .page-item.disabled .page-link {
        background-color: rgba(255, 255, 255, 0.5);
        color: #adb5bd;
        cursor: not-allowed;
        opacity: 0.6;
        box-shadow: none;
    }

    .pagination .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
        background-color: rgba(255, 255, 255, 0.5);
        color: #adb5bd;
    }

    /* Style khusus untuk Previous dan Next */
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        min-width: 100px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        background: var(--secondary-gradient);
        color: white;
    }

    .pagination .page-item:first-child .page-link:hover,
    .pagination .page-item:last-child .page-link:hover {
        background: var(--secondary-gradient);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 20px rgba(240, 147, 251, 0.4);
    }

    /* Dots (...) styling */
    .pagination .page-item .page-link[aria-label="..."] {
        pointer-events: none;
        background-color: transparent;
        color: #6c757d;
        font-weight: 700;
        box-shadow: none;
        border: none;
    }

    /* Responsive pagination */
    @media (max-width: 768px) {
        .pagination-container {
            padding: 30px 15px;
            margin: 30px 0;
        }

        .pagination {
            gap: 4px;
        }

        .pagination .page-link {
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            min-width: 80px;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section" style="margin:-40px; padding-top:150px; padding-bottom:40px;">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">🚀 Platform Mentoring & Pelatihan</h1>
            <p class="hero-subtitle">Tingkatkan skill Anda dengan seminar, webinar, dan pelatihan dari admin, alumni, dan siswa</p>
        </div>
    </div>
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="container">
        <div class="search-container">
            <div class="position-relative">
                <input type="text" 
                       class="form-control search-mentors" 
                       id="searchInput"
                       placeholder="🔍 Cari mentoring, webinar, atau pelatihan...">
                <button class="search-btn" type="button" onclick="searchMentoring()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        
        <button class="btn btn-add-mentoring" data-bs-toggle="modal" data-bs-target="#tambahMentoringModal">
            <i class="fas fa-plus me-2"></i>Tambah Mentoring Baru
        </button>
    </div>

    <!-- Modal Tambah Mentoring -->
    <div class="modal fade" id="tambahMentoringModal" tabindex="-1" aria-labelledby="tambahMentoringModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header text-white">
                    <h5 class="modal-title fw-semibold text-white" id="tambahMentoringModalLabel">
                        <i class="bi bi-journal-plus me-2"></i>Buat Mentoring Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('mentoring.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="judul_mentoring" class="form-label">
                                <i class="fas fa-graduation-cap me-2 text-primary"></i>Judul Mentoring
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="judul_mentoring" 
                                   name="judul_mentoring" 
                                   placeholder="Contoh: Workshop UI/UX Design untuk Pemula" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-align-left me-2 text-primary"></i>Deskripsi
                            </label>
                            <textarea class="form-control" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Jelaskan tentang mentoring ini, apa yang akan dipelajari, dan siapa target pesertanya..." 
                                      required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="path_gambar" class="form-label">
                                <i class="fas fa-image me-2 text-primary"></i>Upload Gambar
                            </label>
                            <input class="form-control" 
                                   type="file" 
                                   id="path_gambar" 
                                   name="path_gambar" 
                                   accept="image/*">
                            <div class="form-text ms-1">
                                <i class="fas fa-info-circle me-1"></i>Format: JPG, PNG. Maksimal: 5MB
                            </div>
                        </div>

                        <div class="d-flex gap-3 justify-content-end">
                            <button type="button" 
                                    class="btn btn-outline-secondary rounded-pill px-4" 
                                    data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-save me-1"></i> Simpan Mentoring
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mentoring Grid -->
    <div class="mentoring-grid">
        <div class="row g-4" id="mentoringGrid">
            @forelse($mentorings as $mentoring)
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch mentoring-item"
                 data-title="{{ strtolower($mentoring->judul_mentoring) }}"
                 data-description="{{ strtolower($mentoring->deskripsi) }}">
                <div class="mentor-card">
                    <div class="mentor-img-container">
<div class="mentoring-type">
    @if(strpos(strtolower($mentoring->judul_mentoring), 'webinar') !== false)
        📹 Webinar
    @elseif(strpos(strtolower($mentoring->judul_mentoring), 'workshop') !== false)
        🛠️ Workshop
    @elseif(strpos(strtolower($mentoring->judul_mentoring), 'seminar') !== false)
        🎓 Seminar
    @endif
</div>
                        @if($mentoring->path_gambar)
                            <img src="{{ asset('storage/' . $mentoring->path_gambar) }}" 
                                 class="mentor-img" 
                                 alt="{{ $mentoring->judul_mentoring }}">
                        @else
                            <img src="{{ asset('assets/img/avatar-1.webp') }}" 
                                 class="mentor-img" 
                                 alt="{{ $mentoring->judul_mentoring }}">
                        @endif
                        <div class="mentor-overlay">
                            <div class="text-center">
                                <i class="fas fa-eye fa-2x mb-2"></i>
                                <div>Lihat Detail</div>
                            </div>
                        </div>
                    </div>
                    <div class="mentor-content">
                        <h4 class="mentor-name">{{ $mentoring->judul_mentoring }}</h4>
                        <div class="mentor-specialty">
                            Dibuat oleh: {{ $mentoring->name ?? 'Admin' }}
                        </div>
                        <p class="mentor-bio">
                            {{ $mentoring->deskripsi }}
                        </p>
                        <div class="mentor-actions">
                            <a href="{{ route('mentor.detail', ['id' => $mentoring->id ?? 1]) }}" 
                               class="btn-book">
                                <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                            </a>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $mentoring->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-graduation-cap fa-5x text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">Belum Ada Mentoring</h3>
                    <p class="text-muted mb-4">Mulai berbagi pengetahuan dengan membuat mentoring pertama Anda!</p>
                    <button class="btn btn-primary rounded-pill px-4 py-2" 
                            data-bs-toggle="modal" 
                            data-bs-target="#tambahMentoringModal">
                        <i class="fas fa-plus me-2"></i>Buat Mentoring Pertama
                    </button>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($mentorings->hasPages())
    <div class="pagination-container">
        {{ $mentorings->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
    @endif
</div>

<script>
    // [update] Robust search: make global, keep layout with d-none, accurate visible count
    window.searchMentoring = function() {
        const inputEl = document.getElementById('searchInput');
        if (!inputEl) return; // [update] guard when element missing
        const searchTerm = (inputEl.value || '').toLowerCase().trim();
        const items = document.querySelectorAll('.mentoring-item');

        let visibleCount = 0;
        items.forEach(item => {
            const title = (item.getAttribute('data-title') || '').toLowerCase();
            const description = (item.getAttribute('data-description') || '').toLowerCase();
            const match = !searchTerm || title.includes(searchTerm) || description.includes(searchTerm);

            // [update] use Bootstrap d-none to hide, avoid overriding d-flex layout
            item.classList.toggle('d-none', !match);
            if (match) {
                visibleCount++;
                item.style.animation = 'fadeInUp 0.5s ease';
            }
        });

        // [update] show/hide "no results" message
        let noResultsMsg = document.getElementById('noResultsMessage');
        if (visibleCount === 0 && searchTerm !== '') {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.id = 'noResultsMessage';
                noResultsMsg.className = 'col-12 text-center py-5';
                noResultsMsg.innerHTML = `
                    <div class="mb-4">
                        <i class="fas fa-search fa-3x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Tidak ditemukan hasil untuk "${searchTerm}"</h4>
                    <p class="text-muted">Coba gunakan kata kunci yang berbeda</p>
                `;
                const grid = document.getElementById('mentoringGrid');
                if (grid) grid.appendChild(noResultsMsg);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }
    };

    // [update] Real-time search with debounce and guards
    (function() {
        const input = document.getElementById('searchInput');
        if (!input) return;
        input.addEventListener('input', function() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                window.searchMentoring();
            }, 300);
        });

        // Enter key search
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                window.searchMentoring();
            }
        });
    })();

    // Animation on load (unchanged)
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.mentor-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Form validation and enhancement (unchanged)
    document.getElementById('tambahMentoringModal')?.addEventListener('shown.bs.modal', function() {
        document.getElementById('judul_mentoring')?.focus();
    });

    // File upload preview (unchanged; fix size calc)
    document.getElementById('path_gambar')?.addEventListener('change', function(e) {
        const file = e.target.files?.[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) { // [update] 5MB correct bytes
                alert('Ukuran file terlalu besar! Maksimal 5MB.');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                console.log('File loaded successfully');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<!-- Add fadeInUp animation -->
<style>
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
</style>
@endsection

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: "🎉 Mentoring Berhasil Dibuat!",
      icon: "success",
      html: "Mentoring Anda telah berhasil ditambahkan ke platform",
      showConfirmButton: true,
      confirmButtonText: 'Oke, Mantap!',
      confirmButtonColor: '#667eea',
      background: '#f8f9ff',
      customClass: {
        popup: 'rounded-4',
        confirmButton: 'rounded-pill px-4'
      }
    });
  });
</script>
@endif

@if(session('error') || $errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: "error",
      title: "Oops! Ada Kesalahan",
      html: "Sepertinya ada masalah saat mengunggah mentoring. Silakan coba lagi.",
      showConfirmButton: true,
      confirmButtonText: 'Coba Lagi',
      confirmButtonColor: '#f5576c',
      background: '#fff5f5',
      customClass: {
        popup: 'rounded-4',
        confirmButton: 'rounded-pill px-4'
      }
    });
  });
</script>
@endif