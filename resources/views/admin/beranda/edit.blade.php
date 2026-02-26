@extends('layouts.admin')
@section('page-title', 'Edit Konten Beranda')
@section('content')
<form method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="card">
        <div class="card-header"><span class="card-title">🏠 Section Hero</span></div>

        <div class="form-group">
            <label>Judul Hero *</label>
            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $beranda->hero_title ?? 'Solusi Pemasangan dan Perbaikan kelistrikan anda') }}" required>
        </div>
        <div class="form-group">
            <label>Sub Judul Hero *</label>
            <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $beranda->hero_subtitle ?? 'Melayani kebutuhan Jasa pemasangan dan perbaikan untuk Tempat usaha dan tempat tinggal anda') }}" required>
        </div>
        <div class="form-group">
            <label>Foto Background Hero</label>
            @if(isset($beranda) && $beranda->hero_image)
                <div style="margin-bottom:10px"><img src="{{ Storage::url($beranda->hero_image) }}" style="width:300px;height:150px;object-fit:cover;border-radius:8px"></div>
            @endif
            <input type="file" name="hero_image" class="form-control" accept="image/*">
        </div>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title">📊 Statistik</span></div>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:20px">
            <div class="form-group">
                <label>Angka Statistik 1</label>
                <input type="number" name="stat_proyek" class="form-control" value="{{ old('stat_proyek', $beranda->stat_proyek ?? 150) }}">
            </div>
            <div class="form-group">
                <label>Label Statistik 1</label>
                <input type="text" name="stat_proyek_label" class="form-control" value="{{ old('stat_proyek_label', $beranda->stat_proyek_label ?? 'Berkualitas') }}">
            </div>
            <div class="form-group">
                <label>Angka Statistik 2</label>
                <input type="number" name="stat_tahun" class="form-control" value="{{ old('stat_tahun', $beranda->stat_tahun ?? 15) }}">
            </div>
            <div class="form-group">
                <label>Label Statistik 2</label>
                <input type="text" name="stat_tahun_label" class="form-control" value="{{ old('stat_tahun_label', $beranda->stat_tahun_label ?? 'Terpercaya') }}">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title">🏢 Section Tentang</span></div>
        <div class="form-group">
            <label>Judul Tentang *</label>
            <input type="text" name="tentang_title" class="form-control" value="{{ old('tentang_title', $beranda->tentang_title ?? 'Tentang Kristech Solusindo Energi') }}" required>
        </div>
        <div class="form-group">
            <label>Deskripsi Tentang *</label>
            <textarea name="tentang_description" class="form-control" required>{{ old('tentang_description', $beranda->tentang_description ?? 'Kami ahli dalam kontraktor mekanikal elektrikal dengan pendekatan profesional dan solusi tepat untuk bisnis Anda.') }}</textarea>
        </div>
        <div class="form-group">
            <label>Foto Tentang</label>
            @if(isset($beranda) && $beranda->tentang_image)
                <div style="margin-bottom:10px"><img src="{{ Storage::url($beranda->tentang_image) }}" style="width:300px;height:150px;object-fit:cover;border-radius:8px"></div>
            @endif
            <input type="file" name="tentang_image" class="form-control" accept="image/*">
        </div>
    </div>

    <button type="submit" class="btn btn-primary" style="font-size:16px;padding:14px 30px">💾 Simpan Semua Perubahan</button>
</form>
@endsection
