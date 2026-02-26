<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
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
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'urutan'    => 'integer',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi', 'icon', 'urutan');
        $data['aktif'] = $request->has('aktif') ? true : false;
        $data['slug'] = Str::slug($request->nama);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        Layanan::create($data);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Layanan $layanan) {
        return view('admin.layanan.form', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan) {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi', 'icon', 'urutan');
        $data['aktif'] = $request->has('aktif') ? true : false;
        $data['slug'] = Str::slug($request->nama);

        if ($request->hasFile('foto')) {
            if ($layanan->foto) Storage::disk('public')->delete($layanan->foto);
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        $layanan->update($data);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diupdate!');
    }

    public function destroy(Layanan $layanan) {
        if ($layanan->foto) Storage::disk('public')->delete($layanan->foto);
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
