<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model {
    protected $fillable = ['judul','deskripsi','foto','kategori','aktif','urutan'];
    protected $casts = ['aktif' => 'boolean'];
}
