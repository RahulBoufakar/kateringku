@extends('templates.user')

@section('header')
    <div class="text-center text-white py-4 px-3">
        <h1 class="fw-bold mb-2 fluid-heading" >Selamat Datang di <span class="text-warning">KateringKu</span></h1>
        <p class="lead mb-0 fw-semibold">Solusi praktis dan lezat untuk setiap acara Anda</p>
        <p class="mb-4 fw-semibold">Dari rumah hingga kantor, kami hadir dengan menu terbaik dan pelayanan profesional</p>
        <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-4">Pesan Sekarang</a>
    </div>
@endsection

@section('content')
    <div class="container my-5">
        <div class="card shadow rounded-4 p-4">
            <h4 class="mb-5 text-center">Kelompok 2 - Profil Anggota</h4>
            <div class="row justify-content-center text-center">

                <!-- Member 1 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Ahmad Fadli" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Oshin Deby Tomasila</p>
                    <p class="mb-0 text-muted">220102070</p>
                </div>

                <!-- Member 2 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Siti Nurhaliza" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Christina Sofia Lekatompessy</p>
                    <p class="mb-0 text-muted">220102145</p>
                </div>

                <!-- Member 3 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Budi Santoso" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Nur Hufaira Tuasalamony</p>
                    <p class="mb-0 text-muted">220102143</p>
                </div>

                <!-- Member 4 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Rina Kartika" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Maulana</p>
                    <p class="mb-0 text-muted">220102079</p>
                </div>

                <!-- Member 5 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Dimas Saputra" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Rahul Rahman Boufakar </p>
                    <p class="mb-0 text-muted">220102078</p>
                </div>

                <!-- Member 5 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Dimas Saputra" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Frendi saplola </p>
                    <p class="mb-0 text-muted">220102032</p>
                </div>
                <!-- Member 5 -->
                <div class="col-md">
                    {{-- <img src="{{ asset('logo.jpeg') }}" alt="Dimas Saputra" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;"> --}}
                    <p class="mb-1 fw-semibold">Gustaf R Dahoklory </p>
                    <p class="mb-0 text-muted">220102003</p>
                </div>

            </div>
        </div>
    </div>
@endsection
