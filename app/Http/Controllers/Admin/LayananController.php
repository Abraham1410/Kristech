<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\LayananSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index() {
        $layanans = Layanan::orderBy('urutan')->get();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create() {
        return view('admin.layanan.form');
    }

    public function store(Request $request) {
        $request->validate([
            'nama'               => 'required|string|max:255',
            'deskripsi'          => 'required|string',
            'urutan'             => 'integer',
            'foto'               => 'nullable|image|max:2048',
            'sections.*.judul'   => 'required|string|max:255',
            'sections.*.deskripsi' => 'required|string',
            'sections.*.foto'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi', 'icon', 'urutan');
        $data['aktif'] = $request->has('aktif') ? true : false;
        $data['slug'] = Str::slug($request->nama);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        $layanan = Layanan::create($data);

        // Simpan sections
        if ($request->has('sections')) {
            foreach ($request->sections as $i => $section) {
                $sectionData = [
                    'layanan_id' => $layanan->id,
                    'judul'      => $section['judul'],
                    'deskripsi'  => $section['deskripsi'],
                    'urutan'     => $i,
                ];
                if (isset($request->file('sections')[$i]['foto'])) {
                    $sectionData['foto'] = $request->file('sections')[$i]['foto']->store('layanan/sections', 'public');
                }
                LayananSection::create($sectionData);
            }
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Layanan $layanan) {
        $layanan->load('sections');
        return view('admin.layanan.form', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan) {
        $request->validate([
            'nama'               => 'required|string|max:255',
            'deskripsi'          => 'required|string',
            'foto'               => 'nullable|image|max:2048',
            'sections.*.judul'   => 'required|string|max:255',
            'sections.*.deskripsi' => 'required|string',
            'sections.*.foto'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi', 'icon', 'urutan');
        $data['aktif'] = $request->has('aktif') ? true : false;
        $data['slug'] = Str::slug($request->nama);

        if ($request->hasFile('foto')) {
            if ($layanan->foto) Storage::disk('public')->delete($layanan->foto);
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        $layanan->update($data);

        // Hapus sections lama lalu buat ulang
        foreach ($layanan->sections as $oldSection) {
            if ($oldSection->foto) Storage::disk('public')->delete($oldSection->foto);
        }
        $layanan->sections()->delete();

        if ($request->has('sections')) {
            foreach ($request->sections as $i => $section) {
                $sectionData = [
                    'layanan_id' => $layanan->id,
                    'judul'      => $section['judul'],
                    'deskripsi'  => $section['deskripsi'],
                    'urutan'     => $i,
                ];
                // Cek foto section yang diupload
                if ($request->hasFile("sections.$i.foto")) {
                    $sectionData['foto'] = $request->file("sections.$i.foto")->store('layanan/sections', 'public');
                } elseif (isset($section['foto_existing'])) {
                    $sectionData['foto'] = $section['foto_existing'];
                }
                LayananSection::create($sectionData);
            }
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diupdate!');
    }

    public function destroy(Layanan $layanan) {
        if ($layanan->foto) Storage::disk('public')->delete($layanan->foto);
        foreach ($layanan->sections as $section) {
            if ($section->foto) Storage::disk('public')->delete($section->foto);
        }
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
