<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\Weather;

class WeatherController extends Controller
{
    public function get_weather($lat, $long)
    {
        $return = Cache::get('weather_data');
        if(!$return) {
            $weather_data = Weather::get_weather($lat, $long);

            $return = array(
                'today' => $weather_data['today'],
                1 => $weather_data[1],
                2 => $weather_data[2],
                3 => $weather_data[3],
                4 => $weather_data[4],
                5 => $weather_data[5],
                6 => $weather_data[6],
            );

            Cache::put('weather_data', $return, 10);
        }

        return $return;
    }
}
