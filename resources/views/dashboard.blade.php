@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 bg-light" style="min-height: 100vh;">
  <!-- Header -->
  <div class="mt-5 p-5 rounded-4 shadow-lg mb-5 position-relative overflow-hidden animate__animated animate__fadeIn" style="background: linear-gradient(135deg, #6C5CE7, #341f97); color: white;">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
      <div>
        <h1 class="fw-bold display-4 mb-2" style="color: aliceblue">👋 Selamat Datang, Admin!</h1>
        {{-- o --}}
      </div>
      
    </div>
    {{-- <img src="https://undraw.co/api/illustrations/analytics.svg" alt="Ilustrasi" class="position-absolute end-0 bottom-0 me-4 mb-3" style="width: 160px; opacity: 0.2;"> --}}
  </div>

  <!-- Summary Cards -->
  <div class="row g-4 mb-5">
    <div class="col-md-3">
      <div class="card bg-primary text-white shadow-lg rounded-4 border-0 animate__animated animate__zoomIn">
        <div class="card-body text-center position-relative overflow-hidden">
          <i class="bi bi-people-fill fs-1 position-absolute opacity-25 top-0 end-0 p-3"></i>
          <h6 class="text-uppercase small fw-semibold mb-2" style="color: aliceblue">Total Alumni</h6>
          <h2 class="fw-bold display-6" style="color: aliceblue">{{ $totalAlumni }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white shadow-lg rounded-4 border-0 animate__animated animate__zoomIn animate__delay-1s">
        <div class="card-body text-center position-relative overflow-hidden">
          <i class="bi bi-briefcase-fill fs-1 position-absolute opacity-25 top-0 end-0 p-3"></i>
          <h6 class="text-uppercase small fw-semibold mb-2" style="color: aliceblue">Sudah Bekerja</h6>
          <h2 class="fw-bold display-6" style="color: aliceblue">{{ $alreadyWorking }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning text-dark shadow-lg rounded-4 border-0 animate__animated animate__zoomIn animate__delay-2s">
        <div class="card-body text-center position-relative overflow-hidden">
          <i class="bi bi-mortarboard-fill fs-1 position-absolute opacity-25 top-0 end-0 p-3"></i>
          <h6 class="text-uppercase small fw-semibold mb-2" style="color: aliceblue">Studi Lanjut</h6>
          <h2 class="fw-bold display-6" style="color: aliceblue">{{ $furtherStudy }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-danger text-white shadow-lg rounded-4 border-0 animate__animated animate__zoomIn animate__delay-3s">
        <div class="card-body text-center position-relative overflow-hidden">
          <i class="bi bi-person-dash-fill fs-1 position-absolute opacity-25 top-0 end-0 p-3"></i>
          <h6 class="text-uppercase small fw-semibold mb-2" style="color: aliceblue">Belum Bekerja</h6>
          <h2 class="fw-bold display-6" style="color: aliceblue">{{ $notWorkingYet }}</h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts -->
  <div class="row g-4 mb-5">
    <div class="col-lg-8">
      <div class="card shadow rounded-4 border-0 animate__animated animate__fadeInLeftBig">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-primary">📊 Grafik Alumni Berdasarkan Angkatan</h5>
            <a href="#" class="text-decoration-none text-primary small">Lihat Semua</a>
          </div>
          <div class="d-flex gap-3 mb-3 align-items-center">
            <div class="d-flex align-items-center gap-2">
              <label for="startYear" class="text-primary fw-semibold small mb-0">Dari Tahun:</label>
              <select id="startYear" class="form-select form-select-sm border-0 shadow-sm" style="width: 100px;">
                <option value="">Semua</option>
                @for($year = date('Y'); $year >= 2000; $year--)
                  <option value="{{ $year }}">{{ $year }}</option>
                @endfor
              </select>
            </div>
            <div class="d-flex align-items-center gap-2">
              <label for="endYear" class="text-primary fw-semibold small mb-0">Sampai Tahun:</label>
              <select id="endYear" class="form-select form-select-sm border-0 shadow-sm" style="width: 100px;">
                <option value="">Semua</option>
                @for($year = date('Y'); $year >= 2000; $year--)
                  <option value="{{ $year }}">{{ $year }}</option>
                @endfor
              </select>
            </div>
            <button id="applyFilter" class="btn btn-primary btn-sm rounded-pill px-3">Terapkan Filter</button>
          </div>
          <canvas id="alumniChart" height="120"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow rounded-4 border-0 animate__animated animate__fadeInRightBig">
        <div class="card-body text-center">
          <h5 class="fw-bold text-primary mb-3">📈 Distribusi Status</h5>
          <canvas id="alumniPieChart" height="180"></canvas>
        </div>
      </div>
    </div>
  </div>


<!-- Main Header Section -->
<div class="card shadow-lg rounded-4 border-0 mb-5 animate__animated animate__fadeInDown">
  <div class="card-header p-5 border-0 rounded-4" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8eeff 100%); border-left: 8px solid #6f42c1; position: relative; overflow: hidden;">
    <div class="card-header::before" style="content: ''; position: absolute; top: 0; right: 0; width: 100px; height: 100%; background: linear-gradient(45deg, rgba(111, 66, 193, 0.1), transparent);"></div>
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="d-flex align-items-center mb-3">
          <div class="me-4" style="background: linear-gradient(135deg, #6f42c1, #8b5cf6); width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(111, 66, 193, 0.3); animation: pulse 2s infinite;">
            <i class="bi bi-cloud-upload-fill text-white" style="font-size: 28px;"></i>
          </div>
          <div>
            <h1 class="fw-bold text-primary mb-2" style="font-size: 2.5rem;">
              Data Unggah Pengguna
            </h1>
            <p class="text-secondary mb-0 fs-5">
              Kelola dan pantau semua konten yang diunggah oleh pengguna dalam satu dashboard terpusat
            </p>
          </div>
        </div>
        
        <!-- Breadcrumb -->
        {{-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a href="#" class="text-decoration-none text-primary">
                <i class="bi bi-house-door-fill me-1"></i>Dashboard
              </a>
            </li>
            <li class="breadcrumb-item">
              <a href="#" class="text-decoration-none text-primary">Admin</a>
            </li>
            <li class="breadcrumb-item active text-secondary" aria-current="page">
              Data Unggah Pengguna
            </li>
          </ol>
        </nav> --}}
      </div>
      
      {{-- <div class="col-lg-4">
        <div class="row g-3">
          <div class="col-6">
            <div class="rounded-3 p-3 text-center" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
  <div id="totalKonten" class="text-primary fw-bold fs-4">{{ $totalKonten ?? 0 }}</div>
              <div class="text-muted small">Total Konten</div>
            </div>
          </div>
          <div class="col-6">
            <div class="rounded-3 p-3 text-center" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
  <div id="hariIni" class="text-success fw-bold fs-4">{{ $hariIni ?? 0 }}</div>
              <div class="text-muted small">Hari Ini</div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
</div>


  <!-- Forum Section -->
  <div class="card shadow-lg rounded-4 border-0 mb-5 animate__animated animate__fadeInUp">
    <div class="card-header p-4 border-0 rounded-4" style="background: linear-gradient(135deg, #e0f2ff, #f9fcff); border-left: 8px solid #0d6efd;">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3 class="fw-bold text-primary mb-1">
            <i class="bi bi-chat-dots-fill me-2"></i>Data Forum
          </h3>
          <p class="text-secondary mb-0">Kelola semua postingan forum yang diunggah oleh pengguna.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2">
            <label for="searchForum" class="text-dark fw-semibold mb-0">Cari:</label>
            <input type="text" id="searchForum" class="form-control form-control-sm border-0 shadow-sm" style="width: 200px;" placeholder="Nama atau Judul">
          </div>
          <div class="d-flex align-items-center gap-2">
            <label for="entriesForum" class="text-dark fw-semibold mb-0">Tampilkan:</label>
            <select id="entriesForum" class="form-select form-select-sm border-0 shadow-sm" style="width: 80px;">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="all">Semua</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 modern-table" id="forumTable">
          <thead class="table-primary">
            <tr>
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama Penginisiasi</th>
              <th class="px-4 py-3">Judul</th>
              <th class="px-4 py-3">Waktu</th>
              <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latestForumTopics as $index => $topic)
            <tr>
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    <i class="bi bi-person-fill text-white"></i>
                  </div>
                  <span class="fw-semibold">{{ $topic->creator_name ?? 'Unknown' }}</span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="fw-semibold text-primary">{{ $topic->judul_topik }}</div>
              </td>
              <td class="px-4 py-3">
                <small class="text-muted">{{ \Carbon\Carbon::parse($topic->created_at)->locale('id')->diffForHumans() }}</small>
              </td>
              <td class="px-4 py-3 text-center">
                <form action="{{ route('forum.destroy', $topic->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 btn-delete">
                    <i class="bi bi-trash3-fill"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-between align-items-center p-3 border-top">
        <div class="text-muted small" id="forumInfo">
          Menampilkan <span id="forumStart">1</span> sampai <span id="forumEnd">10</span> dari <span id="forumTotal">{{ count($latestForumTopics) }}</span> entri
        </div>
        <nav>
          <ul class="pagination pagination-sm mb-0" id="forumPagination">
            <!-- Pagination akan diisi oleh JavaScript -->
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Lowongan Kerja Section -->
  <div class="card shadow-lg rounded-4 border-0 mb-5 animate__animated animate__fadeInUp">
    <div class="card-header p-4 border-0 rounded-4" style="background: linear-gradient(135deg, #fff6e0, #fffdf5); border-left: 8px solid #ffc107;">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3 class="fw-bold text-warning mb-1">
            <i class="bi bi-megaphone-fill me-2"></i>Data Lowongan Kerja
          </h3>
          <p class="text-secondary mb-0">Kelola data lowongan kerja yang tersedia.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2">
            <label for="searchLowongan" class="text-dark fw-semibold mb-0">Cari:</label>
            <input type="text" id="searchLowongan" class="form-control form-control-sm border-0 shadow-sm" style="width: 200px;" placeholder="Nama atau Judul">
          </div>
          <div class="d-flex align-items-center gap-2">
            <label for="entriesLowongan" class="text-dark fw-semibold mb-0">Tampilkan:</label>
            <select id="entriesLowongan" class="form-select form-select-sm border-0 shadow-sm" style="width: 80px;">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="all">Semua</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 modern-table" id="lowonganKerjaTable">
          <thead class="table-warning">
            <tr>
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama</th>
              <th class="px-4 py-3">Judul</th>
              <th class="px-4 py-3">Waktu</th>
              <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latestLowongan as $index => $lowongan)
            <tr>
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    <i class="bi bi-briefcase-fill text-dark"></i>
                  </div>
                  <span class="fw-semibold">{{ strtolower($lowongan->name) === 'admin' ? 'admin' : $lowongan->name ?? 'Unknown' }}</span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="fw-semibold text-warning">{{ $lowongan->judul }}</div>
              </td>
              <td class="px-4 py-3">
                <small class="text-muted">{{ \Carbon\Carbon::parse($lowongan->created_at)->locale('id')->diffForHumans() }}</small>
              </td>
              <td class="px-4 py-3 text-center">
                <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 btn-delete">
                    <i class="bi bi-trash3-fill"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-between align-items-center p-3 border-top">
        <div class="text-muted small" id="lowonganInfo">
          Menampilkan <span id="lowonganStart">1</span> sampai <span id="lowonganEnd">10</span> dari <span id="lowonganTotal">{{ count($latestLowongan) }}</span> entri
        </div>
        <nav>
          <ul class="pagination pagination-sm mb-0" id="lowonganPagination">
            <!-- Pagination akan diisi oleh JavaScript -->
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Mentoring Section -->
  <div class="card shadow-lg rounded-4 border-0 mb-5 animate__animated animate__fadeInUp">
    <div class="card-header p-4 border-0 rounded-4" style="background: linear-gradient(135deg, #e0fafa, #f8fcfc); border-left: 8px solid #0dcaf0;">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3 class="fw-bold text-info mb-1">
            <i class="bi bi-person-video3 me-2"></i>Data Mentorship
          </h3>
          <p class="text-secondary mb-0">Kelola sesi Mentorship yang tersedia untuk pengguna.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2">
            <label for="searchMentoring" class="text-dark fw-semibold mb-0">Cari:</label>
            <input type="text" id="searchMentoring" class="form-control form-control-sm border-0 shadow-sm" style="width: 200px;" placeholder="Nama atau Judul">
          </div>
          <div class="d-flex align-items-center gap-2">
            <label for="entriesMentoring" class="text-dark fw-semibold mb-0">Tampilkan:</label>
            <select id="entriesMentoring" class="form-select form-select-sm border-0 shadow-sm" style="width: 80px;">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="all">Semua</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 modern-table" id="mentoringTable">
          <thead class="table-info">
            <tr>
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama</th>
              <th class="px-4 py-3">Judul</th>
              <th class="px-4 py-3">Waktu</th>
              <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latestMentoring as $index => $mentoring)
            <tr>
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    <i class="bi bi-person-video3 text-white"></i>
                  </div>
                  <span class="fw-semibold">{{ strtolower($mentoring->name) === 'admin' ? 'admin' : $mentoring->name ?? 'Unknown' }}</span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="fw-semibold text-info">{{ $mentoring->judul_mentoring }}</div>
              </td>
              <td class="px-4 py-3">
                <small class="text-muted">{{ \Carbon\Carbon::parse($mentoring->created_at)->locale('id')->diffForHumans() }}</small>
              </td>
              <td class="px-4 py-3 text-center">
                <form action="{{ route('mentoring.destroy', $mentoring->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 btn-delete">
                    <i class="bi bi-trash3-fill"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-between align-items-center p-3 border-top">
        <div class="text-muted small" id="mentoringInfo">
          Menampilkan <span id="mentoringStart">1</span> sampai <span id="mentoringEnd">10</span> dari <span id="mentoringTotal">{{ count($latestMentoring) }}</span> entri
        </div>
        <nav>
          <ul class="pagination pagination-sm mb-0" id="mentoringPagination">
            <!-- Pagination akan diisi oleh JavaScript -->
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Berita Section -->
  <div class="card shadow-lg rounded-4 border-0 mb-5 animate__animated animate__fadeInUp">
    <div class="card-header p-4 border-0 rounded-4" style="background: linear-gradient(135deg, #fdecea, #fff8f8); border-left: 8px solid #dc3545;">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3 class="fw-bold text-danger mb-1">
            <i class="bi bi-newspaper me-2"></i>Data Berita
          </h3>
          <p class="text-secondary mb-0">Kelola berita yang telah diposting oleh pengguna.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2">
            <label for="searchBerita" class="text-dark fw-semibold mb-0">Cari:</label>
            <input type="text" id="searchBerita" class="form-control form-control-sm border-0 shadow-sm" style="width: 200px;" placeholder="Nama atau Judul">
          </div>
          <div class="d-flex align-items-center gap-2">
            <label for="entriesBerita" class="text-dark fw-semibold mb-0">Tampilkan:</label>
            <select id="entriesBerita" class="form-select form-select-sm border-0 shadow-sm" style="width: 80px;">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="all">Semua</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 modern-table" id="beritaTable">
          <thead class="table-danger">
            <tr>
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama</th>
              <th class="px-4 py-3">Judul</th>
              <th class="px-4 py-3">Waktu</th>
              <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latestBerita as $index => $berita)
            <tr>
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                  <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    <i class="bi bi-newspaper text-white"></i>
                  </div>
                  <span class="fw-semibold">{{ $berita->name ?? 'Unknown' }}</span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="fw-semibold text-danger">{{ $berita->judul }}</div>
              </td>
              <td class="px-4 py-3">
<small class="text-muted">{{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->diffForHumans() }}</small>
              </td>
              <td class="px-4 py-3 text-center">
                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 btn-delete">
                    <i class="bi bi-trash3-fill"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-between align-items-center p-3 border-top">
        <div class="text-muted small" id="beritaInfo">
          Menampilkan <span id="beritaStart">1</span> sampai <span id="beritaEnd">10</span> dari <span id="beritaTotal">{{ count($latestBerita) }}</span> entri
        </div>
        <nav>
          <ul class="pagination pagination-sm mb-0" id="beritaPagination">
            <!-- Pagination akan diisi oleh JavaScript -->
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<script>
  // Global chart variable
  let alumniChart;

  // Function to create/update chart
  function createAlumniChart(labels, data) {
    const ctxBar = document.getElementById('alumniChart').getContext('2d');

    // Destroy existing chart if it exists
    if (alumniChart) {
      alumniChart.destroy();
    }

    alumniChart = new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Alumni',
          data: data,
          backgroundColor: (function() {
            const baseColors = [
              '#6C5CE7', '#FDCB6E', '#E17055', '#00B894', '#0984E3', '#D63031', '#00CEC9', '#FD79A8', '#636E72', '#FFEAA7'
            ];
            const colors = [];
            const count = labels.length;
            for (let i = 0; i < count; i++) {
              colors.push(baseColors[i % baseColors.length]);
            }
            return colors;
          })(),
          borderRadius: 12,
          hoverBackgroundColor: (function() {
            const hoverColors = [
              '#A29BFE', '#FFEAA7', '#FF7675', '#55EFC4', '#74B9FF', '#FF7675', '#00CEC9', '#FF6B81', '#B2BEC3', '#FFF3B0'
            ];
            const colors = [];
            const count = labels.length;
            for (let i = 0; i < count; i++) {
              colors.push(hoverColors[i % hoverColors.length]);
            }
            return colors;
          })()
        }]
      },
      options: {
        scales: { y: { beginAtZero: true, ticks: { display: false } } },
        plugins: { legend: { display: false }, tooltip: { enabled: true } },
        animation: { duration: 1500, easing: 'easeOutQuart' }
      }
    });
  }

  // Initialize chart with initial data
  createAlumniChart(@json($alumniYearLabels), @json($alumniYearCounts));

  // Add event listener for apply filter button
  document.getElementById('applyFilter').addEventListener('click', async function() {
    const startYear = document.getElementById('startYear').value;
    const endYear = document.getElementById('endYear').value;

    try {
      const response = await fetch(`/admin/dashboard/chart-data?year_from=${startYear}&year_to=${endYear}`, {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        credentials: 'same-origin'
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const data = await response.json();
      createAlumniChart(data.labels, data.data);
    } catch (error) {
      console.error('Failed to fetch chart data:', error);
    }
  });

  const ctxPie = document.getElementById('alumniPieChart').getContext('2d');
  new Chart(ctxPie, {
    type: 'doughnut',
    data: {
      labels: ['Bekerja', 'Studi Lanjut', 'Belum Bekerja'],
      datasets: [{
        data: [{{ $alreadyWorking }}, {{ $furtherStudy }}, {{ $notWorkingYet }}],
        backgroundColor: ['#00B894', '#FDCB6E', '#E17055'],
        hoverBackgroundColor: ['#55EFC4', '#FFEAA7', '#FF7675']
      }]
    },
    options: {
      plugins: { legend: { position: 'bottom' }, tooltip: { enabled: true } },
      animation: { animateRotate: true, duration: 2000 }
    }
  });

  // Enhanced Table Management Class
  class EnhancedDataTable {
    constructor(tableId, searchId, entriesId, infoId, paginationId) {
      this.table = document.getElementById(tableId);
      this.searchInput = document.getElementById(searchId);
      this.entriesSelect = document.getElementById(entriesId);
      this.infoElement = document.getElementById(infoId);
      this.paginationElement = document.getElementById(paginationId);
      
      this.originalRows = Array.from(this.table.querySelectorAll('tbody tr'));
      this.filteredRows = [...this.originalRows];
      this.currentPage = 1;
      this.rowsPerPage = 10;
      
      this.init();
    }
    
    init() {
      this.searchInput.addEventListener('input', () => this.handleSearch());
      this.entriesSelect.addEventListener('change', () => this.handleEntriesChange());
      this.render();
    }
    
    handleSearch() {
      const searchTerm = this.searchInput.value.toLowerCase();
      this.filteredRows = this.originalRows.filter(row => {
        const text = row.textContent.toLowerCase();
        return text.includes(searchTerm);
      });
      this.currentPage = 1;
      this.render();
    }
    
    handleEntriesChange() {
      const value = this.entriesSelect.value;
      this.rowsPerPage = value === 'all' ? this.filteredRows.length : parseInt(value);
      this.currentPage = 1;
      this.render();
    }
    
    render() {
      this.hideAllRows();
      this.showCurrentPageRows();
      this.updateInfo();
      this.updatePagination();
    }
    
    hideAllRows() {
      this.originalRows.forEach(row => row.style.display = 'none');
    }
    
    showCurrentPageRows() {
      const start = (this.currentPage - 1) * this.rowsPerPage;
      const end = start + this.rowsPerPage;
      const currentRows = this.filteredRows.slice(start, end);
      
      currentRows.forEach((row, index) => {
        row.style.display = 'table-row';
        const numberCell = row.querySelector('td:first-child');
        if (numberCell) {
          numberCell.textContent = start + index + 1;
        }
      });
    }
    
    updateInfo() {
      const start = Math.min((this.currentPage - 1) * this.rowsPerPage + 1, this.filteredRows.length);
      const end = Math.min(this.currentPage * this.rowsPerPage, this.filteredRows.length);
      const total = this.filteredRows.length;
      
      this.infoElement.querySelector('[id$="Start"]').textContent = this.filteredRows.length > 0 ? start : 0;
      this.infoElement.querySelector('[id$="End"]').textContent = end;
      this.infoElement.querySelector('[id$="Total"]').textContent = total;
    }
    
    updatePagination() {
      const totalPages = Math.ceil(this.filteredRows.length / this.rowsPerPage);
      this.paginationElement.innerHTML = '';
      
      if (totalPages <= 1) return;
      
      // Previous button
      const prevLi = document.createElement('li');
      prevLi.className = `page-item ${this.currentPage === 1 ? 'disabled' : ''}`;
      prevLi.innerHTML = `<a class="page-link" href="#" data-page="${this.currentPage - 1}">‹</a>`;
      this.paginationElement.appendChild(prevLi);
      
      // Page numbers
      const startPage = Math.max(1, this.currentPage - 2);
      const endPage = Math.min(totalPages, this.currentPage + 2);
      
      if (startPage > 1) {
        const firstLi = document.createElement('li');
        firstLi.className = 'page-item';
        firstLi.innerHTML = '<a class="page-link" href="#" data-page="1">1</a>';
        this.paginationElement.appendChild(firstLi);
        
        if (startPage > 2) {
          const ellipsisLi = document.createElement('li');
          ellipsisLi.className = 'page-item disabled';
          ellipsisLi.innerHTML = '<span class="page-link">...</span>';
          this.paginationElement.appendChild(ellipsisLi);
        }
      }
      
      for (let i = startPage; i <= endPage; i++) {
        const pageLi = document.createElement('li');
        pageLi.className = `page-item ${i === this.currentPage ? 'active' : ''}`;
        pageLi.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
        this.paginationElement.appendChild(pageLi);
      }
      
      if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
          const ellipsisLi = document.createElement('li');
          ellipsisLi.className = 'page-item disabled';
          ellipsisLi.innerHTML = '<span class="page-link">...</span>';
          this.paginationElement.appendChild(ellipsisLi);
        }
        
        const lastLi = document.createElement('li');
        lastLi.className = 'page-item';
        lastLi.innerHTML = `<a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>`;
        this.paginationElement.appendChild(lastLi);
      }
      
      // Next button
      const nextLi = document.createElement('li');
      nextLi.className = `page-item ${this.currentPage === totalPages ? 'disabled' : ''}`;
      nextLi.innerHTML = `<a class="page-link" href="#" data-page="${this.currentPage + 1}">›</a>`;
      this.paginationElement.appendChild(nextLi);
      
      // Add click event listeners
      this.paginationElement.querySelectorAll('a[data-page]').forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const page = parseInt(link.dataset.page);
          if (page >= 1 && page <= totalPages && page !== this.currentPage) {
            this.currentPage = page;
            this.render();
          }
        });
      });
    }
    
    goToPage(page) {
      const totalPages = Math.ceil(this.filteredRows.length / this.rowsPerPage);
      if (page >= 1 && page <= totalPages) {
        this.currentPage = page;
        this.render();
      }
    }
  }

  // Initialize tables when DOM is loaded
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize all enhanced data tables
    const forumTable = new EnhancedDataTable('forumTable', 'searchForum', 'entriesForum', 'forumInfo', 'forumPagination');
    const lowonganTable = new EnhancedDataTable('lowonganKerjaTable', 'searchLowongan', 'entriesLowongan', 'lowonganInfo', 'lowonganPagination');
    const mentoringTable = new EnhancedDataTable('mentoringTable', 'searchMentoring', 'entriesMentoring', 'mentoringInfo', 'mentoringPagination');
    const beritaTable = new EnhancedDataTable('beritaTable', 'searchBerita', 'entriesBerita', 'beritaInfo', 'beritaPagination');
    
    // Add smooth scrolling to tables
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.transition = 'transform 0.3s ease';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
    
    // Add loading animation for delete buttons
    document.querySelectorAll('.btn-delete, .btn-danger').forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const form = this.closest('form');
        const originalText = this.innerHTML;

        Swal.fire({
          title: "Apakah Anda yakin?",
          text: "Data unggahan ini akan dihapus dan tidak dapat dikembalikan!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",  // Biru
  cancelButtonColor: "#d33",      // Merah
  confirmButtonText: "Ya, hapus!",
  cancelButtonText: "Batal"
        }).then((result) => {
          if (result.isConfirmed) {
            this.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Menghapus...';
            this.disabled = true;
            form.submit();
          }
        });
      });
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    async function fetchDashboardStats() {
      try {
        const response = await fetch('/api/admin/dashboard-stats', {
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
          },
          credentials: 'same-origin'
        });
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        console.log('Dashboard stats data:', data);
        document.getElementById('totalKonten').textContent = data.totalKonten;
        document.getElementById('hariIni').textContent = data.hariIni;
      } catch (error) {
        console.error('Failed to fetch dashboard stats:', error);
      }
    }

    // Initial fetch
    fetchDashboardStats();

    // Refresh every 10 seconds
    setInterval(fetchDashboardStats, 10000);
  });
</script>

@if(session('success'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: "Good job!",
      text: "Data berhasil dihapus!",
      icon: "success"
    });
  });
</script>
@endif

<style>


@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}
.breadcrumb-item + .breadcrumb-item::before {
  content: "›";
  font-weight: bold;
  color: #6f42c1;
}
  /* Enhanced Modern Table Styles */
  .modern-table {
    border: none;
    border-radius: 0;
    overflow: hidden;
    box-shadow: none;
  }

  .modern-table thead th {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    color: #495057;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
  }

  .modern-table tbody tr {
    transition: all 0.3s ease;
    border: none;
  }

  .modern-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9ff, #fff8f8);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .modern-table tbody td {
    border: none;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
  }

  /* Card Hover Effects */
  .card {
    transition: all 0.3s ease;
    border: none;
  }

  .card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
  }

  /* Button Styles */
  .btn {
    transition: all 0.3s ease;
    border: none;
    font-weight: 500;
  }

  .btn-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
  }

  .btn-danger:hover {
    background: linear-gradient(135deg, #c82333, #bd2130);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
  }

  /* Pagination Styles */
  .pagination {
    border-radius: 8px;
    overflow: hidden;
  }

  .page-link {
    border: none;
    color: #6c757d;
    padding: 8px 12px;
    transition: all 0.3s ease;
  }

  .page-link:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    color: #495057;
    transform: translateY(-1px);
  }

  .page-item.active .page-link {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
  }

  /* Search and Filter Controls */
  .form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }

  /* Responsive Enhancements */
  @media (max-width: 768px) {
    .d-flex.gap-3 {
      flex-direction: column;
      gap: 1rem !important;
    }
    
    .table-responsive {
      border-radius: 8px;
      border: 1px solid #dee2e6;
    }
    
    .modern-table {
      font-size: 0.875rem;
    }
    
    .modern-table th,
    .modern-table td {
      padding: 0.5rem !important;
    }
  }

  /* Loading Animation */
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .bi-arrow-clockwise {
    animation: spin 1s linear infinite;
  }

  /* Enhanced Card Headers */
  .card-header {
    background: none !important;
    border: none !important;
  }

  /* Table Color Themes */
  .table-primary th {
    background: linear-gradient(135deg, #cce5ff, #b3d7ff) !important;
    color: #0056b3 !important;
  }

  .table-warning th {
    background: linear-gradient(135deg, #fff2cc, #ffe69c) !important;
    color: #856404 !important;
  }

  .table-info th {
    background: linear-gradient(135deg, #ccf2ff, #99e6ff) !important;
    color: #055160 !important;
  }

  .table-danger th {
    background: linear-gradient(135deg, #ffcccc, #ff9999) !important;
    color: #721c24 !important;
  }

  /* Smooth Transitions */
  * {
    transition: all 0.3s ease;
  }

  /* Custom Scrollbar */
  .table-responsive::-webkit-scrollbar {
    height: 8px;
  }

  .table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
  }

  .table-responsive::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-radius: 4px;
  }

  .table-responsive::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
  }
</style>


@if(session('loginSuccess'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
      }
    });
    Toast.fire({
      icon: "success",
      title: "Berhasil masuk"
    });
  });
</script>
@endif

@endsection
