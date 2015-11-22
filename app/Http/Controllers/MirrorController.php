<?php

namespace App\Http\Controllers;

use Cache;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\NewsController;

class MirrorController extends Controller
{
    private $weather_controller;
    private $news_controller;

    public function index()
    {
        $weather_controller = new WeatherController();
        $weather_data = $weather_controller->get_weather(33.9567, -83.3583); // Athens
        // $weather_data = $weather_controller->get_weather(34.0500, -118.2500); // LA
        // $weather_data = $weather_controller->get_weather(40.7142, -74.0064); // NY
        // $weather_data = $weather_controller->get_weather(51.5171, -0.1062); // London
        // $weather_data = $weather_controller->get_weather(-33.8683, 151.2086); // Sydney

        $news_controller = new NewsController();
        $news_controller->add_source('http://news.google.com/news?cf=all&hl=en&pz=1&ned=us&topic=tc&output=rss', 5);
        $news_controller->add_source('http://feeds.bbci.co.uk/news/rss.xml?edition=us', 5);
        $news_data = $news_controller->fetch_sources();
        // print_r($news_data); die();

        $locale = 'Athens, GA';
        $date = date('l, F d, Y');
        $time = date('g:i a');
        $weather = $weather_data;
        $news = $news_data;

        return view('mirror.main', [
            'date' => $date,
            'time' => $time,
            'locale' => $locale,
            'weather' => $weather,
            'news' => $news
        ]);
    }

    public function flush_cache()
    {
        Cache::flush();
        header('Location: /');
        die();
    }
}
