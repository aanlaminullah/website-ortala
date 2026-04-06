<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublikasiDokumen extends Model
{
    protected $table = 'publikasi_dokumen';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'kategori',
        'file',
        'tipe_file',
        'ukuran_file',
        'tahun',
        'tanggal',
        'aktif',
    ];

    protected $casts = [
        'aktif'   => 'boolean',
        'tanggal' => 'date',
    ];

    public function ukuranFormat(): string
    {
        $bytes = $this->ukuran_file;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    public function ikonFile(): string
    {
        return match (true) {
            str_contains($this->tipe_file, 'pdf')                                                          => 'bxs-file-pdf',
            str_contains($this->tipe_file, 'spreadsheetml') ||
                str_contains($this->tipe_file, 'excel') ||
                str_contains($this->tipe_file, 'csv')                                                          => 'bxs-spreadsheet',
            str_contains($this->tipe_file, 'presentationml') ||
                str_contains($this->tipe_file, 'presentation') ||
                str_contains($this->tipe_file, 'powerpoint')                                                   => 'bxs-slideshow',
            str_contains($this->tipe_file, 'wordprocessingml') ||
                str_contains($this->tipe_file, 'word') ||
                str_contains($this->tipe_file, 'document')                                                     => 'bxs-file-doc',
            default                                                                                         => 'bxs-file',
        };
    }

    public function warnaIkon(): string
    {
        return match (true) {
            str_contains($this->tipe_file, 'pdf')                                                          => 'text-red-500',
            str_contains($this->tipe_file, 'spreadsheetml') ||
                str_contains($this->tipe_file, 'excel') ||
                str_contains($this->tipe_file, 'csv')                                                          => 'text-green-500',
            str_contains($this->tipe_file, 'presentationml') ||
                str_contains($this->tipe_file, 'presentation') ||
                str_contains($this->tipe_file, 'powerpoint')                                                   => 'text-orange-500',
            str_contains($this->tipe_file, 'wordprocessingml') ||
                str_contains($this->tipe_file, 'word') ||
                str_contains($this->tipe_file, 'document')                                                     => 'text-blue-500',
            default                                                                                         => 'text-gray-500',
        };
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
