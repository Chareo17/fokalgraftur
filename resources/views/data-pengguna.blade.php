@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #667eea;
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-color: #f093fb;
        --success-color: #4facfe;
        --warning-color: #f6d365;
        --danger-color: #ff6b6b;
        --light-bg: #f8fafc;
        --white: #ffffff;
        --text-dark: #2d3748;
        --text-muted: #718096;
        --border-radius: 16px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        margin-top: 100px;
    }

    .main-container {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin: 20px;
        padding: 0;
        overflow: hidden;
    }
    .icon-wrapper {
    margin-right: 8px;
    font-size: 1.5rem;
    vertical-align: middle;
}

    .header-section {
        background: var(--primary-gradient);
        color: white;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.1;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .header-content {
            flex-direction: row;
            justify-content: space-between;
        }
    }

    .page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);

    /* Ukuran kotak judul */
    width: 100%;
    max-width: 500px;
    height: auto;
    min-height: 80px;
    background: #ffffff;
    color: #333;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);

    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;

    padding: 1rem 20px;
}

    .title-box {
    background: #ffffff;
    border-radius: 20px;
    padding: 0px 0px;
    width: 100%;
    max-width: 600px; /* Ukuran maksimum kotak */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    border-left: 6px solid #764ba2;
    backdrop-filter: blur(4px);
    margin: 0 auto; /* Agar berada di tengah */
    transition: all 0.3s ease-in-out;
}

.title-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 35px rgba(0, 0, 0, 0.12);
}


    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .btn-add-user {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        transition: var(--transition);
        backdrop-filter: blur(10px);
    }

    .btn-add-user:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .filter-section {
        background: var(--light-bg);
        padding: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .filter-card {
        background: white;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .filter-form {
        padding: 2rem;
    }

    .filter-main-controls {
        display: grid;
        grid-template-columns: 200px 1fr auto;
        gap: 1.5rem;
        align-items: end;
        margin-bottom: 0;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .filter-input,
    .filter-select {
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
    }

    .filter-input:focus,
    .filter-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .btn-filter-apply {
        padding: 0.75rem 1.5rem;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        height: fit-content;
    }

    .btn-filter-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .filter-alumni-section,
    .filter-siswa-section {
        margin-top: 2rem;
    }

    .filter-divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        gap: 1rem;
    }

    .filter-divider-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    }

    .filter-divider-text {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-muted);
        background: white;
        padding: 0 1rem;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-alumni-controls,
    .filter-siswa-controls {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        align-items: end;
    }

    .filter-stats {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 1.5rem 2rem;
        border-top: 1px solid #e2e8f0;
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .stat-item i {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .filter-main-controls {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .filter-alumni-controls,
        .filter-siswa-controls {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .filter-section {
            padding: 1rem;
        }
        
        .filter-form {
            padding: 1.5rem;
        }
        
        .filter-stats {
            padding: 1rem 1.5rem;
            flex-direction: column;
            gap: 1rem;
        }
        
        .stat-item {
            justify-content: center;
        }
    }

    /* Animation for showing/hiding filter sections */
    .filter-alumni-section,
    .filter-siswa-section {
        transition: all 0.3s ease;
        opacity: 1;
    }

    .filter-alumni-section[style*="display: none"],
    .filter-siswa-section[style*="display: none"] {
        opacity: 0;
        transform: translateY(-10px);
    }

    /* Improved form elements */
    .filter-input::placeholder {
        color: #a0aec0;
        font-style: italic;
    }

    .filter-select {
        cursor: pointer;
    }

    .filter-select option {
        padding: 0.5rem;
    }

    /* Loading state for filter button */
    .btn-filter-apply:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .btn-filter-apply:disabled:hover {
        transform: none;
        box-shadow: none;
    }

    .table-section {
        padding: 2rem;
    }

    .custom-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .custom-table thead {
        background: var(--primary-gradient);
        color: white;
    }

    .custom-table th {
        font-weight: 600;
        padding: 1rem;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .custom-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: var(--transition);
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(90deg, #f8fafc 0%, #edf2f7 100%);
        transform: translateX(5px);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: var(--transition);
    }

    .user-avatar:hover {
        transform: scale(1.1);
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge.bg-primary {
        background: var(--primary-gradient) !important;
        border: none;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
        border: none;
    }

    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition);
        border: none;
        margin-right: 0.5rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(246, 211, 101, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
        color: white;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        padding: 2rem;
        border: none;
        position: relative;
    }

    .modal-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .btn-close {
        position: relative;
        z-index: 1;
    }

    .modal-body {
        padding: 2rem;
        background: #fafbfc;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-floating .form-control,
    .form-floating .form-select {
        height: 60px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        transition: var(--transition);
    }

    .form-floating label {
        padding: 1rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .form-floating .form-control:focus,
    .form-floating .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-floating .form-control:focus ~ label,
    .form-floating .form-control:not(:placeholder-shown) ~ label,
    .form-floating .form-select:focus ~ label,
    .form-floating .form-select:not([value=""]) ~ label {
        color: var(--primary-color);
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .form-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--primary-color);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-footer {
        padding: 1.5rem 2rem;
        background: white;
        border: none;
    }

    .btn-modal {
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        min-width: 120px;
    }

    .btn-cancel {
        background: #f1f5f9;
        color: var(--text-dark);
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
        color: var(--text-dark);
    }

    .btn-submit {
        background: var(--success-color);
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        color: white;
    }

    .icon-wrapper {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .main-container {
            margin: 10px;
        }
        
        .header-section {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .filter-section {
            padding: 1rem;
        }
        
        .table-section {
            padding: 1rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
    }
</style>

<div class="main-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-content d-flex justify-content-between align-items-center">
            <div>
                <div class="title-box">
                    <h1 class="page-title">
                        <span class="icon-wrapper">👥</span> Data Pengguna
                    </h1>
                </div>
                <p class="page-subtitle mb-0">
                    Kelola pengguna alumni dan siswa dengan mudah
                </p>
            </div>
            <button class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#tambahPenggunaModal">
                <i class="bi bi-plus-circle me-2"></i> Tambah Pengguna
            </button>
        </div>
    </div>
    

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-card">
            <form method="GET" action="{{ route('data-pengguna') }}" class="filter-form">
                <!-- Main Filter Controls -->
                <div class="filter-main-controls">
                    <div class="filter-group">
                        <label for="role" class="filter-label">
                            <i class="bi bi-funnel me-1"></i>
                            Filter Role
                        </label>
                        <select name="role" id="role" class="filter-select">
                            <option value="all" {{ (isset($role) && $role === 'all') ? 'selected' : '' }}>Semua Role</option>
                            <option value="alumni" {{ (isset($role) && $role === 'alumni') ? 'selected' : '' }}>Alumni</option>
                            <option value="siswa" {{ (isset($role) && $role === 'siswa') ? 'selected' : '' }}>Siswa</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="search" class="filter-label">
                            <i class="bi bi-search me-1"></i>
                            Pencarian
                        </label>
                        <input type="text" name="search" id="search" class="filter-input" placeholder="Cari berdasarkan nama..." value="{{ $search ?? '' }}">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label" style="opacity: 0;">Action</label>
                        <button type="submit" class="btn-filter-apply">
                            <i class="bi bi-search me-2"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Alumni Specific Filters -->
                <div class="filter-alumni-section" id="alumni_filters" style="{{ (isset($role) && $role === 'alumni') ? '' : 'display: none;' }}">
                    <div class="filter-divider">
                        <div class="filter-divider-line"></div>
                        <span class="filter-divider-text">
                            <i class="bi bi-mortarboard me-1"></i>
                            Filter Alumni
                        </span>
                        <div class="filter-divider-line"></div>
                    </div>

<div class="filter-alumni-controls">
    <div class="filter-group">
        <label for="tanggal_lahir" class="filter-label">
            <i class="bi bi-calendar3 me-1"></i>
            Tanggal Lahir
        </label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="filter-input" placeholder="Tanggal Lahir..." value="{{ $tanggalLahir ?? '' }}">
    </div>

    <div class="filter-group">
        <label for="tahun_lulusan" class="filter-label">
            <i class="bi bi-calendar-event me-1"></i>
            Tahun Lulusan
        </label>
        <input type="number" name="tahun_lulusan" id="tahun_lulusan" class="filter-input" placeholder="Tahun lulusan..." value="{{ $tahunLulusan ?? '' }}">
    </div>

    <div class="filter-group">
        <label for="jurusan" class="filter-label">
            <i class="bi bi-book me-1"></i>
            Jurusan
        </label>
        <input type="text" name="jurusan" id="jurusan" class="filter-input" placeholder="Jurusan..." value="{{ $jurusan ?? '' }}">
    </div>

    <div class="filter-group">
        <label for="status" class="filter-label">
            <i class="bi bi-briefcase me-1"></i>
            Status
        </label>
        <select name="status" id="status" class="filter-select">
            <option value="">Semua Status</option>
            <option value="Bekerja" {{ (isset($status) && $status === 'Bekerja') ? 'selected' : '' }}>Bekerja</option>
            <option value="Tidak Bekerja" {{ (isset($status) && $status === 'Tidak Bekerja') ? 'selected' : '' }}>Tidak Bekerja</option>
            <option value="Studi Lanjut" {{ (isset($status) && $status === 'Studi Lanjut') ? 'selected' : '' }}>Studi Lanjut</option>
        </select>
    </div>

    <div class="filter-group">
        <label for="per_page" class="filter-label">
            <i class="bi bi-list-nested me-1"></i>
            Per Halaman
        </label>
        <input type="number" name="per_page" id="per_page" class="filter-input" min="0" value="{{ $perPage ?? 10 }}" />
    </div>
</div>
                </div>

                <!-- Siswa Specific Filters -->
                <div class="filter-siswa-section" id="siswa_filters" style="{{ (isset($role) && $role === 'siswa') ? '' : 'display: none;' }}">
                    <div class="filter-divider">
                        <div class="filter-divider-line"></div>
                        <span class="filter-divider-text">
                            <i class="bi bi-person-badge me-1"></i>
                            Filter Siswa
                        </span>
                        <div class="filter-divider-line"></div>
                    </div>

<div class="filter-siswa-controls">
    <div class="filter-group">
        <label for="per_page_siswa" class="filter-label">
            <i class="bi bi-list-nested me-1"></i>
            Per Halaman
        </label>
<input type="number" name="per_page_siswa" id="per_page_siswa" class="filter-input" min="0" value="{{ request()->query('per_page_siswa', 10) }}" />
    </div>
</div>
                </div>
            </form>

            <!-- Statistics Section -->
            <div class="filter-stats">
@if(isset($role) && $role === 'alumni')
    <div class="stat-item">
        <i class="bi bi-people-fill"></i>
        <span>Total Alumni: <strong>{{ $alumni instanceof \Illuminate\Pagination\LengthAwarePaginator ? $alumni->total() : $alumni->count() }}</strong></span>
    </div>
    @if(!empty($tahunLulusan) && !is_null($totalAlumniByYear))
        <div class="stat-item">
            <i class="bi bi-calendar-check"></i>
            <span>Alumni Tahun {{ $tahunLulusan }}: <strong>{{ $totalAlumniByYear }}</strong></span>
        </div>
    @endif
@elseif(isset($role) && $role === 'siswa')
    <div class="stat-item">
        <i class="bi bi-person-badge"></i>
        <span>Total Siswa: <strong>{{ $siswa instanceof \Illuminate\Pagination\LengthAwarePaginator ? $siswa->total() : $siswa->count() }}</strong></span>
    </div>
@else
    <div class="stat-item">
        <i class="bi bi-mortarboard"></i>
        <span>Total Alumni: <strong>{{ $alumni instanceof \Illuminate\Pagination\LengthAwarePaginator ? $alumni->total() : $alumni->count() }}</strong></span>
    </div>
    <div class="stat-item">
        <i class="bi bi-person-badge"></i>
        <span>Total Siswa: <strong>{{ $siswa instanceof \Illuminate\Pagination\LengthAwarePaginator ? $siswa->total() : $siswa->count() }}</strong></span>
    </div>
@endif
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <div class="table-responsive">
            <table class="table custom-table mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th style="width: 200px;">Nama</th>
                        @if(isset($role) && $role === 'alumni')
                            <th style="width: 150px;">Tanggal Lahir</th>
                            <th style="width: 120px;">Tahun Lulusan</th>
                            <th style="width: 150px;">Jurusan</th>
                            <th style="width: 200px;">Alamat</th>
                            <th style="width: 150px;">No HP/WhatsApp</th>
                            <th style="width: 120px;">Status</th>
                            
                            <th style="width: 180px;">Perusahaan</th>
                            <th style="width: 180px;">Universitas</th>
                            <th style="width: 180px;">Nomor Induk Alumni</th>
                            <th style="width: 120px;">Ijazah</th>
                            
                        @else
                        
                            <th style="width: 150px;">Jurusan</th>
                            @if(isset($role) && $role === 'siswa')
                                <th style="width: 120px;">NIS</th>
                            @endif
                        @endif
                        <th style="width: 150px;">Status Aktivitas</th>
                        <th style="width: 100px;">Role</th>
                        <th style="width: 100px;">Password</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentPage = 1;
                        $perPage = $perPage ?? 10;
                        if (isset($alumni) && $alumni instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                            $currentPage = $alumni->currentPage();
                        } elseif (isset($siswa) && $siswa instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                            $currentPage = $siswa->currentPage();
                        }
                        $no = ($currentPage - 1) * $perPage + 1;
                    @endphp

                    {{-- Alumni --}}
                    @foreach ($alumni as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=667eea&color=fff&rounded=true" class="user-avatar" alt="Avatar">
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->username ?? 'No username' }}</small>
                                    </div>
                                </div>
                            </td>
                            @if(isset($role) && $role === 'alumni')
                                <td>{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-F-Y') : '-' }}</td>
                                <td><span class="badge bg-light text-dark">{{ $user->tahun_lulusan }}</span></td>
                                <td>{{ $user->jurusan }}</td>
                                <td>{{ $user->alamat ?? '-' }}</td>
                                <td>{{ $user->no_hp ?? '-' }}</td>
                                <td>
                                    @if($user->status)
                                        <span class="badge bg-info">{{ $user->status }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $user->nama_perusahaan ?? '-' }}</td>
                                <td>{{ $user->nama_universitas ?? '-' }}</td>
                                <td>{{ $user->nia ?? '-' }}</td>
                                <td>
                                    @if($user->ijazah)
                                        @php
                                            $ijazahFiles = json_decode($user->ijazah, true);
                                            $fileCount = is_array($ijazahFiles) ? count($ijazahFiles) : 1;
                                        @endphp
                                        <div class="d-flex flex-column gap-1">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-view-ijazah"
                                                    data-ijazah-files="{{ $user->ijazah }}"
                                                    data-user-name="{{ $user->name }}"
                                                    title="Lihat Ijazah">
                                                <i class="bi bi-eye me-1"></i>
                                                Lihat {{ $fileCount > 1 ? "({$fileCount} file)" : '' }}
                                            </button>
                                            @if($fileCount > 1)
                                                <small class="text-muted">{{ $fileCount }} file tersimpan</small>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @else
                                <td>{{ $user->jurusan }}</td>
                            @endif
                            <td>
                                <span class="badge bg-{{ ($user->activity_status ?? 'Belum pernah login') === 'Belum pernah login' ? 'danger' : ($user->activity_status_color ?? 'light') }}">
                                    {{ $user->activity_status ?? 'Belum pernah login' }}
                                </span>
                            </td>
                            <td><span class="badge bg-primary">Alumni</span></td>
                            <td><span class="text-muted">••••••••</span></td>
                            <td>
                                <button type="button" class="btn btn-action btn-edit btn-sm btn-edit-user" 
                                    data-user-type="alumni" 
                                    data-user-id="{{ $user->id }}" 
                                    data-name="{{ $user->name }}" 
                                    data-username="{{ $user->username ?? '' }}" 
                                    data-jurusan="{{ $user->jurusan }}" 
                                    data-tahun-lulusan="{{ $user->tahun_lulusan ?? '' }}" 
                                    data-no-hp="{{ $user->no_hp ?? '' }}" 
                                    data-alamat="{{ $user->alamat ?? '' }}" 
                                    data-status="{{ $user->status ?? '' }}"
                                    data-nama-perusahaan="{{ $user->nama_perusahaan ?? '' }}" 
                                    data-nama-universitas="{{ $user->nama_universitas ?? '' }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.users.delete') }}" class="d-inline delete-user-form">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="user_type" value="alumni">
                                    <button type="submit" class="btn btn-action btn-delete btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    {{-- Siswa --}}
                    @foreach ($siswa as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6c757d&color=fff&rounded=true" class="user-avatar" alt="Avatar">
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->username ?? 'No username' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->jurusan }}</td>
                            @if(isset($role) && $role === 'siswa')
                                <td>{{ $user->nis ?? '-' }}</td>
                            @endif
                            <td>
                                <span class="badge bg-{{ ($user->activity_status ?? 'Belum pernah login') === 'Belum pernah login' ? 'danger' : ($user->activity_status_color ?? 'light') }}">
                                    {{ $user->activity_status ?? 'Belum pernah login' }}
                                </span>
                            </td>
                            <td><span class="badge bg-secondary">Siswa</span></td>
                            <td><span class="text-muted">••••••••</span></td>
                            <td>
                                <button type="button" class="btn btn-action btn-edit btn-sm btn-edit-user"
                                    data-user-type="siswa"
                                    data-user-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-username="{{ $user->username ?? '' }}"
                                    data-jurusan="{{ $user->jurusan }}"
                                    data-nis="{{ $user->nis ?? '' }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-action btn-warning btn-sm btn-convert-to-alumni"
                                    data-user-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-username="{{ $user->username ?? '' }}"
                                    data-jurusan="{{ $user->jurusan }}">
                                    <i class="bi bi-arrow-up-circle"></i> Alumni
                                </button>
                                <form method="POST" action="{{ route('admin.users.delete') }}" class="d-inline delete-user-form">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="user_type" value="siswa">
                                    <button type="submit" class="btn btn-action btn-delete btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                @php
                    $currentPage = 1;
                    if (isset($alumni) && $alumni instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                        $currentPage = $alumni->currentPage();
                    } elseif (isset($siswa) && $siswa instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                        $currentPage = $siswa->currentPage();
                    }
                @endphp
@if(isset($role) && $role === 'alumni')
    <div class="mb-2">Halaman {{ $currentPage }}</div>
    @if($alumni instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $alumni->onEachSide(0)->links('pagination::simple-bootstrap-4') }}
    @endif
@elseif(isset($role) && $role === 'siswa')
    <div class="mb-2">Halaman {{ $currentPage }}</div>
    @if($siswa instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $siswa->onEachSide(0)->links('pagination::simple-bootstrap-4') }}
    @endif
@else
    {{-- Show pagination for alumni and siswa separately --}}
    <div>
        <h6>Halaman {{ $currentPage }}</h6>
        @if($alumni instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $alumni->onEachSide(0)->links('pagination::simple-bootstrap-4') }}
        @endif
    </div>
    {{-- <div>
        <h6>Siswa</h6>
        @if($siswa instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $siswa->onEachSide(0)->links('pagination::simple-bootstrap-4') }}
        @endif
    </div> --}}
@endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Konversi Siswa ke Alumni -->
<div class="modal fade" id="convertToAlumniModal" tabindex="-1" aria-labelledby="convertToAlumniModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formConvertToAlumni" method="POST" action="{{ route('admin.users.convert-to-alumni') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="convertToAlumniModalLabel">
                        <i class="bi bi-arrow-up-circle me-2"></i>
                        Konversi Siswa ke Alumni
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Basic Information -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="bi bi-person-circle"></i>
                            Informasi Dasar Siswa
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="convert_name" name="name" placeholder="Nama Lengkap" readonly>
                            <label for="convert_name">👤 Nama Lengkap</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="convert_username" name="username" placeholder="Username" readonly>
                            <label for="convert_username">🔑 Username</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="convert_jurusan" name="jurusan" placeholder="Jurusan" readonly>
                            <label for="convert_jurusan">📚 Jurusan</label>
                        </div>
                    </div>

                    <!-- Alumni Information -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="bi bi-mortarboard"></i>
                            Informasi Alumni
                        </div>

                        <div class="form-floating">
                            <input type="date" class="form-control" id="convert_tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                            <label for="convert_tanggal_lahir">🎂 Tanggal Lahir</label>
                        </div>

                        <div class="form-floating">
                            <input type="number" class="form-control" id="convert_tahun_lulusan" name="tahun_lulusan" placeholder="Tahun Lulusan" required>
                            <label for="convert_tahun_lulusan">🎓 Tahun Lulusan</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="convert_alamat" name="alamat" placeholder="Alamat Lengkap" required>
                            <label for="convert_alamat">🏠 Alamat Lengkap</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="convert_no_hp" name="no_hp" placeholder="No HP/WhatsApp" required>
                            <label for="convert_no_hp">📱 No HP/WhatsApp</label>
                        </div>

                        <!-- Profile Image Upload -->
                        <div class="mb-3">
                            <label for="convert_profile_image" class="form-label" style="font-weight: 600; color: var(--text-dark); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-camera me-1"></i>
                                📸 Upload Foto Profil
                            </label>
                            <input type="file"
                                   class="form-control"
                                   id="convert_profile_image"
                                   name="profile_image"
                                   accept=".jpg,.jpeg,.png"
                                   onchange="previewProfileImage(this)">
                            <div class="form-text" style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">
                                <i class="bi bi-info-circle me-1"></i>
                                Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.
                            </div>
                        </div>

                        <!-- Profile Image Preview -->
                        <div id="profile-image-preview" class="d-none" style="margin-top: 1rem;">
                            <div class="form-section-title" style="font-size: 0.95rem; margin-bottom: 0.75rem;">
                                <i class="bi bi-eye me-1"></i>
                                Preview Foto Profil
                            </div>
                            <img id="profile-image-preview-img" src="" alt="Profile Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        </div>

                        <!-- Ijazah Upload Field -->
                        <div class="mb-3">
                            <label for="convert_ijazah" class="form-label" style="font-weight: 600; color: var(--text-dark); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-file-earmark-check me-1"></i>
                                📄 Upload Ijazah (JPG/PDF)
                            </label>
                            <input type="file"
                                   class="form-control"
                                   id="convert_ijazah"
                                   name="ijazah_files[]"
                                   accept=".jpg,.jpeg,.pdf,.png,.doc,.docx"
                                   multiple
                                   onchange="validateConvertFileSelection(this)">
                            <div class="form-text" style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">
                                <i class="bi bi-info-circle me-1"></i>
                                Format yang didukung: JPG, JPEG, PDF, PNG, DOC, DOCX. Maksimal 5MB per file.
                            </div>
                        </div>

                        <!-- File Preview Area -->
                        <div id="convert-file-preview" class="d-none" style="margin-top: 1rem;">
                            <div class="form-section-title" style="font-size: 0.95rem; margin-bottom: 0.75rem;">
                                <i class="bi bi-eye me-1"></i>
                                Preview File Ijazah
                            </div>
                            <div id="convert-file-list"></div>
                        </div>

                        <div class="form-floating">
                            <select class="form-select" id="convert_status" name="status" onchange="toggleConvertStatusFields()" required>
                                <option value="">Pilih Status</option>
                                <option value="Bekerja">Bekerja</option>
                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                                <option value="Studi Lanjut">Studi Lanjut</option>
                            </select>
                            <label for="convert_status">💼 Status Saat Ini</label>
                        </div>

                        <div id="convert_fieldPerusahaan" class="d-none">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="convert_nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan">
                                <label for="convert_nama_perusahaan">🏢 Nama Perusahaan</label>
                            </div>
                        </div>

                        <div id="convert_fieldUniversitas" class="d-none">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="convert_nama_universitas" name="nama_universitas" placeholder="Nama Universitas">
                                <label for="convert_nama_universitas">🎓 Nama Universitas</label>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden input for user_id -->
                    <input type="hidden" name="user_id" id="convert_user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modal btn-cancel" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-modal btn-submit" id="convertSubmitButton">
                        <i class="bi bi-arrow-up-circle me-2"></i>
                        Konversi ke Alumni
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Pengguna -->
<div class="modal fade" id="tambahPenggunaModal" tabindex="-1" aria-labelledby="tambahPenggunaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formTambahPengguna" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="tambahPenggunaModalLabel">
                        <i class="bi bi-person-plus me-2"></i>
                        Tambah Pengguna Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Basic Information -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="bi bi-person-circle"></i>
                            Informasi Dasar
                        </div>
                        
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                            <label for="nama">👤 Nama Lengkap</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                            <label for="username">🔑 Username</label>
                        </div>

                        <div class="form-floating" id="roleSelectContainer">
                            <select class="form-select" id="form_role" name="user_type" required onchange="toggleFields()">
                                <option value="">Pilih Role</option>
                                <option value="alumni" {{ old('user_type') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                                <option value="siswa" {{ old('user_type') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            </select>
                            <label for="form_role">🎯 Role Pengguna</label>
                        </div>
                        <div class="form-floating d-none" id="roleDisplayContainer">
                            <input type="text" class="form-control" id="roleDisplay" readonly>
                            <label for="roleDisplay">🎯 Role Pengguna</label>
                        </div>

                        <div class="form-floating">
                                <select class="form-select" id="jurusan" name="jurusan" required>
                                    <option value="" disabled {{ old('jurusan') ? '' : 'selected' }}>Pilih Jurusan</option>
                                    <option value="Teknik Grafika" {{ old('jurusan') == 'Teknik Grafika' ? 'selected' : '' }}>Teknik Grafika</option>
                                    <option value="Desain Komunikasi Visual" {{ old('jurusan') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                                    <option value="Teknik Komputer dan Jaringan" {{ old('jurusan') == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                                </select>
                                <label for="jurusan">📚 Jurusan</label>
                                @if(old('jurusan'))
                                    <input type="hidden" name="jurusan" value="{{ old('jurusan') }}">
                                @endif
                            </div>
                    </div>

                    <!-- Alumni Fields -->
                    <div id="alumniFields" class="d-none">
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-mortarboard"></i>
                                Informasi Alumni
                            </div>
                            
                            <div class="form-floating">
                                <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                                <label for="tanggalLahir">🎂 Tanggal Lahir</label>
                            </div>

                            <div class="form-floating">
                                <input type="number" class="form-control" id="tahunLulusan" name="tahun_lulusan" placeholder="Tahun Lulusan" value="{{ old('tahun_lulusan') }}">
                                <label for="tahunLulusan">🎓 Tahun Lulusan</label>
                            </div>

                            <div class="form-floating">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" value="{{ old('alamat') }}">
                                <label for="alamat">🏠 Alamat Lengkap</label>
                            </div>

                            <div class="form-floating">
                                <input type="text" class="form-control" id="noHp" name="no_hp" placeholder="No HP/WhatsApp" value="{{ old('no_hp') }}">
                                <label for="noHp">📱 No HP/WhatsApp</label>
                            </div>

                            <!-- Ijazah Upload Field -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="bi bi-file-earmark-check"></i>
                                    Upload Ijazah
                                </div>

                                <div class="mb-3">
                                    <label for="ijazah" class="form-label" style="font-weight: 600; color: var(--text-dark); display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="bi bi-upload me-1"></i>
                                        📄 Upload Ijazah (JPG/PDF)
                                    </label>
                                    <input type="file"
                                           class="form-control"
                                           id="ijazah"
                                           name="ijazah_files[]"
                                           accept=".jpg,.jpeg,.pdf,.png,.doc,.docx"
                                           multiple
                                           onchange="validateFileSelection(this)"
                                           style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 0.75rem; background: white; transition: var(--transition);">
                                    <div class="form-text" style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format yang didukung: JPG, JPEG, PDF. Maksimal 5MB per file.
                                    </div>
                                </div>

                                <!-- File Preview Area -->
                                <div id="file-preview" class="d-none" style="margin-top: 1rem;">
                                    <div class="form-section-title" style="font-size: 0.95rem; margin-bottom: 0.75rem;">
                                        <i class="bi bi-eye me-1"></i>
                                        Preview File
                                    </div>
                                    <div id="file-list"></div>
                                </div>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" id="modalStatus" name="status" onchange="toggleStatusFields()">
                                    <option value="">Pilih Status</option>
                                    <option value="Bekerja" {{ old('status') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                    <option value="Tidak Bekerja" {{ old('status') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="Studi Lanjut" {{ old('status') == 'Studi Lanjut' ? 'selected' : '' }}>Studi Lanjut</option>
                                </select>
                                <label for="status">💼 Status Saat Ini</label>
                            </div>

                            <div id="fieldPerusahaan" class="d-none">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="namaPerusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan') }}">
                                    <label for="namaPerusahaan">🏢 Nama Perusahaan</label>
                                </div>
                            </div>

                            <div id="fieldUniversitas" class="d-none">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="namaUniversitas" name="nama_universitas" placeholder="Nama Universitas" value="{{ old('nama_universitas') }}">
                                    <label for="namaUniversitas">🎓 Nama Universitas</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Siswa Fields -->
                    <div id="siswaFields" class="d-none">
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-person-badge"></i>
                                Informasi Siswa
                            </div>
                            
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Nomor Induk Siswa" value="{{ old('nis') }}">
                                <label for="nis">🆔 Nomor Induk Siswa (NIS)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div id="passwordSection">
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-shield-lock"></i>
                                Keamanan Akun
                            </div>
                            
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">🔒 Password</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                                <label for="password_confirmation">🔒 Konfirmasi Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modal btn-cancel" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-modal btn-submit" id="submitButton">
                        <i class="bi bi-person-plus me-2"></i>
                        Tambah Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize fields
        toggleFields();
        toggleStatusFields();

        // Event listeners
        document.getElementById('role')?.addEventListener('change', toggleFields);
document.getElementById('modalStatus')?.addEventListener('change', toggleStatusFields);

        // SweetAlert for delete confirmation
        document.querySelectorAll('.delete-user-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const row = this.closest('tr');
                const nama = row.querySelector('td:nth-child(2) .fw-semibold').innerText.trim();

                Swal.fire({
                    title: 'Hapus Pengguna?',
                    html: `Apakah Anda yakin ingin menghapus <strong>${nama}</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan.</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-3',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        this.submit();
                    }
                });
            });
        });

document.querySelectorAll('.btn-edit-user').forEach(button => {
    button.addEventListener('click', function () {
        const userType = this.getAttribute('data-user-type');
        const userId = this.getAttribute('data-user-id');
        const name = this.getAttribute('data-name');
        const username = this.getAttribute('data-username') || '';
        const jurusan = this.getAttribute('data-jurusan') || '';
        const tahunLulusan = this.getAttribute('data-tahun-lulusan') || '';
        const noHp = this.getAttribute('data-no-hp') || '';
        const alamat = this.getAttribute('data-alamat') || '';
        const status = this.getAttribute('data-status') || '';
        const namaPerusahaan = this.getAttribute('data-nama-perusahaan') || '';
        const namaUniversitas = this.getAttribute('data-nama-universitas') || '';
        const nis = this.getAttribute('data-nis') || '';

        // Set form action to update route
        const form = document.getElementById('formTambahPengguna');
        if (userType === 'alumni') {
            form.action = '{{ route("alumni.update") }}';
        } else if (userType === 'siswa') {
            form.action = '{{ route("siswa.update") }}';
        }

        // Set method to PUT for update
        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

        // Set hidden input for user id
        let idInput = form.querySelector('input[name="id"]');
        if (!idInput) {
            idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            form.appendChild(idInput);
        }
        idInput.value = userId;

        // Fill form fields
        form.querySelector('input[name="name"]').value = name;
        form.querySelector('input[name="username"]').value = username;
        form.querySelector('select[name="jurusan"]').value = jurusan;
        form.querySelector('select[name="user_type"]').value = userType;

        // Show appropriate fields based on user type
        const alumniFields = document.getElementById('alumniFields');
        const siswaFields = document.getElementById('siswaFields');
        const passwordSection = document.getElementById('passwordSection');
        const tahunLulusanInput = form.querySelector('input[name="tahun_lulusan"]');
        const jurusanSelect = form.querySelector('select[name="jurusan"]');

if (userType === 'alumni') {
    alumniFields.classList.remove('d-none');
    siswaFields.classList.add('d-none');
    tahunLulusanInput.value = tahunLulusan;
    tahunLulusanInput.setAttribute('readonly', true);
    // Disable jurusan select for editing
    jurusanSelect.setAttribute('disabled', true);
    // Add hidden input for jurusan to submit value when disabled
    let hiddenJurusan = form.querySelector('input[name="jurusan_hidden"]');
    if (!hiddenJurusan) {
        hiddenJurusan = document.createElement('input');
        hiddenJurusan.type = 'hidden';
        hiddenJurusan.name = 'jurusan';
        hiddenJurusan.value = jurusan;
        hiddenJurusan.setAttribute('name', 'jurusan');
        hiddenJurusan.setAttribute('id', 'jurusan_hidden');
        form.appendChild(hiddenJurusan);
    } else {
        hiddenJurusan.value = jurusan;
    }
    // Hide role select and show role display text
    document.getElementById('roleSelectContainer').classList.add('d-none');
    const roleDisplayContainer = document.getElementById('roleDisplayContainer');
    roleDisplayContainer.classList.remove('d-none');
    const roleDisplayInput = document.getElementById('roleDisplay');
    roleDisplayInput.value = 'Alumni (tidak bisa diubah)';
    // Disable tahun_lulusan input (already readonly)
    // no additional action needed
    noHpInput = form.querySelector('input[name="no_hp"]');
    alamatInput = form.querySelector('input[name="alamat"]');
    statusSelect = form.querySelector('select[name="status"]');
    namaPerusahaanInput = form.querySelector('input[name="nama_perusahaan"]');
    namaUniversitasInput = form.querySelector('input[name="nama_universitas"]');
    noHpInput.value = noHp;
    alamatInput.value = alamat;
    statusSelect.value = status;
    namaPerusahaanInput.value = namaPerusahaan;
    namaUniversitasInput.value = namaUniversitas;
    toggleStatusFields();
    // Show password fields for alumni edit
    passwordSection.classList.add('d-none');
    form.querySelector('input[name="password"]').removeAttribute('required');
    form.querySelector('input[name="password_confirmation"]').removeAttribute('required');
} else if (userType === 'siswa') {
    siswaFields.classList.remove('d-none');
    alumniFields.classList.add('d-none');
    form.querySelector('input[name="nis"]').value = nis;
    // Hide password fields for siswa edit (no confirmation required)
    passwordSection.classList.add('d-none');
    form.querySelector('input[name="password"]').removeAttribute('required');
    form.querySelector('input[name="password_confirmation"]').removeAttribute('required');
    // Make sure tahun_lulusan is editable for siswa (or clear readonly)
    tahunLulusanInput.removeAttribute('readonly');
    jurusanSelect.setAttribute('disabled', true);
    // Add hidden input for jurusan to submit value when disabled
    let hiddenJurusan = form.querySelector('input[name="jurusan_hidden"]');
    if (!hiddenJurusan) {
        hiddenJurusan = document.createElement('input');
        hiddenJurusan.type = 'hidden';
        hiddenJurusan.name = 'jurusan';
        hiddenJurusan.value = jurusan;
        hiddenJurusan.setAttribute('name', 'jurusan');
        hiddenJurusan.setAttribute('id', 'jurusan_hidden');
        form.appendChild(hiddenJurusan);
    } else {
        hiddenJurusan.value = jurusan;
    }
    // Hide role select and show role display text for siswa role (disable role change)
    document.getElementById('roleSelectContainer').classList.add('d-none');
    const roleDisplayContainer = document.getElementById('roleDisplayContainer');
    roleDisplayContainer.classList.remove('d-none');
    const roleDisplayInput = document.getElementById('roleDisplay');
    roleDisplayInput.value = 'Siswa (tidak bisa diubah)';
}

        // Change modal title and submit button for edit mode
        const modalTitle = document.getElementById('tambahPenggunaModalLabel');
        const submitButton = document.getElementById('submitButton');
        modalTitle.innerHTML = '<i class="bi bi-pencil-square me-2"></i>Edit Pengguna';
        submitButton.innerHTML = '<i class="bi bi-save me-2"></i>Simpan Perubahan';
        submitButton.className = 'btn btn-modal btn-submit';

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('tambahPenggunaModal'));
        modal.show();
    });
});

// Handle convert to alumni button clicks
document.querySelectorAll('.btn-convert-to-alumni').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-user-id');
        const name = this.getAttribute('data-name');
        const username = this.getAttribute('data-username') || '';
        const jurusan = this.getAttribute('data-jurusan');

        // Fill the convert modal form
        document.getElementById('convert_user_id').value = userId;
        document.getElementById('convert_name').value = name;
        document.getElementById('convert_username').value = username;
        document.getElementById('convert_jurusan').value = jurusan;

        // Clear other fields
        document.getElementById('convert_tanggal_lahir').value = '';
        document.getElementById('convert_tahun_lulusan').value = '';
        document.getElementById('convert_alamat').value = '';
        document.getElementById('convert_no_hp').value = '';
        document.getElementById('convert_status').value = '';
        document.getElementById('convert_nama_perusahaan').value = '';
        document.getElementById('convert_nama_universitas').value = '';

        // Clear file inputs
        document.getElementById('convert_profile_image').value = '';
        document.getElementById('convert_ijazah').value = '';

        // Hide conditional fields
        document.getElementById('convert_fieldPerusahaan').classList.add('d-none');
        document.getElementById('convert_fieldUniversitas').classList.add('d-none');

        // Clear file previews
        document.getElementById('profile-image-preview').classList.add('d-none');
        document.getElementById('convert-file-preview').classList.add('d-none');

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('convertToAlumniModal'));
        modal.show();
    });
});

// Add event listener for convert status change
document.getElementById('convert_status').addEventListener('change', toggleConvertStatusFields);

function toggleConvertStatusFields() {
    const status = document.getElementById('convert_status')?.value;
    const fieldPerusahaan = document.getElementById('convert_fieldPerusahaan');
    const fieldUniversitas = document.getElementById('convert_fieldUniversitas');

    // Hide both fields first
    fieldPerusahaan?.classList.add('d-none');
    fieldUniversitas?.classList.add('d-none');

    // Show relevant field based on status
    if (status === 'Bekerja') {
        fieldPerusahaan?.classList.remove('d-none');
    } else if (status === 'Studi Lanjut') {
        fieldUniversitas?.classList.remove('d-none');
    }
}

        // Add user button click handler (reset form)
        document.querySelector('.btn-add-user').addEventListener('click', function () {
            const form = document.getElementById('formTambahPengguna');

            // Reset form action and method for adding
            form.action = '{{ route("admin.users.store") }}';
            
            // Remove method override and id inputs
            const methodInput = form.querySelector('input[name="_method"]');
            const idInput = form.querySelector('input[name="id"]');
            if (methodInput) methodInput.remove();
            if (idInput) idInput.remove();

            // Reset form
            form.reset();

            // Get current filter role value
            const filterRoleSelect = document.getElementById('role');
            let currentFilterRole = 'siswa'; // default to siswa if not found
            if (filterRoleSelect) {
                currentFilterRole = filterRoleSelect.value;
            }

            // Set form role select based on filter role if it is 'siswa' or 'alumni'
            const formRoleSelect = form.querySelector('select[name="user_type"]');
            if (formRoleSelect && (currentFilterRole === 'siswa' || currentFilterRole === 'alumni')) {
                formRoleSelect.value = currentFilterRole;
                // Enable role select for add form (fix issue where it was disabled)
                formRoleSelect.removeAttribute('disabled');
            } else if (formRoleSelect) {
                formRoleSelect.value = '';
                // Enable role select for 'all' or other values
                formRoleSelect.removeAttribute('disabled');
            }

            // Trigger toggleFields to show/hide fields based on role
            if (typeof toggleFields === 'function') {
                toggleFields();
            }

            // Hide all conditional fields except those shown by toggleFields
            // (toggleFields already handles alumniFields and siswaFields visibility)
            document.getElementById('fieldPerusahaan').classList.add('d-none');
            document.getElementById('fieldUniversitas').classList.add('d-none');

            // Show password section
            const passwordSection = document.getElementById('passwordSection');
            passwordSection.classList.remove('d-none');
            form.querySelector('input[name="password"]').setAttribute('required', 'required');
            form.querySelector('input[name="password_confirmation"]').setAttribute('required', 'required');

            // Reset modal title and submit button for add mode
            const modalTitle = document.getElementById('tambahPenggunaModalLabel');
            const submitButton = document.getElementById('submitButton');
            modalTitle.innerHTML = '<i class="bi bi-person-plus me-2"></i>Tambah Pengguna Baru';
            submitButton.innerHTML = '<i class="bi bi-person-plus me-2"></i>Tambah Pengguna';
            submitButton.className = 'btn btn-modal btn-submit';
        });

        // Form submission with loading
        document.getElementById('formTambahPengguna').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submitButton');
            const originalText = submitButton.innerHTML;
            
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
            
            // Re-enable button after 3 seconds to prevent permanent disable if there's an error
            setTimeout(() => {
                if (submitButton.disabled) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }
            }, 3000);
        });
    });

    function toggleFields() {
        const role = document.getElementById('form_role')?.value;
        const alumniFields = document.getElementById('alumniFields');
        const siswaFields = document.getElementById('siswaFields');
        const passwordSection = document.getElementById('passwordSection');

        // Hide all fields first
        alumniFields.classList.add('d-none');
        siswaFields.classList.add('d-none');

        if (role === 'alumni') {
            alumniFields.classList.remove('d-none');
            toggleStatusFields();
        } else if (role === 'siswa') {
            siswaFields.classList.remove('d-none');
        }

        // Show password section for new users (when no _method input exists)
        const isEditing = document.querySelector('input[name="_method"]');
        if (!isEditing) {
            passwordSection.classList.remove('d-none');
        }
    }

function toggleStatusFields() {
    const status = document.getElementById('modalStatus')?.value;
    const fieldPerusahaan = document.getElementById('fieldPerusahaan');
    const fieldUniversitas = document.getElementById('fieldUniversitas');
    const inputPerusahaan = document.getElementById('namaPerusahaan');
    const inputUniversitas = document.getElementById('namaUniversitas');

    // Hide both fields first
    fieldPerusahaan?.classList.add('d-none');
    fieldUniversitas?.classList.add('d-none');

    // Show relevant field based on status without clearing input values
    if (status === 'Bekerja') {
        fieldPerusahaan?.classList.remove('d-none');
    } else if (status === 'Studi Lanjut') {
        fieldUniversitas?.classList.remove('d-none');
    }
}

    // Add some nice animations when modal opens
    document.getElementById('tambahPenggunaModal').addEventListener('shown.bs.modal', function () {
        const firstInput = this.querySelector('input:not([type="hidden"]):not([readonly])');
        if (firstInput) {
            firstInput.focus();
        }

    // Set disabled attribute on role select based on current filter role
    const filterRoleSelect = document.getElementById('role');
    let currentFilterRole = null;
    if (filterRoleSelect) {
        currentFilterRole = filterRoleSelect.value;
        if (currentFilterRole === 'all') {
            currentFilterRole = null;
        }
    }
    const formRoleSelect = document.getElementById('form_role');
    const form = document.getElementById('formTambahPengguna');
    if (formRoleSelect) {
        // Always enable the role select so it can be changed regardless of filter
        formRoleSelect.removeAttribute('disabled');
        // Remove hidden input if exists
        let hiddenInput = form.querySelector('input[name="user_type_hidden"]');
        if (hiddenInput) {
            hiddenInput.remove();
        }
    }
    });

    

    // Clear form when modal is hidden
    document.getElementById('tambahPenggunaModal').addEventListener('hidden.bs.modal', function () {
        const form = document.getElementById('formTambahPengguna');
        
        // Reset form if it was in edit mode
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) {
            // This was an edit form, reset everything
            form.reset();
            methodInput.remove();
            const idInput = form.querySelector('input[name="id"]');
            if (idInput) idInput.remove();
            
            // Reset to add mode
            form.action = '{{ route("admin.users.store") }}';
            document.getElementById('tambahPenggunaModalLabel').innerHTML = '<i class="bi bi-person-plus me-2"></i>Tambah Pengguna Baru';
            document.getElementById('submitButton').innerHTML = '<i class="bi bi-person-plus me-2"></i>Tambah Pengguna';
            
            // Show password section
            const passwordSection = document.getElementById('passwordSection');
            passwordSection.classList.remove('d-none');
            form.querySelector('input[name="password"]').setAttribute('required', 'required');
            form.querySelector('input[name="password_confirmation"]').setAttribute('required', 'required');
        }
    });


    document.getElementById('role').addEventListener('change', function () {
        const tahunLulusanContainer = document.getElementById('tahun_lulusan_container');
        if (this.value === 'alumni') {
            tahunLulusanContainer.style.display = 'flex';
        } else {
            tahunLulusanContainer.style.display = 'none';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const alumniFilters = document.getElementById('alumni_filters');
    const siswaFilters = document.getElementById('siswa_filters');
    const filterForm = document.querySelector('.filter-form');
    
    // Handle role change
    roleSelect.addEventListener('change', function() {
        const selectedRole = this.value;
        
        // Hide all specific filters first
        alumniFilters.style.display = 'none';
        siswaFilters.style.display = 'none';
        
        // Show relevant filters with animation
        if (selectedRole === 'alumni') {
            setTimeout(() => {
                alumniFilters.style.display = 'block';
                alumniFilters.style.opacity = '0';
                alumniFilters.style.transform = 'translateY(-10px)';
                
                setTimeout(() => {
                    alumniFilters.style.opacity = '1';
                    alumniFilters.style.transform = 'translateY(0)';
                }, 50);
            }, 150);
        } else if (selectedRole === 'siswa') {
            setTimeout(() => {
                siswaFilters.style.display = 'block';
                siswaFilters.style.opacity = '0';
                siswaFilters.style.transform = 'translateY(-10px)';
                
                setTimeout(() => {
                    siswaFilters.style.opacity = '1';
                    siswaFilters.style.transform = 'translateY(0)';
                }, 50);
            }, 150);
        }
    });
    
    // Handle form submission
    filterForm.addEventListener('submit', function(e) {
        const submitButton = this.querySelector('.btn-filter-apply');
        const originalText = submitButton.innerHTML;
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memuat...';
        
        // Reset button after 3 seconds if form doesn't submit
        setTimeout(() => {
            if (submitButton.disabled) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        }, 3000);
    });
    
    // Auto-submit on enter key in search input
    document.getElementById('search').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterForm.submit();
        }
    });
});

// File validation function
function validateFileSelection(input) {
    const files = input.files;
    const maxFiles = 5;
    const maxSize = 5 * 1024 * 1024; // 5MB per file
    const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

    // Check file count
    if (files.length > maxFiles) {
        Swal.fire({
            title: 'Terlalu Banyak File',
            text: `Anda hanya dapat mengunggah maksimal ${maxFiles} file sekaligus.`,
            icon: 'warning',
            confirmButtonText: 'Tutup'
        });
        input.value = '';
        return;
    }

    // Check each file
    let hasError = false;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        // Check file size
        if (file.size > maxSize) {
            Swal.fire({
                title: 'File Terlalu Besar',
                text: `File "${file.name}" terlalu besar. Maksimal 5MB per file.`,
                icon: 'warning',
                confirmButtonText: 'Tutup'
            });
            hasError = true;
            break;
        }

        // Check file type
        if (!allowedTypes.includes(file.type)) {
            Swal.fire({
                title: 'Format File Tidak Didukung',
                text: `File "${file.name}" memiliki format yang tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.`,
                icon: 'warning',
                confirmButtonText: 'Tutup'
            });
            hasError = true;
            break;
        }
    }

    if (hasError) {
        input.value = '';
        return;
    }

    // Show file preview
    showFilePreview(files);
}

function showFilePreview(files) {
    const previewDiv = document.getElementById('file-preview');
    const fileListDiv = document.getElementById('file-list');

    if (files.length === 0) {
        previewDiv.classList.add('d-none');
        return;
    }

    let html = '<div class="file-preview-list">';
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileSize = formatFileSize(file.size);
        const fileIcon = getFileIcon(file.type);

        html += `
            <div class="file-preview-item" style="display: flex; align-items: center; gap: 12px; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; margin-bottom: 4px; background: #f8fafc;">
                <i class="${fileIcon}" style="font-size: 1.2rem; color: #667eea;"></i>
                <div style="flex: 1;">
                    <div style="font-weight: 500; color: #2d3748;">${file.name}</div>
                    <div style="font-size: 0.8rem; color: #718096;">${fileSize}</div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${i})">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
    }
    html += '</div>';

    fileListDiv.innerHTML = html;
    previewDiv.classList.remove('d-none');
}

function getFileIcon(fileType) {
    if (fileType.includes('pdf')) {
        return 'bi bi-file-earmark-pdf';
    } else if (fileType.includes('image')) {
        return 'bi bi-file-earmark-image';
    } else if (fileType.includes('word')) {
        return 'bi bi-file-earmark-word';
    } else {
        return 'bi bi-file-earmark';
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Handle view ijazah button clicks
document.addEventListener('DOMContentLoaded', function() {
    // Handle view ijazah button clicks
    document.querySelectorAll('.btn-view-ijazah').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const ijazahFiles = this.getAttribute('data-ijazah-files');
            const userName = this.getAttribute('data-user-name');

            if (ijazahFiles) {
                try {
                    const files = JSON.parse(ijazahFiles);

                    if (Array.isArray(files) && files.length > 0) {
                        if (files.length === 1) {
                            // Single file - handle as before
                            const fileUrl = '{{ asset("storage") }}/' + files[0];
                            const isPdf = files[0].toLowerCase().includes('.pdf');

                            if (isPdf) {
                                window.open(fileUrl, '_blank');
                            } else {
                                showIjazahModal(fileUrl, userName);
                            }
                        } else {
                            // Multiple files - show selection modal
                            showMultipleFilesModal(files, userName);
                        }
                    } else {
                        Swal.fire({
                            title: 'File Tidak Ditemukan',
                            text: 'File ijazah tidak tersedia untuk ditampilkan.',
                            icon: 'warning',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (error) {
                    console.error('Error parsing ijazah files:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan dalam memproses file ijazah.',
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            } else {
                Swal.fire({
                    title: 'File Tidak Ditemukan',
                    text: 'File ijazah tidak tersedia untuk ditampilkan.',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    });
});

// Function to show multiple files selection modal
function showMultipleFilesModal(files, userName) {
    let filesList = '';
    files.forEach((file, index) => {
        const fileUrl = '{{ asset("storage") }}/' + file;
        const isPdf = file.toLowerCase().includes('.pdf');
        const fileIcon = isPdf ? 'bi-file-earmark-pdf' : 'bi-file-earmark-image';
        const fileType = isPdf ? 'PDF' : 'Gambar';

        filesList += `
            <div class="file-item" style="display: flex; align-items: center; gap: 12px; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 8px; background: #f8fafc; cursor: pointer; transition: all 0.2s ease;" onclick="openFile('${fileUrl}', ${isPdf}, '${userName}')">
                <i class="bi ${fileIcon}" style="font-size: 1.5rem; color: #667eea;"></i>
                <div style="flex: 1;">
                    <div style="font-weight: 500; color: #2d3748;">${file}</div>
                    <div style="font-size: 0.8rem; color: #718096;">${fileType}</div>
                </div>
                <i class="bi bi-eye" style="color: #667eea;"></i>
            </div>
        `;
    });

    Swal.fire({
        title: `Ijazah - ${userName}`,
        html: `
            <div style="text-align: left; max-height: 60vh; overflow-y: auto;">
                <p style="margin-bottom: 1rem; color: #718096; font-size: 0.9rem;">
                    <i class="bi bi-info-circle me-1"></i>
                    Klik pada file untuk membuka
                </p>
                ${filesList}
            </div>
        `,
        width: '90%',
        showConfirmButton: true,
        confirmButtonText: 'Tutup',
        customClass: {
            popup: 'ijazah-modal'
        }
    });
}

// Function to open file (either in new tab for PDF or modal for images)
function openFile(fileUrl, isPdf, userName) {
    if (isPdf) {
        window.open(fileUrl, '_blank');
    } else {
        showIjazahModal(fileUrl, userName);
    }
}

// Function to show ijazah in modal
function showIjazahModal(imageUrl, userName) {
    Swal.fire({
        title: `Ijazah - ${userName}`,
        html: `
            <div style="text-align: center;">
                <img src="${imageUrl}"
                     alt="Ijazah"
                     style="max-width: 100%; max-height: 70vh; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);"
                     onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400/e2e8f0/718096?text=File+tidak+dapat+ditampilkan';">
            </div>
        `,
        width: '90%',
        showConfirmButton: true,
        confirmButtonText: 'Tutup',
        customClass: {
            popup: 'ijazah-modal'
        }
    });
}


</script>
@endpush

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session("success") }}',
            icon: 'success'
        });
    });
</script>
@endif
