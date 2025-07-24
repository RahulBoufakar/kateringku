@extends('templates.user')

@section('title-page', 'Detail Pesanan #' . $order->id)

@section('header')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div>
            <h1 class="display-5 fw-bold">Detail Pesanan Anda</h1>
            <p class="lead">Lacak status pesanan Anda dan lakukan pembayaran di sini.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h4>Pesanan #{{ $order->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d F Y') }}<br>
                    <strong>Tanggal Acara:</strong> {{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}<br>
                    <strong>Status:</strong> <span
                        class="badge bg-primary">{{ Str::title(str_replace('_', ' ', $order->status)) }}</span>
                </div>
                <div class="col-md-6">
                    <strong>Alamat Pengiriman:</strong><br>
                    {{ $order->shipping_address }}
                </div>
            </div>

            <hr>

            <h5>Detail Item:</h5>
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
                    @foreach ($order->details as $detail)
                        <tr>
                            <td>{{ $detail->package->name ?? 'Item Dihapus' }}</td>
                            <td>{{ $detail->quantity }} orang</td>
                            <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if (Auth::user()->orders->first()->id == $order->id)
                        <tr>
                            <th colspan="3" class="text-end">Total Harga Awal:</th>
                            <th>Rp {{ number_format($order->total_price/0.85, 0, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Diskon:</th>
                            <th>15%</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Total Harga Akhir:</th>
                            <th>Rp {{ number_format($order->total_price , 0, ',', '.') }}</th>
                        </tr>
                    @else
                        <tr>
                            <th colspan="3" class="text-end">Total Harga:</th>
                            <th>Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                        </tr>
                    @endif
                </tfoot>
            </table>

            <hr>

            {{-- BAGIAN LOGIKA PEMBAYARAN --}}
            @if ($order->status == 'waiting_payment')
                <div class="alert alert-warning">
                    <h4 class="alert-heading">Silakan Lakukan Pembayaran</h4>
                    <p>Untuk melanjutkan pesanan, silakan transfer sejumlah <strong>Rp
                            {{ number_format($order->total_price, 0, ',', '.') }}</strong> ke rekening berikut:</p>
                    <p><strong>Bank BCA: 123-456-7890</strong> a.n. KateringKu Indonesia</p>
                    <hr>
                    <p>Setelah melakukan pembayaran, mohon upload bukti transfer Anda pada form di bawah ini.</p>
                </div>
                <form action="{{ route('order.upload_proof', $order) }}" method="POST" enctype="multipart/form-data"
                    class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran (JPG, PNG)</label>
                        <input class="form-control @error('payment_proof') is-invalid @enderror" type="file"
                            id="payment_proof" name="payment_proof" required>
                        @error('payment_proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Kirim Bukti Pembayaran</button>
                </form>
            @elseif ($order->status == 'waiting_confirmation')
                <div class="alert alert-info">
                    <h4 class="alert-heading">Menunggu Konfirmasi</h4>
                    <p>Terima kasih! Bukti pembayaran Anda telah kami terima dan akan segera kami periksa. Mohon tunggu
                        konfirmasi dari admin.</p>
                    <hr>
                    <strong>Bukti yang Anda upload:</strong><br>
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran"
                        class="img-fluid mt-2" style="max-width: 300px;">
                </div>
            @elseif ($order->status == 'confirmed')
                <div class="alert alert-success">
                    <h4 class="alert-heading">Pesanan Dikonfirmasi!</h4>
                    <p>Pembayaran Anda telah kami konfirmasi. Pesanan Anda akan kami siapkan sesuai tanggal acara. Terima
                        kasih telah memesan!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
