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
                        <i class="bi bi-shield-check text-white" style="font-size: 2.5rem;"></i>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">Validasi Donasi Alumni</h1>
                    <p class="text-white-50 mb-0">Kelola dan validasi donasi dari alumni dengan mudah</p>
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
                                    <i class="bi bi-clock-history text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Menunggu Validasi</h6>
                                <h3 class="fw-bold mb-0 text-primary">{{ $donations->where('status', 'belum divalidasi')->count() }}</h3>
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
                                    <i class="bi bi-check-circle text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Tervalidasi</h6>
                                <h3 class="fw-bold mb-0 text-success">{{ $donations->where('status', 'divalidasi')->count() }}</h3>
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
                                    <i class="bi bi-currency-dollar text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Total Donasi</h6>
                                <h3 class="fw-bold mb-0 text-warning">Rp {{ number_format($donations->where('status', 'divalidasi')->sum('nominal'), 0, ',', '.') }}</h3>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#withdrawalModal">
                                    <i class="bi bi-dash-circle me-1"></i>Penarikan
                                </button>
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
                                       placeholder="Cari nama donatur..." 
                                       onkeyup="searchTable()"
                                       style="background: #f8fafc; border-radius: 16px;">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="btn-group shadow-sm" role="group">
                                <input type="radio" class="btn-check" name="statusFilter" id="all" autocomplete="off" checked onclick="filterByStatus('all')">
                                <label class="btn btn-outline-primary rounded-start-pill" for="all">Semua</label>
                                
                                <input type="radio" class="btn-check" name="statusFilter" id="pending" autocomplete="off" onclick="filterByStatus('belum divalidasi')">
                                <label class="btn btn-outline-primary" for="pending">Pending</label>
                                
                                <input type="radio" class="btn-check" name="statusFilter" id="validated" autocomplete="off" onclick="filterByStatus('divalidasi')">
                                <label class="btn btn-outline-primary" for="validated">Validated</label>
                                
                                <input type="radio" class="btn-check" name="statusFilter" id="rejected" autocomplete="off" onclick="filterByStatus('ditolak')">
                                <label class="btn btn-outline-primary rounded-end-pill" for="rejected">Rejected</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="donasiTable">
                        <thead class="text-white position-sticky top-0" style="background: linear-gradient(90deg, #4F46E5, #7C3AED); z-index: 10;">
                            <tr>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-hash me-2"></i>No
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person me-2"></i>Nama Donatur
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-image me-2"></i>Bukti Transfer
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-currency-dollar me-2"></i>Nominal
                                    </div>
                                </th>
                                <th class="py-4 px-4 fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-check me-2"></i>Status
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
                        @foreach($donations as $index => $donation)
                        @php
                            // Cek dan bersihkan path gambar
                            $gambarUrl = null;
                            $actualPath = null;
                            $fileExists = false;
                            
                            if ($donation->gambar_donasi) {
                                // Bersihkan path dari kemungkinan duplikasi
                                $cleanPath = str_replace(['storage/', 'donations/donations/', 'public/'], '', $donation->gambar_donasi);
                                
                                // Pastikan path dimulai dengan donations/
                                if (!str_starts_with($cleanPath, 'donations/')) {
                                    $cleanPath = 'donations/' . $cleanPath;
                                }
                                
                                // Cek apakah file benar-benar ada
                                $fullPath = public_path('storage/' . $cleanPath);
                                $fileExists = file_exists($fullPath);
                                
                                // Set URL
                                $gambarUrl = asset('storage/' . $cleanPath);
                                $actualPath = 'storage/' . $cleanPath;
                            }
                        @endphp
                            <tr class="donation-row" data-status="{{ $donation->status }}">
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
                                            <i class="bi bi-person-fill text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $donation->nama ? $donation->nama : 'Anonymous' }}</h6>
                                            <p class="text-muted small mb-0">{{ $donation->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @if($donation->gambar_donasi)
                                        <button type="button" 
                                                class="btn btn-outline-primary rounded-pill shadow-sm position-relative overflow-hidden"
                                                onclick="showImageModal('{{ $gambarUrl }}', '{{ $donation->nama ? $donation->nama : 'Anonymous' }}')"
                                                style="border: 2px solid; background: linear-gradient(45deg, rgba(79, 70, 229, 0.1), rgba(124, 58, 237, 0.1));">
                                            <i class="bi bi-eye me-2"></i>
                                            Lihat Bukti
                                            <div class="position-absolute top-0 end-0 translate-middle">
                                                @if($fileExists)
                                                    <span class="badge bg-success rounded-circle" style="width: 12px; height: 12px;"></span>
                                                @else
                                                    <span class="badge bg-danger rounded-circle" style="width: 12px; height: 12px;"></span>
                                                @endif
                                            </div>
                                        </button>
                                    @else
                                        <div class="d-flex align-items-center text-muted">
                                            <i class="bi bi-image me-2"></i>
                                            <span>Tidak ada bukti</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-center">
                                        <span class="badge fs-6 px-3 py-2 fw-bold" 
                                              style="background: linear-gradient(45deg, #00b894, #00cec9); border-radius: 12px;">
                                            Rp {{ number_format($donation->nominal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @if($donation->status == 'belum divalidasi')
                                        <span class="badge rounded-pill px-3 py-2 fw-semibold shadow-sm" 
                                              style="background: linear-gradient(45deg, #fdcb6e, #e17055); color: white;">
                                            <i class="bi bi-clock me-1"></i>Pending
                                        </span>
                                    @elseif($donation->status == 'divalidasi')
                                        <span class="badge rounded-pill px-3 py-2 fw-semibold shadow-sm" 
                                              style="background: linear-gradient(45deg, #00b894, #00cec9); color: white;">
                                            <i class="bi bi-check-circle me-1"></i>Validated
                                        </span>
                                    @elseif($donation->status == 'ditolak')
                                        <span class="badge rounded-pill px-3 py-2 fw-semibold shadow-sm" 
                                              style="background: linear-gradient(45deg, #e17055, #d63031); color: white;">
                                            <i class="bi bi-x-circle me-1"></i>Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($donation->status == 'belum divalidasi')
                                        <div class="btn-group shadow-sm" role="group">
                                            <form action="{{ route('donasi.validate', $donation->id) }}" method="POST" style="display:inline-block;" class="validate-donation-form">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-success rounded-start-pill px-3 py-2 fw-semibold" 
                                                        data-bs-toggle="tooltip" 
                                                        title="Terima Donasi"
                                                        style="background: linear-gradient(45deg, #00b894, #00cec9); border: none;">
                                                    <i class="bi bi-check-lg me-1"></i>
                                                    Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('donasi.reject', $donation->id) }}" method="POST" style="display:inline-block;" class="reject-donation-form">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-danger rounded-end-pill px-3 py-2 fw-semibold" 
                                                        data-bs-toggle="tooltip" 
                                                        title="Tolak Donasi"
                                                        style="background: linear-gradient(45deg, #e17055, #d63031); border: none;">
                                                    <i class="bi bi-x-lg me-1"></i>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="text-muted d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check-all me-2"></i>
                                            <span>Sudah diproses</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if($donations->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada data donasi</h5>
                    <p class="text-muted">Belum ada donasi yang perlu divalidasi.</p>
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
                    <i class="bi bi-image me-2"></i>Bukti Transfer - <span id="modalDonorName"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" alt="Bukti Transfer" class="img-fluid w-100" style="max-height: 70vh; object-fit: contain;">
            </div>
            <div class="modal-footer border-0 justify-content-center" style="background: #f8fafc;">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x me-2"></i>Tutup
                </button>
                <a id="downloadLink" href="" download class="btn btn-primary rounded-pill px-4" style="background: linear-gradient(45deg, #4F46E5, #7C3AED); border: none;">
                    <i class="bi bi-download me-2"></i>Download
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Withdrawal Modal -->
<div class="modal fade" id="withdrawalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-xl" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0" style="background: linear-gradient(90deg, #dc3545, #c82333);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-dash-circle me-2"></i>Penarikan Dana
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('donasi.withdrawal') }}" method="POST" id="withdrawalForm">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="nominal" class="form-label fw-semibold">Jumlah Penarikan (Rp)</label>
                        <input type="number" class="form-control form-control-lg" id="nominal" name="nominal" placeholder="Masukkan jumlah penarikan" min="1" max="1000000000" required style="border-radius: 12px;">
                        <div class="form-text">Minimal Rp 1, maksimal Rp 1.000.000.000</div>
                    </div>
                    <div class="mb-3">
                        <label for="alasan" class="form-label fw-semibold">Alasan Penarikan (Opsional)</label>
                        <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Jelaskan alasan penarikan..." style="border-radius: 12px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center" style="background: #f8fafc;">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4" style="background: linear-gradient(45deg, #dc3545, #c82333); border: none;">
                        <i class="bi bi-dash-circle me-2"></i>Konfirmasi Penarikan
                    </button>
                </div>
            </form>
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

    // Validate forms
    const validateForms = document.querySelectorAll('.validate-donation-form');
    validateForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Konfirmasi Validasi",
                text: "Apakah Anda yakin ingin menerima donasi ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#00b894",
                cancelButtonColor: "#ddd",
                confirmButtonText: '<i class="bi bi-check me-2"></i>Ya, Terima!',
                cancelButtonText: '<i class="bi bi-x me-2"></i>Batal',
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
                        text: 'Sedang memvalidasi donasi',
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

    // Reject forms
    const rejectForms = document.querySelectorAll('.reject-donation-form');
    rejectForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Konfirmasi Penolakan",
                text: "Apakah Anda yakin ingin menolak donasi ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e17055",
                cancelButtonColor: "#ddd",
                confirmButtonText: '<i class="bi bi-x me-2"></i>Ya, Tolak!',
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
                        text: 'Sedang menolak donasi',
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

    // Withdrawal form
    const withdrawalForm = document.getElementById('withdrawalForm');
    if (withdrawalForm) {
        withdrawalForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const nominal = document.getElementById('nominal').value;
            Swal.fire({
                title: "Konfirmasi Penarikan",
                text: `Apakah Anda yakin ingin menarik Rp ${nominal.toLocaleString('id-ID')}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#ddd",
                confirmButtonText: '<i class="bi bi-dash-circle me-2"></i>Ya, Tarik!',
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
                        text: 'Sedang memproses penarikan',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-4'
                        },
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    withdrawalForm.submit();
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
    @elseif(session('rejected'))
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session('rejected') }}",
        icon: "success",
        confirmButtonColor: "#00b894",
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
    const table = document.getElementById('donasiTable');
    const trs = table.tBodies[0].getElementsByTagName('tr');

    for (let i = 0; i < trs.length; i++) {
        const td = trs[i].getElementsByTagName('td')[1]; // Nama Donasi column
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

// Filter by status function
function filterByStatus(status) {
    const rows = document.querySelectorAll('.donation-row');
    
    rows.forEach(row => {
        if (status === 'all' || row.getAttribute('data-status') === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Show image modal
function showImageModal(imageUrl, donorName) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImage = document.getElementById('modalImage');
    const modalDonorName = document.getElementById('modalDonorName');
    const downloadLink = document.getElementById('downloadLink');
    
    modalImage.src = imageUrl;
    modalDonorName.textContent = donorName;
    downloadLink.href = imageUrl;
    
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
document.querySelectorAll('.donation-row').forEach(row => {
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