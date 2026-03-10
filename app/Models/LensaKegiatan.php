<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LensaKegiatan extends Model
{
    protected $table = 'lensa_kegiatan';

    protected $fillable = ['judul', 'foto', 'tanggal', 'aktif'];

    protected $casts = [
        'aktif'   => 'boolean',
        'tanggal' => 'date',
    ];
}
