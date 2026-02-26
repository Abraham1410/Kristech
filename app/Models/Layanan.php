<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model {
    protected $fillable = ['nama', 'slug', 'deskripsi', 'icon', 'foto', 'aktif', 'urutan'];
    protected $casts = ['aktif' => 'boolean'];

    public function setNamaAttribute($value) {
        $this->attributes['nama'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function sections() {
        return $this->hasMany(LayananSection::class)->orderBy('urutan');
    }
}
