<?php

namespace Api\Components;

use Api\Model\City;

class TimeConverter
{
    public const TIME_HOUR = 3600;

    public function getLocalTime(City $city)
    {
        return strtotime(gmdate('r')) + $city->getOffset() * self::TIME_HOUR;
    }

    public function getUtcTime(City $city, string $localTime)
    {
        return $localTime - $city->getOffset() * self::TIME_HOUR;
    }
}
