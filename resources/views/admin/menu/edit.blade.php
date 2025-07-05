@extends('templates.admin')

@section('title', 'Edit Menu: ' . $menuItem->name)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit Menu</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.menus.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Method spoofing untuk update --}}
            <div class="mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menuItem->nama_menu) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $menuItem->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Lauk Utama" {{ old('kategori', $menuItem->kategori) == 'Lauk Utama' ? 'selected' : '' }}>Lauk Utama</option>
                    <option value="Sayuran" {{ old('kategori', $menuItem->kategori) == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                    <option value="Pendamping" {{ old('kategori', $menuItem->kategori) == 'Pendamping' ? 'selected' : '' }}>Pendamping</option>
                    <option value="Minuman" {{ old('kategori', $menuItem->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="Dessert" {{ old('kategori', $menuItem->kategori) == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                </select>
                 @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga per Porsi</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $menuItem->harga) }}" required>
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar Baru (Opsional)</label>
                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($menuItem->gambar)
                    <div class="mt-2">
                        <small>Gambar saat ini:</small><br>
                        <img src="{{ asset('storage/' . $menuItem->gambar) }}" alt="{{ $menuItem->nama_menu }}" style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection