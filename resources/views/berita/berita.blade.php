@extends('layouts.app')

@section('content')
<section id="hero" class="hero-section">
  <div class="container text-center">
    <h1 class="hero-title" style="color: #FFFFFF;">Kegiatan Terbaru di Sekolah</h1>
    <p class="hero-subtitle" style="color: #D3D3D3;">Informasi mengenai acara dan kegiatan yang diadakan untuk alumni dan siswa di sekolah kami.</p>
  </div>
</section>

<!-- Berita Section -->
<section id="news" class="py-5">
  <div class="container">

    <div class="text-center mb-4">
      <h2 class="mb-3">Daftar Berita</h2>
      <button class="btn btn-gradient btn-lg px-4 py-2 rounded-pill shadow-lg" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
        <i class="bi bi-plus-circle-dotted me-2"></i> Tambah Berita
      </button>
    </div>

    <div class="row">
@foreach ($berita as $item)
      <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
        <div class="card news-card shadow-lg rounded-3 w-100" data-created-at="{{ $item->created_at }}">
          <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/500x300' }}" class="card-img-top" alt="{{ $item->judul }}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $item->judul }}</h5>
            <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($item->ringkasan, 150, '...') }}</p>
            <p class="text-muted small timeago"></p>
            <a href="{{ route('berita.show', ['id' => $item->id]) }}" class="btn btn-primary mt-auto">Baca Selengkapnya</a>
          </div>
        </div>
      </div>
@endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex flex-column align-items-center mt-5">
      <div class="mb-3">
        {{ $berita->links('pagination::bootstrap-5') }}
      </div>
    </div>
  
  </div>
</section>

<!-- Modal Tambah Berita -->
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-5">
      <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-top-5">
          <h5 class="modal-title" id="modalTambahBeritaLabel">
            <i class="bi bi-file-earmark-plus"></i> <span class="fw-bold">Tambah Berita Baru</span>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body p-4">
          <div class="mb-3">
            <label for="judul" class="form-label text-dark fw-semibold">🎯 Judul Berita</label>
            <input type="text" name="judul" id="judul" class="form-control form-control-lg rounded-3 border-0 shadow-sm" placeholder="Masukkan judul berita" required>
          </div>
          <div class="mb-3">
            <label for="ringkasan" class="form-label text-dark fw-semibold">📝 Ringkasan Berita</label>
            <textarea name="ringkasan" id="ringkasan" rows="4" class="form-control rounded-3 border-0 shadow-sm" placeholder="Ceritakan dengan ringkas tentang berita ini" required></textarea>
          </div>
          <div class="mb-3">
            <label for="gambar" class="form-label text-dark fw-semibold">🖼️ Gambar Berita</label>
            <input type="file" name="gambar" id="gambar" class="form-control rounded-3 border-0 shadow-sm" accept="image/*" required>
            <small class="text-muted">Upload gambar berkualitas tinggi untuk hasil yang lebih menarik!</small>
          </div>
        </div>
        <div class="modal-footer bg-light rounded-bottom-5">
          <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
            <i class="bi bi-save"></i> Simpan
          </button>
          <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-3" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Batal
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('styles')
  <style>
    .hero-section {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      padding: 100px 0;
      text-align: center;
      color: white;
      border-radius: 0 0 50% 50%;
    }

    .hero-title {
      font-size: 4rem;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 20px;
      animation: fadeInUp 1s ease-in-out;
    }

    .hero-subtitle {
      font-size: 1.25rem;
      font-weight: 400;
      margin-top: 20px;
      animation: fadeInUp 1.5s ease-in-out;
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .news-card {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
      transition: all 0.3s ease-in-out;
    }

    .news-card img {
      object-fit: cover;
      height: 250px;
      transition: transform 0.3s ease-in-out;
    }

    .news-card:hover img {
      transform: scale(1.05);
    }

    .card-body {
      padding: 20px;
      background-color: #fff;
      color: #333;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #333;
      transition: color 0.3s;
    }

    .card-title:hover {
      color: #2575fc;
    }

    .card-text {
      font-size: 1rem;
      color: #555;
      margin-bottom: 15px;
    }

    .btn-news {
      background-color: #2575fc;
      color: white;
      padding: 10px 20px;
      font-size: 1rem;
      text-transform: uppercase;
      border-radius: 25px;
      transition: background-color 0.3s ease;
      letter-spacing: 1px;
    }

    .btn-news:hover {
      background-color: #6a11cb;
      text-decoration: none;
    }

    .btn-hover:hover {
      transform: scale(1.1);
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-gradient {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      border: none;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-gradient:focus {
      outline: none;
      box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.5);
    }

    .btn-lg {
      padding-left: 1.5rem;
      padding-right: 1.5rem;
      font-size: 1.1rem;
    }

    .me-2 {
      margin-right: 0.5rem;
    }

    /* ========== PAGINATION STYLING - RAPI & MODERN ========== */
    
    /* Container Pagination */
    .pagination {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 15px 25px;
      background: #ffffff;
      border-radius: 50px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      margin: 0;
    }

    /* Reset default list style */
    .pagination .page-item {
      list-style: none;
      margin: 0;
    }

    /* Style untuk semua link pagination */
    .pagination .page-link {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 42px;
      height: 42px;
      padding: 8px 12px;
      border: 2px solid transparent;
      border-radius: 10px;
      background-color: #f8f9fa;
      color: #495057;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
    }

    /* Hover effect */
    .pagination .page-link:hover {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      border-color: transparent;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(106, 17, 203, 0.3);
    }

    /* Active page */
    .pagination .page-item.active .page-link {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      border-color: transparent;
      box-shadow: 0 4px 12px rgba(106, 17, 203, 0.4);
      transform: scale(1.05);
    }

    /* Disabled state */
    .pagination .page-item.disabled .page-link {
      background-color: #e9ecef;
      color: #adb5bd;
      cursor: not-allowed;
      opacity: 0.5;
    }

    .pagination .page-item.disabled .page-link:hover {
      transform: none;
      box-shadow: none;
      background-color: #e9ecef;
      color: #adb5bd;
    }

    /* Style khusus untuk Previous dan Next */
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
      min-width: 90px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.85rem;
    }

    /* Dots (...) styling */
    .pagination .page-item .page-link[aria-label="..."] {
      pointer-events: none;
      background-color: transparent;
      color: #6c757d;
      font-weight: 700;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }

      .hero-subtitle {
        font-size: 1rem;
      }

      .card-title {
        font-size: 1.2rem;
      }

      .col-lg-4 {
        flex: 0 0 50%;
        max-width: 50%;
      }

      .pagination {
        padding: 12px 20px;
        gap: 6px;
      }

      .pagination .page-link {
        min-width: 38px;
        height: 38px;
        font-size: 0.9rem;
        padding: 6px 10px;
      }

      .pagination .page-item:first-child .page-link,
      .pagination .page-item:last-child .page-link {
        min-width: 75px;
        font-size: 0.8rem;
      }
    }

    @media (max-width: 576px) {
      .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
      }

      .pagination {
        padding: 10px 15px;
        gap: 4px;
        border-radius: 30px;
      }

      .pagination .page-link {
        min-width: 35px;
        height: 35px;
        font-size: 0.85rem;
        padding: 5px 8px;
      }

      .pagination .page-item:first-child .page-link,
      .pagination .page-item:last-child .page-link {
        min-width: 65px;
        font-size: 0.75rem;
        padding: 5px 10px;
      }
    }

    /* Hide pagination info text */
    /* .d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between,
    .flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between {
      display: none !important;
    } */
  </style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    function updateTimeAgo() {
      const cards = document.querySelectorAll('.news-card[data-created-at]');
      cards.forEach(card => {
        const createdAt = card.getAttribute('data-created-at');
        const timeagoElem = card.querySelector('.timeago');
        if (createdAt && timeagoElem) {
          timeagoElem.textContent = dayjs(createdAt).fromNow();
        }
      });
    }
    updateTimeAgo();
    setInterval(updateTimeAgo, 1000);

    @if(session('error') || $errors->any())
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="#">Why do I have this issue?</a>'
      });
    @endif

    @if(session('success'))
      Swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
      });
    @endif
  });
</script>
@endpush