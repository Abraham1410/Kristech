<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function index() {
        $portofolios = Portofolio::orderBy('urutan')->get();
        return view('admin.portofolio.index', compact('portofolios'));
    }

    public function create() {
        return view('admin.portofolio.form');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('portofolio', 'public');

        Portofolio::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'kategori' => $request->kategori,
            'aktif' => $request->has('aktif'),
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit(Portofolio $portofolio) {
        return view('admin.portofolio.form', compact('portofolio'));
    }

    public function update(Request $request, Portofolio $portofolio) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('judul','deskripsi','kategori','urutan');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($portofolio->foto);
            $data['foto'] = $request->file('foto')->store('portofolio', 'public');
        }

        $portofolio->update($data);
        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil diupdate!');
    }

    public function destroy(Portofolio $portofolio) {
        Storage::disk('public')->delete($portofolio->foto);
        $portofolio->delete();
        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}
