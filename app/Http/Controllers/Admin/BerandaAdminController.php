<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Beranda;
use App\Models\Layanan;
use App\Models\Proyek;
use App\Models\Portofolio;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaAdminController extends Controller
{
    public function index() {
        $totalLayanan = Layanan::count();
        $totalProyek = Proyek::count();
        $totalPortofolio = Portofolio::count();
        $pesanBaru = Pesan::where('sudah_dibaca', false)->count();
        return view('admin.dashboard', compact('totalLayanan','totalProyek','totalPortofolio','pesanBaru'));
    }

    public function edit() {
        $beranda = Beranda::first() ?? new Beranda();
        return view('admin.beranda.edit', compact('beranda'));
    }

    public function update(Request $request) {
        $request->validate([
            'hero_title' => 'required|string',
            'hero_subtitle' => 'required|string',
            'tentang_title' => 'required|string',
            'tentang_description' => 'required|string',
        ]);

        $beranda = Beranda::first() ?? new Beranda();
        $data = $request->only('hero_title','hero_subtitle','tentang_title','tentang_description','stat_proyek','stat_proyek_label','stat_tahun','stat_tahun_label');

        if ($request->hasFile('hero_image')) {
            if ($beranda->hero_image) Storage::disk('public')->delete($beranda->hero_image);
            $data['hero_image'] = $request->file('hero_image')->store('beranda', 'public');
        }

        if ($request->hasFile('tentang_image')) {
            if ($beranda->tentang_image) Storage::disk('public')->delete($beranda->tentang_image);
            $data['tentang_image'] = $request->file('tentang_image')->store('beranda', 'public');
        }

        $beranda->fill($data);
        $beranda->save();

        return redirect()->route('admin.beranda.edit')->with('success', 'Konten beranda berhasil diupdate!');
    }
}
