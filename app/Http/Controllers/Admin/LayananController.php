<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'urutan' => 'integer',
        ]);
        Layanan::create($request->only('nama','deskripsi','icon','aktif','urutan'));
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Layanan $layanan) {
        return view('admin.layanan.form', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);
        $layanan->update($request->only('nama','deskripsi','icon','aktif','urutan'));
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diupdate!');
    }

    public function destroy(Layanan $layanan) {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
