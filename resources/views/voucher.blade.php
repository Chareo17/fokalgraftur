@extends('layouts.app')

@section('content')
<div class="voucher-wrapper">
    <!-- Hero Section -->
    <div class="voucher-hero">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content text-center text-white">
                <div class="hero-icon"  style="margin-top: 100px;">
                    <i class="bi bi-ticket-perforated-fill"></i>
                </div>
                <h1 class="hero-title mb-3" style="color: #f8f7f7;">Voucher Management</h1>

                {{-- <p class="hero-subtitle mb-0">Kelola voucher Anda dengan mudah dan elegant</p> --}}
            </div>
            

        </div>
    </div>

    <!-- Main Content -->
    <div class="container voucher-container">
        @php
            $isLoggedIn = Auth::guard('admin')->check() || Auth::guard('alumni')->check() || Auth::guard('siswa')->check() || Auth::guard('web')->check();
            $isAdmin = Auth::guard('admin')->check();
        @endphp


        @if($isAdmin)
        <!-- Add Voucher Form - Admin Only -->
        <div class="add-voucher-section">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-card">
                        <div class="form-header">
                            <h2 class="form-title">
                                <i class="bi bi-plus-circle me-2"></i>
                                Tambah Voucher Baru
                            </h2>
                            <p class="form-subtitle">Buat voucher menarik untuk pelanggan Anda</p>
                        </div>

                        <form class="voucher-form" id="voucherForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <!-- Image Upload -->
                                <div class="col-12">
                                    <label class="form-label">Gambar Voucher</label>
                                    <div class="image-upload-area">
                                        <input type="file" name="gambar" id="voucherImage" class="image-input" accept="image/jpeg,image/png,image/jpg,image/gif">
                                        <div class="upload-placeholder">
                                            <i class="bi bi-cloud-upload"></i>
                                            <h5>Upload Gambar</h5>
                                            <p>Drag & drop atau klik untuk memilih gambar</p>
                                            <span class="file-info">PNG, JPG hingga 2MB</span>
                                        </div>
                                        <div class="image-preview" style="display: none;">
                                            <img id="previewImg" src="" alt="Preview">
                                            <button type="button" class="btn-remove" onclick="removeImage()">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-lg-6">
                                    <label for="judul" class="form-label">Judul Voucher</label>
                                    <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul voucher" required>
                                </div>

                                <!-- Discount Type -->
                                <div class="col-lg-6">
                                    <label for="tipe_diskon" class="form-label">Tipe Diskon</label>
                                    <select class="form-select" name="tipe_diskon" id="tipe_diskon" required>
                                        <option value="">Pilih tipe diskon</option>
                                        <option value="percentage">Persentase (%)</option>
                                        <option value="fixed">Nominal Tetap (Rp)</option>
                                    </select>
                                </div>

                                <!-- Discount Value -->
                                <div class="col-lg-6">
                                    <label for="diskon" class="form-label">Nilai Diskon</label>
                                    <input type="number" class="form-control" name="diskon" id="diskon" placeholder="Masukkan nilai diskon" required min="1" max="100">
                                </div>

                                <!-- Minimum Purchase -->
                                <div class="col-lg-6">
                                    <label for="minimal_belanja" class="form-label">Minimal Belanja <span class="text-muted">(Opsional)</span></label>
                                    <input type="number" class="form-control" name="minimal_belanja" id="minimal_belanja" placeholder="0" min="0">
                                </div>

                                <!-- Expiry Date -->
                                <div class="col-lg-6">
                                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                                    <input type="date" class="form-control" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" required>
                                </div>

                                <!-- Usage Limit -->
                                <div class="col-lg-6">
                                    <label for="batas_penggunaan" class="form-label">Batas Penggunaan <span class="text-muted">(Opsional)</span></label>
                                    <input type="number" class="form-control" name="batas_penggunaan" id="batas_penggunaan" placeholder="Kosongkan untuk unlimited" min="1">
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">Deskripsi Voucher</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Jelaskan detail voucher, syarat dan ketentuan" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Buat Voucher
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Voucher Results -->
        <div class="voucher-results-section">
            <div class="section-header">
                <h2 class="section-title" >Voucher Anda</h2>
                <p class="section-subtitle">Kelola dan pantau voucher yang telah dibuat</p>
                 <!-- Search Section -->
        <div class="search-section">
            <div class="search-container">
                <div class="search-wrapper">
                    <div class="search-input-group">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text"
                               id="voucherSearch"
                               class="search-input"
                               placeholder="Cari judul voucher..."
                               autocomplete="off">
                        <button type="button" id="clearSearch" class="clear-search-btn" style="display: none;">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
                <div id="searchResultsInfo" class="search-results-info" style="display: none;">
                    <div class="results-count">0 dari 0 voucher ditemukan</div>
                </div>
            </div>
        </div>
            </div>
            
            

            <!-- Vouchers Grid -->
            <div class="vouchers-grid" id="vouchersContainer">
                @forelse($vouchers as $voucher)
                    <div class="voucher-card" data-voucher-id="{{ $voucher->id }}">
                        <div class="voucher-image">
                            <img src="{{ $voucher->gambar ? asset('storage/' . $voucher->gambar) : 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80' }}" alt="Voucher">
                            <div class="discount-badge {{ $voucher->tipe_diskon === 'fixed' ? 'fixed' : '' }}">
                                {{ $voucher->formatted_discount }}
                            </div>
                            <div class="voucher-actions">
                               <button class="btn btn-sm btn-light" title="Delete" onclick="deleteVoucher({{ $voucher->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="voucher-content">
                            <h4 class="voucher-title">{{ $voucher->judul }}</h4>
                            <p class="voucher-description">{{ $voucher->deskripsi }}</p>
                            <div class="voucher-details">
                                <div class="detail-item">
                                    <i class="bi bi-wallet2"></i>
                                    <span>Min. Belanja: {{ $voucher->formatted_minimal_belanja }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>Berlaku hingga: {{ $voucher->tanggal_kadaluarsa->format('d M Y') }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-people"></i>
                                    <span>Digunakan: {{ $voucher->usage_status }}</span>
                                </div>
                            </div>
                            <div class="voucher-status">
                                <span class="status-badge {{ $voucher->isActive() ? 'active' : ($voucher->isExpired() ? 'expired' : 'inactive') }}">
                                    @if($voucher->isActive())
                                        Aktif
                                    @elseif($voucher->isExpired())
                                        Kedaluwarsa
                                    @else
                                        Tidak Aktif
                                    @endif
                                </span>
                            </div>
                            <div class="voucher-actions-bottom">
                                @if($voucher->is_used_by_current_user)
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="bi bi-check-circle me-1"></i>
                                        Sudah Digunakan
                                    </button>
                                @else
                                    @if($isLoggedIn)
                                        <button class="btn btn-primary btn-sm" onclick="useVoucher({{ $voucher->id }})" {{ $voucher->isActive() ? '' : 'disabled' }}>
                                            <i class="bi bi-download me-1"></i>
                                            Gunakan
                                        </button>
                                    @else
                                        <button class="btn btn-warning btn-sm" disabled>
                                            <i class="bi bi-lock me-1"></i>
                                            Login Dulu
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state col-12">
                        <div class="empty-icon">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                        <h3>Belum Ada Voucher</h3>
                        <p>Buat voucher pertama Anda menggunakan form di atas</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($vouchers->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $vouchers->links() }}
                </div>
            @endif
        </div>

       
    </div>
</div>



<script>
// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// Image Upload Handler
document.getElementById('voucherImage').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            showNotification('Format file tidak didukung. Gunakan PNG, JPG, atau GIF.', 'error');
            this.value = '';
            return;
        }

        // Validate file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            showNotification('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.querySelector('.upload-placeholder').style.display = 'none';
            document.querySelector('.image-preview').style.display = 'block';
        }
        reader.onerror = function() {
            showNotification('Error membaca file gambar', 'error');
        }
        reader.readAsDataURL(file);
    }
});

function removeImage() {
    document.getElementById('voucherImage').value = '';
    document.querySelector('.upload-placeholder').style.display = 'flex';
    document.querySelector('.image-preview').style.display = 'none';
}

// Form Handler with AJAX
document.getElementById('voucherForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');

    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';

    // Prepare headers for file upload
    const headers = {};
    if (csrfToken) {
        headers['X-CSRF-TOKEN'] = csrfToken;
    }

    fetch('{{ route("voucher.store") }}', {
        method: 'POST',
        body: formData,
        headers: headers
    })
    .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            throw new Error('Server returned non-JSON response');
        }
    })
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');

            // Reset form
            this.reset();
            removeImage();

            // Reload page to show new voucher
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showNotification(data.message || 'Terjadi kesalahan', 'error');

            // Show validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorMsg = data.errors[key][0];
                    showNotification(errorMsg, 'error');
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan voucher. Periksa koneksi internet Anda.', 'error');
    })
    .finally(() => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Buat Voucher';
    });
});

// Delete Voucher Function
function deleteVoucher(voucherId) {
    if (!confirm('Apakah Anda yakin ingin menghapus voucher ini?')) {
        return;
    }

    // Prepare headers for file upload
    const headers = {};
    if (csrfToken) {
        headers['X-CSRF-TOKEN'] = csrfToken;
    }

    fetch(`/voucher/${voucherId}`, {
        method: 'DELETE',
        headers: headers
    })
    .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            throw new Error('Server returned non-JSON response');
        }
    })
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');

            // Remove voucher card from DOM
            const voucherCard = document.querySelector(`[data-voucher-id="${voucherId}"]`);
            if (voucherCard) {
                voucherCard.remove();
            }

            // Check if no vouchers left
            const remainingVouchers = document.querySelectorAll('[data-voucher-id]');
            if (remainingVouchers.length === 0) {
                document.getElementById('vouchersContainer').innerHTML = `
                    <div class="empty-state col-12">
                        <div class="empty-icon">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                        <h3>Belum Ada Voucher</h3>
                        <p>Buat voucher pertama Anda menggunakan form di atas</p>
                    </div>
                `;
            }
        } else {
            showNotification(data.message || 'Gagal menghapus voucher', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menghapus voucher. Periksa koneksi internet Anda.', 'error');
    });
}

// // Edit Voucher Function
// function editVoucher(voucherId) {
//     fetch(`/voucher/${voucherId}`)
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 const voucher = data.voucher;

//                 // Fill edit form
//                 document.getElementById('editVoucherId').value = voucher.id;
//                 document.getElementById('editJudul').value = voucher.judul;
//                 document.getElementById('editTipeDiskon').value = voucher.tipe_diskon;
//                 document.getElementById('editDiskon').value = voucher.diskon;
//                 document.getElementById('editMinimalBelanja').value = voucher.minimal_belanja || '';
//                 document.getElementById('editTanggalKadaluarsa').value = voucher.tanggal_kadaluarsa;
//                 document.getElementById('editBatasPenggunaan').value = voucher.batas_penggunaan || '';
//                 document.getElementById('editStatus').value = voucher.status;
//                 document.getElementById('editDeskripsi').value = voucher.deskripsi;

//                 // Show modal
//                 const modal = new bootstrap.Modal(document.getElementById('editVoucherModal'));
//                 modal.show();
//             } else {
//                 showNotification('Gagal memuat data voucher', 'error');
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             showNotification('Terjadi kesalahan saat memuat voucher', 'error');
//         });
// }

// // Update Voucher Function
// function updateVoucher() {
//     const form = document.getElementById('editVoucherForm');
//     const formData = new FormData(form);
//     const voucherId = document.getElementById('editVoucherId').value;

//     // Prepare headers for file upload
//     const headers = {};
//     if (csrfToken) {
//         headers['X-CSRF-TOKEN'] = csrfToken;
//     }

//     fetch(`/voucher/${voucherId}`, {
//         method: 'PUT',
//         body: formData,
//         headers: headers
//     })
//     .then(response => {
//         // Check if response is JSON
//         const contentType = response.headers.get('content-type');
//         if (contentType && contentType.includes('application/json')) {
//             return response.json();
//         } else {
//             throw new Error('Server returned non-JSON response');
//         }
//     })
//     .then(data => {
//         if (data.success) {
//             showNotification(data.message, 'success');

//             // Close modal
//             const modal = bootstrap.Modal.getInstance(document.getElementById('editVoucherModal'));
//             modal.hide();

//             // Reload page to show updated voucher
//             setTimeout(() => {
//                 window.location.reload();
//             }, 1500);
//         } else {
//             showNotification(data.message || 'Gagal memperbarui voucher', 'error');

//             // Show validation errors
//             if (data.errors) {
//                 Object.keys(data.errors).forEach(key => {
//                     const errorMsg = data.errors[key][0];
//                     showNotification(errorMsg, 'error');
//                 });
//             }
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         showNotification('Terjadi kesalahan saat memperbarui voucher. Periksa koneksi internet Anda.', 'error');
//     });
// }

// Notification System
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    const iconMap = {
        'success': 'check-circle',
        'error': 'x-circle',
        'info': 'info-circle'
    };
    
    notification.innerHTML = `
        <i class="bi bi-${iconMap[type] || 'info-circle'}"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Set minimum date to tomorrow for expiry date
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
document.getElementById('tanggal_kadaluarsa').min = tomorrow.toISOString().split('T')[0];
document.getElementById('editTanggalKadaluarsa').min = tomorrow.toISOString().split('T')[0];

// Use Voucher Function
function useVoucher(voucherId) {
    const useBtn = event.target.closest('button');
    const originalText = useBtn.innerHTML;

    // Disable button and show loading
    useBtn.disabled = true;
    useBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Mengunduh...';

    // Prepare headers
    const headers = {};
    if (csrfToken) {
        headers['X-CSRF-TOKEN'] = csrfToken;
    }

    // Create FormData properly
    const formData = new FormData();
    formData.append('voucher_id', voucherId);

    fetch(`/api/vouchers/use`, {
        method: 'POST',
        body: formData,
        headers: headers
    })
    .then(response => {
        // Check if response is a file download or JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            // It's a file download
            return response.blob().then(blob => ({
                success: true,
                blob: blob,
                filename: response.headers.get('content-disposition')?.split('filename=')[1]?.replace(/"/g, '') || `voucher-${voucherId}.jpg`
            }));
        }
    })
    .then(data => {
        if (data.success && data.blob) {
            // Create download link
            const url = window.URL.createObjectURL(data.blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = data.filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);

            showNotification('Voucher berhasil diunduh!', 'success');

            // Update voucher card to show used state instead of removing it
            const voucherCard = document.querySelector(`[data-voucher-id="${voucherId}"]`);
            if (voucherCard) {
                // Update the usage count display
                const detailItems = voucherCard.querySelectorAll('.detail-item');
                detailItems.forEach(item => {
                    if (item.textContent.includes('Digunakan:')) {
                        // Extract current count and increment it
                        const currentText = item.textContent;
                        const match = currentText.match(/Digunakan: (\d+)\/(\d+)/);
                        if (match) {
                            const currentCount = parseInt(match[1]) + 1;
                            const maxCount = match[2];
                            item.innerHTML = `<i class="bi bi-people"></i><span>Digunakan: ${currentCount}/${maxCount}</span>`;
                        }
                    }
                });

                // Replace the "Gunakan" button with "Sudah Digunakan" button
                const actionButton = voucherCard.querySelector('.voucher-actions-bottom .btn');
                if (actionButton) {
                    actionButton.outerHTML = `
                        <button class="btn btn-secondary btn-sm" disabled>
                            <i class="bi bi-check-circle me-1"></i>
                            Sudah Digunakan
                        </button>
                    `;
                }
            }
        } else {
            showNotification(data.message || 'Gagal mengunduh voucher', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat mengunduh voucher. Periksa koneksi internet Anda.', 'error');
    })
    .finally(() => {
        // Re-enable button
        useBtn.disabled = false;
        useBtn.innerHTML = originalText;
    });
}

// Dynamic discount validation
document.getElementById('tipe_diskon').addEventListener('change', function() {
    const discountInput = document.getElementById('diskon');
    if (this.value === 'percentage') {
        discountInput.max = 100;
        discountInput.placeholder = 'Maksimal 100%';
    } else {
        discountInput.removeAttribute('max');
        discountInput.placeholder = 'Masukkan nominal dalam Rupiah';
    }
});
</script>

<style>
    .voucher-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* Hero Section */
    .voucher-hero {
        position: relative;
        height: 40vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.9;
    }

    .hero-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);
        animation: float 6s ease-in-out infinite;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-icon i {
        font-size: 3rem;
        animation: bounce 2s infinite;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    /* Container */
    .voucher-container {
        padding: 4rem 0;
        max-width: 1200px;
    }

    /* Add Voucher Form */
    .add-voucher-section {
        margin-bottom: 5rem;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .form-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: #718096;
        font-size: 1.1rem;
    }

    /* Form Elements */
    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    /* Image Upload */
    .image-upload-area {
        position: relative;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        background: #f7fafc;
        transition: all 0.3s ease;
        min-height: 200px;
    }

    .image-upload-area:hover {
        border-color: #667eea;
        background: #edf2f7;
    }

    .image-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .upload-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 200px;
        text-align: center;
        color: #718096;
    }

    .upload-placeholder i {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .upload-placeholder h5 {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .upload-placeholder p {
        margin-bottom: 0.5rem;
    }

    .file-info {
        font-size: 0.875rem;
        color: #a0aec0;
    }

    .image-preview {
        position: relative;
        height: 200px;
        border-radius: 8px;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-remove {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.5);
        border: none;
        border-radius: 50%;
        color: white;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-remove:hover {
        background: rgba(220, 38, 38, 0.8);
    }

    /* Voucher Results */
    .voucher-results-section {
        margin-bottom: 3rem;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: -1.5rem;
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: #718096;
    }

    /* Vouchers Grid */
    .vouchers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    .voucher-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
    }

    .voucher-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .voucher-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .voucher-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .voucher-card:hover .voucher-image img {
        transform: scale(1.05);
    }

    .discount-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(238, 90, 36, 0.4);
    }

    .discount-badge.fixed {
        background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.4);
    }

    .voucher-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        gap: 0.5rem;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .voucher-card:hover .voucher-actions {
        opacity: 1;
        transform: translateY(0);
    }

    .voucher-actions .btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.9);
        border: none;
        color: #2d3748;
        transition: all 0.3s ease;
    }

    .voucher-actions .btn:hover {
        background: white;
        transform: scale(1.1);
    }

    .voucher-content {
        padding: 1.5rem;
    }

    .voucher-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }

    .voucher-description {
        color: #718096;
        margin-bottom: 1.5rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .voucher-details {
        margin-bottom: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: #4a5568;
        font-size: 0.9rem;
    }

    .detail-item i {
        color: #667eea;
        margin-right: 0.5rem;
        width: 16px;
    }

    .voucher-status {
        display: flex;
        justify-content: flex-end;
    }

    .status-badge {
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge.active {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
    }

    .status-badge.expired {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        color: white;
    }

    .status-badge.inactive {
        background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
    }

    .empty-icon i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #4a5568;
    }

    /* Buttons */
    .btn {
        border-radius: 12px;
        padding: 0.8rem 1.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(160, 174, 192, 0.4);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 174, 192, 0.6);
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .modal-header {
        border-bottom: 1px solid #e2e8f0;
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 700;
        color: #2d3748;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 1.5rem;
    }

    /* Notifications */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 1050;
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.3s ease;
        border-left: 4px solid;
        max-width: 350px;
    }

    .notification.show {
        transform: translateX(0);
        opacity: 1;
    }

    .notification.success {
        border-left-color: #48bb78;
        color: #2d3748;
    }

    .notification.success i {
        color: #48bb78;
    }

    .notification.error {
        border-left-color: #f56565;
        color: #2d3748;
    }

    .notification.error i {
        color: #f56565;
    }

    .notification.info {
        border-left-color: #4299e1;
        color: #2d3748;
    }

    .notification.info i {
        color: #4299e1;
    }

    /* Pagination Styling */
    .pagination {
        gap: 0.5rem;
    }

    .page-link {
        border-radius: 8px;
        border: none;
        color: #667eea;
        padding: 0.5rem 0.75rem;
        margin: 0 0.1rem;
    }

    .page-link:hover {
        background-color: #667eea;
        color: white;
    }

    .page-item.active .page-link {
        background-color: #667eea;
        border-color: #667eea;
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

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

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .form-card {
            padding: 2rem 1.5rem;
        }
        
        .form-title {
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .vouchers-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .voucher-card {
            margin: 0 1rem;
        }
        
        .upload-placeholder {
            height: 150px;
        }
        
        .image-preview {
            height: 150px;
        }
        
        .voucher-image {
            height: 160px;
        }
        
        .notification {
            right: 10px;
            left: 10px;
            transform: translateY(-100px);
        }
        
        .notification.show {
            transform: translateY(0);
        }

        .modal-dialog {
            margin: 1rem;
        }
    }

    @media (max-width: 576px) {
        .voucher-container {
            padding: 2rem 0;
        }
        
        .form-card {
            padding: 1.5rem 1rem;
        }
        
        .voucher-content {
            padding: 1rem;
        }
        
        .hero-icon i {
            font-size: 2.5rem;
        }
        
        .discount-badge {
            font-size: 1rem;
            padding: 0.4rem 0.8rem;
        }
        
        .voucher-actions {
            position: static;
            opacity: 1;
            transform: none;
            justify-content: center;
            margin-top: 1rem;
            padding: 0 1rem;
        }
        
        .voucher-card:hover .voucher-actions {
            position: static;
        }
    }

    /* Loading States */
    .form-card.loading {
        position: relative;
        pointer-events: none;
    }

    .form-card.loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .form-card.loading::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border: 4px solid #e2e8f0;
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 11;
    }

    @keyframes spin {
        to {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    /* Hover Effects for Better UX */
    .form-control:hover {
        border-color: #a0aec0;
    }

    .form-select:hover {
        border-color: #a0aec0;
    }

    .image-upload-area.dragover {
        border-color: #667eea;
        background: #edf2f7;
        transform: scale(1.02);
    }

    /* Focus Indicators */
    .btn:focus {
        outline: 3px solid rgba(102, 126, 234, 0.3);
        outline-offset: 2px;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Search Section */
    .search-section {
        margin-top: 3rem;
        padding: 2rem 0;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .search-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .search-wrapper {
        margin-bottom: 1rem;
    }

    .search-input-group {
        position: relative;
        display: flex;
        align-items: center;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .search-input-group:focus-within {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        color: #718096;
        font-size: 1.1rem;
        z-index: 2;
        transition: color 0.3s ease;
    }

    .search-input-group:focus-within .search-icon {
        color: #667eea;
    }

    .search-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        color: #2d3748;
        outline: none;
    }

    .search-input::placeholder {
        color: #a0aec0;
    }

    .clear-search-btn {
        position: absolute;
        right: 0.5rem;
        background: none;
        border: none;
        color: #718096;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .clear-search-btn:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .search-results-info {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0;
    }

    .results-count {
        color: #718096;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Empty Search State */
    .empty-search-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #718096;
    }

    .empty-search-state .empty-icon i {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }

    .empty-search-state h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #4a5568;
    }

    .empty-search-state p {
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    /* Print Styles */
    @media print {
        .voucher-hero,
        .add-voucher-section,
        .voucher-actions,
        .search-section,
        .btn {
            display: none !important;
        }

        .voucher-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #e2e8f0;
        }

        .vouchers-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
<script>
    // Search functionality
    let searchTimeout;
    const searchInput = document.getElementById('voucherSearch');
    const clearButton = document.getElementById('clearSearch');
    const searchResultsInfo = document.getElementById('searchResultsInfo');
    const vouchersContainer = document.getElementById('vouchersContainer');
    
    // Get all voucher cards
    function getAllVoucherCards() {
        return Array.from(vouchersContainer.querySelectorAll('.voucher-card'));
    }
    
    // Show/hide clear button
    function toggleClearButton(show) {
        clearButton.style.display = show ? 'flex' : 'none';
    }
    
    // Update search results info
    function updateSearchResultsInfo(query, visibleCount, totalCount) {
        if (query.trim() === '') {
            searchResultsInfo.style.display = 'none';
            return;
        }
        
        const resultsCount = searchResultsInfo.querySelector('.results-count');
        resultsCount.textContent = `${visibleCount} dari ${totalCount} voucher ditemukan`;
        searchResultsInfo.style.display = 'flex';
    }
    
    // Clear search function
    function clearSearch() {
        searchInput.value = '';
        toggleClearButton(false);
        searchResultsInfo.style.display = 'none';
        
        // Show all voucher cards
        const allCards = getAllVoucherCards();
        allCards.forEach(card => {
            card.style.display = 'block';
            card.style.animation = 'fadeInUp 0.3s ease forwards';
        });
        
        // Reset empty state
        const emptyState = vouchersContainer.querySelector('.empty-state');
        if (emptyState && allCards.length > 0) {
            emptyState.style.display = 'none';
        }
    }
    
    // Search vouchers function
    function searchVouchers(query) {
        const allCards = getAllVoucherCards();
        const searchQuery = query.toLowerCase().trim();
        
        if (searchQuery === '') {
            clearSearch();
            return;
        }
        
        let visibleCount = 0;
        const totalCount = allCards.length;
        
        // Filter voucher cards
        allCards.forEach((card, index) => {
            const titleElement = card.querySelector('.voucher-title');
            const title = titleElement ? titleElement.textContent.toLowerCase() : '';
            
            if (title.includes(searchQuery)) {
                card.style.display = 'block';
                card.style.animation = `fadeInUp 0.3s ease ${index * 0.1}s forwards`;
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Handle empty search results
        let emptySearchState = vouchersContainer.querySelector('.empty-search-state');
        
        if (visibleCount === 0) {
            if (!emptySearchState) {
                emptySearchState = document.createElement('div');
                emptySearchState.className = 'empty-search-state col-12';
                emptySearchState.innerHTML = `
                    <div class="empty-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3>Voucher Tidak Ditemukan</h3>
                    <p>Tidak ada voucher yang sesuai dengan pencarian "<strong id="searchQuery">${query}</strong>"</p>
                    <button type="button" class="btn btn-outline-primary" onclick="clearSearch()">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali ke semua voucher
                    </button>
                `;
                vouchersContainer.appendChild(emptySearchState);
            } else {
                emptySearchState.style.display = 'block';
                emptySearchState.querySelector('#searchQuery').textContent = query;
            }
            
            // Hide original empty state if exists
            const originalEmptyState = vouchersContainer.querySelector('.empty-state');
            if (originalEmptyState) {
                originalEmptyState.style.display = 'none';
            }
        } else {
            if (emptySearchState) {
                emptySearchState.style.display = 'none';
            }
        }
        
        updateSearchResultsInfo(query, visibleCount, totalCount);
    }
    
    // Event listeners
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value;
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        // Show/hide clear button
        toggleClearButton(query.length > 0);
        
        // Debounce search
        searchTimeout = setTimeout(() => {
            searchVouchers(query);
        }, 300);
    });
    
    // Clear button click
    clearButton.addEventListener('click', clearSearch);
    
    // Enter key support
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimeout);
            searchVouchers(this.value);
        } else if (e.key === 'Escape') {
            clearSearch();
            this.blur();
        }
    });
    
    // Focus/blur effects
    searchInput.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    searchInput.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
    </script>
@endsection