<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    public function index() {
        $proyeks = Proyek::orderBy('urutan')->get();
        return view('admin.proyek.index', compact('proyeks'));
    }

    public function create() {
        return view('admin.proyek.form');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('proyek', 'public');

        Proyek::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'kategori' => $request->kategori,
            'aktif' => $request->has('aktif'),
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function edit(Proyek $proyek) {
        return view('admin.proyek.form', compact('proyek'));
    }

    public function update(Request $request, Proyek $proyek) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('judul','deskripsi','kategori','urutan');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($proyek->foto);
            $data['foto'] = $request->file('foto')->store('proyek', 'public');
        }

        $proyek->update($data);
        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil diupdate!');
    }

    public function destroy(Proyek $proyek) {
        Storage::disk('public')->delete($proyek->foto);
        $proyek->delete();
        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil dihapus!');
    }
}
