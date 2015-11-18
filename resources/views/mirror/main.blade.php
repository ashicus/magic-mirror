@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="mirror-view">
        <h1 class="locale">{{ $locale }}</h1>
        <h1 class="date">{{ $date }}</h1>
        <h2 class="time">{{ $time }}</h2>
        <h2 class="current_temperature">{{ $current_temperature }}</h2>
    </div>
@endsection
