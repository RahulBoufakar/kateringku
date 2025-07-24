@extends('templates.user')

@section('header')
    <div class="text-center text-white py-4 px-3">
        <h1 class="fw-bold mb-2 fluid-heading">Selamat Datang di <span class="text-warning">KateringKu</span></h1>
        <p class="lead mb-0 fw-semibold">Makenan Lezat, Di Jamin Halal</p>
        <p class="mb-4 fw-semibold">Solusi praktis dan lezat untuk setiap acara Anda</p>
        <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-4 shadow-sm">Pesan Sekarang</a>
    </div>
@endsection

@section('content')
    <!-- Promo Diskon -->
    <div class="container mb-5">
        <div class="card border-warning shadow rounded-4 overflow-hidden">
            <div class="row g-0">
                @auth()
                    @if(Auth::user()->orders()->count() == 0)
                        <div class="col-md-4 bg-warning d-flex align-items-center justify-content-center">
                            <div class="text-center p-4">
                                <h2 class="text-dark fw-bold display-4">15%</h2>
                                <p class="text-dark fs-5 fw-bold mb-0">DISKON</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body py-4">
                            <h3 class="card-title fw-bold">Promo Spesial untuk Pelanggan Baru!</h3>
                            <p class="card-text">Nikmati diskon 15% pada pesanan pertama Anda di KateringKu. Cepat, lezat, dan harga terjangkau. Jangan lewatkan kesempatan ini!</p>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-4 me-3 fw-bold">Pesan Sekarang</a>
                                <span class="badge bg-danger rounded-pill fs-6 py-2 px-3">
                                    Hanya untuk Pesanan Pertama!
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif()
                @else()
                    <div class="col-md-4 bg-warning d-flex align-items-center justify-content-center">
                            <div class="text-center p-4">
                                <h2 class="text-dark fw-bold display-4">15%</h2>
                                <p class="text-dark fs-5 fw-bold mb-0">DISKON</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body py-4">
                            <h3 class="card-title fw-bold">Promo Spesial untuk Pelanggan Baru!</h3>
                            <p class="card-text">Nikmati diskon 15% pada pesanan pertama Anda di KateringKu. Cepat, lezat, dan harga terjangkau. Jangan lewatkan kesempatan ini!</p>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-4 me-3 fw-bold">Pesan Sekarang</a>
                                <span class="badge bg-danger rounded-pill fs-6 py-2 px-3">
                                    Hanya untuk Pesanan Pertama!
                                </span>
                            </div>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </div>

    <!-- Profil Anggota -->
    <div class="container my-5">
        <div class="card shadow rounded-4 p-4">
            <h4 class="mb-5 text-center">Kelompok 2 - Profil Anggota</h4>
            <div class="row justify-content-center text-center">

                <!-- Member 1 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Oshin Deby Tomasila</p>
                    <p class="mb-0 text-muted">220102070</p>
                </div>

                <!-- Member 2 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Christina Sofia Lekatompessy</p>
                    <p class="mb-0 text-muted">220102145</p>
                </div>

                <!-- Member 3 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Nur Hufaira Tuasalamony</p>
                    <p class="mb-0 text-muted">220102143</p>
                </div>

                <!-- Member 4 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Maulana</p>
                    <p class="mb-0 text-muted">220102079</p>
                </div>

                <!-- Member 5 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Rahul Rahman Boufakar</p>
                    <p class="mb-0 text-muted">220102078</p>
                </div>

                <!-- Member 6 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Frendi Saplola</p>
                    <p class="mb-0 text-muted">220102032</p>
                </div>
                
                <!-- Member 7 -->
                <div class="col-md">
                    <p class="mb-1 fw-semibold">Gustaf R Dahoklory</p>
                    <p class="mb-0 text-muted">220102003</p>
                </div>

            </div>
        </div>
    </div>
@endsection