@extends('templates.admin')

@section('title', 'Tambah Paket Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Paket</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Paket</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="price_per_pax" class="form-label">Harga per Orang (Pax)</label>
                <input type="number" class="form-control @error('price_per_pax') is-invalid @enderror" id="price_per_pax" name="price_per_pax" value="{{ old('price_per_pax') }}" required>
                @error('price_per_pax') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="min_order" class="form-label">Minimal Pesanan (jumlah orang)</label>
                <input type="number" class="form-control @error('min_order') is-invalid @enderror" id="min_order" name="min_order" value="{{ old('min_order') }}" required>
                @error('min_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Paket (Opsional)</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pilih Menu yang Termasuk dalam Paket</label>
                <div class="row">
                    @foreach ($menuItems as $item)
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input @error('menu_items') is-invalid @enderror" 
                                    type="checkbox" 
                                    name="menu_items[]" 
                                    id="menu_item_{{ $item->id }}" 
                                    value="{{ $item->id }}"
                                    {{ in_array($item->id, old('menu_items', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="menu_item_{{ $item->id }}">
                                    {{ $item->nama_menu }} ({{ $item->kategori }})
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <small class="form-text text-muted">Centang menu yang ingin dimasukkan ke dalam paket.</small>
                @error('menu_items') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection