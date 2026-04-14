<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Identitas
            ['key' => 'nama_dinas',     'value' => 'Bagian Organisasi dan Tata Laksana',                    'type' => 'text',    'group' => 'identitas'],
            ['key' => 'sub_nama_dinas', 'value' => 'Pemerintah Kabupaten Bolaang Mongondow Utara',        'type' => 'text',    'group' => 'identitas'],
            ['key' => 'nama_singkat',   'value' => 'Boltara',        'type' => 'text', 'group' => 'identitas'],
            ['key' => 'singkatan_dinas', 'value' => 'Ortala',         'type' => 'text', 'group' => 'identitas'],
            ['key' => 'logo',           'value' => 'img/logo-bolmut.png',                 'type' => 'image',   'group' => 'identitas'],

            // Hero
            ['key' => 'hero_judul',     'value' => 'Mewujudkan Tata Kelola Pemerintahan yang Efektif & Efisien', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subjudul',  'value' => 'Transformasi organisasi melalui penguatan kelembagaan, analisis jabatan, dan peningkatan kualitas pelayanan publik.', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_gambar',    'value' => null,                                  'type' => 'image',   'group' => 'hero'],
            ['key' => 'login_gambar',   'value' => null,                                  'type' => 'image',   'group' => 'hero'],
            ['key' => 'login_quote',    'value' => 'Data yang akurat adalah fondasi kebijakan perikanan yang tepat sasaran untuk kesejahteraan nelayan.', 'type' => 'text', 'group' => 'hero'],

            // Warna
            ['key' => 'warna_primer',   'value' => '#0284c7',                             'type' => 'color',   'group' => 'warna'],
            ['key' => 'warna_gelap',    'value' => '#0c4a6e',                             'type' => 'color',   'group' => 'warna'],
            ['key' => 'warna_aksen',    'value' => '#fbbf24',                             'type' => 'color',   'group' => 'warna'],

            // Modul
            ['key' => 'modul_publikasi_data',          'value' => '1', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'modul_data_tangkap',            'value' => '1', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'modul_publikasi_dokumen',       'value' => '1', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'modul_pengumuman',              'value' => '1', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'modul_berita',                  'value' => '0', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'modul_struktur_organisasi',     'value' => '1', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'modul_visi_misi',               'value' => '1', 'type' => 'boolean', 'group' => 'modul'],
            ['key' => 'hero_mode', 'value' => 'carousel', 'type' => 'text', 'group' => 'hero'],

            // Berita
            ['key' => 'berita_alias', 'value' => 'bpkd', 'type' => 'text', 'group' => 'berita'],

            // Kontak & Footer
            ['key' => 'kontak_nama_instansi', 'value' => 'Bagian Organisasi dan Tata Laksana',           'type' => 'text', 'group' => 'kontak'],
            ['key' => 'kontak_alamat',        'value' => 'Jl. Trans Sulawesi, Boroko, Kab. Bolmut',      'type' => 'text', 'group' => 'kontak'],
            ['key' => 'kontak_telepon',       'value' => '(0434) 123456',                                'type' => 'text', 'group' => 'kontak'],
            ['key' => 'kontak_email',         'value' => 'ortala@bolmutkab.go.id',                       'type' => 'text', 'group' => 'kontak'],
            ['key' => 'kontak_maps_url',      'value' => null,                                           'type' => 'text', 'group' => 'kontak'],
            ['key' => 'kontak_facebook',      'value' => null,                                           'type' => 'text', 'group' => 'kontak'],
            ['key' => 'kontak_instagram',     'value' => null,                                           'type' => 'text', 'group' => 'kontak'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
