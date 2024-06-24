<?php

namespace App\Helpers;

use App\Models\Localization;

class LocalizationHelper
{
    public static function get($key, $default = null)
    {
        $localization = Localization::where('key', $key)->first();
        return $localization ? $localization->translations : $default;
    }
}
