<?php
// database/migrations/2024_01_01_000001_create_berandas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('berandas', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('hero_image')->nullable();
            $table->string('tentang_title');
            $table->text('tentang_description');
            $table->string('tentang_image')->nullable();
            $table->integer('stat_proyek')->default(150);
            $table->string('stat_proyek_label')->default('Proyek Selesai');
            $table->integer('stat_tahun')->default(15);
            $table->string('stat_tahun_label')->default('Tahun Pengalaman');
            $table->timestamps();
        });

        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('icon')->nullable();
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('kategori')->nullable();
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto');
            $table->string('kategori')->nullable();
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->text('pesan');
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('berandas');
        Schema::dropIfExists('layanans');
        Schema::dropIfExists('proyeks');
        Schema::dropIfExists('portofolios');
        Schema::dropIfExists('pesans');
    }
};
