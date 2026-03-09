<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }

        // Handle upload gambar
        $imageKeys = ['logo', 'hero_gambar', 'login_gambar'];
        foreach ($imageKeys as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $old = setting($imageKey);
                if ($old && !str_starts_with($old, 'img/')) {
                    Storage::disk('public')->delete($old);
                }
                $path = $request->file($imageKey)->store('settings', 'public');
                SiteSetting::where('key', $imageKey)->update(['value' => $path]);
            }
        }

        // Handle boolean modul (unchecked checkbox tidak terkirim)
        $modulKeys = [
            'modul_publikasi_data',
            'modul_pengumuman',
            'modul_berita',
            'modul_struktur_organisasi',
            'modul_visi_misi',
        ];
        foreach ($modulKeys as $key) {
            SiteSetting::where('key', $key)->update([
                'value' => $request->has($key) ? '1' : '0'
            ]);
        }

        clear_settings_cache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
