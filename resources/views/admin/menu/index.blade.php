@extends('templates.admin')

@section('title-page', 'Menu')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <h1>Menu</h1>
            <a href="{{ route('menu.create') }}" class="btn btn-primary">Tambah Menu</a>
        </div>
        <p>Welcome to the admin menu management page!</p>
        <p>Here you can manage your application menus, add new items, and organize them as needed.</p>

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menu as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_menu }}</td>
                            <td>{{ $data->deskripsi }}</td>
                            <td>Rp{{ number_format($data->harga, 0, ',', '.') }}</td>
                            <td>
                                @if($data->gambar)
                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="{{ $data->nama_menu }}" width="60">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $data->kategori }}</td>
                            <td>
                                <a href="{{ route('menu.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('menu.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data menu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection