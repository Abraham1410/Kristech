{{-- resources/views/admin/portofolio/index.blade.php --}}
@extends('layouts.admin')
@section('page-title', 'Kelola Portofolio')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Portofolio & Galeri</span>
        <a href="{{ route('admin.portofolio.create') }}" class="btn btn-primary">+ Tambah Foto</a>
    </div>
    <table>
        <thead>
            <tr><th>#</th><th>Foto</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($portofolios as $i => $porto)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><img src="{{ Storage::url($porto->foto) }}" class="img-preview" alt="{{ $porto->judul }}"></td>
                <td><strong>{{ $porto->judul }}</strong></td>
                <td>{{ $porto->kategori ?? '-' }}</td>
                <td>
                    @if($porto->aktif) <span class="badge-aktif">Aktif</span>
                    @else <span class="badge-nonaktif">Nonaktif</span> @endif
                </td>
                <td>
                    <a href="{{ route('admin.portofolio.edit', $porto) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.portofolio.destroy', $porto) }}" style="display:inline" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#888;padding:30px">Belum ada portofolio.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
