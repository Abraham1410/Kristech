<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model {
    protected $fillable = ['nama', 'deskripsi', 'icon', 'foto', 'aktif', 'urutan'];
    protected $casts = ['aktif' => 'boolean'];
}
