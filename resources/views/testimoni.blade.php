@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
  <div class="container text-center" style="margin-top: 15px;">
    <h1 class="hero-title text-light">Kelola Testimoni Alumni</h1>
    <p class="hero-subtitle">Tambah dan kelola testimoni dari para alumni SMK GRAFIKA YAYASAN LEKTUR</p>
  </div>
</section>

<!-- Header Section -->
<section class="section-header">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h3 class="mb-1 text-dark">Daftar Testimoni Alumni</h3>
        <p class="text-muted mb-0">Kelola testimoni dari para alumni</p>
      </div>
      <div class="col-md-4 text-end">
        <button type="button" class="btn btn-gradient btn-lg" data-bs-toggle="modal" data-bs-target="#testimonialModal">
          <i class="bi bi-plus-circle me-2"></i>Tambah Testimoni
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
  <div class="container">
    <div class="row" id="testimonialsContainer">
      @if(isset($testimonials) && count($testimonials) > 0)
        @foreach($testimonials as $testimonial)
        <div class="col-lg-6 col-xl-4 mb-4" data-testimonial-id="{{ $testimonial->id }}">
          <div class="card testimonial-card h-100 shadow-sm">
            <button type="button" class="delete-btn" onclick="deleteTestimonial({{ $testimonial->id }})" title="Hapus testimoni">
              <i class="bi bi-trash"></i>
            </button>
            <div class="card-body d-flex flex-column text-center p-4">
              <div class="mb-3">
                <img src="{{ $testimonial->foto ?? 'https://via.placeholder.com/80' }}" 
                     alt="{{ $testimonial->nama_alumni }}" 
                     class="testimonial-avatar rounded-circle">
              </div>
              <div class="quote-block flex-grow-1 mb-3">
                <p class="testimonial-text mb-0">"{{ $testimonial->testimoni }}"</p>
              </div>
              <div class="testimonial-author">
                <h6 class="fw-bold mb-1 text-primary">{{ $testimonial->nama_alumni }}</h6>
                <p class="text-muted small mb-1">{{ $testimonial->jurusan }}</p>
                <p class="text-primary fw-semibold small mb-1">Lulusan {{ $testimonial->tahun_lulusan }}</p>
                @if($testimonial->posisi_pekerjaan)
                  <p class="text-success fw-semibold small mb-1">{{ $testimonial->posisi_pekerjaan }}</p>
                @endif
                @if($testimonial->nama_perusahaan)
                  <p class="text-info small mb-1">{{ $testimonial->nama_perusahaan }}</p>
                @endif
                <p class="text-muted small mb-0">Dibuat pada {{ $testimonial->created_at->format('l, d F Y') }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      @else
        <div class="col-12" id="emptyState">
          <div class="empty-state">
            <i class="bi bi-chat-quote display-1 text-muted mb-3"></i>
            <h4 class="mt-3 text-muted">Belum ada testimoni</h4>
            <p class="text-muted">Mulai tambahkan testimoni pertama dari alumni</p>
            <button type="button" class="btn btn-gradient btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#testimonialModal">
              <i class="bi bi-plus-circle me-2"></i>Tambah Testimoni Pertama
            </button>
          </div>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- Modal Form -->
<div class="modal fade" id="testimonialModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-gradient text-white">
        <h5 class="modal-title">
          <i class="bi bi-plus-circle me-2"></i>Tambah Testimoni Alumni
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="testimonialForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <!-- Photo Upload -->
          <div class="mb-4">
            <label for="foto" class="form-label fw-semibold">
              <i class="bi bi-camera me-1"></i>Foto Alumni *
            </label>
            <div class="upload-area" id="uploadArea">
              <i class="bi bi-cloud-upload display-4 text-muted"></i>
              <p class="fw-semibold mt-2 mb-1">Klik atau drag foto ke sini</p>
              <small class="text-muted">JPG, PNG, WEBP (Max 2MB)</small>
              <input type="file" class="d-none" id="foto" name="foto" accept="image/*" required>
            </div>
            <div id="imagePreview" class="mt-3 text-center d-none">
              <img id="previewImg" class="preview-image rounded-circle" alt="Preview">
            </div>
          </div>

          <div class="row">
            <!-- Nama Alumni -->
            <div class="col-md-6 mb-3">
              <label for="nama" class="form-label fw-semibold">
                <i class="bi bi-person me-1"></i>Nama Alumni *
              </label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" required>
            </div>

            <!-- Jurusan -->
            <div class="col-md-6 mb-3">
              <label for="jurusan" class="form-label fw-semibold">
                <i class="bi bi-book me-1"></i>Jurusan *
              </label>
              <select class="form-select" id="jurusan" name="jurusan" required>
                <option value="">Pilih Jurusan</option>
                <option value="Teknik Grafika">Teknik Grafika</option>
                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
              </select>
            </div>

            <!-- Tahun Lulusan -->
            <div class="col-md-6 mb-3">
              <label for="tahunLulusan" class="form-label fw-semibold">
                <i class="bi bi-calendar me-1"></i>Tahun Lulusan *
              </label>
              <select class="form-select" id="tahunLulusan" name="tahun_lulusan" required></select>
            </div>

            <!-- Posisi -->
            <div class="col-md-6 mb-3">
              <label for="posisi" class="form-label fw-semibold">
                <i class="bi bi-briefcase me-1"></i>Posisi/Pekerjaan
              </label>
              <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Software Developer">
            </div>

            <!-- Perusahaan -->
            <div class="col-12 mb-3">
              <label for="perusahaan" class="form-label fw-semibold">
                <i class="bi bi-building me-1"></i>Perusahaan/Institusi
              </label>
              <input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="PT. Technology Indonesia">
            </div>

            <!-- Testimoni -->
            <div class="col-12 mb-3">
              <label for="testimoni" class="form-label fw-semibold">
                <i class="bi bi-chat-quote me-1"></i>Testimoni *
              </label>
              <textarea class="form-control" id="testimoni" name="testimoni" rows="4" 
                        placeholder="Ceritakan pengalaman selama di SMKN 1 Jakarta..." 
                        required maxlength="500"></textarea>
              <div class="d-flex justify-content-between mt-2">
                <small class="text-muted">Minimal 50 karakter</small>
                <small class="text-muted"><span id="charCount">0</span>/500</small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-gradient" id="submitBtn">
            <i class="bi bi-check-circle me-1"></i>Simpan Testimoni
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
:root {
  --primary: #667eea;
  --secondary: #764ba2;
  --success: #28a745;
  --danger: #dc3545;
  --shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
  --border-radius: 15px;
  --transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

/* Hero Section */
.hero {
  background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  color: white;
  padding: 80px 0;
  position: relative;
  overflow: hidden;
}

.hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.1);
}

.hero .container {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-size: clamp(2rem, 5vw, 3.5rem);
  font-weight: 700;
  margin-bottom: 1rem;
  text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.979)252, 0.3);
  animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
  font-size: 1.2rem;
  opacity: 0.9;
  animation: fadeInUp 1.2s ease-out;
}

/* Section Header */
.section-header {
  background: white;
  border-bottom: 1px solid #e9ecef;
  padding: 2rem 0;
}

/* Button Styles */
.btn-gradient {
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  border: none;
  color: white;
  font-weight: 600;
  border-radius: 25px;
  padding: 12px 30px;
  box-shadow: var(--shadow);
  transition: var(--transition);
}

.btn-gradient:hover {
  background: linear-gradient(135deg, var(--secondary), var(--primary));
  transform: translateY(-2px);
  color: white;
  box-shadow: 0 12px 35px rgba(102, 126, 234, 0.25);
}

/* Card Styles */
.testimonial-card {
  background: white;
  border: none;
  border-radius: var(--border-radius);
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.testimonial-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.testimonial-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.testimonial-card:hover::before {
  opacity: 1;
}

.testimonial-avatar {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border: 3px solid white;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: var(--transition);
}

.testimonial-card:hover .testimonial-avatar {
  border-color: var(--primary);
  transform: scale(1.05);
}

.testimonial-text {
  font-style: italic;
  color: #495057;
  line-height: 1.6;
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.quote-block {
  background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
  border-left: 4px solid var(--primary);
  padding: 1rem 1.5rem;
  border-radius: 0 10px 10px 0;
}

.delete-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  width: 35px;
  height: 35px;
  background: rgba(220, 53, 69, 0.9);
  border: none;
  border-radius: 50%;
  color: white;
  opacity: 0;
  transition: var(--transition);
  z-index: 10;
}

.testimonial-card:hover .delete-btn {
  opacity: 1;
}

.delete-btn:hover {
  background: var(--danger);
  transform: scale(1.1);
}

/* Modal Styles */
.modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.modal-header.bg-gradient {
  background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
  border-bottom: none;
}

/* Form Styles */
.form-control, .form-select {
  border: 2px solid #e9ecef;
  border-radius: 10px;
  padding: 12px 15px;
  transition: var(--transition);
}

.form-control:focus, .form-select:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
}

/* Upload Area */
.upload-area {
  border: 2px dashed #dee2e6;
  border-radius: var(--border-radius);
  background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
  padding: 2rem;
  text-align: center;
  cursor: pointer;
  transition: var(--transition);
}

.upload-area:hover, .upload-area.dragover {
  border-color: var(--primary);
  background: linear-gradient(135deg, #f0f2ff 0%, #ffffff 100%);
  transform: translateY(-2px);
}

.preview-image {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border: 3px solid var(--primary);
  box-shadow: var(--shadow);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: #6c757d;
}

.empty-state i {
  font-size: 4rem;
  opacity: 0.5;
}

/* Animations */
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
  from { opacity: 1; transform: scale(1); }
  to { opacity: 0; transform: scale(0.9) translateY(-20px); }
}

.animate-in {
  animation: fadeInUp 0.6s ease-out;
}

.animate-out {
  animation: fadeOut 0.5s ease-out forwards;
}

/* Responsive */
@media (max-width: 768px) {
  .hero { padding: 60px 0; }
  .delete-btn { opacity: 1; }
  .section-header .text-end { text-align: center !important; margin-top: 1rem; }
}

/* Utilities */
.text-primary { color: var(--primary) !important; }
.text-success { color: var(--success) !important; }
.text-info { color: #17a2b8 !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  class TestimonialManager {
    constructor() {
      this.init();
    }
  
    init() {
      this.setupEventListeners();
      this.populateYearOptions();
      this.initializeAnimations();
    }
  
    setupEventListeners() {
      const form = document.getElementById('testimonialForm');
      const uploadArea = document.getElementById('uploadArea');
      const photoInput = document.getElementById('foto');
      const testimoniTextarea = document.getElementById('testimoni');
  
      // Form submission
      form?.addEventListener('submit', (e) => this.handleSubmit(e));
  
      // File upload
      uploadArea?.addEventListener('click', () => photoInput?.click());
      uploadArea?.addEventListener('dragover', (e) => this.handleDragOver(e));
      uploadArea?.addEventListener('dragleave', (e) => this.handleDragLeave(e));
      uploadArea?.addEventListener('drop', (e) => this.handleDrop(e));
      photoInput?.addEventListener('change', (e) => this.handleFileSelect(e));
  
      // Character counter
      testimoniTextarea?.addEventListener('input', () => this.updateCharCount());
  
      // Modal reset
      document.getElementById('testimonialModal')?.addEventListener('hidden.bs.modal', () => {
        this.resetForm();
      });
  
      // Form validation (on blur)
      form?.querySelectorAll('input[required], select[required], textarea[required]').forEach(input => {
        input.addEventListener('blur', () => this.validateField(input));
      });
    }
  
    populateYearOptions() {
      const yearSelect = document.getElementById('tahunLulusan');
      if (!yearSelect) return;
  
      const currentYear = new Date().getFullYear();
      for (let year = currentYear; year >= 2000; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
      }
    }
  
    handleDragOver(e) {
      e.preventDefault();
      document.getElementById('uploadArea')?.classList.add('dragover');
    }
  
    handleDragLeave(e) {
      e.preventDefault();
      document.getElementById('uploadArea')?.classList.remove('dragover');
    }
  
    handleDrop(e) {
      e.preventDefault();
      document.getElementById('uploadArea')?.classList.remove('dragover');
      if (e.dataTransfer.files.length > 0) this.processFile(e.dataTransfer.files[0]);
    }
  
    handleFileSelect(e) {
      if (e.target.files?.[0]) this.processFile(e.target.files[0]);
    }
  
    processFile(file) {
      if (file.size > 2 * 1024 * 1024) {
        this.showAlert('Ukuran file terlalu besar. Maksimal 2MB.', 'warning');
        return;
      }
      if (!file.type.startsWith('image/')) {
        this.showAlert('File harus berupa gambar.', 'warning');
        return;
      }
  
      const reader = new FileReader();
      reader.onload = (e) => {
        const previewImg = document.getElementById('previewImg');
        const imagePreview = document.getElementById('imagePreview');
        if (previewImg && imagePreview) {
          previewImg.src = e.target.result;
          imagePreview.classList.remove('d-none');
        }
      };
      reader.readAsDataURL(file);
    }
  
    updateCharCount() {
      const textarea = document.getElementById('testimoni');
      const charCount = document.getElementById('charCount');
      if (!textarea || !charCount) return;
  
      const length = textarea.value.length;
      charCount.textContent = length;
      charCount.style.color = length >= 50 ? '#28a745' : '#dc3545';
    }
  
    validateField(field) {
      const value = field.value.trim();
      let isValid = true;
  
      if (field.hasAttribute('required') && !value) {
        isValid = false;
      } else if (field.id === 'testimoni' && value.length < 50) {
        isValid = false;
      }
  
      field.classList.toggle('is-valid', isValid);
      field.classList.toggle('is-invalid', !isValid);
      return isValid;
    }
  
    validateForm() {
      const requiredFields = ['nama', 'jurusan', 'tahunLulusan', 'testimoni'];
      let isValid = true;
  
      requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field && !this.validateField(field)) isValid = false;
      });
  
      const photoInput = document.getElementById('foto');
      if (!photoInput?.files?.[0]) {
        this.showAlert('Foto alumni harus diupload.', 'warning');
        isValid = false;
      }
  
      return isValid;
    }
  
    async handleSubmit(e) {
      e.preventDefault();
      if (!this.validateForm()) return;
  
      const submitBtn = document.getElementById('submitBtn');
      const originalHTML = submitBtn.innerHTML;
  
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
  
      try {
        const formData = new FormData(e.target);
        const response = await this.submitTestimonial(formData);
  
        if (response.success) {
          this.addTestimonialToPage(response.data);
          bootstrap.Modal.getInstance(document.getElementById('testimonialModal'))?.hide();
          this.showAlert('Testimoni berhasil ditambahkan!', 'success', true);
        } else {
          this.showAlert(response.message || 'Gagal menambahkan testimoni.', 'error');
        }
      } catch (error) {
        console.error('Submit error:', error);
        this.showAlert('Terjadi kesalahan saat menyimpan testimoni.', 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalHTML;
      }
    }
  
    async submitTestimonial(formData) {
      const response = await fetch("{{ route('testimoni.store') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
          'Accept': 'application/json'
        },
        body: formData
      });
  
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return await response.json();
    }
  
    addTestimonialToPage(data) {
      const container = document.getElementById('testimonialsContainer');
      const emptyState = document.getElementById('emptyState');
      if (emptyState) emptyState.remove();

      const testimonialHTML = this.createTestimonialHTML(data);
      container.insertAdjacentHTML('afterbegin', testimonialHTML);
      container.firstElementChild.classList.add('animate-in');
    }

    createTestimonialHTML(data) {
      const now = new Date();
      const dateString = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
      return `
        <div class="col-lg-6 col-xl-4 mb-4" data-testimonial-id="${data.id}">
          <div class="card testimonial-card h-100 shadow-sm">
            <button type="button" class="delete-btn" onclick="deleteTestimonial(${data.id})">
              <i class="bi bi-trash"></i>
            </button>
            <div class="card-body d-flex flex-column text-center p-4">
              <div class="mb-3">
                <img src="${data.foto || 'https://via.placeholder.com/80'}"
                     alt="${data.nama_alumni}"
                     class="testimonial-avatar rounded-circle">
              </div>
              <div class="quote-block flex-grow-1 mb-3">
                <p class="testimonial-text mb-0">"${data.testimoni}"</p>
              </div>
              <div class="testimonial-author">
                <h6 class="fw-bold mb-1 text-primary">${data.nama_alumni}</h6>
                <p class="text-muted small mb-1">${data.jurusan}</p>
                <p class="text-primary fw-semibold small mb-1">Lulusan ${data.tahun_lulusan}</p>
                ${data.posisi_pekerjaan ? `<p class="text-success fw-semibold small mb-1">${data.posisi_pekerjaan}</p>` : ''}
                ${data.nama_perusahaan ? `<p class="text-info small mb-1">${data.nama_perusahaan}</p>` : ''}
                <p class="text-muted small mb-0">Dibuat pada ${dateString}</p>
              </div>
            </div>
          </div>
        </div>
      `;
    }
  
    resetForm() {
      const form = document.getElementById('testimonialForm');
      if (!form) return;
      form.reset();
  
      document.getElementById('imagePreview')?.classList.add('d-none');
      document.getElementById('charCount').textContent = '0';
  
      form.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.classList.remove('is-valid', 'is-invalid');
      });
    }
  
    initializeAnimations() {
      document.querySelectorAll('.testimonial-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-in');
      });
    }
  
    showAlert(message, type = 'info', reload = false) {
      const icons = { success: 'success', error: 'error', warning: 'warning', info: 'info' };
      const titles = { success: 'Berhasil!', error: 'Gagal!', warning: 'Peringatan!', info: 'Informasi' };
  
      Swal.fire({
        title: titles[type] || titles.info,
        text: message,
        icon: icons[type] || icons.info,
        confirmButtonText: 'OK',
        customClass: {
          popup: 'rounded-3',
          confirmButton: 'rounded-pill'
        }
      }).then(() => {
        if (reload && type === 'success') window.location.reload();
      });
    }
  }
  
  function deleteTestimonial(id) {
    Swal.fire({
      title: 'Hapus Testimoni?',
      text: 'Testimoni yang dihapus tidak dapat dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then(async (result) => {
      if (!result.isConfirmed) return;
      try {
        const response = await fetch(`{{ url('/testimoni') }}/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
          }
        });
        const data = await response.json();
        if (data.success) {
          document.querySelector(`[data-testimonial-id="${id}"]`)?.remove();
          Swal.fire('Terhapus!', 'Testimoni berhasil dihapus.', 'success').then(() => window.location.reload());
        } else {
          Swal.fire('Gagal!', 'Gagal menghapus testimoni.', 'error');
        }
      } catch {
        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus testimoni.', 'error');
      }
    });
  }
  
  // Initialize
  document.addEventListener('DOMContentLoaded', () => new TestimonialManager());
  </script>
  
@endpush