@extends('layouts.app')
@section('title', $layanan->nama . ' - Kristech Solusindo Energi')

@section('styles')
<style>
    .page-hero {
        background: linear-gradient(135deg,#1a2e4a 0%,#1a4a7a 100%);
        padding: 80px 40px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        top: -40%; left: -10%;
        width: 500px; height: 500px;
        background: rgba(26,111,212,0.15);
        border-radius: 50%;
    }
    .page-hero-content { position: relative; z-index: 1; }
    .page-hero h1 { font-size: 44px; font-weight: 800; margin-bottom: 12px; }
    .breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px; }
    .breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; }
    .breadcrumb a:hover { color: #fff; }

    .detail-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 70px 60px;
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 60px;
        align-items: start;
    }

    /* KONTEN UTAMA */
    .detail-content h2 {
        font-size: 42px;
        font-weight: 800;
        color: #1a2e4a;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 24px;
    }
    .detail-content p {
        font-size: 15px;
        color: #555;
        line-height: 1.9;
        margin-bottom: 30px;
        white-space: pre-line;
    }
    .detail-foto {
        width: 100%;
        border-radius: 14px;
        object-fit: cover;
        max-height: 500px;
        display: block;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        margin-bottom: 60px;
    }
    .detail-foto-placeholder {
        width: 100%;
        height: 350px;
        background: linear-gradient(135deg,#e8f0fe,#d0e4ff);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        margin-bottom: 60px;
    }

    /* SECTION ITEM */
    .section-divider {
        border: none;
        border-top: 1px solid #eee;
        margin: 40px 0;
    }
    .section-judul {
        font-size: 32px;
        font-weight: 800;
        color: #1a2e4a;
        margin-bottom: 20px;
    }

    /* SIDEBAR */
    .detail-sidebar { position: sticky; top: 100px; }
    .sidebar-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 20px;
    }
    .sidebar-card-title {
        background: #1a2e4a;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 14px 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .sidebar-layanan-list { padding: 8px 0; }
    .sidebar-layanan-list a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 500;
        color: #444;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }
    .sidebar-layanan-list a:hover,
    .sidebar-layanan-list a.active {
        background: #f0f6ff;
        color: #1a6fd4;
        border-left-color: #1a6fd4;
    }
    .sidebar-cta {
        background: linear-gradient(135deg, #1a2e4a, #1a6fd4);
        border-radius: 14px;
        padding: 24px 20px;
        text-align: center;
        color: #fff;
    }
    .sidebar-cta h4 { font-size: 16px; font-weight: 700; margin-bottom: 10px; }
    .sidebar-cta p { font-size: 13px; color: rgba(255,255,255,0.8); margin-bottom: 16px; line-height: 1.6; }
    .sidebar-cta a {
        display: block;
        padding: 12px;
        background: #fff;
        color: #1a2e4a;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .sidebar-cta a:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.2); }

    @media (max-width: 768px) {
        .detail-wrapper { grid-template-columns: 1fr; padding: 40px 20px; gap: 30px; }
        .detail-content h2 { font-size: 28px; }
        .section-judul { font-size: 22px; }
        .detail-sidebar { position: static; }
        .page-hero h1 { font-size: 28px; }
    }
</style>
@endsection

@section('content')

<div class="page-hero">
    <div class="page-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> ›
            <a href="{{ route('layanan') }}">Layanan</a> ›
            {{ $layanan->nama }}
        </div>
        <h1>{{ $layanan->nama }}</h1>
    </div>
</div>

<div class="detail-wrapper">
    {{-- KONTEN UTAMA --}}
    <div class="detail-content">
        {{-- Section utama --}}
        <div class="reveal">
            <h2>{{ $layanan->nama }}</h2>
            <p>{{ $layanan->deskripsi }}</p>

            @if($layanan->foto)
                <img src="{{ Storage::url($layanan->foto) }}" alt="{{ $layanan->nama }}" class="detail-foto">
            @else
                <div class="detail-foto-placeholder">{{ $layanan->icon ?? '⚡' }}</div>
            @endif
        </div>

        {{-- Sections tambahan --}}
        @foreach($layanan->sections as $section)
        <hr class="section-divider">
        <div class="reveal">
            <h3 class="section-judul">{{ $section->judul }}</h3>
            <p>{{ $section->deskripsi }}</p>

            @if($section->foto)
                <img src="{{ Storage::url($section->foto) }}" alt="{{ $section->judul }}" class="detail-foto">
            @endif
        </div>
        @endforeach
    </div>

    {{-- SIDEBAR --}}
    <div class="detail-sidebar">
        <div class="sidebar-card">
            <div class="sidebar-card-title">Layanan Lainnya</div>
            <div class="sidebar-layanan-list">
                @foreach($layanans as $item)
                    <a href="{{ route('layanan.detail', $item->slug) }}"
                       class="{{ $item->id === $layanan->id ? 'active' : '' }}">
                        <span>{{ $item->icon ?? '⚡' }}</span>
                        {{ $item->nama }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="sidebar-cta">
            <h4>Butuh Layanan Ini?</h4>
            <p>Konsultasikan kebutuhan Anda dengan tim kami secara gratis.</p>
            <a href="{{ route('home') }}#kontak">Hubungi Kami →</a>
        </div>
    </div>
</div>

@endsection
