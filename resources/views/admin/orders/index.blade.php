@extends('templates.admin')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Semua Pesanan</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pemesan</th>
                            <th>Email</th>
                            <th>Tanggal Pesan</th>
                            <th>Tanggal Acara</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td>{{ $order->user->email ?? '-' }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-primary">{{ Str::title(str_replace('_', ' ', $order->status)) }}</span>
                            </td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection