@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px; margin-top: 60px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-pencil-square text-white" style="font-size: 2.5rem;"></i>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">Edit Undangan</h1>
                    <p class="text-white-50 mb-0">Perbarui informasi undangan event</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-xl" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 24px;">
                    <div class="card-body p-5">
                        <form action="{{ route('admin.undangan.update', $undangan->id) }}" method="POST" enctype="multipart/form-data" id="undanganForm">
                            @csrf
                            @method('PUT')

                            <!-- Judul Field -->
                            <div class="mb-4">
                                <label for="judul" class="form-label fw-semibold text-dark mb-3">
                                    <i class="bi bi-envelope me-2"></i>Judul Undangan
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text border-0" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white;">
                                        <i class="bi bi-envelope-fill"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control border-0 shadow-sm @error('judul') is-invalid @enderror"
                                           id="judul"
                                           name="judul"
                                           value="{{ old('judul', $undangan->judul) }}"
                                           placeholder="Masukkan judul undangan..."
                                           style="background: #f8fafc; border-radius: 0 12px 12px 0;"
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Deskripsi Field -->
                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-semibold text-dark mb-3">
                                    <i class="bi bi-file-text me-2"></i>Deskripsi
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white;">
                                        <i class="bi bi-file-text-fill"></i>
                                    </span>
                                    <textarea class="form-control border-0 shadow-sm @error('deskripsi') is-invalid @enderror"
                                              id="deskripsi"
                                              name="deskripsi"
                                              rows="4"
                                              placeholder="Masukkan deskripsi undangan..."
                                              style="background: #f8fafc; border-radius: 0 12px 12px 0;"
                                              required>{{ old('deskripsi', $undangan->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Current Gambar Display -->
                            @if($undangan->gambar)
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-3">
                                        <i class="bi bi-image me-2"></i>Gambar Saat Ini
                                    </label>
                                    <div class="card border-0" style="background: #f8fafc; border-radius: 16px;">
                                        <div class="card-body p-4">
                                            @php
                                                $extension = pathinfo($undangan->gambar, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                            @endphp
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    @if($isImage)
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                             style="width: 48px; height: 48px; background: linear-gradient(45deg, #667eea, #764ba2);">
                                                            <i class="bi bi-image text-white"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold text-dark">Gambar Undangan</h6>
                                                            <p class="mb-0 text-muted small">Klik untuk melihat gambar</p>
                                                        </div>
                                                    @else
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                             style="width: 48px; height: 48px; background: linear-gradient(45deg, #e17055, #fdcb6e);">
                                                            <i class="bi bi-file-earmark-pdf text-white"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold text-dark">Dokumen PDF</h6>
                                                            <p class="mb-0 text-muted small">Klik untuk membuka PDF</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if($isImage)
                                                        <button type="button"
                                                                class="btn btn-outline-primary rounded-pill px-3 py-2 fw-semibold"
                                                                onclick="showImageModal('{{ asset('storage/' . $undangan->gambar) }}', '{{ $undangan->judul }}')">
                                                            <i class="bi bi-eye me-1"></i>Lihat
                                                        </button>
                                                    @else
                                                        <a href="{{ asset('storage/' . $undangan->gambar) }}"
                                                           target="_blank"
                                                           class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold">
                                                            <i class="bi bi-file-earmark-pdf me-1"></i>Buka
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Gambar Field -->
                            <div class="mb-4">
                                <label for="gambar" class="form-label fw-semibold text-dark mb-3">
                                    <i class="bi bi-upload me-2"></i>{{ $undangan->gambar ? 'Ganti Gambar (Opsional)' : 'Gambar Undangan (Opsional)' }}
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white;">
                                        <i class="bi bi-upload"></i>
                                    </span>
                                    <input type="file"
                                           class="form-control border-0 shadow-sm @error('gambar') is-invalid @enderror"
                                           id="gambar"
                                           name="gambar"
                                           accept="image/*,application/pdf"
                                           style="background: #f8fafc; border-radius: 0 12px 12px 0;">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text text-muted mt-2">
                                    <i class="bi bi-info-circle me-1"></i>Biarkan kosong jika tidak ingin mengubah gambar. Format yang didukung: JPG, PNG, PDF. Maksimal 10MB.
                                </div>
                            </div>

                            <!-- Role Target Field -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-3">
                                    <i class="bi bi-people me-2"></i>Target Penerima
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-lg">
                                            <input class="form-check-input @error('role_target') is-invalid @enderror"
                                                   type="checkbox"
                                                   id="alumni"
                                                   name="role_target[]"
                                                   value="alumni"
                                                   {{ in_array('alumni', old('role_target', $undangan->role_target ?? [])) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="alumni">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                         style="width: 40px; height: 40px; background: linear-gradient(45deg, #00b894, #00cec9);">
                                                        <i class="bi bi-person text-white"></i>
                                                    </div>
                                                    Alumni
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-lg">
                                            <input class="form-check-input @error('role_target') is-invalid @enderror"
                                                   type="checkbox"
                                                   id="siswa"
                                                   name="role_target[]"
                                                   value="siswa"
                                                   {{ in_array('siswa', old('role_target', $undangan->role_target ?? [])) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="siswa">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                         style="width: 40px; height: 40px; background: linear-gradient(45deg, #fdcb6e, #e17055);">
                                                        <i class="bi bi-person text-white"></i>
                                                    </div>
                                                    Siswa
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('role_target')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted mt-2">
                                    <i class="bi bi-info-circle me-1"></i>Pilih minimal satu target penerima undangan.
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.undangan.show', $undangan->id) }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold" style="background: linear-gradient(45deg, #4F46E5, #7C3AED); border: none;">
                                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-xl" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0" style="background: linear-gradient(90deg, #4F46E5, #7C3AED);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-image me-2"></i>Gambar Undangan - <span id="modalTitle"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" alt="Gambar Undangan" class="img-fluid w-100" style="max-height: 70vh; object-fit: contain;">
            </div>
            <div class="modal-footer border-0 justify-content-center" style="background: #f8fafc;">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('undanganForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Validate checkboxes
        const checkboxes = document.querySelectorAll('input[name="role_target[]"]:checked');
        if (checkboxes.length === 0) {
            Swal.fire({
                title: "Pilih Target",
                text: "Pilih minimal satu target penerima undangan.",
                icon: "warning",
                confirmButtonColor: "#fdcb6e",
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-4 shadow-xl',
                    confirmButton: 'rounded-pill px-4'
                }
            });
            return;
        }

        // Show loading
        Swal.fire({
            title: 'Memproses...',
            text: 'Sedang menyimpan perubahan',
            allowOutsideClick: false,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-4'
            },
            didOpen: () => {
                Swal.showLoading()
            }
        });

        form.submit();
    });

    // File input preview
    const fileInput = document.getElementById('gambar');
    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB

            // Show file info
            const fileInfo = document.createElement('div');
            fileInfo.className = 'alert alert-info mt-2 rounded-pill';
            fileInfo.innerHTML = `<i class="bi bi-file-earmark me-2"></i>${fileName} (${fileSize} MB)`;

            // Remove previous file info
            const existingInfo = fileInput.parentNode.querySelector('.alert');
            if (existingInfo) {
                existingInfo.remove();
            }

            fileInput.parentNode.appendChild(fileInfo);
        }
    });

    // Character counter for textarea
    const textarea = document.getElementById('deskripsi');
    const maxLength = 1000; // Set max length if needed

    textarea.addEventListener('input', function () {
        const length = this.value.length;
        if (length > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }
    });

    // Add smooth animations
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.02)';
            this.style.transition = 'all 0.3s ease';
        });

        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Checkbox animations
    const checkboxes = document.querySelectorAll('.form-check-input');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.style.transform = 'scale(1.05)';
                label.style.transition = 'all 0.3s ease';
            } else {
                label.style.transform = 'scale(1)';
            }
        });
    });
});

// Show image modal
function showImageModal(imageUrl, title) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');

    modalImage.src = imageUrl;
    modalTitle.textContent = title;

    modal.show();
}

// Success/Error notifications
@if(session('success'))
Swal.fire({
    title: "Berhasil!",
    text: "{{ session('success') }}",
    icon: "success",
    confirmButtonColor: "#00b894",
    confirmButtonText: 'OK',
    customClass: {
        popup: 'rounded-4 shadow-xl',
        confirmButton: 'rounded-pill px-4'
    }
});
@elseif(session('error'))
Swal.fire({
    title: "Error!",
    text: "{{ session('error') }}",
    icon: "error",
    confirmButtonColor: "#e17055",
    confirmButtonText: 'OK',
    customClass: {
        popup: 'rounded-4 shadow-xl',
        confirmButton: 'rounded-pill px-4'
    }
});
@endif
</script>

<style>
    /* Custom Animations */
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

    .card {
        animation: fadeInUp 0.8s ease forwards;
        transform: translateY(30px);
        opacity: 0;
    }

    /* Glassmorphism effect */
    .card {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    /* Smooth transitions */
    * {
        transition: all 0.3s ease;
    }

    /* Input focus effects */
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        border-color: #4F46E5;
    }

    /* Button hover effects */
    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Checkbox styling */
    .form-check-input:checked {
        background-color: #4F46E5;
        border-color: #4F46E5;
    }

    .form-check-input:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
    }

    /* Alert styling */
    .alert {
        border: none;
        border-radius: 12px;
    }

    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 6px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: linear-gradient(90deg, #4F46E5, #7C3AED);
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(90deg, #3730A3, #5B21B6);
    }

    /* Modal animations */
    .modal.fade .modal-dialog {
        transform: scale(0.8) translateY(-50px);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .modal.show .modal-dialog {
        transform: scale(1) translateY(0);
        opacity: 1;
    }
</style>
@endpush
