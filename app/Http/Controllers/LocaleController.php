<?php

namespace App\Http\Controllers;

use Cache;
use Config;
use App\Models\Locale;

class LocaleController extends Controller
{
    public function get_locale($lat, $long)
    {
        $cache_key = 'locale_data' . $lat . $long;
        $return = Cache::get($cache_key);

        if(!$return) {
            $locale_data = Locale::get_locale($lat, $long);

            $return = array(
                'city' => $locale_data['city'],
                'state' => $locale_data['state'],
            );

            Cache::put($cache_key, $return, Config::get('mirror.cache_time'));
        }

        return $return;
    }
}
