@extends('templates.admin')

@section('title', 'Manajemen Paket Katering')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Paket Katering</h3>
            <div class="card-tools">
                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Paket Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Paket</th>
                        <th>Harga per Orang</th>
                        <th>Min. Pesanan</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $package->name }}</td>
                            <td>Rp {{ number_format($package->price_per_pax, 0, ',', '.') }}</td>
                            <td>{{ $package->min_order }} orang</td>
                            <td>
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data paket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{-- Tampilkan pagination hanya jika $packages adalah LengthAwarePaginator --}}
            @if($packages instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $packages->links() }}
            @endif
        </div>
    </div>
@endsection