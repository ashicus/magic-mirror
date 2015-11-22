<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    private static $API_URL = 'https://api.forecast.io/forecast/b33246746f8ac703298fee7028f03abb/';

    private static $icon_map = array(
        'clear-day' => 'wi-day-sunny',
        'clear-night' => 'wi-night-clear',
        'rain' => 'wi-rain',
        'snow' => 'wi-snow',
        'sleet' => 'wi-sleet',
        'wind' => 'wi-strong-wind',
        'fog' => 'wi-fog',
        'cloudy' => 'wi-cloudy',
        'partly-cloudy-day' => 'wi-day-sunny-overcast',
        'partly-cloudy-night' => 'wi-night-alt-partly-cloudy'
    );

    public static function get_weather($lat, $long)
    {
        $json = json_decode(file_get_contents(self::$API_URL . $lat . ',' . $long), TRUE);

        $weather_data = array(
            'today' => array(
                'icon' => self::_map_icon($json['currently']['icon']),
                'current_temperature' => round($json['currently']['temperature']),
                'current_feels_like' => round($json['currently']['apparentTemperature']),
                'current_conditions' => $json['currently']['summary'],
                'hour_summary' => $json['hourly']['summary'],
                'day_summary' => $json['daily']['summary'],
                'sunrise_time' => date('h:i a', $json['daily']['data'][0]['sunriseTime']),
                'sunset_time' => date('h:i a', $json['daily']['data'][0]['sunsetTime']),
                'low_temperature' => round($json['daily']['data'][0]['temperatureMin']),
                'high_temperature' => round($json['daily']['data'][0]['temperatureMax'])
            ),
        );

        for($i = 0; $i < 5; $i++) {
            $weather_data[$i] = array(
                'day' => date('l', $json['daily']['data'][$i]['time']),
                'icon' => self::_map_icon($json['daily']['data'][$i]['icon']),
                'sunrise_time' => date('h:i a', $json['daily']['data'][$i]['sunriseTime']),
                'sunset_time' => date('h:i a', $json['daily']['data'][$i]['sunsetTime']),
                'low_temperature' => round($json['daily']['data'][$i]['temperatureMin']),
                'high_temperature' => round($json['daily']['data'][$i]['temperatureMax'])
            );
        }

        return $weather_data;
    }

    private static function _map_icon($icon)
    {
        return self::$icon_map[$icon];
    }
}
