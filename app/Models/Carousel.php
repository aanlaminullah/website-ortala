<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = 'carousel';
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'aktif', 'urutan'];
    protected $casts = ['aktif' => 'boolean'];
}
