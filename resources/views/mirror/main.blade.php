@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="mirror-view-main">
        <div class="left">
            <div class="weather">
                <p class="locale">{{ $locale['city'] }}, {{ $locale['state'] }}</p>
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
                            @if ($i == 0)
                                <p class="day">Today</p>
                            @else
                                <p class="day">{{ $weather[$i]['day'] }}</p>
                            @endif
                            <p class="icon wi {{ $weather[$i]['icon'] }}"></p>
                            <p class="high">{{ $weather[$i]['high_temperature'] }}°</p>
                            <p class="low">{{ $weather[$i]['low_temperature'] }}°</p>
                        </li>
                    @endfor
                </ol>
            </div>

            <div class="calendar">
                <p class="title">Calendar: {{ $calendar['name'] }}</p>
                <ol>
                    {{ $cur_date = null }}
                    @foreach ($calendar['events'] as $event)
                        @if ($event['start_date'] != $cur_date)
                            <?php $cur_date = $event['start_date']; ?>
                            <h2>{{ $cur_date }}</h2>
                        @endif

                        <li class="{{ $event['all_day'] ? 'all_day' : '' }}">
                            @if ($event['all_day'])
                                {{ $event['summary'] }}
                            @else
                                {{ $event['start_time'] }} - {{ $event['summary'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        <div class="right">
            <div class="date-time">
                <p class="date">{{ $date }}</p>
                <p class="time">{!! $time !!}</p>
            </div>
        </div>

        <div class="news">
            <ul class="channels">
            @foreach ($news as $channel)
                <li class="channel">
                    <p class="title">
                        {{-- <img src="{{ $channel['channel_image'] }}" /> --}}
                        {{ $channel['channel_title'] }}
                    </p>

                    <ul class="articles">
                        @foreach ($channel['items'] as $item)
                            <li><a href="{{ $item['link'] }}" target="_blank">{{ $item['time'] }} - {{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection
