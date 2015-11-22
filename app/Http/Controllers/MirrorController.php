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
        $weather_data = $weather_controller->get_weather(33.9567, -83.3583);
        // $weather_data = $weather_controller->get_weather(34.0500, -118.2500);

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
