@extends('layouts.app')
@section('title', 'Layanan - Kristech Solusindo Energi')

@section('styles')
<style>
    .page-hero { background:linear-gradient(135deg,#1a2e4a 0%,#1a4a7a 100%); padding:80px 40px; text-align:center; color:#fff; position:relative; overflow:hidden; }
    .page-hero::before { content:''; position:absolute; top:-40%;left:-10%; width:500px;height:500px; background:rgba(26,111,212,0.15); border-radius:50%; }
    .page-hero-content { position:relative; z-index:1; }
    .page-hero h1 { font-size:44px; font-weight:800; margin-bottom:12px; animation:fadeUp 0.8s ease forwards; }
    .page-hero p { font-size:16px; color:rgba(255,255,255,0.75); animation:fadeUp 0.8s ease 0.2s both; }
    .breadcrumb { display:flex; align-items:center; justify-content:center; gap:8px; font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:14px; }
    .breadcrumb a { color:rgba(255,255,255,0.6); text-decoration:none; }
    .breadcrumb a:hover { color:#fff; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

    /* LAYANAN SECTION */
    .layanan-section {
        padding: 70px 60px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .layanan-item {
        margin-bottom: 80px;
        padding-bottom: 80px;
        border-bottom: 1px solid #eee;
    }
    .layanan-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .layanan-item-header {
        margin-bottom: 20px;
    }
    .layanan-item-header h2 {
        font-size: 42px;
        font-weight: 800;
        color: #1a2e4a;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }
    .layanan-item-desc {
        font-size: 15px;
        color: #555;
        line-height: 1.8;
        max-width: 800px;
        margin-bottom: 30px;
    }
    .layanan-item-foto {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }
    .layanan-item-foto-placeholder {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, #e8f0fe, #d0e4ff);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
    }

    /* PROSES KERJA */
    .proses-section { background:#f8f9fa; padding:80px 60px; text-align:center; }
    .section-tag { display:inline-block; background:#e8f0fe; color:#1a6fd4; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; padding:6px 14px; border-radius:20px; margin-bottom:12px; }
    .proses-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; max-width:1000px; margin:50px auto 0; position:relative; }
    .proses-grid::before { content:''; position:absolute; top:32px; left:10%; right:10%; height:2px; background:linear-gradient(to right,#1a6fd4,#4d9fff); z-index:0; }
    .proses-item { position:relative; z-index:1; }
    .proses-num { width:64px; height:64px; background:#1a6fd4; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:22px; font-weight:800; margin:0 auto 16px; box-shadow:0 4px 20px rgba(26,111,212,0.3); transition:transform 0.3s; }
    .proses-item:hover .proses-num { transform:scale(1.1); }
    .proses-item h4 { font-size:15px; font-weight:700; color:#1a2e4a; margin-bottom:8px; }
    .proses-item p { font-size:13px; color:#777; line-height:1.6; }

    /* CTA */
    .cta-layanan { background:linear-gradient(135deg,#1a2e4a,#1a6fd4); padding:80px 40px; text-align:center; color:#fff; }
    .cta-layanan h2 { font-size:36px; font-weight:800; margin-bottom:14px; }
    .cta-layanan p { font-size:16px; color:rgba(255,255,255,0.8); margin-bottom:32px; }
    .cta-layanan a { display:inline-block; padding:15px 40px; background:#fff; color:#1a2e4a; border-radius:50px; font-size:15px; font-weight:700; text-decoration:none; transition:all 0.3s; }
    .cta-layanan a:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(0,0,0,0.2); }

    .empty-state { text-align:center; padding:80px; color:#888; }

    @media (max-width:768px) {
        .layanan-section { padding:40px 20px; }
        .layanan-item-header h2 { font-size:28px; }
        .proses-grid { grid-template-columns:repeat(2,1fr); }
        .proses-grid::before { display:none; }
        .proses-section { padding:50px 20px; }
        .page-hero h1 { font-size:28px; }
    }
</style>
@endsection

@section('content')

<div class="page-hero">
    <div class="page-hero-content">
        <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> › Layanan</div>
        <h1>Layanan Kami</h1>
        <p>Jasa instalasi dan perbaikan MEP profesional untuk bisnis dan hunian Anda</p>
    </div>
</div>

@if($layanans->count() > 0)
<div class="layanan-section">
    @foreach($layanans as $i => $layanan)
    <div class="layanan-item reveal">
        <div class="layanan-item-header">
            <h2>{{ $layanan->nama }}</h2>
        </div>
        <p class="layanan-item-desc">{{ $layanan->deskripsi }}</p>

        @if($layanan->foto)
            <img src="{{ Storage::url($layanan->foto) }}"
                 alt="{{ $layanan->nama }}"
                 class="layanan-item-foto">
        @else
            <div class="layanan-item-foto-placeholder">
                {{ $layanan->icon ?? '⚡' }}
            </div>
        @endif
    </div>
    @endforeach
</div>
@else
<div class="empty-state"><p style="font-size:40px">⚡</p><p>Layanan sedang diperbarui.</p></div>
@endif

{{-- PROSES KERJA --}}
<div class="proses-section">
    <div class="reveal">
        <span class="section-tag">Cara Kerja</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:10px">Proses Kerja Kami</h2>
        <p style="font-size:15px;color:#666">Sederhana, cepat, dan profesional</p>
    </div>
    <div class="proses-grid">
        <div class="proses-item reveal delay-1">
            <div class="proses-num">1</div>
            <h4>Konsultasi</h4>
            <p>Hubungi kami dan ceritakan kebutuhan Anda</p>
        </div>
        <div class="proses-item reveal delay-2">
            <div class="proses-num">2</div>
            <h4>Survey</h4>
            <p>Tim kami datang untuk survey lokasi secara gratis</p>
        </div>
        <div class="proses-item reveal delay-3">
            <div class="proses-num">3</div>
            <h4>Penawaran</h4>
            <p>Kami berikan estimasi harga yang transparan</p>
        </div>
        <div class="proses-item reveal delay-4">
            <div class="proses-num">4</div>
            <h4>Pengerjaan</h4>
            <p>Instalasi profesional sesuai standar dan tepat waktu</p>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="cta-layanan reveal">
    <h2>Butuh Layanan Kami?</h2>
    <p>Konsultasikan kebutuhan Anda sekarang — gratis dan tanpa komitmen</p>
    <a href="{{ route('home') }}#kontak">Hubungi Sekarang →</a>
</div>

@endsection
