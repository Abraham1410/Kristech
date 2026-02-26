@extends('layouts.admin')
@section('page-title', 'Kelola Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Layanan</span>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Layanan</th>
                <th>Deskripsi</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($layanans as $i => $layanan)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $layanan->nama }}</strong></td>
                <td style="max-width:300px">{{ Str::limit($layanan->deskripsi, 80) }}</td>
                <td>{{ $layanan->urutan }}</td>
                <td>
                    @if($layanan->aktif)
                        <span class="badge-aktif">Aktif</span>
                    @else
                        <span class="badge-nonaktif">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.layanan.edit', $layanan) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.layanan.destroy', $layanan) }}" style="display:inline" onsubmit="return confirm('Hapus layanan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#888;padding:30px">Belum ada layanan. Klik "Tambah Layanan" untuk mulai.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
