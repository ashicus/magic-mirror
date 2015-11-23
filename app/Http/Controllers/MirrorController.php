<?php

namespace App\Http\Controllers;

use Cache;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NewsController;

class MirrorController extends Controller
{
    private $latitude = 33.9567;
    private $longitude = -83.3583;

    public function index()
    {
        $locale_controller = new LocaleController();
        $locale_data = $locale_controller->get_locale($this->latitude, $this->longitude);

        $weather_controller = new WeatherController();
        $weather_data = $weather_controller->get_weather($this->latitude, $this->longitude); // Athens
        // $weather_data = $weather_controller->get_weather(34.0500, -118.2500); // LA
        // $weather_data = $weather_controller->get_weather(40.7142, -74.0064); // NY
        // $weather_data = $weather_controller->get_weather(51.5171, -0.1062); // London
        // $weather_data = $weather_controller->get_weather(-33.8683, 151.2086); // Sydney

        $calendar_controller = new CalendarController();
        $calendar_data = $calendar_controller->get_calendar('https://theadsmith.basecamphq.com/feed/project_ical?token=8727c1a78f3e1f7c68abec8a7ef518a9&project_id=1331340', 7);
        // print_r($calendar_data); die();

        $news_controller = new NewsController();
        $news_controller->add_source('http://news.google.com/news?cf=all&hl=en&pz=1&ned=us&topic=tc&output=rss', 5);
        $news_controller->add_source('http://news.google.com/news?cf=all&hl=en&pz=1&ned=us&topic=w&output=rss', 5);
        $news_controller->add_source('http://onlineathens.com/taxonomy/term/4691/2/feed', 5);
        $news_data = $news_controller->fetch_sources();
        // print_r($news_data); die();

        $locale = $locale_data;
        $date = date('l, F d, Y');
        $time = date('g:i a');
        $weather = $weather_data;
        $calendar = $calendar_data;
        $news = $news_data;

        return view('mirror.main', [
            'date' => $date,
            'time' => $time,
            'locale' => $locale,
            'weather' => $weather,
            'calendar' => $calendar,
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
