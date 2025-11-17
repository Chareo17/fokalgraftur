@extends('layouts.app')

@section('content')


<section id="hero" class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title" style="color: #FFFFFF;">Lowongan Kerja Terbaru</h1>
        <p class="hero-subtitle" style="color: #D3D3D3;">Temukan kesempatan kerja terbaru dan bergabunglah dengan tim kami untuk berkembang bersama.</p>

    </div>
</section>

<!-- Button for Modal -->
@if(Auth::guard('admin')->check() || Auth::guard('alumni')->check())
    <div class="d-flex justify-content-end">
        <button class="btn btn-gradient btn-lg px-4 py-2 rounded-pill shadow-lg mt-4 me-3" data-bs-toggle="modal" data-bs-target="#modalTambahLowongan">
            <i class="bi bi-plus-circle-dotted me-2"></i> Tambah Lowongan
        </button>
    </div>
    
    
    <!-- Modal Tambah Lowongan -->
    <div class="modal fade" id="modalTambahLowongan" tabindex="-1" aria-labelledby="modalTambahLowonganLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content border-0 shadow-lg rounded-5">
<form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-header bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-top-5">
        <h5 class="modal-title" id="modalTambahLowonganLabel">
            <i class="bi bi-file-earmark-plus"></i> <span class="fw-bold">Tambah Lowongan Baru</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
    </div>
    <div class="modal-body p-4">
        <!-- Input for Judul Lowongan -->
        <div class="mb-3">
            <label for="judul" class="form-label text-dark fw-semibold">🎯 Judul Lowongan</label>
            <input type="text" name="judul" id="judul" class="form-control form-control-lg rounded-3 border-0 shadow-sm" placeholder="Masukkan judul lowongan" required>
        </div>
        <!-- Input for Deskripsi Lowongan -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label text-dark fw-semibold">📋 Deskripsi Lowongan</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control rounded-3 border-0 shadow-sm" placeholder="Deskripsikan pekerjaan secara lebih detail" required></textarea>
        </div>
        <!-- Input for Gambar Lowongan -->
        <div class="mb-3">
            <label for="gambar" class="form-label text-dark fw-semibold">🖼️ Gambar Lowongan</label>
            <input type="file" name="gambar" id="gambar" class="form-control rounded-3 border-0 shadow-sm" accept="image/*" required>
            <small class="text-muted">Upload gambar berkualitas tinggi untuk hasil yang lebih menarik!</small>
        </div>
        <!-- Input for Batas Pengumpulan Persyaratan -->
        <div class="mb-3">
            <label for="batas_pengumpulan" class="form-label text-dark fw-semibold">📅 Batas Pengumpulan Persyaratan</label>
            <input type="date" name="batas_pengumpulan" id="batas_pengumpulan" class="form-control form-control-lg rounded-3 border-0 shadow-sm" placeholder="Pilih tanggal batas pengumpulan">
            <small class="text-muted">Pilih tanggal batas akhir pengumpulan persyaratan lowongan.</small>
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
    @endif



<section class="py-5">
    <div class="container">
        <div class="row">
          {{-- @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
          @endif --}}

          <section class="py-5">
              <div class="container">
                  <div class="row">
                      @forelse($lowongans as $lowongan)
                      <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                          <div class="card shadow-lg rounded-3 overflow-hidden h-100 transition-all duration-300 ease-in-out hover-shadow-lg">
                              <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="card-img-top" alt="Lowongan Image" style="height: 200px; object-fit: cover;">
                              <div class="card-body d-flex flex-column">
                                  <h5 class="card-title text-dark fw-bold" style="font-size: 1.25rem;">Posisi: {{ $lowongan->judul }}</h5>

                                  <p class="card-text" style="font-size: 1rem;">{{ Str::limit($lowongan->deskripsi, 100) }}</p>
                                  <a href="{{ route('lowongan.show', $lowongan->id) }}" class="mt-auto btn btn-success rounded-pill px-4 py-2" style="transition: background-color 0.3s ease;">Lihat Detail</a>
                              </div>
                          </div>
                      </div>
                      @empty
                      <p class="text-center">Belum ada lowongan tersedia.</p>
                      @endforelse
                  </div>

                  <!-- Pagination -->
                  <div class="d-flex flex-column align-items-center mt-5">
                      <div class="mb-3">
                      {{ $lowongans->links('pagination::bootstrap-5') }}
                     </div>
                 </div>
              </div>
          </section>

@endsection
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: "Lowongan Berhasil Di Upload",
      icon: "success",
      draggable: true,
      text: '{{ session("success") }}'
    });
  });
</script>
@endif

@if ($errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      icon: "error",
      title: "gagal di unggah",
      text: "karakter teks anda melebihi batas!",
      draggable: true,
    });
  });
</script>
@endif

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 400;
        margin-top: 20px;
    }

    /* Modal and Button Styles */
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

    .btn-lg {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        font-size: 1.1rem;
    }

    .modal-content {
        border-radius: 10px;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .col-lg-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

//modal tambah lowongan
    .modal-body {
        font-size: 1rem;
        color: #333;
    }

    .form-label {
        font-size: 1rem; /* Memastikan ukuran font label konsisten */
        font-weight: 600; /* Menjaga ketebalan label */
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        font-size: 1rem; /* Menyama ratakan ukuran font input */
        padding: 0.75rem; /* Memberi padding yang pas */
        border-radius: 0.375rem; /* Border radius seragam */
    }

    .btn {
        font-size: 1rem; /* Menyama ratakan ukuran font pada tombol */
        padding: 0.75rem 1.25rem; /* Padding tombol seragam */
    }

    .btn-close-white {
        font-size: 1.2rem; /* Ukuran font untuk tombol close */
    }

    .modal-header,
    .modal-footer {
        font-size: 1rem; /* Ukuran font di header dan footer modal */
    }
</style>
@endpush
