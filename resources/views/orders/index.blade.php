@extends('templates.user')

@section('title-page', 'Daftar Pesanan Saya')

@section('header')
    <h1 class="display-5 fw-bold">Daftar Pesanan Anda</h1>
    <p class="lead">Lihat riwayat pesanan dan detail pesanan Anda di sini.</p>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Riwayat Pesanan</h4>
            </div>
            <div class="card-body">
                @if ($orders->isEmpty())
                    <div class="alert alert-info">
                        Anda belum memiliki pesanan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Acara</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-primary">{{ Str::title(str_replace('_', ' ', $order->status)) }}</span>
                                        </td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('order.show', $order) }}" class="btn btn-sm btn-info">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
