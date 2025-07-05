@extends('templates.user')

@section('title-page', 'Keranjang Belanja')

@section('header')
    <h1 class="display-5 fw-bold">Keranjang Belanja Anda</h1>
    <p class="lead">Periksa kembali item pesanan Anda sebelum melanjutkan ke pembayaran.</p>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                            <td>{{ $details['quantity'] }} porsi</td>
                            <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_item_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-danger">&times;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Harga:</th>
                        <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>

            <hr>

            <h4>Lanjutkan Pemesanan</h4>
            <form action="{{ route('order.place.cart') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="event_date" class="form-label">Tanggal Acara</label>
                        <input type="date" class="form-control" name="event_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="shipping_address" class="form-label">Alamat Lengkap Pengiriman</label>
                        <textarea class="form-control" name="shipping_address" rows="3" required>{{ auth()->user()->alamat ?? '' }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Buat Pesanan Sekarang</button>
            </form>
        @else
            <div class="alert alert-info text-center">
                Keranjang belanja Anda masih kosong.
            </div>
        @endif
    </div>
</div>
@endsection