@extends('layouts.admin')
@section('page-title', 'Pesan Masuk')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Pesan Masuk @if($belumDibaca > 0) <span class="badge" style="background:#e74c3c;color:#fff;padding:3px 8px;border-radius:10px;font-size:12px">{{ $belumDibaca }} baru</span> @endif</span>
    </div>
    <table>
        <thead>
            <tr><th>#</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Pesan</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($pesans as $i => $pesan)
            <tr style="{{ !$pesan->sudah_dibaca ? 'font-weight:600' : '' }}">
                <td>{{ $i + 1 }}</td>
                <td>{{ $pesan->nama }}</td>
                <td>{{ $pesan->email }}</td>
                <td>{{ $pesan->telepon ?? '-' }}</td>
                <td style="max-width:200px">{{ Str::limit($pesan->pesan, 60) }}</td>
                <td style="white-space:nowrap">{{ $pesan->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if(!$pesan->sudah_dibaca)
                        <span class="badge-baru">Baru</span>
                    @else
                        <span style="color:#888;font-size:12px">Dibaca</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.pesan.show', $pesan) }}" class="btn btn-primary btn-sm">Lihat</a>
                    <form method="POST" action="{{ route('admin.pesan.destroy', $pesan) }}" style="display:inline" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;color:#888;padding:30px">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
