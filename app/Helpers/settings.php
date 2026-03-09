<?php

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('setting_bool')) {
    function setting_bool(string $key): bool
    {
        return (bool) setting($key, false);
    }
}

if (!function_exists('clear_settings_cache')) {
    function clear_settings_cache(): void
    {
        Cache::forget('site_settings');
    }
}
