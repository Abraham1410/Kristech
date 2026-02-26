@extends('layouts.admin')
@section('page-title', 'Detail Pesan')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <span class="card-title">Detail Pesan</span>
        <a href="{{ route('admin.pesan.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
    <table style="width:100%">
        <tr><td style="width:120px;color:#888;padding:10px 0;font-size:14px">Nama</td><td style="font-size:14px;padding:10px 0"><strong>{{ $pesan->nama }}</strong></td></tr>
        <tr><td style="color:#888;padding:10px 0;font-size:14px">Email</td><td style="font-size:14px;padding:10px 0"><a href="mailto:{{ $pesan->email }}">{{ $pesan->email }}</a></td></tr>
        <tr><td style="color:#888;padding:10px 0;font-size:14px">Telepon</td><td style="font-size:14px;padding:10px 0">{{ $pesan->telepon ?? '-' }}</td></tr>
        <tr><td style="color:#888;padding:10px 0;font-size:14px">Tanggal</td><td style="font-size:14px;padding:10px 0">{{ $pesan->created_at->format('d F Y, H:i') }}</td></tr>
        <tr>
            <td style="color:#888;padding:10px 0;font-size:14px;vertical-align:top">Pesan</td>
            <td style="font-size:14px;padding:10px 0;line-height:1.7">{{ $pesan->pesan }}</td>
        </tr>
    </table>
    <div style="margin-top:20px;display:flex;gap:10px">
        <a href="mailto:{{ $pesan->email }}" class="btn btn-primary">📧 Balas via Email</a>
        @if($pesan->telepon)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->telepon) }}" target="_blank" class="btn btn-success">💬 WhatsApp</a>
        @endif
    </div>
</div>
@endsection
