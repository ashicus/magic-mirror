@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="mirror-view-main">
        <div class="left">
            <div class="weather">
                <p class="locale">{{ $locale }}</p>
                <div class="today">
                    <div class="temp-conditions">
                        <div class="conditions">
                            <p class="icon wi {{ $weather['today']['icon'] }}"></p>
                            <p class="current-conditions">{{ $weather['today']['current_conditions'] }}</p>
                        </div>

                        <div class="temp">
                            <p class="current_temperature">{{ $weather['today']['current_temperature'] }}</p>
                            <p class="feels-like">Feels like {{ $weather['today']['current_feels_like'] }}°</p>
                        </div>
                    </div>

                    <div class="sunrise-sunset">
                        <p class="sunrise"><span class="wi wi-sunrise"></span>{{ $weather['today']['sunrise_time'] }}</p>
                        <p class="sunset"><span class="wi wi-sunset"></span>{{ $weather['today']['sunset_time'] }}</p>
                    </div>

                    <p class="summaries">{{ $weather['today']['hour_summary'] }} {{ $weather['today']['day_summary'] }}</p>
                </div>

                <ol class="week">
                    @for ($i = 0; $i < 5; $i++)
                        <li>
                            <p class="day">{{ $weather[$i]['day'] }}</p>
                            <p class="icon wi {{ $weather[$i]['icon'] }}"></p>
                            <p class="high">{{ $weather[$i]['high_temperature'] }}°</p>
                            <p class="low">{{ $weather[$i]['low_temperature'] }}°</p>
                        </li>
                    @endfor
                </ol>
            </div>
        </div>

        <div class="right">
            <div class="date-time">
                <p class="date">{{ $date }}</p>
                <p class="time">{{ $time }}</p>
            </div>
        </div>
    </div>
@endsection
