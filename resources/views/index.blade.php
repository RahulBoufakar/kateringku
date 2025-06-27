@extends('templates.user')

@section('header')
    @include('partials.navbar')
    <div class="text-center text-white py-4 px-3">
        <h1 class="fw-bold mb-2">Selamat Datang di <span class="text-warning">KateringKu</span></h1>
        <p class="lead mb-0">Solusi praktis dan lezat untuk setiap acara Anda</p>
        <p class="mb-4">Dari rumah hingga kantor, kami hadir dengan menu terbaik dan pelayanan profesional</p>
        <a href="#pesan" class="btn btn-warning btn-lg px-4">Pesan Sekarang</a>
    </div>

@endsection

@section('content')
   <div class="container my-5">
  <div class="card shadow rounded-4 p-4">
    <h4 class="mb-4 text-center">Kelompok 2 - Profil Anggota</h4>
    <div class="row justify-content-center text-center">
      
      <!-- Member 1 -->
      <div class="col-md">
        <img src="{{ asset('logo.jpeg') }}" alt="Ahmad Fadli" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="mb-1 fw-semibold">Nama: Ahmad Fadli</p>
        <p class="mb-0 text-muted">NIM: 21102101</p>
      </div>

      <!-- Member 2 -->
      <div class="col-md">
        <img src="{{ asset('logo.jpeg') }}" alt="Siti Nurhaliza" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="mb-1 fw-semibold">Nama: Siti Nurhaliza</p>
        <p class="mb-0 text-muted">NIM: 21102102</p>
      </div>

      <!-- Member 3 -->
      <div class="col-md">
        <img src="{{ asset('logo.jpeg') }}" alt="Budi Santoso" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="mb-1 fw-semibold">Nama: Budi Santoso</p>
        <p class="mb-0 text-muted">NIM: 21102103</p>
      </div>

      <!-- Member 4 -->
      <div class="col-md">
        <img src="{{ asset('logo.jpeg') }}" alt="Rina Kartika" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="mb-1 fw-semibold">Nama: Rina Kartika</p>
        <p class="mb-0 text-muted">NIM: 21102104</p>
      </div>

      <!-- Member 5 -->
      <div class="col-md">
        <img src="{{ asset('logo.jpeg') }}" alt="Dimas Saputra" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="mb-1 fw-semibold">Nama: Dimas Saputra</p>
        <p class="mb-0 text-muted">NIM: 21102105</p>
      </div>

    </div>
  </div>
</div>
@endsection