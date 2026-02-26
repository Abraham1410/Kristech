<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model {
    protected $fillable = ['nama','email','telepon','pesan','sudah_dibaca'];
    protected $casts = ['sudah_dibaca' => 'boolean'];
}
