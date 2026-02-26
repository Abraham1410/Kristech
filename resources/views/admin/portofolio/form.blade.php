@extends('layouts.admin')
@section('page-title', isset($portofolio) ? 'Edit Portofolio' : 'Tambah Portofolio')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">{{ isset($portofolio) ? 'Edit Portofolio' : 'Tambah Foto Portofolio' }}</span>
        <a href="{{ route('admin.portofolio.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
    <form method="POST" action="{{ isset($portofolio) ? route('admin.portofolio.update', $portofolio) : route('admin.portofolio.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($portofolio)) @method('PUT') @endif

        <div class="form-group">
            <label>Judul *</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $portofolio->judul ?? '') }}" required placeholder="Contoh: Instalasi CCTV Gedung A">
            @error('judul') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi singkat (opsional)">{{ old('deskripsi', $portofolio->deskripsi ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Foto {{ isset($portofolio) ? '(Kosongkan jika tidak ingin mengganti)' : '*' }}</label>
            @if(isset($portofolio) && $portofolio->foto)
                <div style="margin-bottom:10px">
                    <img src="{{ Storage::url($portofolio->foto) }}" style="width:200px;height:150px;object-fit:cover;border-radius:8px">
                </div>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*" {{ !isset($portofolio) ? 'required' : '' }}>
            @error('foto') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $portofolio->kategori ?? '') }}" placeholder="Contoh: CCTV">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $portofolio->urutan ?? 0) }}" min="0">
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check" style="margin-top:10px">
                    <input type="checkbox" name="aktif" id="aktif" {{ old('aktif', $portofolio->aktif ?? true) ? 'checked' : '' }}>
                    <label for="aktif">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">💾 Simpan Portofolio</button>
    </form>
</div>
@endsection
