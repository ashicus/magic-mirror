@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="mirror-view-main">
        <p class="locale">{{ $locale }}</p>
        <p class="date">{{ $date }}</p>
        <p class="time">{{ $time }}</p>

        <div class="weather">
            <div class="today">
                <div class="temp-conditions">
                    <p class="conditions">
                        <span class="icon wi {{ $weather['today']['icon'] }}"></span>
                        <span class="current-conditions">{{ $weather['today']['current_conditions'] }}</span>
                    </p>

                    <div class="temp">
                        <h2 class="current_temperature">{{ $weather['today']['current_temperature'] }}°</h2>

                        @if ($weather['today']['current_temperature'] != $weather['today']['current_feels_like'])
                            <small>feels like {{ $weather['today']['current_feels_like'] }}°</small>
                        @endif
                    </div>
                </div>
                <p class="hour">{{ $weather['today']['hour_summary'] }}</p>
                <p class="day">{{ $weather['today']['day_summary'] }}</p>
                <p class="sunrise"><span class="wi wi-sunrise"></span>{{ $weather['today']['sunrise_time'] }}</p>
                <p class="sunset"><span class="wi wi-sunset"></span>{{ $weather['today']['sunset_time'] }}</p>
                <p class="high">{{ $weather['today']['high_temperature'] }}°</p>
                <p class="low">{{ $weather['today']['low_temperature'] }}°</p>
            </div>

            <ol class="week">
                @for ($i = 1; $i < 7; $i++)
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
@endsection
