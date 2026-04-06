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
            ['key' => 'nama_dinas',     'value' => 'Dinas Perikanan',                    'type' => 'text',    'group' => 'identitas'],
            ['key' => 'sub_nama_dinas', 'value' => 'Kab. Bolaang Mongondow Utara',        'type' => 'text',    'group' => 'identitas'],
            ['key' => 'nama_singkat',   'value' => 'Bolmut',        'type' => 'text', 'group' => 'identitas'],
            ['key' => 'singkatan_dinas', 'value' => 'Diskan',         'type' => 'text', 'group' => 'identitas'],
            ['key' => 'logo',           'value' => 'img/logo-bolmut.png',                 'type' => 'image',   'group' => 'identitas'],

            // Hero
            ['key' => 'hero_judul',     'value' => 'Mewujudkan Perikanan Maju & Berkelanjutan', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subjudul',  'value' => 'Sistem informasi terpadu perikanan Kabupaten Bolaang Mongondow Utara untuk kesejahteraan nelayan dan pelestarian ekosistem laut yang lestari.', 'type' => 'text', 'group' => 'hero'],
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

            // Berita
            ['key' => 'berita_alias', 'value' => 'bpkd', 'type' => 'text', 'group' => 'berita'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
