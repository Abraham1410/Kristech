<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananSection extends Model {
    protected $fillable = ['layanan_id', 'judul', 'deskripsi', 'foto', 'urutan'];

    public function layanan() {
        return $this->belongsTo(Layanan::class);
    }
}
