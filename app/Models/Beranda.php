<?php
// app/Models/Beranda.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model {
    protected $fillable = [
        'hero_title','hero_subtitle','hero_image',
        'tentang_title','tentang_description','tentang_image',
        'stat_proyek','stat_proyek_label','stat_tahun','stat_tahun_label'
    ];
}
