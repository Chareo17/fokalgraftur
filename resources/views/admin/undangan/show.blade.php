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
                        <i class="bi bi-eye text-white" style="font-size: 2.5rem;"></i>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">Detail Undangan</h1>
                    <p class="text-white-50 mb-0">Informasi lengkap undangan event</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Undangan Card -->
                <div class="card border-0 shadow-xl mb-4" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 24px;">
                    <div class="card-body p-5">
                        <!-- Header Info -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-4"
                                         style="width: 60px; height: 60px; background: linear-gradient(45deg, #ffeaa7, #fab1a0);">
                                        <i class="bi bi-envelope-fill text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h2 class="fw-bold mb-1 text-dark">{{ $undangan->judul }}</h2>
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-calendar me-1"></i>Dibuat pada {{ $undangan->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="d-flex flex-column align-items-md-end">
                                    <small class="text-muted mb-2">Dibuat oleh</small>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                                             style="width: 32px; height: 32px; background: linear-gradient(45deg, #667eea, #764ba2);">
                                            <i class="bi bi-person text-white" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $author }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Target Recipients -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="bi bi-people me-2"></i>Target Penerima
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                @if($undangan->role_target)
                                    @foreach($undangan->role_target as $role)
                                        @if($role == 'alumni')
                                            <span class="badge rounded-pill px-4 py-2 fw-semibold shadow-sm"
                                                  style="background: linear-gradient(45deg, #00b894, #00cec9); color: white; font-size: 0.9rem;">
                                                <i class="bi bi-person me-1"></i>Alumni
                                            </span>
                                        @elseif($role == 'siswa')
                                            <span class="badge rounded-pill px-4 py-2 fw-semibold shadow-sm"
                                                  style="background: linear-gradient(45deg, #fdcb6e, #e17055); color: white; font-size: 0.9rem;">
                                                <i class="bi bi-person me-1"></i>Siswa
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="bi bi-file-text me-2"></i>Deskripsi
                            </h5>
                            <div class="card border-0" style="background: #f8fafc; border-radius: 16px;">
                                <div class="card-body p-4">
                                    <p class="mb-0 text-dark lh-base">{{ $undangan->deskripsi }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Attachment -->
                        @if($undangan->gambar)
                            <div class="mb-4">
                                <h5 class="fw-bold text-dark mb-3">
                                    <i class="bi bi-paperclip me-2"></i>Lampiran
                                </h5>
                                @php
                                    $extension = pathinfo($undangan->gambar, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                @endphp
                                <div class="card border-0" style="background: #f8fafc; border-radius: 16px;">
                                    <div class="card-body p-4">
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
                                            <div class="d-flex gap-2">
                                                @if($isImage)
                                                    <button type="button"
                                                            class="btn btn-primary rounded-pill px-4 py-2 fw-semibold"
                                                            onclick="showImageModal('{{ asset('storage/' . $undangan->gambar) }}', '{{ $undangan->judul }}')">
                                                        <i class="bi bi-eye me-2"></i>Lihat Gambar
                                                    </button>
                                                @else
                                                    <a href="{{ asset('storage/' . $undangan->gambar) }}"
                                                       target="_blank"
                                                       class="btn btn-secondary rounded-pill px-4 py-2 fw-semibold">
                                                        <i class="bi bi-file-earmark-pdf me-2"></i>Buka PDF
                                                    </a>
                                                @endif
                                                <a href="{{ asset('storage/' . $undangan->gambar) }}"
                                                   download="{{ pathinfo($undangan->gambar, PATHINFO_BASENAME) }}"
                                                   class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
                                                    <i class="bi bi-download me-2"></i>Unduh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.undangan.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                            <div class="btn-group shadow-sm" role="group">
                                <a href="{{ route('admin.undangan.edit', $undangan->id) }}"
                                   class="btn btn-warning rounded-start-pill px-4 py-2 fw-semibold"
                                   data-bs-toggle="tooltip"
                                   title="Edit Undangan">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.undangan.destroy', $undangan->id) }}" method="POST" style="display:inline-block;" class="delete-undangan-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger rounded-end-pill px-4 py-2 fw-semibold"
                                            data-bs-toggle="tooltip"
                                            title="Hapus Undangan">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card border-0 shadow-xl" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 24px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-dark mb-4">
                            <i class="bi bi-bar-chart me-2"></i>Statistik Undangan
                        </h5>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 60px; height: 60px; background: linear-gradient(45deg, #667eea, #764ba2);">
                                        <i class="bi bi-eye text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h4 class="fw-bold text-primary mb-1">{{ $undangan->id }}</h4>
                                    <p class="text-muted small mb-0">ID Undangan</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 60px; height: 60px; background: linear-gradient(45deg, #00b894, #00cec9);">
                                        <i class="bi bi-calendar-check text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h4 class="fw-bold text-success mb-1">{{ $undangan->created_at->format('d M') }}</h4>
                                    <p class="text-muted small mb-0">Tanggal Dibuat</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 60px; height: 60px; background: linear-gradient(45deg, #fdcb6e, #e17055);">
                                        <i class="bi bi-clock text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h4 class="fw-bold text-warning mb-1">{{ $undangan->created_at->format('H:i') }}</h4>
                                    <p class="text-muted small mb-0">Waktu Dibuat</p>
                                </div>
                            </div>
                        </div>
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
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Delete form
    const deleteForm = document.querySelector('.delete-undangan-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda yakin ingin menghapus undangan ini? Tindakan ini tidak dapat dibatalkan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e17055",
                cancelButtonColor: "#ddd",
                confirmButtonText: '<i class="bi bi-trash me-2"></i>Ya, Hapus!',
                cancelButtonText: '<i class="bi bi-arrow-left me-2"></i>Batal',
                reverseButtons: true,
                backdrop: `rgba(0,0,0,0.7)`,
                customClass: {
                    popup: 'rounded-4 shadow-xl',
                    confirmButton: 'rounded-pill px-4',
                    cancelButton: 'rounded-pill px-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang menghapus undangan',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-4'
                        },
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    deleteForm.submit();
                }
            });
        });
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

// Add smooth animations
document.addEventListener('scroll', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        const rect = card.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            card.style.transform = 'translateY(0)';
            card.style.opacity = '1';
        }
    });
});

// Add hover effects
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
        this.style.transition = 'all 0.3s ease';
    });

    btn.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});
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
        animation: fadeInUp 0.6s ease forwards;
        transform: translateY(30px);
        opacity: 0;
    }

    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }

    /* Glassmorphism effect */
    .card {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    /* Smooth transitions */
    * {
        transition: all 0.3s ease;
    }

    /* Button hover effects */
    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Badge styling */
    .badge {
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* Card styling */
    .card {
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
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

    /* Custom scrollbar */
    .card::-webkit-scrollbar {
        width: 6px;
    }

    .card::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .card::-webkit-scrollbar-thumb {
        background: linear-gradient(90deg, #4F46E5, #7C3AED);
        border-radius: 10px;
    }

    .card::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(90deg, #3730A3, #5B21B6);
    }
</style>
@endpush
