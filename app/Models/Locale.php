<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    private static $API_URL = 'http://geocoder.ca/?reverse=1&allna=1&geoit=xml&corner=1';

    public static function get_locale($lat, $long)
    {
        $xml = simplexml_load_string(file_get_contents(self::$API_URL . '&latt='.$lat.'&longt='.$long));

        $locale_data = array(
            'city' => $xml->city->__toString(),
            'state' => $xml->prov->__toString(),
        );

        return $locale_data;
    }
}
