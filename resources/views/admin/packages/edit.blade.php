@extends('templates.admin')

@section('title', 'Edit Paket: ' . $package->name)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit Paket</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Paket</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $package->name) }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $package->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="price_per_pax" class="form-label">Harga per Orang (Pax)</label>
                <input type="number" class="form-control @error('price_per_pax') is-invalid @enderror" id="price_per_pax" name="price_per_pax" value="{{ old('price_per_pax', $package->price_per_pax) }}" required>
                @error('price_per_pax') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="min_order" class="form-label">Minimal Pesanan (jumlah orang)</label>
                <input type="number" class="form-control @error('min_order') is-invalid @enderror" id="min_order" name="min_order" value="{{ old('min_order', $package->min_order) }}" required>
                @error('min_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="image_url" class="form-label">Upload Gambar Baru (Opsional)</label>
                <input class="form-control @error('image_url') is-invalid @enderror" type="file" id="image_url" name="image_url">
                @error('image_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if ($package->image_url)
                    <div class="mt-2">
                        <small>Gambar saat ini:</small><br>
                        <img src="{{ asset('storage/' . $package->image_url) }}" alt="{{ $package->getOriginal('name') }}" style="max-width: 200px;">
                    </div>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="menu_items" class="form-label">Pilih Menu yang Termasuk dalam Paket</label>
                @php
                    // Ambil ID dari menu yang sudah terhubung dengan paket ini
                    $selectedMenuItems = old('menu_items', $package->menuItems->pluck('id')->toArray());
                @endphp
                <select class="form-select @error('menu_items') is-invalid @enderror" id="menu_items" name="menu_items[]" multiple required size="10">
                    @foreach ($menuItems as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id, $selectedMenuItems) ? 'selected' : '' }}>
                            {{ $item->nama_menu }} ({{ $item->kategori }})
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Tahan tombol Ctrl (atau Command di Mac) untuk memilih lebih dari satu.</small>
                @error('menu_items') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection