<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class SettingHelper
{

    public static function get($key, $default = null)
    {
        return Cache::rememberForever('settings.' . $key, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set($key, $value)
    {
        $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forever('settings.' . $key, $value);
        return $setting;
    }

    public static function delete($key)
    {
        $setting = Setting::where('key', $key)->first();
        if ($setting) {
            $setting->delete();
            Cache::forget('settings.' . $key);
        }
    }

}
