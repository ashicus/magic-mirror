<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\ICal;

class CalendarController extends Controller
{
    public function get_calendar($url, $limit)
    {
        $cache_key = 'calendar_data' . $url . $limit;
        $return = Cache::get($cache_key);

        if(!$return) {
            $ical = new ICal($url);
            $events = $ical->events();
            $events = $ical->sortEventsWithOrder($events);

            $return = array(
                'name' => $ical->calendarName(),
                'events' => array()
            );

            foreach ($events as $event) {
                $start = strtotime($event['DTSTART']);

                if($start >= time() && count($return['events']) < $limit) {
                    $end = strtotime($event['DTEND']);
                    $summary = @ucwords($event['SUMMARY']);
                    $all_day = date('g:i a', $start) == '12:00 am' ? true : false;

                    $return['events'][] = array(
                        'start' => date('M d, g:i a', $start),
                        'start_date' => date('M d', $start),
                        'start_time' => date('g:i a', $start),
                        'end' => date('M d, g:i a', $end),
                        'all_day' => $all_day,
                        'summary' => $summary,
                    );
                }
            }

            Cache::put($cache_key, $return, 10);
        }

        return $return;
    }
}
