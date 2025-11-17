@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-top: 90px;">Perkembangan Sekolah</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#perkembanganModal" onclick="loadForm('{{ route('admin.perkembangan-sekolah.create') }}')">Tambah Perkembangan</button>
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal Publikasi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perkembangan as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ Str::limit($item->description, 50) }}</td>
                <td>{{ $item->tanggal_publikasi }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" width="100">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#perkembanganModal" onclick="loadForm('{{ route('admin.perkembangan-sekolah.edit', $item->id) }}')">Edit</button>
                    <form action="{{ route('admin.perkembangan-sekolah.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="perkembanganModal" tabindex="-1" aria-labelledby="perkembanganModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perkembanganModalLabel">Tambah/Edit Perkembangan Sekolah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Form will be loaded here -->
      </div>
    </div>
  </div>
</div>

<script>
function loadForm(url) {
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('modalBody').innerHTML = data;
    })
    .catch(error => console.error('Error loading form:', error));
}
</script>
@endsection
