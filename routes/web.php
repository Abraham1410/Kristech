<?php
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\ProyekController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\PesanController;
use Illuminate\Support\Facades\Route;

// ===== FRONTEND ROUTES =====
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/layanan', [FrontendController::class, 'layanan'])->name('layanan');
Route::get('/layanan/{slug}', [FrontendController::class, 'layananDetail'])->name('layanan.detail');
Route::get('/proyek', [FrontendController::class, 'proyek'])->name('proyek');
Route::get('/portofolio', [FrontendController::class, 'portofolio'])->name('portofolio');
Route::get('/tentang-kami', [FrontendController::class, 'tentang'])->name('tentang');
Route::post('/kirim-pesan', [FrontendController::class, 'kirimPesan'])->name('kirim.pesan');

// ===== AUTH ROUTES (Laravel Breeze) =====
require __DIR__.'/auth.php';

// ===== ADMIN ROUTES =====
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [BerandaAdminController::class, 'index'])->name('dashboard');
    Route::get('/beranda', [BerandaAdminController::class, 'edit'])->name('beranda.edit');
    Route::put('/beranda', [BerandaAdminController::class, 'update'])->name('beranda.update');
    Route::resource('layanan', LayananController::class);
    Route::resource('proyek', ProyekController::class);
    Route::resource('portofolio', PortofolioController::class);
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{pesan}', [PesanController::class, 'show'])->name('pesan.show');
    Route::delete('/pesan/{pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');
});
