@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="hero-content">
          <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 50) }}</li>
              </ol>
            </nav>
          </div>
          <h1 class="hero-title" >{{ $berita->judul }}</h1>
          <div class="article-meta">
            <div class="meta-item">
              <i class="bi bi-calendar3"></i>
              <span>{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</span>
            </div>
            <div class="meta-item">
              <i class="bi bi-person-circle"></i>
              <span>{{ $author }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <article class="news-article">
          <!-- Featured Image -->
          <div class="featured-image-wrapper">
            @if(!empty($berita->gambar))
              <img src="{{ asset('storage/' . $berita->gambar) }}" class="featured-image" alt="Gambar Berita">
            @else
              <img src="{{ asset('assets/img/avatar-1.webp') }}" class="featured-image" alt="Gambar Berita">
            @endif
            <div class="image-overlay"></div>
          </div>

          <!-- Article Content -->
          <div class="article-content">
            <div class="content-wrapper">
              <div class="article-text">
                {!! nl2br(e($berita->ringkasan)) !!}
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="article-actions">
            <div class="action-buttons">
              <a href="{{ route('berita.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Berita</span>
              </a>
              {{-- <a href="{{ route('donasi.form') }}" target="_blank" class="btn btn-gradient">
                <i class="bi bi-heart-fill"></i>
                <span>Dukung dengan Donasi</span>
              </a> --}}
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
:root {
  --primary-color: #2563eb;
  --secondary-color: #64748b;
  --accent-color: #f59e0b;
  --text-primary: #1e293b;
  --text-secondary: #64748b;
  --bg-light: #f8fafc;
  --border-color: #e2e8f0;
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 120px 0 80px;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
  opacity: 0.5;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.2);
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
  color: white;
}

.breadcrumb-wrapper {
  margin-bottom: 2rem;
}

.breadcrumb {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 50px;
  padding: 0.75rem 1.5rem;
  margin: 0 auto;
  width: fit-content;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.breadcrumb-item + .breadcrumb-item::before {
  content: "→";
  color: rgba(255, 255, 255, 0.7);
}

.breadcrumb-item a {
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
}

.breadcrumb-item a:hover {
  color: #fbbf24;
}

.breadcrumb-item.active {
  color: rgba(255, 255, 255, 0.8);
}

.hero-title {
  font-size: 3rem;
  color: white;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 2rem;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.41)
  animation: fadeInUp 0.8s ease-out;
}

.article-meta {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin-top: 2rem;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  padding: 0.75rem 1.5rem;
  border-radius: 50px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.meta-item:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
}

.meta-item i {
  font-size: 1.1rem;
  color: #fbbf24;
}

/* Main Content */
.main-content {
  padding: 4rem 0;
  background: var(--bg-light);
}

.news-article {
  background: white;
  border-radius: 24px;
  box-shadow: var(--shadow-xl);
  overflow: hidden;
  transform: translateY(-60px);
  margin-bottom: 2rem;
}

.featured-image-wrapper {
  position: relative;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f8fafc;
  min-height: 500px;
  max-height: 80vh;
}

.featured-image {
  display: block;
  max-width: 100%;
  max-height: 900px;
  width: auto;
  height: auto;
  object-fit: contain;
  transition: transform 0.6s ease;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
}


.featured-image:hover {
  transform: scale(1.02);
}

.image-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 900px;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.3));
  pointer-events: none;
}

.article-content {
  padding: 3rem;
}

.content-wrapper {
  max-width: 800px;
  margin: 0 auto;
}

.article-text {
  font-size: 1.125rem;
  line-height: 1.8;
  color: var(--text-primary);
  text-align: justify;
}

.article-text p {
  margin-bottom: 1.5rem;
  position: relative;
}

.article-text p::first-letter {
  font-size: 3.5rem;
  font-weight: 700;
  float: left;
  line-height: 1;
  margin: 0.1rem 0.5rem 0 0;
  color: var(--primary-color);
}

/* Action Buttons */
.article-actions {
  padding: 2rem 3rem 3rem;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.action-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  border: none;
  position: relative;
  overflow: hidden;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.6s ease;
}

.btn:hover::before {
  left: 100%;
}

.btn-outline-primary {
  color: var(--primary-color);
  border: 2px solid var(--primary-color);
  background: white;
}

.btn-outline-primary:hover {
  background: var(--primary-color);
  color: white;
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}

.btn-gradient {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
  box-shadow: var(--shadow-md);
}

.btn-gradient:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
  background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
}

/* Animations */
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

.news-article {
  animation: fadeInUp 0.8s ease-out 0.2s both;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-section {
    padding: 100px 0 60px;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .article-meta {
    flex-direction: column;
    gap: 1rem;
  }
  
  .featured-image-wrapper {
    min-height: auto;
    max-height: none;
  }
  
  .featured-image {
    border-radius: 8px;
    max-height: 400px;
  }
  
  .article-content {
    padding: 2rem 1.5rem;
  }
  
  .article-text {
    font-size: 1rem;
  }
  
  .article-text p::first-letter {
    font-size: 2.5rem;
  }
  
  .article-actions {
    padding: 1.5rem;
  }
  
  .action-buttons {
    flex-direction: column;
    width: 100%;
  }
  
  .btn {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 576px) {
  .hero-title {
    font-size: 1.5rem;
  }
  
  .breadcrumb {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }
  
  .meta-item {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }
  
  .article-content {
    padding: 1.5rem 1rem;
  }
}

/* Print Styles */
@media print {
  .hero-section,
  .article-actions {
    display: none;
  }
  
  .news-article {
    box-shadow: none;
    transform: none;
    margin: 0;
  }
  
  .featured-image-wrapper {
    height: auto;
    max-height: 400px;
  }
}
</style>
@endpush