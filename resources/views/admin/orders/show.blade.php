@extends('templates.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        {{-- Kolom Detail Pesanan --}}
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pesanan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px">ID Pesanan</th>
                            <td>#{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pemesan</th>
                            <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                        </tr>
                        <tr>
                            <th>Tanggal Acara</th>
                            <td>{{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Pengiriman</th>
                            <td>{{ $order->shipping_address }}</td>
                        </tr>
                         <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-primary">{{ Str::title(str_replace('_', ' ', $order->status)) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran</th>
                            <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>

                    <h5 class="mt-4">Item yang Dipesan:</h5>
                     <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                            <tr>
                                <td>{{ $detail->package->name ?? 'Item Dihapus' }}</td>
                                <td>{{ $detail->quantity }} orang</td>
                                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom Bukti Pembayaran & Aksi --}}
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bukti Pembayaran & Aksi</h3>
                </div>
                <div class="card-body">
                    @if($order->payment_proof)
                        <p>Bukti pembayaran telah diupload oleh pelanggan:</p>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid">
                        </a>

                        {{-- Tombol Konfirmasi hanya muncul jika statusnya 'waiting_confirmation' --}}
                        @if ($order->status == 'waiting_confirmation')
                            <form action="{{ route('admin.orders.confirm_payment', $order) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-success w-100">
                                    <i class="fas fa-check-circle"></i> Konfirmasi Pembayaran
                                </button>
                            </form>
                        @endif

                    @else
                        <div class="alert alert-secondary text-center">
                            Pelanggan belum mengupload bukti pembayaran.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection