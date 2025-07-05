@extends('templates.user')

@section('title-page', 'Detail Paket: ' . $package->name)

@section('header')
    {{-- Header bisa dikosongkan atau diisi sesuai selera --}}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $package->image_url ? asset('storage/' . $package->image_url) : 'https://via.placeholder.com/600x400' }}" class="img-fluid rounded shadow-sm" alt="{{ $package->name }}">
        </div>
        <div class="col-md-6">
            <h1 class="display-5">{{ $package->name }}</h1>
            <h3 class="text-muted">Rp {{ number_format($package->price_per_pax, 0, ',', '.') }} / orang</h3>
            <p class="lead mt-3">{{ $package->description }}</p>
            <p class="text-danger"><small>Minimal pemesanan: {{ $package->min_order }} orang.</small></p>

            <hr>

            <h4>Menu yang Termasuk:</h4>
            <ul>
                @foreach($package->menuItems as $item)
                    <li>{{ $item->name }} ({{ $item->category }})</li>
                @endforeach
            </ul>
            
            <div class="d-grid gap-2 mt-4">
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#orderPackageModal-{{ $package->id }}">
                    Pesan Paket Ini
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="orderPackageModal-{{ $package->id }}" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Pesan Paket: {{ $package->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('order.place.package') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{-- ... isi form modal tidak berubah ... --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection