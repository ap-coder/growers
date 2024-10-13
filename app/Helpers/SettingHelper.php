<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class SettingHelper
{
    // Fetch the setting value or return the default
    public static function get($key, $default = null)
    {
        // Fetch the cached settings or an empty array if cache is not available
        $settings = Cache::get('settings', []);

        // If settings are not cached, reload them from the database
        if (empty($settings)) {
            // Optional: Load settings from the database and cache them
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
            Cache::forever('settings', $settings); // Cache the settings
        }

        // Check if the requested key exists in the settings array
        if (!isset($settings[$key])) {
            // Log a warning if the requested setting is not found
            \Log::warning("Setting key '{$key}' was requested but does not exist.");
        }

        // Return the setting value if it exists, otherwise return the default value
        return $settings[$key] ?? $default;
    }


    // Set a new setting value and update the cache
    public static function set($key, $value)
    {
        $settings = Cache::get('settings', []);
        $settings[$key] = $value;
        Cache::forever('settings', $settings);

        // Optionally update the database as well
        \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);

        return $value;
    }

    // Delete a setting and update the cache
    public static function delete($key)
    {
        $settings = Cache::get('settings', []);
        unset($settings[$key]);
        Cache::forever('settings', $settings);

        // Optionally delete from the database as well
        \App\Models\Setting::where('key', $key)->delete();
    }
}
