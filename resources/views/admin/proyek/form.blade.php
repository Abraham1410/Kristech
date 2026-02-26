@extends('layouts.admin')
@section('page-title', isset($proyek) ? 'Edit Proyek' : 'Tambah Proyek')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">{{ isset($proyek) ? 'Edit Proyek' : 'Tambah Proyek Baru' }}</span>
        <a href="{{ route('admin.proyek.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST" action="{{ isset($proyek) ? route('admin.proyek.update', $proyek) : route('admin.proyek.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($proyek)) @method('PUT') @endif

        <div class="form-group">
            <label>Judul Proyek *</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $proyek->judul ?? '') }}" required placeholder="Contoh: Gedung Kantor PT. XYZ">
            @error('judul') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi *</label>
            <textarea name="deskripsi" class="form-control" required placeholder="Deskripsi proyek...">{{ old('deskripsi', $proyek->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Foto Proyek {{ isset($proyek) ? '(Kosongkan jika tidak ingin mengganti)' : '*' }}</label>
            @if(isset($proyek) && $proyek->foto)
                <div style="margin-bottom:10px">
                    <img src="{{ Storage::url($proyek->foto) }}" style="width:200px;height:150px;object-fit:cover;border-radius:8px">
                </div>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*" {{ !isset($proyek) ? 'required' : '' }}>
            @error('foto') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $proyek->kategori ?? '') }}" placeholder="Contoh: Komersial">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $proyek->urutan ?? 0) }}" min="0">
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check" style="margin-top:10px">
                    <input type="checkbox" name="aktif" id="aktif" {{ old('aktif', $proyek->aktif ?? true) ? 'checked' : '' }}>
                    <label for="aktif">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">💾 Simpan Proyek</button>
    </form>
</div>
@endsection
