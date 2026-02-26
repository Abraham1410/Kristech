@extends('layouts.admin')
@section('page-title', isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">{{ isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</span>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ isset($layanan) ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($layanan)) @method('PUT') @endif

        {{-- INFO UTAMA --}}
        <div class="form-group">
            <label>Nama Layanan *</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $layanan->nama ?? '') }}"
                   required placeholder="Contoh: Kelistrikan">
        </div>

        <div class="form-group">
            <label>Deskripsi Utama *</label>
            <textarea name="deskripsi" class="form-control" rows="5" required
                      placeholder="Deskripsi singkat layanan...">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Foto Utama Layanan</label>
            @if(isset($layanan) && $layanan->foto)
                <div style="margin-bottom:10px">
                    <img src="{{ Storage::url($layanan->foto) }}"
                         style="width:300px;height:180px;object-fit:cover;border-radius:8px;display:block">
                    <small style="color:#888;margin-top:6px;display:block">Upload baru untuk mengganti.</small>
                </div>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">
            <div class="form-group">
                <label>Icon (emoji)</label>
                <input type="text" name="icon" class="form-control"
                       value="{{ old('icon', $layanan->icon ?? '') }}" placeholder="Contoh: ⚡">
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control"
                       value="{{ old('urutan', $layanan->urutan ?? 0) }}" min="0">
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check" style="margin-top:10px">
                    <input type="checkbox" name="aktif" id="aktif" value="1"
                           {{ old('aktif', $layanan->aktif ?? true) ? 'checked' : '' }}>
                    <label for="aktif">Tampilkan di website</label>
                </div>
            </div>
        </div>

        {{-- SECTIONS --}}
        <div style="margin-top:30px;border-top:2px solid #eee;padding-top:24px">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
                <h3 style="font-size:16px;font-weight:700;color:#1a2e4a">📋 Section Konten</h3>
                <button type="button" onclick="tambahSection()" class="btn btn-secondary">+ Tambah Section</button>
            </div>

            <div id="sections-container">
                @if(isset($layanan) && $layanan->sections->count() > 0)
                    @foreach($layanan->sections as $i => $section)
                    <div class="section-item" style="background:#f8f9fa;border-radius:12px;padding:20px;margin-bottom:16px;border:1px solid #e0e0e0">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
                            <strong style="color:#1a2e4a">Section {{ $i + 1 }}</strong>
                            <button type="button" onclick="hapusSection(this)" style="background:#dc3545;color:#fff;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;font-size:13px">🗑 Hapus</button>
                        </div>

                        <div class="form-group">
                            <label>Judul Section *</label>
                            <input type="text" name="sections[{{ $i }}][judul]" class="form-control"
                                   value="{{ $section->judul }}" required placeholder="Contoh: Akses Keahlian yang Berpengalaman">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Section *</label>
                            <textarea name="sections[{{ $i }}][deskripsi]" class="form-control" rows="5" required>{{ $section->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Section</label>
                            @if($section->foto)
                                <div style="margin-bottom:10px">
                                    <img src="{{ Storage::url($section->foto) }}"
                                         style="width:250px;height:150px;object-fit:cover;border-radius:8px;display:block">
                                    <small style="color:#888;margin-top:4px;display:block">Upload baru untuk mengganti.</small>
                                </div>
                                <input type="hidden" name="sections[{{ $i }}][foto_existing]" value="{{ $section->foto }}">
                            @endif
                            <input type="file" name="sections[{{ $i }}][foto]" class="form-control" accept="image/*">
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:20px">💾 Simpan Layanan</button>
    </form>
</div>

<script>
let sectionCount = {{ isset($layanan) ? $layanan->sections->count() : 0 }};

function tambahSection() {
    const i = sectionCount;
    const html = `
    <div class="section-item" style="background:#f8f9fa;border-radius:12px;padding:20px;margin-bottom:16px;border:1px solid #e0e0e0">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <strong style="color:#1a2e4a">Section Baru</strong>
            <button type="button" onclick="hapusSection(this)" style="background:#dc3545;color:#fff;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;font-size:13px">🗑 Hapus</button>
        </div>
        <div class="form-group">
            <label>Judul Section *</label>
            <input type="text" name="sections[${i}][judul]" class="form-control" required placeholder="Contoh: Akses Keahlian yang Berpengalaman">
        </div>
        <div class="form-group">
            <label>Deskripsi Section *</label>
            <textarea name="sections[${i}][deskripsi]" class="form-control" rows="5" required placeholder="Deskripsi section..."></textarea>
        </div>
        <div class="form-group">
            <label>Foto Section</label>
            <input type="file" name="sections[${i}][foto]" class="form-control" accept="image/*">
        </div>
    </div>`;
    document.getElementById('sections-container').insertAdjacentHTML('beforeend', html);
    sectionCount++;
}

function hapusSection(btn) {
    if (confirm('Hapus section ini?')) {
        btn.closest('.section-item').remove();
    }
}
</script>
@endsection
