@extends('layouts.admin')
@section('page-title', isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">{{ isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</span>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ isset($layanan) ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($layanan)) @method('PUT') @endif

        <div class="form-group">
            <label>Nama Layanan *</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $layanan->nama ?? '') }}"
                   required placeholder="Contoh: Kelistrikan">
            @error('nama') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi *</label>
            <textarea name="deskripsi" class="form-control" rows="6" required
                      placeholder="Deskripsi lengkap layanan...">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Foto Layanan</label>
            @if(isset($layanan) && $layanan->foto)
                <div style="margin-bottom:10px">
                    <img src="{{ Storage::url($layanan->foto) }}"
                         style="width:300px;height:200px;object-fit:cover;border-radius:8px;display:block">
                    <small style="color:#888;margin-top:6px;display:block">Foto saat ini. Upload baru untuk mengganti.</small>
                </div>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*">
            @error('foto') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Icon (emoji)</label>
            <input type="text" name="icon" class="form-control"
                   value="{{ old('icon', $layanan->icon ?? '') }}"
                   placeholder="Contoh: ⚡">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control"
                       value="{{ old('urutan', $layanan->urutan ?? 0) }}" min="0">
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check" style="margin-top:10px">
                    <input type="checkbox" name="aktif" id="aktif" value="1"
                           {{ old('aktif', $layanan->aktif ?? true) ? 'checked' : '' }}>
                    <label for="aktif">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">💾 Simpan Layanan</button>
    </form>
</div>
@endsection
