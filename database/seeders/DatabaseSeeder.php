<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Beranda;
use App\Models\Layanan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Kristech',
            'email' => 'admin@kristechsolusindo.com',
            'password' => Hash::make('kristech2024'),
            'email_verified_at' => now(),
        ]);

        // Seed beranda
        Beranda::create([
            'hero_title' => 'Solusi Pemasangan dan Perbaikan kelistrikan anda',
            'hero_subtitle' => 'Melayani kebutuhan Jasa pemasangan dan perbaikan untuk Tempat usaha dan tempat tinggal anda',
            'tentang_title' => 'Tentang Kristech Solusindo Energi',
            'tentang_description' => 'Kami ahli dalam kontraktor mekanikal elektrikal dengan pendekatan profesional dan solusi tepat untuk bisnis Anda.',
            'stat_proyek' => 150,
            'stat_proyek_label' => 'Berkualitas',
            'stat_tahun' => 15,
            'stat_tahun_label' => 'Terpercaya',
        ]);

        // Seed layanan
        $layanans = [
            ['nama' => 'CCTV & Access Control', 'deskripsi' => 'Pemasangan CCTV, Access Card, dan Smart Doorlock profesional', 'icon' => '📷', 'urutan' => 1],
            ['nama' => 'Instalasi Listrik', 'deskripsi' => 'Pemasangan titik lampu, stop kontak, dan panel listrik berkualitas', 'icon' => '⚡', 'urutan' => 2],
            ['nama' => 'Network & Wifi', 'deskripsi' => 'Instalasi jaringan wifi dan network management untuk bisnis Anda', 'icon' => '📶', 'urutan' => 3],
            ['nama' => 'Pemipaan (Plumbing)', 'deskripsi' => 'Pemipaan air bersih dan kotor untuk hunian dan komersial', 'icon' => '🔧', 'urutan' => 4],
            ['nama' => 'AC & Fire Alarm', 'deskripsi' => 'Pemasangan AC dan sistem fire alarm sesuai standar keamanan', 'icon' => '❄️', 'urutan' => 5],
            ['nama' => 'IOT & Smart System', 'deskripsi' => 'Solusi smart building dan Internet of Things untuk gedung modern', 'icon' => '🏠', 'urutan' => 6],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create(array_merge($layanan, ['aktif' => true]));
        }
    }
}
