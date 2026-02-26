@extends('layouts.app')
@section('title', 'Proyek - Kristech Solusindo Energi')

@section('styles')
<style>
    .page-hero {
        background: linear-gradient(135deg, #1a2e4a 0%, #1a4a7a 100%);
        padding: 80px 40px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before { content:''; position:absolute; top:-40%;left:-10%; width:500px;height:500px; background:rgba(26,111,212,0.15); border-radius:50%; }
    .page-hero-content { position:relative; z-index:1; }
    .page-hero h1 { font-size:44px; font-weight:800; margin-bottom:12px; }
    .page-hero p { font-size:16px; color:rgba(255,255,255,0.75); }
    .breadcrumb { display:flex; align-items:center; justify-content:center; gap:8px; font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:14px; }
    .breadcrumb a { color:rgba(255,255,255,0.6); text-decoration:none; }
    .breadcrumb a:hover { color:#fff; }

    .section { padding:80px 60px; }
    .section-tag { display:inline-block; background:#e8f0fe; color:#1a6fd4; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; padding:6px 14px; border-radius:20px; margin-bottom:12px; }

    /* PROYEK GRID */
    .proyek-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        max-width: 1100px;
        margin: 50px auto 0;
    }
    .proyek-card {
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
    }
    .proyek-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,0.14); }
    .proyek-card-foto {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    .proyek-card:hover .proyek-card-foto { transform: scale(1.04); }
    .proyek-card-foto-wrap { overflow: hidden; }
    .proyek-card-info {
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }
    .proyek-card-info h4 { font-size: 18px; font-weight: 700; color: #1a2e4a; margin-bottom: 6px; }
    .proyek-card-info p { font-size: 13px; color: #777; line-height: 1.6; }
    .proyek-arrow {
        width: 40px;
        height: 40px;
        min-width: 40px;
        background: #f0f6ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #1a6fd4;
        transition: all 0.3s;
    }
    .proyek-card:hover .proyek-arrow { background: #1a6fd4; color: #fff; transform: translateX(4px); }

    .empty-state { text-align:center; padding:80px; color:#888; }

    @media (max-width:768px) {
        .proyek-grid { grid-template-columns:1fr; }
        .section { padding:50px 20px; }
        .page-hero h1 { font-size:28px; }
    }
</style>
@endsection

@section('content')

<div class="page-hero">
    <div class="page-hero-content">
        <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> › Proyek</div>
        <h1>Proyek Kami</h1>
        <p>Beberapa hasil kerja kami di bidang Mekanikal Elektrikal</p>
    </div>
</div>

<div class="section" style="background:#fff;text-align:center">
    <div class="reveal">
        <span class="section-tag">Proyek</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:10px">Daftar Proyek Kami</h2>
        <p style="font-size:15px;color:#666">Proyek yang telah kami selesaikan dengan standar kualitas tinggi</p>
    </div>

    @if($proyeks->count() > 0)
    <div class="proyek-grid">
        @foreach($proyeks as $i => $proyek)
        <div class="proyek-card reveal delay-{{ ($i % 2) + 1 }}">
            <div class="proyek-card-foto-wrap">
                <img src="{{ Storage::url($proyek->foto) }}"
                     alt="{{ $proyek->judul }}"
                     class="proyek-card-foto">
            </div>
            <div class="proyek-card-info">
                <div>
                    <h4>{{ $proyek->judul }}</h4>
                    <p>{{ Str::limit($proyek->deskripsi, 100) }}</p>
                </div>
                <div class="proyek-arrow">→</div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">🏗️ Proyek sedang diperbarui.</div>
    @endif
</div>

@endsection
