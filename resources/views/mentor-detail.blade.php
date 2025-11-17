@extends('layouts.app')

@section('content')
<style>
    .mentor-detail-container {
        margin-top: 0px;
        padding-bottom: 50px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .mentor-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        margin-top: 100px;
    }

    .mentor-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .mentor-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px 40px 50px;
        position: relative;
        overflow: hidden;
    }

    .mentor-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .mentor-image-container {
        position: relative;
        max-width: 700px;
        margin: 0 auto 30px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        padding: 8px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .mentor-image-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .mentor-image {
        width: 100%;
        height: auto;
        min-height: 300px;
        border-radius: 16px;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
        display: block;
    }

    .mentor-image:hover {
        border-color: rgba(255, 255, 255, 1);
        transform: scale(1.02);
    }

    .mentor-name {
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    }

    .mentor-specialty {
        font-size: 1.5rem;
        font-weight: 1000;
        opacity: 0.95;
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-block;
        backdrop-filter: blur(10px);
        position: relative;
        z-index: 1;
    }

    .content-section {
        padding: 50px 40px;
        background: white;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    .mentor-description {
        line-height: 1.9;
        color: #4a5568;
        font-size: 1.1rem;
        margin-bottom: 25px;
        text-align: justify;
    }

    .mentor-description p {
        margin-bottom: 20px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .mentor-description p:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }

    .btn-back {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 50px;
        padding: 15px 35px;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-back::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-back:hover::before {
        left: 100%;
    }

    .btn-back:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.6);
    }

    .btn-back i {
        transition: transform 0.3s ease;
    }

    .btn-back:hover i {
        transform: translateX(-5px);
    }

    .info-badges {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .info-badge {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
        transition: all 0.3s ease;
    }

    .info-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 154, 158, 0.5);
    }

    .highlight-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .mentor-detail-container {
            margin-top: 60px;
        }
        
        .mentor-header {
            padding: 40px 20px;
        }
        
        .mentor-name {
            font-size: 2rem;
        }
        
        .mentor-specialty {
            font-size: 1.1rem;
        }
        
        .content-section {
            padding: 40px 20px;
        }
        
        .mentor-image-container {
            max-width: 350px;
            min-height: 250px;
        }
        
        .mentor-image {
            min-height: 250px;
        }
        
        .info-badges {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<div class="mentor-detail-container">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mentor-card">
                    <div class="mentor-header text-center">
                        <div class="mentor-image-container">
                            <img src="{{ isset($mentoring) && $mentoring->path_gambar ? asset('storage/' . $mentoring->path_gambar) : asset('assets/img/avatar-1.webp') }}" alt="Mentor" class="mentor-image">
                        </div>
                        <div class="mentor-name">dibuat oleh : {{ isset($mentoring) ? $mentoring->name : 'Nama Pembuat' }}</div>
                        <div class="mentor-specialty">{{ isset($mentoring) ? $mentoring->judul_mentoring : 'Judul Seminar/Webinar' }}</div>
                        
                        {{-- <div class="info-badges">
                            <span class="info-badge">📚 Seminar/Webinar</span>
                            <span class="info-badge">🎯 Pembelajaran</span>
                            <span class="info-badge">💡 Inspirasi</span>
                        </div> --}}
                    </div>

                    <div class="content-section">
                        <h5 class="section-title">
                            <span class="highlight-text">Deskripsi</span> Seminar/Webinar
                        </h5>
                        <div class="mentor-description">
                            <p>
                                {{ isset($mentoring) ? $mentoring->deskripsi : 'Ini adalah penjelasan lebih lengkap tentang mentoring yang bisa meliputi tujuan, materi yang disampaikan, jadwal, dan manfaat yang akan diperoleh oleh peserta.' }}
                            </p>

                            {{-- <p>
                                Anda juga bisa menambahkan informasi seperti <strong>tanggal pelaksanaan</strong>, <strong>platform</strong> (Zoom, Google Meet, dll.), dan <strong>kontak penyelenggara</strong> jika diperlukan.
                            </p> --}}
                        </div>

                        <div class="text-center">
                            <a href="{{ url()->previous() }}" class="btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Kembali ke daftar mentor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection