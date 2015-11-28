<?php

namespace App\Http\Controllers;

use Cache;
use Config;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NewsController;

class MirrorController extends Controller
{
    private $latitude;
    private $longitude;

    public function index()
    {
        $this->latitude = isset($_GET['lat']) ? $_GET['lat'] : Config::get('mirror.latitude');
        $this->longitude = isset($_GET['long']) ? $_GET['long'] : Config::get('mirror.longitude');

        $locale_controller = new LocaleController();
        $locale_data = $locale_controller->get_locale($this->latitude, $this->longitude);

        $weather_controller = new WeatherController();
        $weather_data = $weather_controller->get_weather($this->latitude, $this->longitude); // Athens

        $calendar_controller = new CalendarController();
        $calendar_data = $calendar_controller->get_calendar(Config::get('mirror.ical_url'), 7);

        $news_controller = new NewsController();
        foreach(Config::get('mirror.news_sources') as $source) {
            $news_controller->add_source($source, 5);
        }
        $news_data = $news_controller->fetch_sources();

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
