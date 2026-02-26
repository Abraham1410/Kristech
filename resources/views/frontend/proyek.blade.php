@extends('layouts.app')
@section('title', 'Proyek - Kristech Solusindo Energi')

@section('styles')
<style>
    .page-hero { background:#1a2e4a; padding:60px 40px; text-align:center; color:#fff; }
    .page-hero h1 { font-size:38px; font-weight:700; margin-bottom:10px; }
    .page-hero p { font-size:15px; color:#aaa; }

    .section { padding:80px 60px; }
    .section-title { font-size:32px; font-weight:700; color:#1a2e4a; margin-bottom:10px; text-align:center; }
    .section-sub { font-size:15px; color:#666; margin-bottom:50px; text-align:center; }

    .proyek-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:30px; max-width:1100px; margin:0 auto; }
    .proyek-card { border-radius:10px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08); transition:transform 0.2s; background:#fff; }
    .proyek-card:hover { transform:translateY(-4px); }
    .proyek-card img { width:100%; height:240px; object-fit:cover; display:block; }
    .proyek-info { padding:20px 24px; display:flex; justify-content:space-between; align-items:center; }
    .proyek-info h4 { font-size:17px; font-weight:600; color:#1a2e4a; }
    .proyek-info p { font-size:13px; color:#888; margin-top:4px; }
    .proyek-badge { background:#e8f0fe; color:#1a6fd4; font-size:12px; padding:4px 10px; border-radius:12px; }

    .empty-state { text-align:center; padding:60px; color:#888; }

    @media(max-width:768px) {
        .proyek-grid { grid-template-columns:1fr; }
        .section { padding:50px 20px; }
        .page-hero h1 { font-size:28px; }
    }
</style>
@endsection

@section('content')

<div class="page-hero">
    <h1>Proyek</h1>
    <p>Beberapa hasil kerja kami di bidang Mekanikal Elektrikal</p>
</div>

<div class="section" style="background:#fff">
    <h2 class="section-title">Daftar Proyek</h2>
    <p class="section-sub">Proyek yang telah kami selesaikan dengan standar kualitas tinggi</p>

    @if($proyeks->count() > 0)
    <div class="proyek-grid">
        @foreach($proyeks as $proyek)
        <div class="proyek-card">
            <img src="{{ Storage::url($proyek->foto) }}" alt="{{ $proyek->judul }}">
            <div class="proyek-info">
                <div>
                    <h4>{{ $proyek->judul }}</h4>
                    <p>{{ Str::limit($proyek->deskripsi, 80) }}</p>
                </div>
                @if($proyek->kategori)
                <span class="proyek-badge">{{ $proyek->kategori }}</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">🏗️ Proyek sedang diperbarui.</div>
    @endif
</div>

@endsection
