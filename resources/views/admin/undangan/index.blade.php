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
                        <i class="bi bi-envelope-paper text-white" style="font-size: 2.5rem;"></i>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">Event & Undangan</h1>
                    <p class="text-white-50 mb-0">Kelola undangan event untuk alumni dan siswa</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff9a9e, #fecfef);">
                                    <i class="bi bi-envelope text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Total Undangan</h6>
                                <h3 class="fw-bold mb-0 text-primary" id="total-count">{{ $undangans->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px; background: linear-gradient(45deg, #a8edea, #fed6e3);">
                                    <i class="bi bi-people text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Untuk Alumni</h6>
                                <h3 class="fw-bold mb-0 text-success" id="alumni-count">{{ $undangans->where('role_target', 'like', '%alumni%')->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px; background: linear-gradient(45deg, #ffecd2, #fcb69f);">
                                    <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Untuk Siswa</h6>
                                <h3 class="fw-bold mb-0 text-warning" id="siswa-count">{{ $undangans->where('role_target', 'like', '%siswa%')->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="card border-0 shadow-xl" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 24px;">
            <div class="card-body p-0">
                <!-- Search and Filter Section -->
                <div class="p-4 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="position-relative">
                                <input type="text"
                                       id="searchInput"
                                       class="form-control form-control-lg border-0 shadow-sm ps-5"
                                       placeholder="Cari judul undangan..."
                                       onkeyup="searchTable()"
                                       style="background: #f8fafc; border-radius: 16px;">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <a href="{{ route('admin.undangan.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold" style="background: linear-gradient(45deg, #4F46E5, #7C3AED); border: none;">
                                <i class="bi bi-plus-circle me-2"></i>Buat Undangan Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="undanganTable">
                        <thead class="text-white position-sticky top-0" style="background: linear-gradient(90deg, #4F46E5, #7C3AED); z-index: 10;">
                            <tr>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-hash me-2"></i>No
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope me-2"></i>Judul
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark me-2"></i>Gambar
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-people me-2"></i>Target
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-gear me-2"></i>Aksi
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($undangans as $index => $undangan)
                            <tr class="undangan-row">
                                <td class="py-4 px-4">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="width: 40px; height: 40px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 12px;">
                                        <span class="text-white fw-bold">{{ $index + 1 }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width: 48px; height: 48px; background: linear-gradient(45deg, #ffeaa7, #fab1a0);">
                                            <i class="bi bi-envelope-fill text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $undangan->judul }}</h6>
                                            <p class="text-muted small mb-0">{{ Str::limit($undangan->deskripsi, 50) }}</p>
                                            <small class="text-muted">{{ $undangan->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @if($undangan->gambar)
                                        @php
                                            $extension = pathinfo($undangan->gambar, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                        @endphp
                                        @if($isImage)
                                            <button type="button"
                                                    class="btn btn-outline-primary rounded-pill shadow-sm position-relative overflow-hidden"
                                                    onclick="showImageModal('{{ asset('storage/' . $undangan->gambar) }}', '{{ $undangan->judul }}')">
                                                <i class="bi bi-eye me-2"></i>
                                                Lihat Gambar
                                            </button>
                                        @else
                                            <a href="{{ asset('storage/' . $undangan->gambar) }}" target="_blank" class="btn btn-outline-secondary rounded-pill shadow-sm">
                                                <i class="bi bi-file-earmark-pdf me-2"></i>
                                                Lihat PDF
                                            </a>
                                        @endif
                                    @else
                                        <div class="d-flex align-items-center text-muted">
                                            <i class="bi bi-image me-2"></i>
                                            <span>Tidak ada file</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    @if($undangan->role_target)
                                        @foreach($undangan->role_target as $role)
                                            @if($role == 'alumni')
                                                <span class="badge rounded-pill px-3 py-2 fw-semibold shadow-sm me-1"
                                                      style="background: linear-gradient(45deg, #00b894, #00cec9); color: white;">
                                                    <i class="bi bi-person me-1"></i>Alumni
                                                </span>
                                            @elseif($role == 'siswa')
                                                <span class="badge rounded-pill px-3 py-2 fw-semibold shadow-sm me-1"
                                                      style="background: linear-gradient(45deg, #fdcb6e, #e17055); color: white;">
                                                    <i class="bi bi-person me-1"></i>Siswa
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        <a href="{{ route('admin.undangan.show', $undangan->id) }}"
                                           class="btn btn-info rounded-start-pill px-3 py-2 fw-semibold"
                                           data-bs-toggle="tooltip"
                                           title="Lihat Detail">
                                            <i class="bi bi-eye me-1"></i>
                                            Lihat
                                        </a>
                                        <form action="{{ route('admin.undangan.destroy', $undangan->id) }}" method="POST" style="display:inline-block;" class="delete-undangan-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger rounded-end-pill px-3 py-2 fw-semibold"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Undangan">
                                                <i class="bi bi-trash me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if($undangans->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-envelope-slash text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada undangan</h5>
                    <p class="text-muted">Belum ada undangan yang dibuat.</p>
                    <a href="{{ route('admin.undangan.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                        <i class="bi bi-plus-circle me-2"></i>Buat Undangan Pertama
                    </a>
                </div>
                @endif
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

    // Delete forms
    const deleteForms = document.querySelectorAll('.delete-undangan-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda yakin ingin menghapus undangan ini?",
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
                    form.submit();
                }
            });
        });
    });

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

// Search function
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('undanganTable');
    const trs = table.tBodies[0].getElementsByTagName('tr');

    for (let i = 0; i < trs.length; i++) {
        const td = trs[i].getElementsByTagName('td')[1]; // Judul column
        if (td) {
            const textValue = td.textContent || td.innerText;
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                trs[i].style.display = '';
            } else {
                trs[i].style.display = 'none';
            }
        }
    }
}

// Show image modal
function showImageModal(imageUrl, title) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');

    modalImage.src = imageUrl;
    modalTitle.textContent = title;

    modal.show();
}

// Add smooth scrolling and animations
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
document.querySelectorAll('.undangan-row').forEach(row => {
    row.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.01)';
        this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
        this.style.transition = 'all 0.3s ease';
    });

    row.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.boxShadow = 'none';
    });
});

// Function to update counts
function updateCounts() {
    fetch('{{ route("admin.undangan.counts") }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-count').textContent = data.total;
            document.getElementById('alumni-count').textContent = data.alumni;
            document.getElementById('siswa-count').textContent = data.siswa;
        })
        .catch(error => console.error('Error fetching counts:', error));
}

// Update counts every 5 seconds
setInterval(updateCounts, 5000);
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
    .card:nth-child(3) { animation-delay: 0.3s; }

    /* Custom scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: linear-gradient(90deg, #4F46E5, #7C3AED);
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(90deg, #3730A3, #5B21B6);
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

    /* Button hover effects */
    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Table row hover */
    .table-hover tbody tr:hover {
        background-color: rgba(79, 70, 229, 0.05);
        transform: scale(1.005);
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
