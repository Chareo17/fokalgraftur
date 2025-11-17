@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Hero Section with Parallax Effect -->
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-icon" style="margin-top: 160px;">
                <i class="fas fa-eye"></i>
            </div>
            <h1 class="hero-title">Detail Konten</h1>
            <div class="hero-divider"></div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="navigation-bar">
        <div class="container">
            <a href="{{ route('admin.pintar.index') }}" class="nav-back-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="content-card">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="header-info">
                        <div class="content-badge">
                            <i class="fas fa-file-alt"></i>
                            <span>Info Perkembangan Sekolah</span>
                        </div>
                        <h1 class="content-title">{{ $perkembangan->title }}</h1>
                        <div class="content-meta">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($perkembangan->tanggal_publikasi)->format('d M Y H:i') }}</span>
                            </div>
                            <div class="status-indicator">
                                <span class="status-dot"></span>
                                <span>Published</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Slider -->
                @if($perkembangan->images && json_decode($perkembangan->images, true) && count(json_decode($perkembangan->images, true)) > 0)
                <div class="slider-container">
                    @php $images = json_decode($perkembangan->images, true); @endphp
                    
                    <div class="slider-wrapper">
                        <div class="slider-track" id="sliderTrack">
                            @foreach($images as $index => $image)
                                <div class="slider-item">
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="{{ $perkembangan->title }} - Image {{ $index + 1 }}"
                                         class="slider-image">
                                    <div class="image-overlay"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if(count($images) > 1)
                        <!-- Navigation Arrows -->
                        <button class="slider-nav prev" id="prevBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slider-nav next" id="nextBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="slider-dots" id="sliderDots">
                            @foreach($images as $index => $image)
                                <span class="dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                            @endforeach
                        </div>

                        <!-- Counter -->
                        <div class="slider-counter">
                            <span id="currentSlide">1</span> / <span id="totalSlides">{{ count($images) }}</span>
                        </div>
                    @endif
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const track = document.getElementById('sliderTrack');
                        const prevBtn = document.getElementById('prevBtn');
                        const nextBtn = document.getElementById('nextBtn');
                        const dots = document.querySelectorAll('.dot');
                        const currentSlideEl = document.getElementById('currentSlide');
                        const totalSlides = {{ count($images) }};
                        let currentIndex = 0;

                        function updateSlider() {
                            track.style.transform = `translateX(-${currentIndex * 100}%)`;
                            
                            // Update dots
                            dots.forEach((dot, index) => {
                                dot.classList.toggle('active', index === currentIndex);
                            });

                            // Update counter
                            if (currentSlideEl) {
                                currentSlideEl.textContent = currentIndex + 1;
                            }
                        }

                        if (prevBtn) {
                            prevBtn.addEventListener('click', () => {
                                currentIndex = currentIndex > 0 ? currentIndex - 1 : totalSlides - 1;
                                updateSlider();
                            });
                        }

                        if (nextBtn) {
                            nextBtn.addEventListener('click', () => {
                                currentIndex = currentIndex < totalSlides - 1 ? currentIndex + 1 : 0;
                                updateSlider();
                            });
                        }

                        dots.forEach(dot => {
                            dot.addEventListener('click', () => {
                                currentIndex = parseInt(dot.dataset.index);
                                updateSlider();
                            });
                        });

                        // Keyboard navigation
                        document.addEventListener('keydown', (e) => {
                            if (e.key === 'ArrowLeft') {
                                currentIndex = currentIndex > 0 ? currentIndex - 1 : totalSlides - 1;
                                updateSlider();
                            } else if (e.key === 'ArrowRight') {
                                currentIndex = currentIndex < totalSlides - 1 ? currentIndex + 1 : 0;
                                updateSlider();
                            }
                        });

                        // Optional: Auto slide every 5 seconds
                        // Uncomment the lines below to enable auto-slide
                        // setInterval(() => {
                        //     currentIndex = currentIndex < totalSlides - 1 ? currentIndex + 1 : 0;
                        //     updateSlider();
                        // }, 5000);
                    });
                </script>
                @endif

                <!-- Content Body -->
                <div class="content-body">
                    <div class="description-section">
                        <div class="section-header">
                            <h3>Deskripsi Lengkap</h3>
                            <div class="section-divider"></div>
                        </div>
                        <div class="description-content">
                            <p>{{ $perkembangan->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @auth('admin')
                <div class="action-section">
                    <div class="action-container">
                        <a href="{{ route('admin.pintar.index', ['edit' => $perkembangan->id]) }}" 
                           class="action-btn primary-btn">
                            <i class="fas fa-edit"></i>
                            <span>Edit Konten</span>
                        </a>
                        <form action="{{ route('admin.pintar.destroy', $perkembangan->id) }}" 
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="action-btn danger-btn" 
                                    onclick="return confirm('Yakin ingin menghapus konten ini?')">
                                <i class="fas fa-trash"></i>
                                <span>Hapus Konten</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
/* Reset and Base Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.content-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    position: relative;
}

/* Hero Section */
.hero-section {
    height: 350px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
    backdrop-filter: blur(1px);
}

.hero-content {
    text-align: center;
    z-index: 2;
    position: relative;
}

.hero-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 30px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: heroIconPulse 3s ease-in-out infinite;
    box-shadow: 0 8px 32px rgba(255, 255, 255, 0.1);
}

.hero-icon i {
    font-size: 3rem;
    color: #fff;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 15px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 30px;
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hero-divider {
    width: 120px;
    height: 4px;
    background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1);
    margin: 0 auto;
    border-radius: 2px;
    animation: expandWidth 1.5s ease-out 0.5s both;
}

/* Navigation Bar */
.navigation-bar {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 100;
}

.nav-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-back-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    color: #fff;
}

/* Main Content */
.main-content {
    padding: 60px 0 100px;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

.content-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 30px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(255, 255, 255, 0.2);
    overflow: hidden;
    animation: slideUpFade 1s ease-out;
}

/* Content Header */
.content-header {
    padding: 50px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
}

.content-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.content-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2d3748;
    line-height: 1.2;
    margin-bottom: 25px;
}

.content-meta {
    display: flex;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #718096;
    font-size: 1rem;
}

.meta-item i {
    color: #667eea;
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(72, 187, 120, 0.1);
    color: #48bb78;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
}

.status-dot {
    width: 8px;
    height: 8px;
    background: #48bb78;
    border-radius: 50%;
    animation: statusPulse 2s infinite;
}

/* Image Slider Styles */
.slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #000;
}

.slider-wrapper {
    width: 100%;
    overflow: hidden;
}

.slider-track {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slider-item {
    min-width: 100%;
    position: relative;
    height: 500px;
}

.slider-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        to bottom,
        transparent 0%,
        transparent 70%,
        rgba(0, 0, 0, 0.3) 100%
    );
}

/* Navigation Arrows */
.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.slider-nav:hover {
    background: #fff;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.slider-nav.prev {
    left: 20px;
}

.slider-nav.next {
    right: 20px;
}

.slider-nav i {
    font-size: 1.2rem;
    color: #667eea;
}

/* Dots Indicator */
.slider-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.dot:hover {
    background: rgba(255, 255, 255, 0.8);
    transform: scale(1.2);
}

.dot.active {
    background: #fff;
    border-color: #667eea;
    transform: scale(1.3);
}

/* Slider Counter */
.slider-counter {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
    color: #fff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    z-index: 10;
}

/* Content Body */
.content-body {
    padding: 50px;
}

.section-header {
    margin-bottom: 30px;
}

.section-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
}

.section-divider {
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
}

.description-content {
    background: rgba(102, 126, 234, 0.03);
    border: 1px solid rgba(102, 126, 234, 0.1);
    border-radius: 20px;
    padding: 40px;
    position: relative;
}

.description-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
    border-radius: 20px 20px 0 0;
}

.description-content p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #4a5568;
    margin: 0;
}

/* Action Section */
.action-section {
    padding: 40px 50px 50px;
    background: rgba(102, 126, 234, 0.02);
    border-top: 1px solid rgba(102, 126, 234, 0.1);
}

.action-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.action-btn {
    padding: 15px 30px;
    border: none;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.primary-btn {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    color: white;
    box-shadow: 0 8px 25px rgba(76, 205, 196, 0.3);
}

.danger-btn {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.action-btn:hover::before {
    left: 100%;
}

/* Animations */
@keyframes heroIconPulse {
    0%, 100% { transform: scale(1); box-shadow: 0 8px 32px rgba(255, 255, 255, 0.1); }
    50% { transform: scale(1.1); box-shadow: 0 12px 40px rgba(255, 255, 255, 0.2); }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes expandWidth {
    from { width: 0; }
    to { width: 120px; }
}

@keyframes slideUpFade {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes statusPulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title { font-size: 2.5rem; }
    .hero-subtitle { font-size: 1.1rem; }
    .hero-icon { width: 70px; height: 70px; }
    .hero-icon i { font-size: 2.5rem; }
    .content-header { padding: 30px 25px; }
    .content-body { padding: 30px 25px; }
    .action-section { padding: 30px 25px 40px; }
    .content-title { font-size: 2rem; }
    .content-meta { flex-direction: column; align-items: flex-start; gap: 15px; }
    .action-container { flex-direction: column; align-items: center; }
    .container { padding: 0 15px; }
    .hero-section { height: 280px; }
    
    .slider-item { height: 350px; }
    .slider-nav { width: 40px; height: 40px; }
    .slider-nav.prev { left: 10px; }
    .slider-nav.next { right: 10px; }
    .slider-nav i { font-size: 1rem; }
}

@media (max-width: 480px) {
    .hero-title { font-size: 2rem; }
    .content-title { font-size: 1.5rem; }
    .action-btn { padding: 12px 24px; font-size: 0.9rem; }
    .slider-item { height: 250px; }
}
</style>
@endsection