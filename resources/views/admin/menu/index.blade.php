@extends('templates.admin')

@section('title-page', 'Menu')

@section('content')
<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mt-4 mb-3 gap-2">
        <h1 class="mb-0">Menu</h1>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">Tambah Menu</a>
    </div>

    <p class="mb-2">Welcome to the admin menu management page!</p>
    <p class="mb-4">Here you can manage your application menus, add new items, and organize them as needed.</p>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Menu</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $data->nama_menu }}</td>
                        <td style="max-width: 300px; word-break: break-word;">{{ $data->deskripsi }}</td>
                        <td>Rp{{ number_format($data->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($data->gambar)
                                <img src="{{ asset('storage/' . $data->gambar) }}" alt="{{ $data->nama_menu }}"
                                    class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $data->kategori }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('admin.menus.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.menus.destroy', $data->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data menu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
