@extends('layouts.app')

@section('content')
<div class="container-fluid px-5 py-5 bg-light" style="min-height: 100vh; margin-top: 60px;">

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">🎓 Data Alumni</h1>
    <div>
      <button class="btn btn-outline-secondary me-2 shadow-sm rounded-pill">
        <i class="bi bi-funnel-fill me-1"></i>Filter
      </button>
      <button class="btn btn-outline-success me-2 shadow-sm rounded-pill">
        <i class="bi bi-download me-1"></i>Export
      </button>
      <button class="btn btn-primary shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahAlumni">
        <i class="bi bi-person-plus-fill me-2"></i>Tambah Alumni
      </button>
    </div>
  </div>

  {{-- Filter Jumlah --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <label for="itemsPerPage" class="form-label me-2">Show</label>
      <select id="itemsPerPage" class="form-select w-auto d-inline-block" disabled>
        <option value="All" selected>All</option>
      </select>
      <span class="ms-2">items per page</span>
    </div>
  </div>

  {{-- Tabel --}}
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 shadow-sm" style="table-layout: fixed; word-wrap: break-word;">
          <thead class="bg-primary text-white">
            <tr class="text-uppercase small fw-semibold">
              <th style="width: 3%;">No</th>
              <th style="width: 15%;">Nama</th>
              <th style="width: 10%;">Tanggal Lahir</th>
              <th style="width: 15%;">Jurusan</th>
              <th style="width: 8%;">Tahun Lulusan</th>
              <th style="width: 12%;">No HP/WhatsApp</th>
              <th style="width: 10%;">Status</th>
              <th style="width: 15%;">Nama Perusahaan</th>
              <th style="width: 15%;">Alamat</th>
              <th style="width: 15%;">Nama Universitas</th>
              <th style="width: 7%;" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($alumni as $index => $al)
            <tr style="word-wrap: break-word;" data-id="{{ $al->id }}">
              <td style="width: 3%;">{{ $index + 1 }}</td>
              <td style="width: 15%;" class="fw-semibold">{{ $al->name }}</td>
              <td style="width: 10%;">{{ $al->tanggal_lahir ? \Carbon\Carbon::parse($al->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
              <td style="width: 15%;">{{ $al->jurusan }}</td>
              <td style="width: 8%;">{{ $al->tahun_lulusan }}</td>
              <td style="width: 12%;">{{ $al->no_hp }}</td>
              <td style="width: 10%;">
                <span class="badge bg-{{ $al->status == 'Bekerja' ? 'success' : ($al->status == 'Studi Lanjut' ? 'warning' : 'danger') }} bg-opacity-10 text-{{ $al->status == 'Bekerja' ? 'success' : ($al->status == 'Studi Lanjut' ? 'warning' : 'danger') }} rounded-pill">
                  {{ $al->status }}
                </span>
              </td>
              <td style="width: 15%;">{{ $al->nama_perusahaan ?? '-' }}</td>
              <td style="width: 15%;">{{ $al->alamat ?? '-' }}</td>
              <td style="width: 15%;">{{ $al->nama_universitas ?? '-' }}</td>
              <td style="width: 7%;" class="text-center">
                <div class="dropdown">
                  <i class="bi bi-three-dots-vertical text-muted" role="button" data-bs-toggle="dropdown"></i>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEditAlumni">
                        <i class="bi bi-pencil-square me-2"></i>Perbarui
                      </a>
                    </li>
                    <li><a class="dropdown-item text-danger btn-delete"><i class="bi bi-trash me-2"></i>Hapus</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
    </table>
  </div>
</div>

{{-- Modal Edit Alumni --}}
<div class="modal fade" id="modalEditAlumni" tabindex="-1" aria-labelledby="modalEditAlumniLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <form id="editAlumniForm" method="POST" action="{{ route('alumni.update') }}">
        @csrf
        @method('PUT')
        <input type="hidden" id="editAlumniId" name="id" value="">
        <div class="modal-header bg-warning text-white rounded-top-4">
          <h5 class="modal-title" id="modalEditAlumniLabel">Perbarui Data Alumni</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="editNama" class="form-label">Nama</label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="editNama" name="name" required>
            </div>
            <div class="col-md-3">
              <label for="editJurusan" class="form-label">Jurusan</label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="editJurusan" name="jurusan" required>
            </div>
            <div class="col-md-3">
              <label for="editTahunLulusan" class="form-label">Tahun Lulusan</label>
              <input type="number" class="form-control rounded-3 shadow-sm" id="editTahunLulusan" name="tahun_lulusan" min="1900" max="2099" required>
            </div>
            <div class="col-md-6">
              <label for="editNoHp" class="form-label">No HP/WhatsApp</label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="editNoHp" name="no_hp" required>
            </div>
            <div class="col-md-6">
              <label for="editStatus" class="form-label">Status</label>
              <select class="form-select rounded-3 shadow-sm" id="editStatus" name="status" required>
                <option value="Bekerja">Bekerja</option>
                <option value="Tidak Bekerja">Tidak Bekerja</option>
                <option value="Studi Lanjut">Studi Lanjut</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="editNamaPerusahaan" class="form-label">Nama Perusahaan</label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="editNamaPerusahaan" name="nama_perusahaan">
            </div>
            <div class="col-md-6">
              <label for="editAlamat" class="form-label">Alamat</label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="editAlamat" name="alamat">
            </div>
            <div class="col-md-6">
              <label for="editNamaUniversitas" class="form-label">Nama Universitas</label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="editNamaUniversitas" name="nama_universitas">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning rounded-pill px-4">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

{{-- CSS --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
  .btn-gradient-prev,
  .btn-gradient-next {
    background: linear-gradient(90deg, #4F46E5, #6D28D9);
    color: #fff;
    border: none;
    transition: transform .2s, box-shadow .2s;
  }
  .btn-gradient-prev:hover,
  .btn-gradient-next:hover {
    transform: translateY(-2px);
    box-shadow: 0 .75rem 1rem rgba(0,0,0,.15);
  }
  .table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transition: background-color 0.3s ease;
  }
</style>
@endpush

{{-- JS --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
   document.addEventListener('DOMContentLoaded', () => {
    const editAlumniModal = new bootstrap.Modal(document.getElementById('modalEditAlumni'));
    const editAlumniForm = document.getElementById('editAlumniForm');

    // Handle "Edit" button click to fill the modal form
    document.querySelectorAll('.dropdown-menu .dropdown-item[data-bs-target="#modalEditAlumni"]').forEach(button => {
      button.addEventListener('click', event => {
        event.preventDefault();
        const tr = button.closest('tr');
        const id = tr.getAttribute('data-id');
        const name = tr.querySelector('td:nth-child(2)').innerText.trim();
        const jurusan = tr.querySelector('td:nth-child(3)').innerText.trim();
        const tahun_lulusan = tr.querySelector('td:nth-child(4)').innerText.trim();
        const no_hp = tr.querySelector('td:nth-child(5)').innerText.trim();
        const status = tr.querySelector('td:nth-child(6) span').innerText.trim();
        const nama_perusahaan = tr.querySelector('td:nth-child(7)').innerText.trim() === '-' ? '' : tr.querySelector('td:nth-child(7)').innerText.trim();
        const alamat = tr.querySelector('td:nth-child(8)').innerText.trim() === '-' ? '' : tr.querySelector('td:nth-child(8)').innerText.trim();
        const nama_universitas = tr.querySelector('td:nth-child(9)').innerText.trim() === '-' ? '' : tr.querySelector('td:nth-child(9)').innerText.trim();

        // Set form values
        document.getElementById('editAlumniId').value = id;
        document.getElementById('editNama').value = name;
        document.getElementById('editJurusan').value = jurusan;
        document.getElementById('editTahunLulusan').value = tahun_lulusan;
        document.getElementById('editNoHp').value = no_hp;
        document.getElementById('editStatus').value = status;
        document.getElementById('editNamaPerusahaan').value = nama_perusahaan;
        document.getElementById('editAlamat').value = alamat;
        document.getElementById('editNamaUniversitas').value = nama_universitas;
      });
    });

    // Handle delete button
    document.querySelectorAll('.btn-delete').forEach(button => {
      button.addEventListener('click', event => {
        event.preventDefault();
        const tr = button.closest('tr');
        const id = tr.getAttribute('data-id');
        const name = tr.querySelector('td:nth-child(2)').innerText.trim();

        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: `Data alumni "${name}" akan dihapus secara permanen!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`/alumni/${id}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
              }
            }).then(response => {
              if (response.ok) {
                tr.remove();
                Swal.fire('Terhapus!', `Data alumni "${name}" telah dihapus.`, 'success');
              } else {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
              }
            }).catch(error => {
              console.error(error);
              Swal.fire('Gagal!', 'Terjadi kesalahan jaringan.', 'error');
            });
          }
        });
      });
    });
  });

    const totalPages = Math.ceil(totalItems / perPage);
    document.getElementById('prevPage').disabled = page === 1;
    document.getElementById('nextPage').disabled = page === totalPages;  

  document.addEventListener('DOMContentLoaded', () => {
    renderTable(currentPage);

    document.getElementById('prevPage').addEventListener('click', () => {
      if (currentPage > 1) renderTable(--currentPage);
    });

    document.getElementById('nextPage').addEventListener('click', () => {
      if (currentPage < Math.ceil(totalItems / perPage)) renderTable(++currentPage);
    });

    document.getElementById('itemsPerPage').addEventListener('change', (e) => {
      perPage = parseInt(e.target.value);
      currentPage = 1;
      renderTable(currentPage);
    });

    document.addEventListener('click', e => {
      if (e.target.closest('.btn-delete')) {
        e.preventDefault();
        Swal.fire({
          title: "Yakin ingin menghapus?",
          text: "Data ini tidak dapat dikembalikan.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, hapus!"
        }).then(result => {
          if (result.isConfirmed) {
            Swal.fire("Terhapus!", "Data alumni berhasil dihapus.", "success");
          }
        });
      }
    });
  });
</script>
@endpush
