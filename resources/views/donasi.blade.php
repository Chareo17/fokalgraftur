@extends('layouts.app')

@section('content')
<div class="container donation-container">
    <!-- Form Donasi -->
    <div class="donation-form" style="margin-top: 100px;">
        <div class="form-header">
            <h2 class="donation-title" style="color: white">💖 Yuk, Donasi Sekarang!</h2>
            <p class="donation-subtitle">Satu langkah kecilmu, satu harapan besar bagi mereka</p>
        </div>
        
        <div class="form-body">
            <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Nominal Donasi -->
                <div class="mb-4">
                    <label for="nominal" class="form-label">
                        Nominal Donasi <span class="emoji" style="--i: 1">💰</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius: 12px 0 0 12px; background-color: #e0f7fa; border-color: #e0f7fa;">Rp</span>
                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Contoh: 50000" required maxlength="1000000000" style="border-radius: 0 12px 12px 0;">
                    </div>
                    <small class="text-muted">Berapapun nominalnya, keikhlasanmu yang terpenting</small>
                    @error('nominal')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Bukti Donasi -->
                <div class="mb-4">
                    <label for="bukti_donasi" class="form-label">
                        Upload Bukti Donasi <span class="emoji" style="--i: 2">📸</span>
                    </label>
                    <div class="file-upload">
                        <div class="file-upload-button">
                            <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                            <h5>Tarik & Letakkan file foto di sini</h5>
                            <p class="mb-0">atau klik untuk memilih file</p>
                            <input type="file" class="file-upload-input" id="bukti_donasi" name="bukti_donasi" accept="image/*" required>
                        </div>
                        <div class="file-name text-center" id="file-name"></div>
                    </div>
                    @error('bukti_donasi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Donation Information Box -->
                <div class="donation-info">
                    <p><i class="fas fa-info-circle"></i> Donasi yang diberikan oleh alumni dan siswa akan terlebih dahulu divalidasi oleh admin.</p>
                    <p><i class="fas fa-shield-alt"></i> Setelah proses validasi, pengguna akan menerima notifikasi terkait status donasi mereka, apakah diterima atau ditolak.</p>
                    <p><i class="fas fa-hand-holding-heart"></i> Donasi yang diterima akan digunakan untuk mendukung kegiatan di lingkungan sekolah atau alumni.</p>
                </div>
                
                <!-- Tombol Submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-donate">
                        <i class="fas fa-heart me-2"></i> Kirim Donasi
                    </button>
                </div>
                
                <div class="text-center thank-you">
                    <p>Terima kasih atas kebaikanmu!</p>
                    <div class="hearts">
                        <i class="fas fa-heart heart" style="--i: 0"></i>
                        <i class="fas fa-heart heart" style="--i: 1"></i>
                        <i class="fas fa-heart heart" style="--i: 2"></i>
                        <i class="fas fa-heart heart" style="--i: 3"></i>
                        <i class="fas fa-heart heart" style="--i: 4"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Riwayat Transaksi / Mutasi Donasi -->
    <div class="donation-history mt-5 mb-5">
        <div class="history-header">
            <h3 style="color: white"><i class="fas fa-history me-2" style="color: white"></i> Riwayat Transaksi Donasi</h3>
            
        </div>

        <div class="history-body">
            @if(isset($donasi) && $donasi->count() > 0)
                <!-- Summary Card -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="summary-card">
                            <div class="summary-icon total">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <div class="summary-info">
                                <h6>Total Donasi</h6>
                                <h4>Rp {{ number_format($donasi->where('status', 'divalidasi')->sum('nominal'), 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="summary-card">
                            <div class="summary-icon approved">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-info">
                                <h6>Disetujui</h6>
                                <h4>{{ $donasi->where('status', 'divalidasi')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="summary-card">
                            <div class="summary-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="summary-info">
                                <h6>Menunggu</h6>
                                <h4>{{ $donasi->where('status', 'belum divalidasi')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="summary-card">
                            <div class="summary-icon rejected">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="summary-info">
                                <h6>Ditolak</h6>
                                <h4>{{ $donasi->where('status', 'ditolak')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction List -->
                <div class="transaction-list">
                    @foreach($donasi as $item)
                        <div class="transaction-item">
                            <div class="transaction-date">
                                <div class="date-badge">
                                    <span class="day">{{ $item->created_at->format('d') }}</span>
                                    <span class="month">{{ $item->created_at->format('M') }}</span>
                                </div>
                            </div>
                            <div class="transaction-details">
                                <div class="transaction-info">
                                    <h5 class="transaction-title">Donasi #{{ $item->id }}</h5>
                                    <p class="transaction-time">
                                        <i class="far fa-clock"></i> {{ $item->created_at->format('H:i') }} WIB
                                    </p>
                                </div>
                                <div class="transaction-amount">
                                    <h4>Rp {{ number_format($item->nominal, 0, ',', '.') }}</h4>
                                    @if($item->status == 'belum divalidasi')
                                        <span class="badge-status pending">
                                            <i class="fas fa-clock"></i> Menunggu Validasi
                                        </span>
                                    @elseif($item->status == 'divalidasi')
                                        <span class="badge-status approved">
                                            <i class="fas fa-check-circle"></i> Disetujui
                                        </span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge-status rejected">
                                            <i class="fas fa-times-circle"></i> Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="transaction-actions">
                                <button class="btn-action" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Transaksi #{{ $item->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="detail-row">
                                            <span class="detail-label">Nominal:</span>
                                            <span class="detail-value">Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Tanggal:</span>
                                            <span class="detail-value">{{ $item->created_at->format('d F Y, H:i') }} WIB</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Status:</span>
                                            <span class="detail-value">
                                                @if($item->status == 'belum divalidasi')
                                                    <span class="badge-status pending">Menunggu Validasi</span>
                                                @elseif($item->status == 'divalidasi')
                                                    <span class="badge-status approved">Disetujui</span>
                                                @elseif($item->status == 'ditolak')
                                                    <span class="badge-status rejected">Ditolak</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Bukti Transfer:</span>
                                        </div>
                                        <div class="text-center mt-2">
                                            <img src="{{ asset('storage/' . $item->gambar_donasi) }}" alt="Bukti Donasi" class="img-fluid" style="max-height: 300px; border-radius: 8px;">
                                        </div>
                                        @if($item->keterangan)
                                            <div class="detail-row mt-3">
                                                <span class="detail-label">Keterangan:</span>
                                                <span class="detail-value">{{ $item->keterangan }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox fa-4x mb-3"></i>
                    <h4>Belum Ada Riwayat Donasi</h4>
                    <p>Donasi pertamamu akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('bukti_donasi').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            document.getElementById('file-name').textContent = e.target.files[0].name;
        }
    });
</script>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .donation-container {
        max-width: 900px;
        margin: 50px auto;
    }
    
    .donation-form {
        background: linear-gradient(135deg, #e0f7fa, #fff, #e1f5fe);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0, 188, 212, 0.15);
        overflow: hidden;
        transition: all 0.3s ease;
        animation: float 6s ease-in-out infinite;
    }
    
    .donation-form:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 188, 212, 0.2);
    }
    
    .form-header {
        background: linear-gradient(135deg, #00bcd4, #3f51b5);
        padding: 30px;
        color: white;
        text-align: center;
        border-radius: 20px 20px 0 0;
    }
    
    .form-body {
        padding: 40px;
    }
    
    .donation-title {
        font-weight: 800;
        letter-spacing: 0.5px;
        margin-bottom: 0;
    }
    
    .donation-subtitle {
        opacity: 0.8;
        font-weight: 300;
    }
    
    .form-control {
        border-radius: 12px;
        padding: 12px 20px;
        border: 2px solid #e0f7fa;
        background-color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s;
        font-size: 16px;
    }
    
    .form-control:focus {
        border-color: #00bcd4;
        box-shadow: 0 0 0 0.25rem rgba(0, 188, 212, 0.25);
        background-color: white;
    }
    
    .form-label {
        font-weight: 600;
        color: #0097a7;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        font-size: 16px;
    }
    
    .emoji {
        font-size: 1.5rem;
        margin-left: 8px;
        display: inline-block;
        animation: bounce 2s infinite;
    }
    
    .btn-donate {
        background: linear-gradient(135deg, #00bcd4, #3f51b5);
        border: none;
        border-radius: 50px;
        padding: 14px 32px;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 20px rgba(0, 188, 212, 0.3);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        color: white;
    }
    
    .btn-donate:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(0, 188, 212, 0.4);
        background: linear-gradient(135deg, #00acc1, #3949ab);
    }
    
    .btn-donate:active {
        transform: translateY(1px);
    }
    
    .file-upload {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .file-upload-input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
        height: 100%;
        width: 100%;
    }
    
    .file-upload-button {
        background: linear-gradient(135deg, #e0f7fa, #b3e5fc);
        color: #0097a7;
        border: 2px dashed #4dd0e1;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .file-upload-button:hover {
        border-color: #00bcd4;
        background: linear-gradient(135deg, #e0f7fa, #fff);
    }
    
    .file-name {
        margin-top: 10px;
        font-size: 14px;
        color: #0097a7;
    }
    
    .thank-you {
        font-weight: 400;
        color: #00838f;
        margin-top: 20px;
        opacity: 0.8;
    }
    
    .hearts {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .heart {
        color: #f48fb1;
        margin: 0 5px;
        animation: beat 1.5s infinite;
        animation-delay: calc(var(--i) * 0.2s);
        font-size: 22px;
    }
    
    .donation-info {
        margin-top: 30px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        border-left: 4px solid #00bcd4;
    }
    
    .donation-info p {
        margin-bottom: 8px;
        color: #00838f;
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px;
    }
    
    .donation-info i {
        margin-right: 8px;
        color: #00bcd4;
        margin-top: 3px;
        flex-shrink: 0;
    }

    /* Riwayat Transaksi Styles */
    .donation-history {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .history-header {
        background: linear-gradient(135deg, #00bcd4, #3f51b5);
        padding: 30px;
        color: white;
        text-align: center;
    }

    .history-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .history-body {
        padding: 30px;
    }

    .summary-card {
        background: linear-gradient(135deg, #e0f7fa, #fff);
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0, 188, 212, 0.1);
        transition: all 0.3s;
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 188, 212, 0.15);
    }

    .summary-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 15px;
    }

    .summary-icon.total {
        background: linear-gradient(135deg, #00bcd4, #0097a7);
        color: white;
    }

    .summary-icon.approved {
        background: linear-gradient(135deg, #4caf50, #388e3c);
        color: white;
    }

    .summary-icon.pending {
        background: linear-gradient(135deg, #ff9800, #f57c00);
        color: white;
    }

    .summary-icon.rejected {
        background: linear-gradient(135deg, #f44336, #d32f2f);
        color: white;
    }

    .summary-info h6 {
        margin: 0;
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .summary-info h4 {
        margin: 5px 0 0 0;
        font-weight: 700;
        color: #00838f;
    }

    .transaction-list {
        margin-top: 20px;
    }

    .transaction-item {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .transaction-item:hover {
        border-color: #00bcd4;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 188, 212, 0.1);
    }

    .transaction-date {
        margin-right: 20px;
    }

    .date-badge {
        background: linear-gradient(135deg, #00bcd4, #3f51b5);
        color: white;
        border-radius: 12px;
        padding: 10px 15px;
        text-align: center;
        min-width: 70px;
    }

    .date-badge .day {
        display: block;
        font-size: 24px;
        font-weight: 700;
        line-height: 1;
    }

    .date-badge .month {
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        margin-top: 2px;
    }

    .transaction-details {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .transaction-title {
        margin: 0;
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .transaction-time {
        margin: 5px 0 0 0;
        color: #999;
        font-size: 14px;
    }

    .transaction-amount h4 {
        margin: 0;
        font-weight: 700;
        color: #00838f;
        font-size: 20px;
    }

    .badge-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 5px;
    }

    .badge-status.pending {
        background: #fff3cd;
        color: #856404;
    }

    .badge-status.approved {
        background: #d4edda;
        color: #155724;
    }

    .badge-status.rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .transaction-actions {
        margin-left: 20px;
    }

    .btn-action {
        background: linear-gradient(135deg, #00bcd4, #0097a7);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-action:hover {
        background: linear-gradient(135deg, #0097a7, #00838f);
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        color: #ddd;
    }

    .modal-content {
        border-radius: 16px;
        border: none;
    }

    .modal-header {
        background: linear-gradient(135deg, #00bcd4, #3f51b5);
        color: white;
        border-radius: 16px 16px 0 0;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #666;
    }

    .detail-value {
        color: #333;
        font-weight: 500;
    }
    
    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes beat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.2); }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .form-body, .history-body {
            padding: 25px;
        }
        
        .form-header, .history-header {
            padding: 20px;
        }

        .transaction-item {
            flex-direction: column;
            text-align: center;
        }

        .transaction-date {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .transaction-details {
            flex-direction: column;
            text-align: center;
        }

        .transaction-amount {
            margin-top: 10px;
        }

        .transaction-actions {
            margin-left: 0;
            margin-top: 15px;
        }
    }
</style>
@endsection