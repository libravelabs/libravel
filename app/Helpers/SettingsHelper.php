<?php

namespace App\Helpers;

use App\Models\PageSettings;
use App\Models\SiteInfo;

class SettingsHelper
{
    public static function getSetting($key, $default = null)
    {
        $setting = PageSettings::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function getInfos($key = null, $default = null)
    {
        $info = cache()->remember('site_info', now()->addMinutes(10), function () {
            return SiteInfo::where('is_default', true)->first() ?? SiteInfo::first();
        });

        if (!$info) {
            return $default;
        }

        if (!$key) {
            return $info->toArray();
        }

        if ($key === 'logo') {
            return $info->getFirstMediaUrl('logo') ?: asset('assets/libravel-logo.png');
        }

        if ($key === 'favicon') {
            return $info->getFirstMediaUrl('favicon') ?: null;
        }

        return $info->{$key} ?? $default;
    }
}
