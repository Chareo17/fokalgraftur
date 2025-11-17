@extends('layouts.app')

@section('content')
<!-- Hero Header -->
<div class="edit-profile-hero">
    <div class="hero-pattern"></div>
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="hero-content text-center">
                    <div class="hero-icon">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <h1 class="hero-title text-white">Edit Profil</h1>
                    <p class="hero-subtitle">Perbarui informasi profil Anda dengan mudah</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Form -->
<div class="edit-profile-section">
    <div class="container">
        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data" class="modern-form">
            @csrf
            <div class="row g-4">

                <!-- Profile Image Section -->
                <div class="col-lg-4">
                    <div class="profile-image-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-camera me-2"></i>
                                Foto Profil
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="image-upload-container">
                                <div class="image-preview">
                                    <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/img/avatar-1.webp') }}"
                                         alt="Profile Image" class="preview-img" id="profilePreview">
                                    <div class="image-overlay">
                                        <i class="bi bi-camera-fill"></i>
                                        <span>Ubah Foto</span>
                                    </div>
                                </div>
                                <input type="file" id="profile_image" name="profile_image" accept="image/*" 
                                       class="image-input" onchange="previewImage(event)">
                                <label for="profile_image" class="upload-btn">
                                    <i class="bi bi-cloud-upload me-2"></i>
                                    Pilih Gambar
                                </label>
                                <p class="upload-hint">JPG, PNG atau GIF (Max. 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="quick-info-card">
                        <h6 class="info-title">Tips Foto Profil</h6>
                        <ul class="info-list">
                            <li><i class="bi bi-check-circle-fill"></i> Gunakan foto yang jelas</li>
                            <li><i class="bi bi-check-circle-fill"></i> Hindari foto buram</li>
                            <li><i class="bi bi-check-circle-fill"></i> Ukuran maksimal 5MB</li>
                        </ul>
                    </div>
                </div>

                <!-- Form Fields Section -->
                <div class="col-lg-8">
                    <div class="form-container">
                        
                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Informasi Pribadi
                                </h5>
                            </div>

                            <!-- Nama -->
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person me-2"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" class="form-control modern-input" id="name" name="name"
                                       value="{{ old('name', $profile->name ?? '') }}" placeholder="Masukkan nama lengkap" required {{ $profile->role == 'siswa' ? 'readonly' : '' }} style="{{ $profile->role == 'siswa' ? 'background-color: #e9ecef; opacity: 0.7;' : '' }}">
                            </div>

                            <!-- Username (alumni dan siswa) -->
                            @if(in_array($profile->role, ['alumni', 'siswa']))
                            <div class="form-group">
                                <label for="username" class="form-label">
                                    <i class="bi bi-at me-2"></i>
                                    Username
                                </label>
                                <input type="text" class="form-control modern-input" id="username" name="username" 
                                       value="{{ old('username', $profile->username ?? '') }}" placeholder="Masukkan username" required>
                            </div>
                            @endif

                            <!-- Alamat (khusus alumni) -->
                            @if($profile->role == 'alumni')
                            <div class="form-group">
                                <label for="alamat" class="form-label">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Alamat
                                </label>
                                <textarea class="form-control modern-input" id="alamat" name="alamat" rows="3" 
                                          placeholder="Masukkan alamat lengkap">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                            </div>
                            @endif

                        <!-- Jurusan -->
                        <div class="form-group">
                            <label for="jurusan" class="form-label">
                                <i class="bi bi-journal-text me-2"></i>
                                Jurusan
                            </label>
                            <input type="text" class="form-control modern-input" id="jurusan" name="jurusan"
                                   value="{{ old('jurusan', $profile->jurusan ?? '') }}" placeholder="Masukkan jurusan" readonly style="background-color: #e9ecef; opacity: 0.7;">
                        </div>

                        <!-- Tanggal Lahir (tidak untuk siswa) -->
                        @if($profile->role != 'siswa')
                        <div class="form-group">
                            <label for="tanggal_lahir" class="form-label">
                                <i class="bi bi-calendar3 me-2"></i>
                                Tanggal Lahir
                            </label>
                            <input type="date" class="form-control modern-input" id="tanggal_lahir" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $profile->tanggal_lahir ?? '') }}" placeholder="Masukkan tanggal lahir">
                        </div>
                        @endif
                    </div>

                    <!-- Academic/Professional Information (Alumni) -->
                    @if($profile->role == 'alumni')
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-mortarboard me-2"></i>
                                Informasi Akademik & Profesional
                            </h5>
                        </div>

                        <div class="row g-3">
                            <!-- Tahun Lulusan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_lulusan" class="form-label">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        Tahun Lulusan
                                    </label>
                                    <input type="number" class="form-control modern-input" id="tahun_lulusan" 
                                           name="tahun_lulusan" value="{{ old('tahun_lulusan', $profile->tahun_lulusan ?? '') }}" 
                                           placeholder="Masukkan jurusan" readonly style="background-color: #e9ecef; opacity: 0.7;">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">
                                        <i class="bi bi-briefcase me-2"></i>
                                        Status Saat Ini
                                    </label>
                                    <select class="form-select modern-input" id="status" name="status" onchange="toggleCompanyUniversityFields()">
                                        <option value="" disabled {{ old('status', $profile->status ?? '') == '' ? 'selected' : '' }}>Pilih Status</option>
                                        <option value="Bekerja" {{ old('status', $profile->status ?? '') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                        <option value="Tidak Bekerja" {{ old('status', $profile->status ?? '') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                        <option value="Studi Lanjut" {{ old('status', $profile->status ?? '') == 'Studi Lanjut' ? 'selected' : '' }}>Studi Lanjut</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Fields -->
                        <div class="dynamic-fields">
                            <!-- University Field -->
                            <div class="form-group dynamic-field" id="universityField" style="display: none;">
                                <label for="nama_universitas" class="form-label">
                                    <i class="bi bi-building me-2"></i>
                                    Nama Universitas
                                </label>
                                <input type="text" class="form-control modern-input" id="nama_universitas" 
                                       name="universitas" value="{{ old('universitas', $profile->nama_universitas ?? '') }}" 
                                       placeholder="Masukkan nama universitas">
                            </div>

                            <!-- Company Field -->
                            <div class="form-group dynamic-field" id="companyField" style="display: none;">
                                <label for="nama_perusahaan" class="form-label">
                                    <i class="bi bi-building me-2"></i>
                                    Nama Perusahaan
                                </label>
                                <input type="text" class="form-control modern-input" id="nama_perusahaan" 
                                       name="nama_perusahaan" value="{{ old('nama_perusahaan', $profile->nama_perusahaan ?? '') }}" 
                                       placeholder="Masukkan nama perusahaan">
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="form-group">
                            <label for="no_hp" class="form-label">
                                <i class="bi bi-telephone me-2"></i>
                                Nomor Telepon / WhatsApp
                            </label>
                            <input type="text" class="form-control modern-input" id="no_hp" name="no_hp" 
                                   value="{{ old('no_hp', $profile->no_hp ?? '') }}" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                    @endif

                        <!-- Student Information -->
                        @if($profile->role == 'siswa')
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title">
                                    <i class="bi bi-card-heading me-2"></i>
                                    Informasi Siswa
                                </h5>
                            </div>

                            <!-- NIS -->
                            <div class="form-group">
                                <label for="nis" class="form-label">
                                    <i class="bi bi-credit-card me-2"></i>
                                    Nomor Induk Siswa (NIS)
                                </label>
                                <input type="text" class="form-control modern-input" id="nis" name="nis"
                                       value="{{ old('nis', $profile->nis ?? '') }}" placeholder="Masukkan NIS" required readonly style="background-color: #e9ecef; opacity: 0.7;">
                            </div>
                        </div>
                        @endif

                        <!-- Password Change Section -->
                        {{-- <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title">
                                    <i class="bi bi-lock me-2"></i>
                                    Ubah Password
                                </h5>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="bi bi-key me-2"></i>
                                    Password Baru
                                </label>
                                <input type="password" class="form-control modern-input" id="password" name="password" placeholder="Masukkan password baru">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-key-fill me-2"></i>
                                    Konfirmasi Password Baru
                                </label>
                                <input type="password" class="form-control modern-input" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru">
                            </div>
                        </div> --}}

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-modern btn-primary w-100">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Update Profil
                                    </button>
                                </div>
                                @if(in_array($profile->role, ['alumni', 'siswa']))
                                <div class="col-md-6">
                                    <a href="{{ route('change-password.form') }}" class="btn btn-modern btn-secondary w-100">
                                        <i class="bi bi-key me-2"></i>
                                        Ubah Password
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('profilePreview');
                img.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleCompanyUniversityFields() {
        const status = document.getElementById('status').value;
        const universityField = document.getElementById('universityField');
        const companyField = document.getElementById('companyField');

        // Hide all fields first
        universityField.style.display = 'none';
        companyField.style.display = 'none';

        // Show relevant field with animation
        if (status === 'Bekerja') {
            companyField.style.display = 'block';
            setTimeout(() => {
                companyField.classList.add('field-show');
            }, 10);
        } else if (status === 'Studi Lanjut') {
            universityField.style.display = 'block';
            setTimeout(() => {
                universityField.classList.add('field-show');
            }, 10);
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function () {
        toggleCompanyUniversityFields();
        
        // Add form validation
        const form = document.querySelector('.modern-form');
        const inputs = form.querySelectorAll('.modern-input');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });
            
            // Check initial values
            if (input.value.trim() !== '') {
                input.classList.add('has-value');
            }
        });

        @if ($errors->any())
            let errorMessages = '<ul style="text-align: left;">';
            @foreach ($errors->all() as $error)
                errorMessages += '<li>{{ $error }}</li>';
            @endforeach
            errorMessages += '</ul>';
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan...',
                html: errorMessages,
                footer: '<a href="#">Mengapa saya mengalami masalah ini?</a>'
            });
        @endif
    });
</script>

<style>
/* Modern Variables */
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    --card-shadow: 0 10px 40px rgba(0,0,0,0.1);
    --card-shadow-hover: 0 20px 60px rgba(0,0,0,0.15);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --input-focus-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Hero Section */
.edit-profile-hero {
    background: var(--primary-gradient);
    position: relative;
    overflow: hidden;
    padding: 100px 0 60px;
    margin-top: 0px;
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

.hero-content {
    color: white;
    position: relative;
    z-index: 2;
}

.hero-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
}

.hero-icon i {
    font-size: 2rem;
    color: white;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 0;
}

/* Edit Profile Section */
.edit-profile-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

/* Profile Image Card */
.profile-image-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
    margin-bottom: 30px;
    transition: var(--transition);
}

.profile-image-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--card-shadow-hover);
}

.profile-image-card .card-header {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    padding: 25px;
    border-bottom: 1px solid #e2e8f0;
}

.profile-image-card .card-title {
    margin: 0;
    color: #1e293b;
    font-weight: 600;
    font-size: 1.1rem;
}

.profile-image-card .card-body {
    padding: 30px;
}

/* Image Upload */
.image-upload-container {
    text-align: center;
}

.image-preview {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto 25px;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: var(--transition);
}

.image-preview:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 45px rgba(0,0,0,0.15);
}

.preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
    color: white;
}

.image-preview:hover .image-overlay {
    opacity: 1;
}

.image-overlay i {
    font-size: 2rem;
    margin-bottom: 8px;
}

.image-input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.upload-btn {
    display: inline-flex;
    align-items: center;
    background: var(--primary-gradient);
    color: white;
    padding: 12px 25px;
    border-radius: 50px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.upload-hint {
    margin-top: 15px;
    font-size: 0.9rem;
    color: #64748b;
}

/* Quick Info Card */
.quick-info-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    padding: 25px;
    transition: var(--transition);
}

.quick-info-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--card-shadow-hover);
}

.info-title {
    color: #1e293b;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 1rem;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    align-items: center;
    padding: 8px 0;
    font-size: 0.9rem;
    color: #64748b;
}

.info-list li i {
    color: #10b981;
    margin-right: 10px;
    font-size: 0.9rem;
}

/* Form Container */
.form-container {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
}

/* Form Sections */
.form-section {
    padding: 30px;
    border-bottom: 1px solid #f1f5f9;
}

.form-section:last-child {
    border-bottom: none;
}

.section-header {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e2e8f0;
}

.section-title {
    color: #1e293b;
    font-weight: 600;
    margin: 0;
    font-size: 1.2rem;
}

/* Form Groups */
.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: flex;
    align-items: center;
    color: #374151;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-label i {
    color: #3b82f6;
    font-size: 1rem;
}

/* Modern Inputs */
.modern-input {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 15px 20px;
    font-size: 1rem;
    transition: var(--transition);
    background: #f8fafc;
    color: #1e293b;
    width: 100%;
}

.modern-input:focus {
    border-color: #3b82f6;
    box-shadow: var(--input-focus-shadow);
    background: white;
    outline: none;
}

.modern-input.has-value {
    background: white;
    border-color: #10b981;
}

.modern-input::placeholder {
    color: #9ca3af;
    opacity: 1;
}

/* Select Styling */
.form-select.modern-input {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px 12px;
    padding-right: 50px;
}

/* Dynamic Fields Animation */
.dynamic-field {
    opacity: 0;
    transform: translateY(-10px);
    transition: var(--transition);
}

.dynamic-field.field-show {
    opacity: 1;
    transform: translateY(0);
}

/* Form Actions */
.form-actions {
    padding: 30px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

/* Modern Buttons */
.btn-modern {
    border: none;
    border-radius: 12px;
    padding: 15px 25px;
    font-weight: 600;
    font-size: 1rem;
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

.btn-primary {
    background: var(--primary-gradient);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-cancel {
    background: #6b7280;
    color: white;
}

.btn-cancel:hover {
    background: #4b5563;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(107, 114, 128, 0.4);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .edit-profile-section {
        padding: 40px 0;
    }
    
    .form-section {
        padding: 20px;
    }
    
    .form-actions {
        padding: 20px;
    }
    
    .image-preview {
        width: 150px;
        height: 150px;
    }
    
    .profile-image-card .card-body {
        padding: 20px;
    }
}

/* Loading Animation */
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

.form-section {
    animation: fadeInUp 0.6s ease forwards;
}

.form-section:nth-child(1) { animation-delay: 0.1s; }
.form-section:nth-child(2) { animation-delay: 0.2s; }
.form-section:nth-child(3) { animation-delay: 0.3s; }

/* Focus States */
.modern-input:focus + .form-label {
    color: #3b82f6;
}

/* Validation States */
.modern-input:valid {
    border-color: #10b981;
}

.modern-input:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #ef4444;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection