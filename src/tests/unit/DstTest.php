<?php

require_once 'model/City.php';
require_once 'components/TimeConverter.php';

use Api\Components\TimeConverter;
use Api\Model\City;

class DstTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $city = new City([
            City::FIELD_ID => md5(time()),
            City::FIELD_NAME => 'test',
            City::FIELD_COUNTRY_ISO => 'AZ',
            City::FIELD_LONGITUDE => 33.5,
            City::FIELD_LATITUDE => 54.1,
            City::FIELD_OFFSET => 3,
        ]);
        $timeConverter = new TimeConverter();
        $assertTime = strtotime(gmdate('r')) + $city->getOffset() * TimeConverter::TIME_HOUR;
        $this->assertEquals($timeConverter->getLocalTime($city), $assertTime);
        $localTime = time();
        $assertGmtTime = $localTime - $city->getOffset() * TimeConverter::TIME_HOUR;;
        $this->assertEquals($timeConverter->getUtcTime($city, $localTime), $assertGmtTime);
    }
}