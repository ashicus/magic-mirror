<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MirrorController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function index()
    {
        return view('mirror.main', [
            'date' => 'Monday, November 17, 2015',
            'time' => '10:00 pm',
            'locale' => 'Athens, GA',
            'current_temperature' => '72°'
        ]);
    }
}
