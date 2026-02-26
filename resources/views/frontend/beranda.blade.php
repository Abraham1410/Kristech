@extends('layouts.app')
@section('title', 'Beranda - Kristech Solusindo Energi')

@section('styles')
<style>
    /* ===== HERO ===== */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 80px 20px 200px;
        background-image: url('{{ $beranda && $beranda->hero_image ? Storage::url($beranda->hero_image) : asset("images/hero-default.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,30,50,0.85) 0%, rgba(26,46,74,0.7) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        color: #fff;
        animation: heroFadeIn 1s ease forwards;
    }
    @keyframes heroFadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .hero h1 {
        font-size: 54px;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 20px;
        text-shadow: 0 2px 20px rgba(0,0,0,0.3);
    }
    .hero h1 span { color: #4d9fff; }
    .hero p {
        font-size: 17px;
        color: rgba(255,255,255,0.85);
        margin-bottom: 36px;
        line-height: 1.7;
        animation: heroFadeIn 1s ease 0.3s both;
    }
    .hero-btns {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
        animation: heroFadeIn 1s ease 0.6s both;
    }
    .btn-hero-primary {
        padding: 15px 40px;
        background: #1a6fd4;
        color: #fff;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(26,111,212,0.4);
    }
    .btn-hero-primary:hover {
        background: #1558b0;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(26,111,212,0.5);
    }
    .btn-hero-outline {
        padding: 15px 40px;
        border: 2px solid rgba(255,255,255,0.7);
        color: #fff;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-hero-outline:hover {
        background: rgba(255,255,255,0.15);
        border-color: #fff;
        transform: translateY(-2px);
    }

    /* Scroll indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 180px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        animation: bounce 2s infinite;
        color: rgba(255,255,255,0.6);
        font-size: 13px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }
    .scroll-indicator span {
        display: block;
        width: 1px;
        height: 40px;
        background: rgba(255,255,255,0.4);
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(8px); }
    }

    /* ===== 3 FITUR ===== */
    .features {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        max-width: 1000px;
        margin: -110px auto 0;
        position: relative;
        z-index: 2;
        background: rgba(15,30,50,0.96);
        backdrop-filter: blur(20px);
        width: 88%;
        border-radius: 4px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .feature {
        padding: 36px 28px;
        text-align: center;
        border-right: 1px solid rgba(255,255,255,0.08);
        transition: background 0.3s;
    }
    .feature:hover { background: rgba(255,255,255,0.05); }
    .feature:last-child { border-right: none; }
    .feature-icon {
        width: 50px;
        height: 50px;
        background: rgba(26,111,212,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 16px;
        transition: transform 0.3s;
    }
    .feature:hover .feature-icon { transform: scale(1.1); }
    .feature h3 { font-size: 17px; font-weight: 700; color: #fff; margin-bottom: 10px; }
    .feature p { font-size: 13px; color: #8899aa; line-height: 1.6; }

    /* ===== SECTIONS ===== */
    .section { padding: 90px 60px; }
    .section-tag {
        display: inline-block;
        background: #e8f0fe;
        color: #1a6fd4;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 20px;
        margin-bottom: 14px;
    }
    .section-title { font-size: 36px; font-weight: 800; color: #1a2e4a; margin-bottom: 14px; line-height: 1.2; }
    .section-sub { font-size: 15px; color: #666; line-height: 1.8; max-width: 650px; }

    /* ===== ABOUT ===== */
    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 70px;
        align-items: center;
        max-width: 1100px;
        margin: 0 auto;
    }
    .about-desc { font-size: 15px; color: #555; line-height: 1.8; margin: 20px 0 32px; }
    .stats { display: flex; gap: 40px; }
    .stat {
        padding: 20px 24px;
        background: #f8f9fa;
        border-radius: 12px;
        border-left: 4px solid #1a6fd4;
        min-width: 110px;
    }
    .stat h3 { font-size: 38px; font-weight: 800; color: #1a6fd4; line-height: 1; }
    .stat h3 sup { font-size: 18px; }
    .stat p { font-size: 12px; color: #888; margin-top: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .about-img {
        width: 100%;
        border-radius: 16px;
        height: 380px;
        object-fit: cover;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        transition: transform 0.5s;
    }
    .about-img:hover { transform: scale(1.02); }

    /* ===== LAYANAN ===== */
    .layanan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        max-width: 1100px;
        margin: 0 auto;
    }
    .layanan-card {
        background: #fff;
        border-radius: 16px;
        padding: 32px 26px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #f0f0f0;
        transition: all 0.3s;
        cursor: default;
    }
    .layanan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(26,111,212,0.15);
        border-color: #1a6fd4;
    }
    .layanan-icon-wrap {
        width: 54px;
        height: 54px;
        background: linear-gradient(135deg, #e8f0fe, #d0e4ff);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 18px;
        transition: transform 0.3s;
    }
    .layanan-card:hover .layanan-icon-wrap { transform: rotate(5deg) scale(1.1); }
    .layanan-card h4 { font-size: 16px; font-weight: 700; color: #1a2e4a; margin-bottom: 10px; }
    .layanan-card p { font-size: 13px; color: #777; line-height: 1.6; }

    /* ===== PORTO ===== */
    .porto-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        max-width: 1100px;
        margin: 0 auto;
    }
    .porto-item {
        overflow: hidden;
        border-radius: 12px;
        aspect-ratio: 4/3;
        background: #eee;
        position: relative;
    }
    .porto-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }
    .porto-item:hover img { transform: scale(1.08); }
    .porto-overlay {
        position: absolute;
        inset: 0;
        background: rgba(26,46,74,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .porto-item:hover .porto-overlay { opacity: 1; }
    .porto-overlay span { color: #fff; font-size: 13px; font-weight: 600; }

    /* ===== CTA SECTION ===== */
    .cta-section {
        background: linear-gradient(135deg, #1a2e4a 0%, #1a6fd4 100%);
        padding: 80px 40px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }
    .cta-section h2 { font-size: 36px; font-weight: 800; margin-bottom: 14px; position: relative; }
    .cta-section p { font-size: 16px; color: rgba(255,255,255,0.8); margin-bottom: 36px; position: relative; }

    /* ===== KONTAK ===== */
    .kontak-section { background: #f8f9fa; padding: 90px 40px; }
    .kontak-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        max-width: 1000px;
        margin: 0 auto;
        align-items: start;
    }
    .kontak-info h2 { font-size: 34px; font-weight: 800; color: #1a2e4a; margin-bottom: 14px; }
    .kontak-info p { font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 30px; }
    .kontak-detail { display: flex; flex-direction: column; gap: 16px; }
    .kontak-detail-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .kontak-detail-item .icon { font-size: 22px; }
    .kontak-detail-item .text { font-size: 14px; color: #333; font-weight: 500; }

    .kontak-form-wrap {
        background: #fff;
        border-radius: 16px;
        padding: 36px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
    }
    .kontak-form-wrap h3 { font-size: 20px; font-weight: 700; color: #1a2e4a; margin-bottom: 24px; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e8e8e8;
        border-radius: 10px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
        color: #333;
    }
    .form-group input:focus, .form-group textarea:focus {
        outline: none;
        border-color: #1a6fd4;
        box-shadow: 0 0 0 3px rgba(26,111,212,0.1);
    }
    .form-group textarea { height: 110px; resize: vertical; }
    .btn-submit {
        width: 100%;
        padding: 14px;
        background: #1a6fd4;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        font-family: inherit;
    }
    .btn-submit:hover {
        background: #1a2e4a;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(26,111,212,0.3);
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .hero h1 { font-size: 32px; }
        .hero { background-attachment: scroll; padding-bottom: 220px; }
        .features { grid-template-columns: 1fr; margin-top: 40px; width: 95%; }
        .feature { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .about-grid, .kontak-grid { grid-template-columns: 1fr; gap: 30px; }
        .layanan-grid, .porto-grid { grid-template-columns: 1fr; }
        .section { padding: 60px 20px; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="hero">
    <div class="hero-content">
        <h1>Solusi <span>Pemasangan</span> dan Perbaikan Kelistrikan Anda</h1>
        <p>{{ $beranda->hero_subtitle ?? 'Melayani kebutuhan Jasa pemasangan dan perbaikan untuk Tempat usaha dan tempat tinggal anda' }}</p>
        <div class="hero-btns">
            <a href="#kontak" class="btn-hero-primary">Hubungi Kami</a>
            <a href="{{ route('layanan') }}" class="btn-hero-outline">Lihat Layanan</a>
        </div>
    </div>
    <div class="scroll-indicator">
        <span></span>
    </div>
</div>

{{-- 3 FITUR --}}
<div class="features">
    <div class="feature reveal delay-1">
        <div class="feature-icon">⚡</div>
        <h3>Instalasi</h3>
        <p>Pemasangan sistem mekanikal dan elektrikal berkualitas tinggi</p>
    </div>
    <div class="feature reveal delay-2">
        <div class="feature-icon">🔧</div>
        <h3>Pemeliharaan</h3>
        <p>Teknisi berpengalaman siap mendukung proyek Anda</p>
    </div>
    <div class="feature reveal delay-3">
        <div class="feature-icon">💡</div>
        <h3>Konsultasi</h3>
        <p>Proses cepat dengan standar keamanan ketat dan gratis</p>
    </div>
</div>

{{-- TENTANG --}}
<div class="section" style="background:#fff">
    <div class="about-grid">
        <div class="reveal-left">
            <span class="section-tag">Tentang Kami</span>
            <h2 class="section-title">{{ $beranda->tentang_title ?? 'Tentang Kristech Solusindo Energi' }}</h2>
            <p class="about-desc">{{ $beranda->tentang_description ?? 'Kami ahli dalam kontraktor mekanikal elektrikal dengan pendekatan profesional.' }}</p>
            <div class="stats">
                <div class="stat">
                    <h3><span class="counter" data-target="{{ $beranda->stat_proyek ?? 150 }}">0</span><sup>+</sup></h3>
                    <p>{{ $beranda->stat_proyek_label ?? 'Berkualitas' }}</p>
                </div>
                <div class="stat">
                    <h3><span class="counter" data-target="{{ $beranda->stat_tahun ?? 15 }}">0</span></h3>
                    <p>{{ $beranda->stat_tahun_label ?? 'Terpercaya' }}</p>
                </div>
            </div>
        </div>
        <div class="reveal-right">
            @if($beranda && $beranda->tentang_image)
                <img src="{{ Storage::url($beranda->tentang_image) }}" alt="Tentang Kami" class="about-img">
            @else
                <div style="background:linear-gradient(135deg,#e8f0fe,#d0e4ff);border-radius:16px;height:380px;display:flex;align-items:center;justify-content:center;font-size:80px">🏢</div>
            @endif
        </div>
    </div>
</div>

{{-- LAYANAN --}}
@if($layanans->count() > 0)
<div class="section" style="background:#f8f9fa;text-align:center">
    <div class="reveal" style="margin-bottom:50px">
        <span class="section-tag">Layanan</span>
        <h2 class="section-title" style="max-width:600px;margin:0 auto 14px">Apa yang Kami Tawarkan</h2>
        <p class="section-sub" style="margin:0 auto">Jasa instalasi dan perbaikan MEP sekala kecil maupun besar untuk hunian dan komersial</p>
    </div>
    <div class="layanan-grid">
        @foreach($layanans as $i => $layanan)
        <div class="layanan-card reveal delay-{{ ($i % 3) + 1 }}">
            <div class="layanan-icon-wrap">{{ $layanan->icon ?? '⚡' }}</div>
            <h4>{{ $layanan->nama }}</h4>
            <p>{{ $layanan->deskripsi }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- PORTOFOLIO --}}
@if($portofolios->count() > 0)
<div class="section" style="background:#fff;text-align:center">
    <div class="reveal" style="margin-bottom:50px">
        <span class="section-tag">Portofolio</span>
        <h2 class="section-title" style="max-width:600px;margin:0 auto 14px">Hasil Kerja Kami</h2>
        <p class="section-sub" style="margin:0 auto">Beberapa proyek yang telah kami selesaikan dengan standar kualitas tinggi</p>
    </div>
    <div class="porto-grid">
        @foreach($portofolios as $i => $porto)
        <div class="porto-item reveal delay-{{ ($i % 3) + 1 }}">
            <img src="{{ Storage::url($porto->foto) }}" alt="{{ $porto->judul }}">
            <div class="porto-overlay">
                <span>{{ $porto->judul }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- CTA --}}
<div class="cta-section reveal">
    <h2>Siap Memulai Proyek Anda?</h2>
    <p>Konsultasikan kebutuhan instalasi Anda dengan tim profesional kami — gratis!</p>
    <a href="#kontak" class="btn-hero-primary" style="display:inline-block">Konsultasi Gratis →</a>
</div>

{{-- KONTAK --}}
<div class="kontak-section" id="kontak">
    <div class="kontak-grid">
        <div class="reveal-left">
            <span class="section-tag">Kontak</span>
            <h2 class="kontak-info" style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:14px">Hubungi Kami</h2>
            <p style="font-size:15px;color:#666;line-height:1.7;margin-bottom:28px">Siap membantu kebutuhan mekanikal elektrikal Anda. Tim kami akan merespons dalam 1x24 jam.</p>
            <div class="kontak-detail">
                <div class="kontak-detail-item">
                    <span class="icon">📞</span>
                    <span class="text">+625162817158</span>
                </div>
                <div class="kontak-detail-item">
                    <span class="icon">✉️</span>
                    <span class="text">info@kristechsolusindo.com</span>
                </div>
                <div class="kontak-detail-item">
                    <span class="icon">⏰</span>
                    <span class="text">Senin - Sabtu, 08.00 - 17.00 WIB</span>
                </div>
            </div>
        </div>

        <div class="kontak-form-wrap reveal-right">
            <h3>Kirim Pesan</h3>

            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('kirim.pesan') }}">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" placeholder="Nama Anda" required value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" placeholder="email@anda.com" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Nomor WhatsApp</label>
                    <input type="tel" name="telepon" placeholder="08xxxxxxxxxx" value="{{ old('telepon') }}">
                </div>
                <div class="form-group">
                    <label>Pesan *</label>
                    <textarea name="pesan" placeholder="Ceritakan kebutuhan Anda..." required>{{ old('pesan') }}</textarea>
                </div>
                <button type="submit" class="btn-submit">Kirim Pesan 🚀</button>
            </form>
        </div>
    </div>
</div>

@endsection
