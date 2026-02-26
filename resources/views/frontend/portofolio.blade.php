@extends('layouts.app')
@section('title', 'Portofolio - Kristech Solusindo Energi')

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
    .page-hero h1 { font-size:44px; font-weight:800; margin-bottom:12px; animation: fadeUp 0.8s ease forwards; }
    .page-hero p { font-size:16px; color:rgba(255,255,255,0.75); animation: fadeUp 0.8s ease 0.2s both; }
    .breadcrumb { display:flex; align-items:center; justify-content:center; gap:8px; font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:14px; animation: fadeUp 0.8s ease 0.1s both; }
    .breadcrumb a { color:rgba(255,255,255,0.6); text-decoration:none; }
    .breadcrumb a:hover { color:#fff; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

    .section { padding:70px 60px; }
    .section-tag { display:inline-block; background:#e8f0fe; color:#1a6fd4; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; padding:6px 14px; border-radius:20px; margin-bottom:12px; }

    /* ===== PROYEK SECTION ===== */
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
    }
    .proyek-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,0.14); }
    .proyek-card-foto-wrap { overflow: hidden; }
    .proyek-card-foto { width:100%; height:280px; object-fit:cover; display:block; transition:transform 0.5s; }
    .proyek-card:hover .proyek-card-foto { transform: scale(1.04); }
    .proyek-card-info { padding:20px 24px; display:flex; justify-content:space-between; align-items:center; gap:16px; }
    .proyek-card-info h4 { font-size:18px; font-weight:700; color:#1a2e4a; margin-bottom:6px; }
    .proyek-card-info p { font-size:13px; color:#777; line-height:1.6; }
    .proyek-arrow { width:40px; height:40px; min-width:40px; background:#f0f6ff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:18px; color:#1a6fd4; transition:all 0.3s; }
    .proyek-card:hover .proyek-arrow { background:#1a6fd4; color:#fff; transform:translateX(4px); }

    /* ===== GALERI SECTION ===== */
    .filter-bar { background:#fff; padding:20px 60px; display:flex; align-items:center; gap:10px; box-shadow:0 2px 10px rgba(0,0,0,0.06); flex-wrap:wrap; }
    .filter-label { font-size:13px; font-weight:600; color:#888; margin-right:4px; }
    .filter-btn { padding:8px 20px; border-radius:50px; font-size:13px; font-weight:600; cursor:pointer; border:2px solid #e8e8e8; background:#fff; color:#555; transition:all 0.25s; font-family:inherit; }
    .filter-btn:hover, .filter-btn.active { background:#1a6fd4; border-color:#1a6fd4; color:#fff; }

    .porto-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; max-width:1100px; margin:40px auto 0; }
    .porto-card { border-radius:14px; overflow:hidden; background:#f0f0f0; position:relative; cursor:pointer; aspect-ratio:4/3; box-shadow:0 4px 20px rgba(0,0,0,0.08); transition:transform 0.3s, box-shadow 0.3s; }
    .porto-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(0,0,0,0.15); }
    .porto-card img { width:100%; height:100%; object-fit:cover; transition:transform 0.5s; display:block; }
    .porto-card:hover img { transform:scale(1.08); }
    .porto-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(15,30,50,0.85) 0%, transparent 60%); opacity:0; transition:opacity 0.3s; display:flex; flex-direction:column; justify-content:flex-end; padding:20px; }
    .porto-card:hover .porto-overlay { opacity:1; }
    .porto-overlay h4 { color:#fff; font-size:15px; font-weight:700; margin-bottom:4px; }
    .porto-overlay span { color:rgba(255,255,255,0.8); font-size:12px; background:rgba(26,111,212,0.7); display:inline-block; padding:3px 10px; border-radius:20px; }

    /* LIGHTBOX */
    .lightbox { position:fixed; inset:0; background:rgba(0,0,0,0.92); z-index:9000; display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity 0.3s; padding:20px; }
    .lightbox.open { opacity:1; pointer-events:all; }
    .lightbox-img { max-width:90vw; max-height:85vh; border-radius:8px; object-fit:contain; transform:scale(0.9); transition:transform 0.3s; }
    .lightbox.open .lightbox-img { transform:scale(1); }
    .lightbox-close { position:fixed; top:20px; right:26px; color:#fff; font-size:40px; cursor:pointer; background:none; border:none; line-height:1; transition:opacity 0.2s; }
    .lightbox-close:hover { opacity:0.6; }
    .lightbox-caption { position:fixed; bottom:24px; left:50%; transform:translateX(-50%); color:#fff; font-size:14px; background:rgba(0,0,0,0.6); padding:8px 20px; border-radius:20px; white-space:nowrap; }

    .stats-strip { background:#1a2e4a; padding:50px 60px; display:grid; grid-template-columns:repeat(4,1fr); gap:20px; text-align:center; }
    .strip-stat h3 { font-size:42px; font-weight:800; color:#4d9fff; margin-bottom:6px; }
    .strip-stat p { font-size:12px; color:rgba(255,255,255,0.6); font-weight:600; text-transform:uppercase; letter-spacing:0.5px; }

    .empty-state { text-align:center; padding:80px 20px; color:#888; }

    @media (max-width:768px) {
        .porto-grid { grid-template-columns:repeat(2,1fr); gap:12px; }
        .proyek-grid { grid-template-columns:1fr; }
        .filter-bar { padding:16px 20px; }
        .section { padding:50px 20px; }
        .stats-strip { grid-template-columns:repeat(2,1fr); padding:40px 20px; }
        .page-hero h1 { font-size:28px; }
    }
</style>
@endsection

@section('content')

<div class="page-hero">
    <div class="page-hero-content">
        <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> › Portofolio</div>
        <h1>Portofolio Kami</h1>
        <p>Hasil kerja profesional di bidang Mekanikal Elektrikal</p>
    </div>
</div>

{{-- ===== SECTION PROYEK ===== --}}
@php
    $proyeks = \App\Models\Proyek::where('aktif', true)->orderBy('urutan')->get();
@endphp
@if($proyeks->count() > 0)
<div class="section" style="background:#fff;text-align:center">
    <div class="reveal">
        <span class="section-tag">Proyek</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:10px">Proyek Kami</h2>
        <p style="font-size:15px;color:#666">Beberapa hasil kerja kami di bidang Mekanikal Elektrikal</p>
    </div>
    <div class="proyek-grid">
        @foreach($proyeks as $i => $proyek)
        <div class="proyek-card reveal delay-{{ ($i % 2) + 1 }}">
            <div class="proyek-card-foto-wrap">
                <img src="{{ Storage::url($proyek->foto) }}" alt="{{ $proyek->judul }}" class="proyek-card-foto">
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
</div>
@endif

{{-- ===== SECTION GALERI ===== --}}
@if($portofolios->count() > 0)
@php $kategoris = $portofolios->pluck('kategori')->filter()->unique()->values(); @endphp
@if($kategoris->count() > 0)
<div class="filter-bar">
    <span class="filter-label">Filter:</span>
    <button class="filter-btn active" data-filter="all">Semua</button>
    @foreach($kategoris as $kat)
    <button class="filter-btn" data-filter="{{ Str::slug($kat) }}">{{ $kat }}</button>
    @endforeach
</div>
@endif

<div class="section" style="background:#f8f9fa;text-align:center">
    <div class="reveal">
        <span class="section-tag">Galeri</span>
        <h2 style="font-size:34px;font-weight:800;color:#1a2e4a;margin-bottom:8px">Galeri Proyek</h2>
        <p style="font-size:14px;color:#888">Proyek kami yang mencerminkan keahlian dan profesionalisme</p>
    </div>
    <div class="porto-grid">
        @foreach($portofolios as $i => $porto)
        <div class="porto-card reveal delay-{{ ($i % 3) + 1 }}"
             data-category="{{ Str::slug($porto->kategori ?? '') }}"
             onclick="openLightbox('{{ Storage::url($porto->foto) }}', '{{ $porto->judul }}', '{{ $porto->kategori ?? '' }}')">
            <img src="{{ Storage::url($porto->foto) }}" alt="{{ $porto->judul }}" loading="lazy">
            <div class="porto-overlay">
                <h4>{{ $porto->judul }}</h4>
                @if($porto->kategori)<span>{{ $porto->kategori }}</span>@endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="stats-strip">
    <div class="strip-stat reveal delay-1"><h3><span class="counter" data-target="{{ $portofolios->count() }}">0</span>+</h3><p>Total Foto</p></div>
    <div class="strip-stat reveal delay-2"><h3><span class="counter" data-target="{{ $kategoris->count() ?: 1 }}">0</span></h3><p>Kategori</p></div>
    <div class="strip-stat reveal delay-3"><h3><span class="counter" data-target="150">0</span>+</h3><p>Proyek Selesai</p></div>
    <div class="strip-stat reveal delay-4"><h3><span class="counter" data-target="15">0</span></h3><p>Tahun Pengalaman</p></div>
</div>

@else
<div class="section"><div class="empty-state"><p style="font-size:48px">📷</p><h3 style="color:#555;margin-bottom:8px">Portofolio Sedang Diperbarui</h3><p>Silakan kunjungi kembali.</p></div></div>
@endif

<div class="lightbox" id="lightbox" onclick="if(event.target===this)closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">×</button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

@endsection

@section('scripts')
<script>
function openLightbox(src, title, kat) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxCaption').textContent = title + (kat ? ' · ' + kat : '');
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if(e.key==='Escape') closeLightbox(); });

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.porto-card').forEach(card => {
            const show = filter === 'all' || card.dataset.category === filter;
            card.style.opacity = show ? '1' : '0';
            card.style.transform = show ? '' : 'scale(0.95)';
            card.style.display = show ? '' : 'none';
        });
    });
});
</script>
@endsection
