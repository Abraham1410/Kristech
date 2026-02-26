<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Layanan;

return new class extends Migration {
    public function up(): void {
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('nama');
        });

        // Generate slug untuk data yang sudah ada
        foreach (Layanan::all() as $layanan) {
            $layanan->slug = Str::slug($layanan->nama);
            $layanan->save();
        }
    }

    public function down(): void {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
