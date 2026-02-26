<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index() {
        $pesans = Pesan::orderByDesc('created_at')->get();
        $belumDibaca = Pesan::where('sudah_dibaca', false)->count();
        return view('admin.pesan.index', compact('pesans', 'belumDibaca'));
    }

    public function show(Pesan $pesan) {
        $pesan->update(['sudah_dibaca' => true]);
        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy(Pesan $pesan) {
        $pesan->delete();
        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus!');
    }
}
