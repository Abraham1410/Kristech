@extends('layouts.admin')
@section('page-title', 'Kelola Proyek')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Proyek</span>
        <a href="{{ route('admin.proyek.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyeks as $i => $proyek)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><img src="{{ Storage::url($proyek->foto) }}" class="img-preview" alt="{{ $proyek->judul }}"></td>
                <td><strong>{{ $proyek->judul }}</strong><br><small style="color:#888">{{ Str::limit($proyek->deskripsi, 60) }}</small></td>
                <td>{{ $proyek->kategori ?? '-' }}</td>
                <td>
                    @if($proyek->aktif)
                        <span class="badge-aktif">Aktif</span>
                    @else
                        <span class="badge-nonaktif">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.proyek.edit', $proyek) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.proyek.destroy', $proyek) }}" style="display:inline" onsubmit="return confirm('Hapus proyek ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#888;padding:30px">Belum ada proyek.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
