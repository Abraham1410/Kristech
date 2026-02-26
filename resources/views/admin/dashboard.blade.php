@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>{{ $totalLayanan }}</h3>
        <p>⚡ Total Layanan</p>
    </div>
    <div class="stat-card" style="border-left-color: #28a745">
        <h3>{{ $totalProyek }}</h3>
        <p>🏗️ Total Proyek</p>
    </div>
    <div class="stat-card" style="border-left-color: #fd7e14">
        <h3>{{ $totalPortofolio }}</h3>
        <p>🖼️ Total Portofolio</p>
    </div>
    <div class="stat-card" style="border-left-color: #e74c3c">
        <h3>{{ $pesanBaru }}</h3>
        <p>✉️ Pesan Belum Dibaca</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Selamat Datang di Admin Panel</span>
    </div>
    <p style="color:#666;font-size:14px;line-height:1.7">
        Halo <strong>{{ auth()->user()->name }}</strong>! Gunakan menu di sebelah kiri untuk mengelola konten website Kristech Solusindo Energi.
        <br><br>
        📌 <strong>Tips:</strong> Perubahan yang Anda simpan akan langsung tampil di website.
    </p>
</div>
@endsection
