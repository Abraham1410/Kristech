<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kristech Solusindo Energi')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; overflow-x: hidden; }

        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-50px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(50px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }
        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }
        .delay-4 { transition-delay: 0.4s; }
        .delay-5 { transition-delay: 0.5s; }
        .delay-6 { transition-delay: 0.6s; }

        .topbar { background: #1a2e4a; text-align: center; padding: 10px; font-size: 13px; letter-spacing: 1.5px; color: #aab; position: relative; overflow: hidden; }
        .topbar::after { content: ''; position: absolute; top: 0; left: -100%; width: 60%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent); animation: shimmer 3s infinite; }
        @keyframes shimmer { 0% { left: -100%; } 100% { left: 200%; } }

        .navbar { background: rgba(255,255,255,0.95); backdrop-filter: blur(12px); padding: 16px 60px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 20px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 1000; transition: all 0.3s ease; }
        .navbar.scrolled { padding: 12px 60px; box-shadow: 0 4px 30px rgba(0,0,0,0.12); }

        .navbar-menu { display: flex; gap: 32px; list-style: none; align-items: center; }
        .navbar-menu > li { position: relative; }
        .navbar-menu a { color: #333; text-decoration: none; font-size: 14px; font-weight: 600; transition: color 0.2s; position: relative; padding-bottom: 4px; display: flex; align-items: center; gap: 4px; }
        .navbar-menu > li > a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: #1a6fd4; transition: width 0.3s ease; }
        .navbar-menu > li > a:hover::after, .navbar-menu > li > a.active::after { width: 100%; }
        .navbar-menu a:hover, .navbar-menu a.active { color: #1a6fd4; }

        .nav-dropdown { position: absolute; top: calc(100% + 16px); left: 50%; transform: translateX(-50%) translateY(-8px); background: #fff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.12); min-width: 200px; padding: 8px 0; opacity: 0; visibility: hidden; transition: all 0.25s ease; z-index: 999; }
        .nav-dropdown::before { content: ''; position: absolute; top: -6px; left: 50%; transform: translateX(-50%); border-left: 6px solid transparent; border-right: 6px solid transparent; border-bottom: 6px solid #fff; }
        .navbar-menu li:hover .nav-dropdown { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
        .nav-dropdown a { display: block; padding: 10px 20px; font-size: 13px; font-weight: 500; color: #444; text-decoration: none; transition: all 0.2s; white-space: nowrap; }
        .nav-dropdown a::after { display: none !important; }
        .nav-dropdown a:hover { background: #f0f6ff; color: #1a6fd4; padding-left: 26px; }
        .nav-dropdown-divider { border: none; border-top: 1px solid #f0f0f0; margin: 4px 0; }
        .dropdown-arrow { font-size: 10px; transition: transform 0.2s; display: inline-block; }
        .navbar-menu li:hover .dropdown-arrow { transform: rotate(180deg); }

        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 4px; }
        .hamburger span { display: block; width: 24px; height: 2px; background: #1a2e4a; transition: all 0.3s; }
        .hamburger.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        .back-to-top { position: fixed; bottom: 30px; right: 30px; width: 46px; height: 46px; background: #1a6fd4; color: #fff; border: none; border-radius: 50%; font-size: 20px; cursor: pointer; opacity: 0; transform: translateY(20px); transition: all 0.3s ease; z-index: 999; box-shadow: 0 4px 15px rgba(26,111,212,0.4); }
        .back-to-top.show { opacity: 1; transform: translateY(0); }
        .back-to-top:hover { background: #1a2e4a; transform: translateY(-3px); }

        .wa-float { position: fixed; bottom: 85px; right: 30px; width: 50px; height: 50px; background: #25D366; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 26px; box-shadow: 0 4px 15px rgba(37,211,102,0.4); z-index: 999; transition: transform 0.3s; animation: pulse-wa 2s infinite; }
        .wa-float:hover { transform: scale(1.1); }
        @keyframes pulse-wa { 0%, 100% { box-shadow: 0 4px 15px rgba(37,211,102,0.4); } 50% { box-shadow: 0 4px 25px rgba(37,211,102,0.7); } }

        .footer { background: #1a2e4a; padding: 60px 60px 30px; color: #aaa; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 40px; max-width: 1100px; margin: 0 auto 40px; }
        .footer h4 { color: #fff; font-size: 15px; font-weight: 700; margin-bottom: 18px; }
        .footer p { font-size: 14px; line-height: 1.8; }
        .footer a { color: #aaa; text-decoration: none; font-size: 14px; display: block; margin-bottom: 10px; transition: all 0.2s; padding-left: 0; }
        .footer a:hover { color: #fff; padding-left: 6px; }

        .footer-kerjasama { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 28px; margin-top: 0; margin-bottom: 28px; max-width: 1100px; margin-left: auto; margin-right: auto; }
        .footer-kerjasama h4 { color: #fff; font-size: 13px; font-weight: 700; margin-bottom: 14px; text-transform: uppercase; letter-spacing: 1px; }
        .kerjasama-list { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .kerjasama-badge { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); color: #ccc; font-size: 13px; font-weight: 600; padding: 6px 16px; border-radius: 20px; }

        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 24px; text-align: center; font-size: 13px; max-width: 1100px; margin: 0 auto; }
        .counter { display: inline-block; }

        @media (max-width: 768px) {
            .navbar { padding: 14px 20px; }
            .navbar-menu { display: none; position: absolute; top: 100%; left: 0; right: 0; background: #fff; flex-direction: column; padding: 20px; gap: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
            .navbar-menu.open { display: flex; }
            .hamburger { display: flex; }
            .nav-dropdown { position: static; opacity: 1; visibility: visible; transform: none; box-shadow: none; background: #f8f9fa; border-radius: 8px; padding: 4px 0; margin-top: 8px; display: none; min-width: unset; }
            .nav-dropdown::before { display: none; }
            .navbar-menu li.dropdown-open .nav-dropdown { display: block; }
            .footer { padding: 40px 20px; }
            .footer-grid { grid-template-columns: 1fr; gap: 24px; }
        }
    </style>

    @yield('styles')
</head>
<body>

<div class="topbar">
    ✨ HARGA TERJANGKAU DENGAN KUALITAS INSTALASI PROFESIONAL
</div>

@php $navLayanans = \App\Models\Layanan::where('aktif', true)->orderBy('urutan')->get(); @endphp
<nav class="navbar" id="navbar">
    <div class="navbar-logo">
        <a href="{{ route('home') }}" style="text-decoration:none">
            <span style="font-size:18px;font-weight:800;color:#1a2e4a">Kristech<span style="color:#1a6fd4"> Solusindo</span></span>
        </a>
    </div>

    <ul class="navbar-menu" id="navMenu">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('portofolio') }}" class="{{ request()->routeIs('portofolio') ? 'active' : '' }}">Portofolio</a></li>
        <li>
            <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}">
                Layanan <span class="dropdown-arrow">▾</span>
            </a>
            @if($navLayanans->count() > 0)
            <div class="nav-dropdown">
                @foreach($navLayanans as $navLayanan)
                    <a href="{{ route('layanan.detail', $navLayanan->slug) }}">{{ $navLayanan->nama }}</a>
                @endforeach
                <hr class="nav-dropdown-divider">
                <a href="{{ route('layanan') }}" style="color:#1a6fd4;font-weight:600">Lihat Semua →</a>
            </div>
            @endif
        </li>
        <li><a href="{{ route('proyek') }}" class="{{ request()->routeIs('proyek') ? 'active' : '' }}">Proyek</a></li>
        <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a></li>
    </ul>

    <div class="hamburger" id="hamburger">
        <span></span><span></span><span></span>
    </div>
</nav>

@yield('content')

<footer class="footer">
    <div class="footer-grid">
        <div class="reveal">
            <h4>Kristech Solusindo Energi</h4>
            <p>Kami ahli dalam kontraktor mekanikal elektrikal dengan pendekatan profesional dan solusi tepat untuk bisnis Anda.</p>
        </div>
        <div class="reveal delay-2">
            <h4>Menu</h4>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('portofolio') }}">Portofolio</a>
            <a href="{{ route('layanan') }}">Layanan</a>
            <a href="{{ route('proyek') }}">Proyek</a>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
        </div>
        <div class="reveal delay-3">
            <h4>Kontak</h4>
            <p>📞 +6285162817158</p><br>
            <p>✉️ info@kristechsolusindo.com</p>
        </div>
    </div>

    <div class="footer-kerjasama">
        <h4>Klien &amp; Mitra Kerja</h4>
        <div class="kerjasama-list">
            <span class="kerjasama-badge">🏪 Indomaret</span>
            <span class="kerjasama-badge">🏪 Alfamart</span>
            <span class="kerjasama-badge">🏠 Rukita</span>
            <span class="kerjasama-badge">☕ Janji Jiwa</span>
            <span class="kerjasama-badge">🏭 Indofood</span>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Kristech Solusindo Energi. All rights reserved.</p>
    </div>
</footer>

<a href="https://wa.me/6285162817158" target="_blank" class="wa-float" title="Chat WhatsApp">💬</a>
<button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', function() {
    if (window.scrollY > 50) { navbar.classList.add('scrolled'); } else { navbar.classList.remove('scrolled'); }
    var btn = document.getElementById('backToTop');
    if (window.scrollY > 400) { btn.classList.add('show'); } else { btn.classList.remove('show'); }
});

var hamburger = document.getElementById('hamburger');
var navMenu = document.getElementById('navMenu');
hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('open');
    navMenu.classList.toggle('open');
});

document.querySelectorAll('.navbar-menu > li > a').forEach(function(link) {
    link.addEventListener('click', function(e) {
        var li = this.parentElement;
        if (window.innerWidth <= 768 && li.querySelector('.nav-dropdown')) {
            e.preventDefault();
            li.classList.toggle('dropdown-open');
        }
    });
});

var revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) { if (entry.isIntersecting) entry.target.classList.add('visible'); });
}, { threshold: 0.1 });
revealElements.forEach(function(el) { observer.observe(el); });

function animateCounter(el, target, duration) {
    var start = 0;
    var increment = target / (duration / 16);
    var timer = setInterval(function() {
        start += increment;
        if (start >= target) { el.textContent = target; clearInterval(timer); }
        else { el.textContent = Math.floor(start); }
    }, 16);
}
var counterObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
        if (entry.isIntersecting && !entry.target.dataset.counted) {
            entry.target.dataset.counted = true;
            animateCounter(entry.target, parseInt(entry.target.dataset.target), 2000);
        }
    });
}, { threshold: 0.5 });
document.querySelectorAll('.counter').forEach(function(el) { counterObserver.observe(el); });
</script>

@yield('scripts')
</body>
</html>
