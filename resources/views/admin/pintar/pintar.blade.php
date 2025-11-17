@extends('layouts.app')

@section('content')
<div class="main-container">
    <!-- Dynamic Background -->
    <div class="background-wrapper">
        <div class="animated-bg"></div>
        <div class="floating-particles"></div>
        <div class="gradient-overlay"></div>
    </div>

    <!-- Enhanced Header with Full Width -->
    <div class="hero-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <div class="animated-logo">
                        <div class="logo-ring"></div>
                        <div class="logo-core">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="logo-pulse"></div>
                    </div>
                </div>
                <div class="title-section">
                    <h1 class="main-title">
                        <span class="title-char" style="--delay: 0.1s">P</span>
                        <span class="title-char" style="--delay: 0.2s">I</span>
                        <span class="title-char" style="--delay: 0.3s">N</span>
                        <span class="title-char" style="--delay: 0.4s">T</span>
                        <span class="title-char" style="--delay: 0.5s">A</span>
                        <span class="title-char" style="--delay: 0.6s">R</span>
                    </h1>
                    <div class="subtitle-container">
                        <p class="main-subtitle">Perkembangan Informasi Terkini Aktual dan Realtime</p>
                        <div class="subtitle-decoration"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section - Top -->
    @auth('admin')
    <div class="form-section">
        <div class="container">
            <div class="form-wrapper">
                <div class="form-container {{ $editing ? 'edit-mode' : 'create-mode' }}">
                    <div class="form-header">
                        <div class="mode-indicator {{ $editing ? 'edit-indicator' : 'create-indicator' }}">
                            <div class="indicator-icon">
                                <i class="fas fa-{{ $editing ? 'edit' : 'plus-circle' }}"></i>
                            </div>
                            <div class="indicator-text">
                                <h3>{{ $editing ? 'Mode Edit Konten' : 'Buat Konten Baru' }}</h3>
                                <p>{{ $editing ? 'Perbarui informasi yang sudah ada' : 'Tambahkan informasi terbaru' }}</p>
                            </div>
                        </div>
                        @if($editing)
                            <div class="edit-badge">
                                <i class="fas fa-pencil-alt"></i>
                                <span>Editing</span>
                            </div>
                        @endif
                    </div>

                    <form action="{{ $editing ? route('admin.pintar.update', $editing->id) : route('admin.pintar.store') }}" method="POST" enctype="multipart/form-data" class="enhanced-form">
                        @csrf
                        @if($editing) @method('PUT') @endif
                        
                        <div class="form-grid">
                            <div class="form-row full-width">
                                <div class="floating-input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-heading"></i>
                                    </div>
                                    <input type="text" name="title" value="{{ old('title', $editing->title ?? '') }}" placeholder=" " required class="enhanced-input">
                                    <label class="enhanced-label">Judul Konten</label>
                                    <div class="input-underline"></div>
                                </div>
                            </div>

                            <div class="form-row full-width">
                                <div class="floating-textarea-group">
                                    <div class="textarea-icon">
                                        <i class="fas fa-align-left"></i>
                                    </div>
                                    <textarea name="description" rows="4" placeholder=" " required class="enhanced-textarea">{{ old('description', $editing->description ?? '') }}</textarea>
                                    <label class="enhanced-label">Deskripsi Lengkap</label>
                                    <div class="input-underline"></div>
                                </div>
                            </div>

                            <div class="form-row half-width">
                                <div class="floating-input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', $editing->tanggal_publikasi ?? '') }}" required class="enhanced-input date-input">
                                    <label class="enhanced-label">Tanggal Publikasi</label>
                                    <div class="input-underline"></div>
                                </div>
                            </div>

                            <div class="form-row full-width">
                                <div class="multiple-upload-zone">
                                    <div class="upload-header">
                                        <h4>Upload Gambar (Maksimal 3)</h4>
                                        <span class="upload-info">PNG, JPG hingga 2MB per gambar</span>
                                    </div>
                                    <div class="upload-grid">
                                        @for($i = 0; $i < 3; $i++)
                                            <div class="upload-slot {{ $editing && $editing->images && json_decode($editing->images, true) && isset(json_decode($editing->images, true)[$i]) ? 'has-image' : '' }}">
                                                <input type="file" name="images[]" accept="image/*" id="imageInput{{ $i }}" class="file-input">
                                                <label for="imageInput{{ $i }}" class="upload-label">
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="upload-title">Upload Gambar {{ $i + 1 }}</span>
                                                            <span class="upload-subtitle">PNG, JPG hingga 2MB</span>
                                                        </div>
                                                    </div>
                                                </label>
                                                @if($editing && $editing->images && json_decode($editing->images, true) && isset(json_decode($editing->images, true)[$i]))
                                                    <div class="current-image-preview">
                                                        <img src="{{ asset('storage/' . json_decode($editing->images, true)[$i]) }}" alt="Current Image {{ $i + 1 }}">
                                                        <div class="image-overlay-edit">
                                                            <i class="fas fa-exchange-alt"></i>
                                                            <span>Ganti Gambar</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions-enhanced">
                            <button type="submit" class="btn-submit {{ $editing ? 'btn-update' : 'btn-create' }}">
                                <div class="btn-content">
                                    <i class="fas fa-{{ $editing ? 'sync-alt' : 'rocket' }}"></i>
                                    <span>{{ $editing ? 'Perbarui Konten' : 'Publikasikan' }}</span>
                                </div>
                                <div class="btn-ripple"></div>
                            </button>
                            @if($editing)
                                <a href="{{ route('admin.pintar.index') }}" class="btn-cancel">
                                    <div class="btn-content">
                                        <i class="fas fa-arrow-left"></i>
                                        <span>Kembali</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <!-- Results Section - Bottom -->
    <div class="results-section">
        <div class="container">
            <div class="results-header">
                <div class="section-title">
                    <div class="title-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="title-content">
                        <h2>Koleksi Konten PINTAR</h2>
                        <p>Informasi terkini yang telah dipublikasikan</p>
                    </div>
                </div>
                <div class="stats-badge">
                    <div class="stat-item">
                        <span class="stat-number">{{ count($perkembangan) }}</span>
                        <span class="stat-label">Total Konten</span>
                    </div>
                </div>
            </div>

            <div class="content-showcase">
                @if(count($perkembangan) > 0)
                    <div class="content-masonry">
                        @foreach($perkembangan as $index => $item)
                            <div class="content-item" style="animation-delay: {{ $index * 0.15 }}s;">
                                <div class="item-header">
                                    <div class="item-image">
                                        @if($item->images && json_decode($item->images, true) && count(json_decode($item->images, true)) > 0)
                                            <img src="{{ asset('storage/' . json_decode($item->images, true)[0]) }}" alt="{{ $item->title }}">
                                        @else
                                            <div class="placeholder-img">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <div class="item-overlay">
                                            @auth('admin')
                                            <div class="overlay-actions">
                                                <a href="{{ route('admin.pintar.index', ['edit' => $item->id]) }}" class="action-button edit-action" title="Edit Konten">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.pintar.destroy', $item->id) }}" method="POST" class="delete-form">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="action-button delete-action" title="Hapus Konten">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h4 class="item-title">{{ $item->title }}</h4>
                                    <div class="item-description" data-full="{{ $item->description }}">
                                        <p class="description-text">{{ Str::limit($item->description, 100) }}</p>
                                        @if(strlen($item->description) > 100)
                                            <button class="expand-btn" onclick="toggleContent(this)">
                                                <span class="btn-text">Baca Selengkapnya</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <div class="item-actions">
                                        <a href="{{ route('admin.pintar.show', $item->id) }}" class="view-details-btn">
                                            <div class="btn-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <span>Lihat Selengkapnya</span>
                                            <div class="btn-arrow">
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="item-footer">
                                        <div class="publish-date">
                                            <i class="fas fa-calendar-check"></i>
                                            <span>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('d M Y') }}</span>
                                        </div>
                                        <div class="item-status">
                                            <span class="status-badge active">
                                                <i class="fas fa-check-circle"></i>
                                                Published
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
    </div>

    <!-- Detail Modal -->
    <div class="detail-modal" id="detailModal">
        <div class="modal-overlay" onclick="closeDetailModal()"></div>
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-title-section">
                    <h3 id="modalTitle"></h3>
                    <div class="modal-date">
                        <i class="fas fa-calendar-alt"></i>
                        <span id="modalDate"></span>
                    </div>
                </div>
                <button class="modal-close-btn" onclick="closeDetailModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-content">
                <div class="modal-image-container" id="modalImageContainer">
                    <img id="modalImage" src="" alt="">
                </div>
                <div class="modal-description">
                    <p id="modalDescription"></p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-actions">
                    <a href="#" class="modal-edit-btn" id="modalEditBtn">
                        <i class="fas fa-edit"></i>
                        <span>Edit Konten</span>
                    </a>
                    <button class="modal-close-action" onclick="closeDetailModal()">
                        <i class="fas fa-check"></i>
                        <span>Selesai</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h3>Belum Ada Konten</h3>
                        <p>Mulai buat konten pertama Anda untuk berbagi informasi terkini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    overflow-x: hidden;
}

.main-container {
    position: relative;
    min-height: 100vh;
}

/* Dynamic Background */
.background-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.animated-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(-45deg, 
        #667eea 0%, 
        #764ba2 25%, 
        #f093fb 50%, 
        #f5576c 75%, 
        #4facfe 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.floating-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(255,255,255,0.4), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.3), transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: particleFloat 20s linear infinite;
}

@keyframes particleFloat {
    0% { transform: translateY(0px); }
    100% { transform: translateY(-200px); }
}

.gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.1);
}

/* Hero Header */
.hero-header {
    padding: 60px 0 80px;
    position: relative;
    margin-top: 50px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.header-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.logo-section {
    margin-bottom: 30px;
}

.animated-logo {
    position: relative;
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: logoRotate 10s linear infinite;
}

.logo-core {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    z-index: 2;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.logo-pulse {
    position: absolute;
    width: 100%;
    height: 100%;
    border: 2px solid rgba(255, 255, 255, 0.4);
    border-radius: 50%;
    animation: logoPulse 2s ease-in-out infinite;
}

@keyframes logoRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes logoPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.7; }
}

.main-title {
    font-size: 4.5rem;
    font-weight: 900;
    color: white;
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
    gap: 5px;
}

.title-char {
    display: inline-block;
    animation: titleBounce 1s ease-out both;
    animation-delay: var(--delay);
    text-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}

@keyframes titleBounce {
    0% { transform: translateY(50px); opacity: 0; }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); opacity: 1; }
}

.subtitle-container {
    position: relative;
}

.main-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 20px;
}

.subtitle-decoration {
    width: 150px;
    height: 4px;
    background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1);
    margin: 0 auto;
    border-radius: 2px;
    animation: decorationExpand 1.5s ease-out 1s both;
}

@keyframes decorationExpand {
    0% { width: 0; opacity: 0; }
    100% { width: 150px; opacity: 1; }
}

/* Form Section */
.form-section {
    padding: 40px 0;
    position: relative;
}

.form-wrapper {
    display: flex;
    justify-content: center;
}

.form-container {
    width: 100%;
    max-width: 800px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    animation: formSlideIn 1s ease-out;
}

@keyframes formSlideIn {
    0% { transform: translateY(50px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.create-mode {
    border-left: 5px solid #4ecdc4;
}

.edit-mode {
    border-left: 5px solid #ff9500;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.mode-indicator {
    display: flex;
    align-items: center;
    gap: 20px;
}

.create-indicator .indicator-icon {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
}

.edit-indicator .indicator-icon {
    background: linear-gradient(135deg, #ff9500, #ff7b00);
}

.indicator-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.indicator-text h3 {
    color: white;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.indicator-text p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
}

.edit-badge {
    background: rgba(255, 149, 0, 0.2);
    border: 1px solid rgba(255, 149, 0, 0.4);
    border-radius: 25px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #ff9500;
    font-size: 0.9rem;
    font-weight: 600;
}

/* Enhanced Form Elements */
.form-grid {
    display: grid;
    gap: 30px;
}

.form-row.full-width {
    grid-column: 1 / -1;
}

.form-row.half-width {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.floating-input-group,
.floating-textarea-group {
    position: relative;
}

.input-icon,
.textarea-icon {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.6);
    z-index: 2;
    transition: all 0.3s ease;
}

.floating-textarea-group .textarea-icon {
    top: 20px;
    transform: none;
}

.enhanced-input,
.enhanced-textarea {
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    color: white;
    font-size: 1rem;
    padding: 18px 20px 18px 55px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.enhanced-input:focus,
.enhanced-textarea:focus {
    outline: none;
    border-color: #4ecdc4;
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.2);
}

.enhanced-input:focus + .enhanced-label,
.enhanced-textarea:focus + .enhanced-label,
.enhanced-input:not(:placeholder-shown) + .enhanced-label,
.enhanced-textarea:not(:placeholder-shown) + .enhanced-label {
    top: -12px;
    left: 15px;
    font-size: 0.85rem;
    color: #4ecdc4;
    background: linear-gradient(90deg, transparent 0%, rgba(102, 126, 234, 0.8) 10%, rgba(118, 75, 162, 0.8) 90%, transparent 100%);
    padding: 4px 8px;
    border-radius: 8px;
}

.enhanced-label {
    position: absolute;
    top: 18px;
    left: 55px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
    pointer-events: none;
    transition: all 0.3s ease;
    z-index: 2;
}

.date-input {
    color-scheme: dark;
}

/* Upload Zone */
.upload-zone {
    position: relative;
    height: 120px;
}

/* Multiple Upload Zone */
.multiple-upload-zone {
    width: 100%;
}

.upload-header {
    margin-bottom: 20px;
    text-align: center;
}

.upload-header h4 {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.upload-info {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.upload-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.upload-slot {
    position: relative;
    height: 120px;
    border: 2px dashed rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    overflow: hidden;
}

.upload-slot:hover {
    border-color: #4ecdc4;
    background: rgba(78, 205, 196, 0.15);
}

.upload-slot.has-image {
    border-color: #4ecdc4;
    background: rgba(78, 205, 196, 0.1);
}

.file-input {
    display: none;
}

.upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    border: 2px dashed rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.upload-label:hover {
    border-color: #4ecdc4;
    background: rgba(78, 205, 196, 0.15);
}

.upload-content {
    text-align: center;
    color: rgba(255, 255, 255, 0.8);
}

.upload-icon {
    font-size: 2rem;
    color: #4ecdc4;
    margin-bottom: 10px;
}

.upload-title {
    display: block;
    font-weight: 600;
    margin-bottom: 4px;
}

.upload-subtitle {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
}

.current-image-preview {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.current-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay-edit {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
    font-size: 0.7rem;
}

.current-image-preview:hover .image-overlay-edit {
    opacity: 1;
}

/* Form Actions */
.form-actions-enhanced {
    display: flex;
    gap: 20px;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-submit {
    position: relative;
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    border: none;
    border-radius: 25px;
    padding: 15px 35px;
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(78, 205, 196, 0.4);
}

.btn-update {
    background: linear-gradient(135deg, #ff9500, #ff7b00);
    box-shadow: 0 10px 25px rgba(255, 149, 0, 0.4);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(78, 205, 196, 0.6);
}

.btn-update:hover {
    box-shadow: 0 15px 35px rgba(255, 149, 0, 0.6);
}

.btn-content {
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
    z-index: 2;
}

.btn-cancel {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 25px;
    padding: 13px 30px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-cancel:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-3px);
    color: white;
    text-decoration: none;
}

/* Results Section */
.results-section {
    padding: 60px 0 100px;
    position: relative;
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 25px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 20px;
}

.title-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.title-content h2 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.title-content p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1rem;
}

.stats-badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px 30px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 900;
    color: #fbfbfb;
    margin-bottom: 5px;
}

.stat-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    font-weight: 500;
}

/* Content Showcase */
.content-showcase {
    position: relative;
}

.content-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    max-height: 800px;
    overflow-y: auto;
    padding-right: 10px;
}

.content-masonry::-webkit-scrollbar {
    width: 8px;
}

.content-masonry::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.content-masonry::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    border-radius: 10px;
}

.content-item {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    animation: itemFadeIn 0.8s ease-out both;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.content-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border-color: rgba(78, 205, 196, 0.4);
}

@keyframes itemFadeIn {
    0% { opacity: 0; transform: translateY(40px) scale(0.95); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

.item-header {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.item-image {
    width: 100%;
    height: 100%;
    position: relative;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.content-item:hover .item-image img {
    transform: scale(1.1);
}

.placeholder-img {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.05));
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.6);
    font-size: 3rem;
}

.item-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.5));
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.content-item:hover .item-overlay {
    opacity: 1;
}

.overlay-actions {
    display: flex;
    gap: 15px;
}

.action-button {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    color: white;
    font-size: 1.1rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.edit-action {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
}

.delete-action {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
}

.action-button:hover {
    transform: scale(1.15);
}

.delete-form {
    display: inline;
}

.item-content {
    padding: 25px;
}

.item-title {
    color: white;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
}

.item-description {
    margin-bottom: 20px;
}

.description-text {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 0;
}

.expand-btn {
    background: none;
    border: none;
    color: #4ecdc4;
    cursor: pointer;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
    padding: 5px 0;
    transition: all 0.3s ease;
}

.expand-btn:hover {
    color: #44a08d;
}

.expand-btn i {
    transition: transform 0.3s ease;
}

.expand-btn.expanded i {
    transform: rotate(180deg);
}

/* Item Actions */
.item-actions {
    margin: 20px 0;
}

.view-details-btn {
    width: 100%;
    background: linear-gradient(135deg, rgba(78, 205, 196, 0.2), rgba(68, 160, 141, 0.2));
    border: 2px solid rgba(78, 205, 196, 0.3);
    border-radius: 15px;
    padding: 12px 20px;
    color: #4ecdc4;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.view-details-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.view-details-btn:hover::before {
    left: 100%;
}

.view-details-btn:hover {
    background: linear-gradient(135deg, rgba(78, 205, 196, 0.3), rgba(68, 160, 141, 0.3));
    border-color: #4ecdc4;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(78, 205, 196, 0.4);
}

.btn-icon {
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.btn-arrow {
    width: 30px;
    height: 30px;
    background: rgba(78, 205, 196, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.view-details-btn:hover .btn-arrow {
    background: rgba(78, 205, 196, 0.4);
    transform: translateX(5px);
}

/* Detail Modal */
.detail-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.detail-modal.active {
    opacity: 1;
    visibility: visible;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
}

.modal-container {
    position: relative;
    width: 90%;
    max-width: 700px;
    max-height: 90vh;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    transform: scale(0.8);
    transition: all 0.3s ease;
}

.detail-modal.active .modal-container {
    transform: scale(1);
}

.modal-header {
    padding: 25px 30px;
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.modal-title-section h3 {
    color: white;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1.3;
}

.modal-date {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.modal-close-btn {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.modal-close-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.modal-content {
    padding: 30px;
    max-height: 400px;
    overflow-y: auto;
}

.modal-content::-webkit-scrollbar {
    width: 6px;
}

.modal-content::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    border-radius: 10px;
}

.modal-image-container {
    margin-bottom: 25px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.modal-image-container img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.modal-image-container.no-image {
    display: none;
}

.modal-description {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    line-height: 1.7;
}

.modal-footer {
    padding: 25px 30px;
    background: rgba(255, 255, 255, 0.05);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.modal-edit-btn,
.modal-close-action {
    padding: 12px 25px;
    border-radius: 20px;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    font-size: 0.95rem;
}

.modal-edit-btn {
    background: linear-gradient(135deg, #ff9500, #ff7b00);
    color: white;
    box-shadow: 0 5px 15px rgba(255, 149, 0, 0.4);
}

.modal-edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 149, 0, 0.6);
    color: white;
    text-decoration: none;
}

.modal-close-action {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    color: white;
    box-shadow: 0 5px 15px rgba(78, 205, 196, 0.4);
}

.modal-close-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(78, 205, 196, 0.6);
}

.item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
}

.publish-date {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.status-badge {
    background: rgba(78, 205, 196, 0.2);
    border: 1px solid rgba(78, 205, 196, 0.4);
    color: #4ecdc4;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: rgba(255, 255, 255, 0.8);
}

.empty-icon {
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.4);
    margin-bottom: 25px;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: white;
}

.empty-state p {
    font-size: 1rem;
    max-width: 400px;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .main-title {
        font-size: 3.5rem;
    }
    
    .form-row.half-width {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .results-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    
    .hero-header {
        padding: 40px 0 60px;
    }
    
    .main-title {
        font-size: 2.8rem;
    }
    
    .main-subtitle {
        font-size: 1.1rem;
    }
    
    .form-container {
        padding: 30px 20px;
        margin: 0 10px;
    }
    
    .form-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        text-align: left;
    }
    
    .mode-indicator {
        gap: 15px;
    }
    
    .indicator-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .indicator-text h3 {
        font-size: 1.2rem;
    }
    
    .form-actions-enhanced {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-submit,
    .btn-cancel {
        width: 100%;
        justify-content: center;
    }
    
    .content-masonry {
        grid-template-columns: 1fr;
        gap: 20px;
        max-height: 600px;
    }
    
    .section-title {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        text-align: left;
    }
    
    .title-content h2 {
        font-size: 1.6rem;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 2.2rem;
        flex-direction: column;
        gap: 0;
    }
    
    .animated-logo {
        width: 100px;
        height: 100px;
    }
    
    .logo-core {
        width: 70px;
        height: 70px;
        font-size: 2rem;
    }
    
    .enhanced-input,
    .enhanced-textarea {
        padding: 15px 15px 15px 45px;
    }
    
    .enhanced-label {
        left: 45px;
    }
    
    .input-icon,
    .textarea-icon {
        width: 35px;
    }
    
    .content-masonry {
        max-height: 500px;
    }
}

    .modal-actions {
        flex-direction: column;
        gap: 12px;
    }
    
    .modal-edit-btn,
    .modal-close-action {
        width: 100%;
        justify-content: center;
    }
    
    .modal-container {
        width: 95%;
        margin: 10px;
    }
    
    .modal-header {
        padding: 20px;
    }
    
    .modal-content {
        padding: 20px;
        max-height: 300px;
    }
    
    .modal-footer {
        padding: 20px;
    }
}

/* Additional Animations */
@keyframes ripple {
    0% { transform: scale(0); opacity: 1; }
    100% { transform: scale(4); opacity: 0; }
}

.btn-submit:active::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    animation: ripple 0.6s linear;
}

/* Scrollbar Styling for Webkit Browsers */
.form-container::-webkit-scrollbar,
.content-masonry::-webkit-scrollbar {
    width: 8px;
}

.form-container::-webkit-scrollbar-track,
.content-masonry::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.form-container::-webkit-scrollbar-thumb,
.content-masonry::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    border-radius: 4px;
}

/* Selection Styling */
::selection {
    background: rgba(78, 205, 196, 0.3);
    color: white;
}

::-moz-selection {
    background: rgba(78, 205, 196, 0.3);
    color: white;
}

/* Placeholder Styling */
.enhanced-input::placeholder,
.enhanced-textarea::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

/* Focus States for Better Accessibility */
.action-button:focus,
.btn-submit:focus,
.btn-cancel:focus,
.enhanced-input:focus,
.enhanced-textarea:focus,
.upload-label:focus,
.view-details-btn:focus,
.modal-edit-btn:focus,
.modal-close-action:focus {
    outline: 2px solid #4ecdc4;
    outline-offset: 2px;
}

/* Print Styles */
@media print {
    .background-wrapper,
    .form-actions-enhanced,
    .overlay-actions,
    .detail-modal {
        display: none;
    }
    
    .main-container {
        background: white;
        color: black;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toggleContent(btn) {
    const description = btn.closest('.item-description');
    const textElement = description.querySelector('.description-text');
    const fullText = description.dataset.full;
    const shortText = fullText.substring(0, 100) + (fullText.length > 100 ? '...' : '');
    const btnText = btn.querySelector('.btn-text');
    const btnIcon = btn.querySelector('i');

    if (btn.classList.contains('expanded')) {
        // Collapse
        textElement.textContent = shortText;
        btnText.textContent = 'Baca Selengkapnya';
        btnIcon.classList.remove('fa-chevron-up');
        btnIcon.classList.add('fa-chevron-down');
        btn.classList.remove('expanded');
    } else {
        // Expand
        textElement.textContent = fullText;
        btnText.textContent = 'Sembunyikan';
        btnIcon.classList.remove('fa-chevron-down');
        btnIcon.classList.add('fa-chevron-up');
        btn.classList.add('expanded');
    }
}

// Modal Functions
function showDetailModal(item) {
    const modal = document.getElementById('detailModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDate = document.getElementById('modalDate');
    const modalImage = document.getElementById('modalImage');
    const modalImageContainer = document.getElementById('modalImageContainer');
    const modalDescription = document.getElementById('modalDescription');
    const modalEditBtn = document.getElementById('modalEditBtn');

    // Populate modal content
    modalTitle.textContent = item.title;
    modalDate.textContent = formatDate(item.tanggal_publikasi);
    modalDescription.textContent = item.description;
    
    // Handle image
    if (item.image) {
        modalImage.src = `/storage/${item.image}`;
        modalImage.alt = item.title;
        modalImageContainer.classList.remove('no-image');
    } else {
        modalImageContainer.classList.add('no-image');
    }
    
    // Set edit button link
    modalEditBtn.href = `{{ route('admin.pintar.index') }}?edit=${item.id}`;
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { 
        day: 'numeric', 
        month: 'long', 
        year: 'numeric' 
    };
    return date.toLocaleDateString('id-ID', options);
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('detailModal');
    if (e.target.classList.contains('modal-overlay')) {
        closeDetailModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetailModal();
    }
});

// Add smooth scrolling for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Add loading state to form submission
document.querySelector('.enhanced-form')?.addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('.btn-submit');
    const btnContent = submitBtn.querySelector('.btn-content');
    const originalContent = btnContent.innerHTML;
    
    btnContent.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Memproses...</span>';
    submitBtn.disabled = true;
    
    // Re-enable button after 5 seconds as fallback
    setTimeout(() => {
        btnContent.innerHTML = originalContent;
        submitBtn.disabled = false;
    }, 5000);
});

// Add file upload preview
document.getElementById('imageInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const uploadZone = document.querySelector('.upload-zone');
            const existingPreview = uploadZone.querySelector('.current-image-preview');
            
            if (existingPreview) {
                existingPreview.querySelector('img').src = e.target.result;
            } else {
                const preview = document.createElement('div');
                preview.className = 'current-image-preview';
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <div class="image-overlay-edit">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Ganti Gambar</span>
                    </div>
                `;
                uploadZone.appendChild(preview);
                uploadZone.classList.add('has-image');
            }
        };
        reader.readAsDataURL(file);
    }
});

// Add intersection observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

// Observe all animated elements
document.querySelectorAll('.content-item, .form-container').forEach(el => {
    observer.observe(el);
});

// Add button hover sound effect (optional)
document.querySelectorAll('.view-details-btn, .modal-edit-btn, .modal-close-action').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        // You can add a subtle sound effect here if needed
        this.style.transform = 'translateY(-2px)';
    });

    btn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// SweetAlert for delete confirmation
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@endsection