@extends('templates.user')

@section('header')
    <div class="text-center text-white py-4 px-3">
        <h1 class="fw-bold mb-2 fluid-heading">Hubungi <span class="text-warning">KateringKu</span></h1>
        <p class="lead mb-0 fw-semibold">Pertanyaan? Saran? Pesan khusus? Kami siap membantu!</p>
        <p class="mb-4 fw-semibold">Tim kami akan merespons secepat mungkin</p>
    </div>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Informasi Kontak -->
            <div class="col-md-6 mb-4 mx-auto">
                <div class="card shadow rounded-4 h-100">
                    <div class="card-header bg-warning text-dark rounded-top-4 py-3">
                        <h3 class="card-title mb-0 fw-bold">Informasi Kontak</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex mb-4">
                            <div class="bg-warning rounded-circle p-3 me-3">
                                <i class="bi bi-telephone fs-2 text-dark"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Telepon</h5>
                                <p class="fs-5 mb-0">
                                    <a href="tel:082198468727" class="text-decoration-none text-dark">
                                        0821-9846-8727
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="bg-warning rounded-circle p-3 me-3">
                                <i class="bi bi-globe fs-2 text-dark"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Website</h5>
                                <p class="fs-5 mb-0">
                                    <a href="https://www.kateringku.com" target="_blank" class="text-decoration-none text-dark">
                                        www.kateringku.com
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="bg-warning rounded-circle p-3 me-3">
                                <i class="bi bi-envelope fs-2 text-dark"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Email</h5>
                                <p class="fs-5 mb-0">
                                    <a href="mailto:info@kateringku.com" class="text-decoration-none text-dark">
                                        info@kateringku.com
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="bg-warning rounded-circle p-3 me-3">
                                <i class="bi bi-people fs-2 text-dark"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Media Sosial</h5>
                                <div class="d-flex mt-2">
                                    <a href="https://instagram.com/kateringku" target="_blank" class="btn btn-outline-dark me-2">
                                        <i class="bi bi-instagram me-1"></i> @kateringku
                                    </a>
                                    <a href="https://fb.me/kateringku" target="_blank" class="btn btn-outline-dark">
                                        <i class="bi bi-facebook me-1"></i> fb.me/kateringku
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('styles')
<style>
    .card {
        border: none;
    }
    .card-header {
        border-bottom: 2px solid rgba(0,0,0,0.1);
    }
    .form-control, .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
    .btn-outline-dark:hover {
        background-color: #ffc107;
        border-color: #ffc107;
    }
</style>
@endsection