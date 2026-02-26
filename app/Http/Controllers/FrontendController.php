<?php
namespace App\Http\Controllers;
use App\Models\Beranda;
use App\Models\Layanan;
use App\Models\Proyek;
use App\Models\Portofolio;
use App\Models\Pesan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $beranda = Beranda::first();
        $layanans = Layanan::where('aktif', true)->orderBy('urutan')->get();
        $proyeks = Proyek::where('aktif', true)->orderBy('urutan')->take(4)->get();
        $portofolios = Portofolio::where('aktif', true)->orderBy('urutan')->take(6)->get();
        return view('frontend.beranda', compact('beranda','layanans','proyeks','portofolios'));
    }

    public function layanan() {
        $layanans = Layanan::where('aktif', true)->orderBy('urutan')->get();
        return view('frontend.layanan', compact('layanans'));
    }

    public function proyek() {
        $proyeks = Proyek::where('aktif', true)->orderBy('urutan')->get();
        return view('frontend.proyek', compact('proyeks'));
    }

    public function portofolio() {
        $portofolios = Portofolio::where('aktif', true)->orderBy('urutan')->get();
        return view('frontend.portofolio', compact('portofolios'));
    }

    public function tentang() {
        $beranda = Beranda::first();
        return view('frontend.tentang', compact('beranda'));
    }

    public function kirimPesan(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Pesan::create($request->only('nama','email','telepon','pesan'));
        return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
