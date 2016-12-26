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
    private $latitude, $longitude;
    private $local_controller, $weather_controller, $calendar_controller, $news_controller;

    public function index()
    {
        $this->latitude = isset($_GET['lat']) ? $_GET['lat'] : Config::get('mirror.latitude');
        $this->longitude = isset($_GET['long']) ? $_GET['long'] : Config::get('mirror.longitude');

        $this->locale_controller = new LocaleController();
        $this->weather_controller = new WeatherController();
        $this->calendar_controller = new CalendarController();
        $this->news_controller = new NewsController();

        $locale_data = $this->locale_controller->get_locale($this->latitude, $this->longitude);
        $weather_data = $this->weather_controller->get_weather($this->latitude, $this->longitude); // Athens
        $calendar_data = $this->calendar_controller->get_calendar(Config::get('mirror.ical_url'), 7);
        foreach(Config::get('mirror.news_sources') as $source) {
            $this->news_controller->add_source($source, 5);
        }
        $news_data = $this->news_controller->fetch_sources();
        // var_dump($news_data);

        return view('mirror.main', [
            'date' => date('l, F d, Y'),
            'time' => date('g') . '<span>:</span>' . date('i a'),
            'locale' => $locale_data,
            'weather' => $weather_data,
            'calendar' => $calendar_data,
            'news' => $news_data
        ]);
    }

    public function flush_cache()
    {
        Cache::flush();
        header('Location: /');
        die();
    }
}
