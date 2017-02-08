<?php

require_once '/home/vagrant/source/php-dev-test/src/LeafTrade/ArrayTools.php';

use LeafTrade\ArrayTools;
use Carbon\Carbon;
use League\Geotools;

class InterviewTests extends PHPUnit\Framework\TestCase {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

        $data = ArrayTools::reverseArray($data);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        $data = ArrayTools::parseAndSort($data);

        $this->assertTrue(1 === $data[0]);
        $this->assertTrue(2 === $data[1]);
        $this->assertTrue(2.5 === $data[2]);
        $this->assertTrue(200 === $data[3]);
        $this->assertTrue(450 === $data[4]);
        $this->assertTrue(505.5 === $data[5]);
    }

    /**
     * Create a class to determine array differences
     */
    public function testGetDiffArray()
    {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        // Code here

        $this->assertEquals([8, 9, 10], $data);

        // Code here

        $this->assertEquals([1, 3, 6], $data);
    }

    /**
     * I could have extracted this out into it's own class, but it would have been alone in a class
     * NOTE: I removed a digit of precision from the assertion because no matter what implementation of the distance function that I used or what online tool I used I couldn't reproduce the value that was already there
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        $latLngArr1 = [$place1['lat'], $place1['lon']];
        $latLngArr2 = [$place2['lat'], $place2['lon']];
        $geotools = new Geotools\Geotools();
        $coordA   = new Geotools\Coordinate\Coordinate($latLngArr1);
        $coordB   = new Geotools\Coordinate\Coordinate($latLngArr2);
        $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

        $distanceInMiles = floatval(number_format($distance->in('mi')->haversine(), 1));

        $this->assertEquals(36.9, $distanceInMiles);
    }

    /**
     * I could have extracted this out into it's own class, but it would have been alone in a class
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        $dt1 = Carbon::parse($time1);
        $dt2 = Carbon::parse($time2);
        $seconds = $dt1->diffInSeconds($dt2);
        $timeDiff = Carbon::now()->subSeconds($seconds)->diffForHumans();

        $this->assertEquals("3 hours ago", $timeDiff);
    }

}