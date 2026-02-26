@extends('layouts.app')
@section('title', 'Tentang Kami - Kristech Solusindo Energi')

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

    .section { padding:80px 60px; }
    .section-tag { display:inline-block; background:#e8f0fe; color:#1a6fd4; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; padding:6px 14px; border-radius:20px; margin-bottom:12px; }

    /* ABOUT MAIN */
    .about-grid { display:grid; grid-template-columns:1fr 1fr; gap:70px; align-items:center; max-width:1100px; margin:0 auto; }
    .about-title { font-size:38px; font-weight:800; color:#1a2e4a; margin-bottom:16px; line-height:1.2; }
    .about-desc { font-size:15px; color:#555; line-height:1.9; margin-bottom:30px; }
    .stats-row { display:flex; gap:20px; flex-wrap:wrap; }
    .stat-box { padding:20px 24px; background:#f8f9fa; border-radius:14px; border-left:4px solid #1a6fd4; flex:1; min-width:110px; transition:transform 0.3s; }
    .stat-box:hover { transform:translateY(-4px); }
    .stat-box h3 { font-size:36px; font-weight:800; color:#1a6fd4; }
    .stat-box p { font-size:12px; color:#888; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-top:4px; }
    .about-img { width:100%; border-radius:20px; height:400px; object-fit:cover; box-shadow:0 24px 60px rgba(0,0,0,0.15); transition:transform 0.4s; }
    .about-img:hover { transform:scale(1.02); }
    .about-placeholder { background:linear-gradient(135deg,#e8f0fe,#d0e4ff); border-radius:20px; height:400px; display:flex; align-items:center; justify-content:center; font-size:80px; }

    /* VISI MISI */
    .visimisi-section { background:#f8f9fa; padding:80px 60px; }
    .visimisi-grid { display:grid; grid-template-columns:1fr 1fr; gap:30px; max-width:1000px; margin:50px auto 0; }
    .visimisi-card { background:#fff; border-radius:16px; padding:36px; box-shadow:0 4px 20px rgba(0,0,0,0.06); transition:transform 0.3s; }
    .visimisi-card:hover { transform:translateY(-4px); }
    .visimisi-icon { font-size:40px; margin-bottom:18px; }
    .visimisi-card h3 { font-size:22px; font-weight:800; color:#1a2e4a; margin-bottom:14px; }
    .visimisi-card p { font-size:14px; color:#666; line-height:1.8; }
    .visimisi-list { list-style:none; padding:0; margin-top:10px; }
    .visimisi-list li { font-size:14px; color:#555; padding:6px 0; display:flex; align-items:flex-start; gap:10px; line-height:1.6; }
    .visimisi-list li::before { content:'✓'; color:#1a6fd4; font-weight:700; flex-shrink:0; margin-top:1px; }

    /* NILAI */
    .nilai-section { background:#fff; padding:80px 60px; text-align:center; }
    .nilai-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; max-width:1000px; margin:50px auto 0; }
    .nilai-card { padding:34px 26px; border-radius:16px; background:#f8f9fa; border:2px solid transparent; transition:all 0.3s; }
    .nilai-card:hover { border-color:#1a6fd4; background:#fff; transform:translateY(-4px); box-shadow:0 12px 30px rgba(26,111,212,0.1); }
    .nilai-icon { font-size:42px; margin-bottom:16px; }
    .nilai-card h4 { font-size:17px; font-weight:700; color:#1a2e4a; margin-bottom:10px; }
    .nilai-card p { font-size:14px; color:#666; line-height:1.7; }

    /* TIMELINE */
    .timeline-section { background:#f8f9fa; padding:80px 60px; }
    .timeline { max-width:700px; margin:50px auto 0; position:relative; }
    .timeline::before { content:''; position:absolute; left:20px; top:0; bottom:0; width:2px; background:linear-gradient(to bottom,#1a6fd4,#4d9fff); }
    .timeline-item { display:flex; gap:30px; margin-bottom:40px; position:relative; }
    .timeline-dot { width:42px; height:42px; background:#1a6fd4; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:14px; font-weight:700; flex-shrink:0; box-shadow:0 4px 15px rgba(26,111,212,0.4); transition:transform 0.3s; z-index:1; }
    .timeline-item:hover .timeline-dot { transform:scale(1.15); }
    .timeline-content { background:#fff; border-radius:12px; padding:20px 24px; box-shadow:0 2px 15px rgba(0,0,0,0.06); flex:1; transition:transform 0.3s; }
    .timeline-item:hover .timeline-content { transform:translateX(4px); }
    .timeline-content h4 { font-size:16px; font-weight:700; color:#1a2e4a; margin-bottom:6px; }
    .timeline-content p { font-size:14px; color:#666; line-height:1.6; }
    .timeline-year { font-size:12px; font-weight:700; color:#1a6fd4; margin-bottom:4px; }

    /* CTA */
    .cta-section { background:linear-gradient(135deg,#1a2e4a,#1a6fd4); padding:80px 40px; text-align:center; color:#fff; }
    .cta-section h2 { font-size:36px; font-weight:800; margin-bottom:14px; }
    .cta-section p { font-size:16px; color:rgba(255,255,255,0.8); margin-bottom:32px; }
    .cta-section a { display:inline-block; padding:15px 40px; background:#fff; color:#1a2e4a; border-radius:50px; font-size:15px; font-weight:700; text-decoration:none; transition:all 0.3s; }
    .cta-section a:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(0,0,0,0.2); }

    @media (max-width:768px) {
        .about-grid,.visimisi-grid { grid-template-columns:1fr; gap:30px; }
        .nilai-grid { grid-template-columns:1fr; }
        .section,.visimisi-section,.nilai-section,.timeline-section { padding:50px 20px; }
        .page-hero h1 { font-size:28px; }
        .timeline::before { left:16px; }
    }
</style>
@endsection

@section('content')

<div class="page-hero">
    <div class="page-hero-content">
        <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> › Tentang Kami</div>
        <h1>Tentang Kami</h1>
        <p>Kenali lebih dekat Kristech Solusindo Energi</p>
    </div>
</div>

{{-- ABOUT MAIN --}}
<div class="section" style="background:#fff">
    <div class="about-grid">
        <div class="reveal-left">
            <span class="section-tag">Tentang</span>
            <h2 class="about-title">{{ $beranda->tentang_title ?? 'Tentang Kristech Solusindo Energi' }}</h2>
            <p class="about-desc">{{ $beranda->tentang_description ?? 'Kami ahli dalam kontraktor mekanikal elektrikal dengan pendekatan profesional dan solusi tepat untuk bisnis Anda.' }}</p>
            <div class="stats-row">
                <div class="stat-box">
                    <h3><span class="counter" data-target="{{ $beranda->stat_proyek ?? 150 }}">0</span>+</h3>
                    <p>{{ $beranda->stat_proyek_label ?? 'Proyek' }}</p>
                </div>
                <div class="stat-box">
                    <h3><span class="counter" data-target="{{ $beranda->stat_tahun ?? 15 }}">0</span></h3>
                    <p>{{ $beranda->stat_tahun_label ?? 'Tahun' }}</p>
                </div>
                <div class="stat-box">
                    <h3><span class="counter" data-target="100">0</span>%</h3>
                    <p>Kepuasan</p>
                </div>
            </div>
        </div>
        <div class="reveal-right">
            @if($beranda && $beranda->tentang_image)
                <img src="{{ Storage::url($beranda->tentang_image) }}" alt="Tentang Kami" class="about-img">
            @else
                <div class="about-placeholder">🏢</div>
            @endif
        </div>
    </div>
</div>

{{-- VISI MISI --}}
<div class="visimisi-section">
    <div class="reveal" style="text-align:center">
        <span class="section-tag">Arah Kami</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:10px">Visi & Misi</h2>
        <p style="font-size:15px;color:#666">Komitmen kami dalam memberikan layanan terbaik</p>
    </div>
    <div class="visimisi-grid">
        <div class="visimisi-card reveal delay-1">
            <div class="visimisi-icon">🎯</div>
            <h3>Visi</h3>
            <p>Menjadi kontraktor MEP terdepan dan terpercaya di Indonesia dengan standar kualitas internasional dan pelayanan prima.</p>
        </div>
        <div class="visimisi-card reveal delay-2">
            <div class="visimisi-icon">🚀</div>
            <h3>Misi</h3>
            <ul class="visimisi-list">
                <li>Memberikan solusi MEP berkualitas tinggi dan terjangkau</li>
                <li>Mengutamakan keamanan dan ketepatan waktu pengerjaan</li>
                <li>Menggunakan material dan teknologi terbaik</li>
                <li>Membangun kepercayaan jangka panjang dengan klien</li>
            </ul>
        </div>
    </div>
</div>

{{-- NILAI --}}
<div class="nilai-section">
    <div class="reveal">
        <span class="section-tag">Nilai Kami</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:10px">Apa yang Membuat Kami Berbeda</h2>
        <p style="font-size:15px;color:#666;max-width:600px;margin:0 auto">Prinsip-prinsip yang mendasari setiap pekerjaan kami</p>
    </div>
    <div class="nilai-grid">
        <div class="nilai-card reveal delay-1">
            <div class="nilai-icon">✅</div>
            <h4>Kualitas Terjamin</h4>
            <p>Kami menggunakan material berkualitas tinggi dan standar instalasi yang telah teruji untuk memastikan hasil terbaik.</p>
        </div>
        <div class="nilai-card reveal delay-2">
            <div class="nilai-icon">⚡</div>
            <h4>Cepat & Tepat Waktu</h4>
            <p>Pengerjaan dilakukan secara efisien tanpa mengorbankan kualitas, selesai sesuai jadwal yang disepakati.</p>
        </div>
        <div class="nilai-card reveal delay-3">
            <div class="nilai-icon">🛡️</div>
            <h4>Keamanan Prioritas</h4>
            <p>Semua instalasi mengikuti standar keamanan yang ketat untuk melindungi properti dan penghuni Anda.</p>
        </div>
        <div class="nilai-card reveal delay-1">
            <div class="nilai-icon">💰</div>
            <h4>Harga Terjangkau</h4>
            <p>Memberikan nilai terbaik untuk investasi Anda dengan harga yang kompetitif dan transparan tanpa biaya tersembunyi.</p>
        </div>
        <div class="nilai-card reveal delay-2">
            <div class="nilai-icon">🤝</div>
            <h4>Kepercayaan</h4>
            <p>Lebih dari 15 tahun membangun kepercayaan dengan ratusan klien yang puas di seluruh Indonesia.</p>
        </div>
        <div class="nilai-card reveal delay-3">
            <div class="nilai-icon">📞</div>
            <h4>Dukungan Purna Jual</h4>
            <p>Kami tidak berhenti di instalasi — tim kami siap membantu pemeliharaan dan perbaikan setelah pengerjaan.</p>
        </div>
    </div>
</div>

{{-- TIMELINE --}}
<div class="timeline-section">
    <div class="reveal" style="text-align:center">
        <span class="section-tag">Perjalanan</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:10px">Perjalanan Kami</h2>
        <p style="font-size:15px;color:#666">Dari awal hingga kini</p>
    </div>
    <div class="timeline">
        <div class="timeline-item reveal">
            <div class="timeline-dot">1</div>
            <div class="timeline-content">
                <div class="timeline-year">Awal Berdiri</div>
                <h4>Kristech Solusindo Energi Didirikan</h4>
                <p>Perusahaan didirikan dengan fokus pada instalasi listrik untuk hunian dan komersial skala kecil.</p>
            </div>
        </div>
        <div class="timeline-item reveal delay-1">
            <div class="timeline-dot">2</div>
            <div class="timeline-content">
                <div class="timeline-year">Berkembang</div>
                <h4>Ekspansi Layanan MEP</h4>
                <p>Memperluas layanan ke mekanikal, plumbing, sistem CCTV, dan jaringan. Mulai menangani proyek komersial besar.</p>
            </div>
        </div>
        <div class="timeline-item reveal delay-2">
            <div class="timeline-dot">3</div>
            <div class="timeline-content">
                <div class="timeline-year">Inovasi</div>
                <h4>Adopsi Teknologi IoT & Smart Building</h4>
                <p>Mengintegrasikan solusi IoT dan smart building untuk memenuhi kebutuhan gedung modern.</p>
            </div>
        </div>
        <div class="timeline-item reveal delay-3">
            <div class="timeline-dot">★</div>
            <div class="timeline-content">
                <div class="timeline-year">Sekarang</div>
                <h4>150+ Proyek Sukses</h4>
                <p>Telah menyelesaikan lebih dari 150 proyek dengan tingkat kepuasan klien 100%, melayani seluruh Indonesia.</p>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="cta-section reveal">
    <h2>Siap Bekerja Sama?</h2>
    <p>Hubungi kami sekarang untuk konsultasi gratis dan penawaran terbaik</p>
    <a href="{{ route('home') }}#kontak">Mulai Konsultasi →</a>
</div>

@endsection
