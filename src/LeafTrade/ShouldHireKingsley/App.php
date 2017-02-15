<?php
namespace LeafTrade\ShouldHireKingsley;

use Carbon\Carbon;
use Location\Coordinate;
use Location\Distance\Vincenty;

class App
{
    const METERS = 0.0006202; // mile

    /**
     * Remove non-alpha characters, split into array
     * and reverse the order
     *
     * @param  string  $string
     * @return array
     */
    public function splitAndReverseString($string)
    {
        $string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
        $words = explode(" ", $string);

        return array_reverse($words);
    }

    /**
     * Cast array of numbers into integer/double
     * and sort lowest to highest
     *
     * @param  array  $array
     * @return array
     */
    public function sortNumbericArray($array)
    {
        $numbers = [];

        foreach ($array as $value) {
            if (is_numeric($value) && floor($value) != $value) {
                $numbers[] = floatval($value);
            } else {
                $numbers[] = intval($value);
            }
        }

        sort($numbers);

        return $numbers;
    }

    /**
     * Get differences from one array to another array
     *
     * @param  array  $needles
     * @param  array  $haystack
     * @return array
     */
    public function getArrayDifferences($needles, $haystack)
    {
        return array_merge(array_diff($needles, $haystack));
    }

    /**
     * Calculate distance between two geo locations
     *
     * @param  array  $to
     * @param  array  $from
     * @return double
     */
    public function calculateDistance($to, $from)
    {
        $coordinate1 = new Coordinate($to['lat'], $to['lon']);
        $coordinate2 = new Coordinate($from['lat'], $from['lon']);

        $calculator = new Vincenty();

        return $calculator->getDistance($coordinate1, $coordinate2);
    }

    /**
     * Convert meters to miles
     *
     * @param  int  $meters
     * @param  integer  $decimals decimals of precision
     * @return string
     */
    public function convertMetersToMiles($meters, $decimals = 2)
    {
        $meters *= self::METERS;

        return number_format($meters, $decimals, '.', '');
    }

    /**
     * Calculate the human difference between two given
     * dates/times/timestamps
     *
     * @param  string  $time1
     * @param  string  $time2
     * @return string
     */
    public function calculateHumanTimeDiff($time1, $time2)
    {
        $time1 = Carbon::parse($time1);
        $time2 = Carbon::parse($time2);

        return $time2->diffForHumans($time1, true) . ' ago';
    }
}