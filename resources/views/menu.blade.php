@extends('templates.user')

@section('title-page', 'Pilih Menu Anda')

@section('header')
    @include('partials.navbar')
    <h1 class="display-4 fw-bold">Pilih Menu Spesial Anda</h1>
    <p class="lead">Pesan paket praktis atau pilih sendiri menu favorit Anda.</p>
@endsection

@section('content')
    <div class="container py-4">
        <div class="mt-5">
            {{-- Tabs untuk Paket dan A La Carte --}}
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-packages-tab" data-bs-toggle="pill" data-bs-target="#pills-packages" type="button" role="tab" aria-controls="pills-packages" aria-selected="true">Paket Katering</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-ala-carte-tab" data-bs-toggle="pill" data-bs-target="#pills-ala-carte" type="button" role="tab" aria-controls="pills-ala-carte" aria-selected="false">Menu Satuan (A La Carte)</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                {{-- Konten Tab Paket --}}
                <div class="tab-pane fade show active" id="pills-packages" role="tabpanel" aria-labelledby="pills-packages-tab">
                    <h2 class="text-center mb-4">Paket Praktis & Lengkap</h2>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse ($packages as $package)
                            <div class="col">
                                <div class="card h-100">
                                    <a href="{{ route('packages.show', $package) }}">
                                        <img src="{{ $package->image_url ? asset('storage/' . $package->image_url) : 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $package->name }}">
                                    </a>
                                    {{-- <img src="{{ $package->image_url ? asset('storage/' . $package->image_url) : 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $package->name }}"> --}}
                                    <div class="card-body">
                                        <a href="{{ route('packages.show', $package) }}"><h5 class="card-title">{{ $package->name }}</h5></a>
                                        <h6 class="card-subtitle mb-2 text-muted">Rp {{ number_format($package->price_per_pax, 0, ',', '.') }}/pax</h6>
                                        <p class="card-text">{{ $package->description }}</p>
                                        <p class="card-text"><small class="text-muted">Minimal pesanan: {{ $package->min_order }} orang.</small></p>
                                        <ul>
                                            @foreach ($package->menuItems->take(4) as $item)
                                                <li>{{ $item->nama_menu }}</li>
                                            @endforeach
                                            @if ($package->menuItems->count() > 4)
                                                <li>... dan lainnya</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        {{-- Tombol untuk membuka Modal Pemesanan --}}
                                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#orderPackageModal-{{ $package->id }}">
                                            Pesan Paket Ini
                                        </button>
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
                                                <p>Silakan isi detail pesanan Anda. Anda harus <a href="{{ route('login') }}">login</a> terlebih dahulu untuk memesan.</p>
                                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                <div class="mb-3">
                                                    <label for="num_of_pax" class="form-label">Jumlah Orang (min. {{ $package->min_order }})</label>
                                                    <input type="number" class="form-control" name="num_of_pax" value="{{ $package->min_order }}" min="{{ $package->min_order }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="event_date" class="form-label">Tanggal Acara</label>
                                                    <input type="date" class="form-control" name="event_date" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="shipping_address" class="form-label">Alamat Lengkap Pengiriman</label>
                                                    <textarea class="form-control" name="shipping_address" rows="3" required>{{ auth()->user()->alamat ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Belum ada paket yang tersedia saat ini.</p>
                        @endforelse
                    </div>
                </div>
                {{-- Konten Tab A La Carte --}}
                <div class="tab-pane fade" id="pills-ala-carte" role="tabpanel" aria-labelledby="pills-ala-carte-tab">
                    <h2 class="text-center mb-4">Pilih Menu Satuan</h2>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @foreach ($menuItems as $category => $items)
                        <h3 class="mt-4">{{ $category }}</h3>
                        <hr>
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            @foreach ($items as $item)
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $item->nama_menu }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->nama_menu }}</h5>
                                            <p class="card-text">Rp {{ number_format($item->harga, 0, ',', '.') }}/porsi</p>
                                        </div>
                                        <div class="card-footer">
                                            {{-- LOGIKA BARU: Cek apakah item ada di keranjang --}}
                                            @if(session('cart') && isset(session('cart')[$item->id]))
                                                <div class="text-center">
                                                    <p class="mb-2">
                                                        <span class="badge bg-primary fs-6">{{ session('cart')[$item->id]['quantity'] }} Porsi</span> di Keranjang
                                                    </p>
                                                    <form action="{{ route('cart.remove') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus menu dari keranjang?')">Hapus</button>
                                                    </form>
                                                </div>
                                            @else
                                                {{-- Jika tidak ada, tampilkan tombol "Tambah ke Keranjang" --}}
                                                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addToCartModal-{{ $item->id }}">
                                                    <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addToCartModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah: {{ $item->nama_menu }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    @guest
                                                        <p>Anda harus <a href="{{ route('login') }}">login</a> untuk menambahkan item.</p>
                                                    @endguest
                                                    <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                                    <div class="mb-3">
                                                        <label for="quantity" class="form-label">Jumlah Porsi:</label>
                                                        <input type="number" class="form-control" name="quantity" value="1" min="1" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection