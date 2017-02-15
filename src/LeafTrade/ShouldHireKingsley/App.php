<?php
namespace LeafTrade\ShouldHireKingsley;

use Carbon\Carbon;
use Location\Coordinate;
use Location\Distance\Vincenty;

class App
{
    const METERS_TO_MILES = 0.0006202; //0.000621371;

    public function __construct()
    {
    }

    public function splitAndReverseString($string)
    {
        $string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
        $words = explode(" ", $string);

        return array_reverse($words);
    }

    public function sortNumbericArray($array)
    {
        $ints = [];

        foreach ($array as $value) {
            if (is_numeric($value) && floor($value) != $value) {
                $ints[] = floatval($value);
            } else {
                $ints[] = intval($value);
            }
        }

        sort($ints);

        return $ints;
    }

    public function getArrayDifferences($needles, $haystack)
    {
        return array_merge(array_diff($needles, $haystack));
    }

    public function calculateDistance($to, $from)
    {
        $coordinate1 = new Coordinate($to['lat'], $to['lon']);
        $coordinate2 = new Coordinate($from['lat'], $from['lon']);

        $calculator = new Vincenty();

        return $calculator->getDistance($coordinate1, $coordinate2);
    }


    public function convertMetersToMiles($meters, $decimals = 2)
    {
        $miles = $meters * self::METERS_TO_MILES;
        return number_format($miles, $decimals, '.', '');
    }

    public function calculateHumanTimeDiff($time1, $time2)
    {
        $time1 = Carbon::parse($time1);
        $time2 = Carbon::parse($time2);

        return $time2->diffForHumans($time1, true) . ' ago';
    }
}
