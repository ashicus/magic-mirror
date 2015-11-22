<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\Weather;

class WeatherController extends Controller
{
    public function get_weather($lat, $long)
    {
        $cache_key = 'weather_data' . $lat . $long;
        $return = Cache::get($cache_key);

        if(!$return) {
            $weather_data = Weather::get_weather($lat, $long);

            $return = array(
                'today' => $weather_data['today'],
                0 => $weather_data[0],
                1 => $weather_data[1],
                2 => $weather_data[2],
                3 => $weather_data[3],
                4 => $weather_data[4],
            );

            Cache::put($cache_key, $return, 10);
        }

        return $return;
    }
}
