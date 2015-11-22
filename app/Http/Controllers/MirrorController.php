<?php

namespace App\Http\Controllers;

use Cache;
use App\Http\Controllers\WeatherController;

class MirrorController extends Controller
{
    private $weather_controller;

    public function index()
    {
        $weather_controller = new WeatherController();
        $weather_data = $weather_controller->get_weather(33.9567, -83.3583); // Athens
        // $weather_data = $weather_controller->get_weather(34.0500, -118.2500); // LA
        // $weather_data = $weather_controller->get_weather(40.7142, -74.0064); // NY
        // $weather_data = $weather_controller->get_weather(51.5171, -0.1062); // London
        // $weather_data = $weather_controller->get_weather(-33.8683, 151.2086); // Sydney

        $locale = 'Athens, GA';
        $date = date('l, F d, Y');
        $time = date('g:i a');
        $weather = $weather_data;

        return view('mirror.main', [
            'date' => $date,
            'time' => $time,
            'locale' => $locale,
            'weather' => $weather
        ]);
    }

    public function flush_cache()
    {
        Cache::flush();
        header('Location: /');
        die();
    }
}
