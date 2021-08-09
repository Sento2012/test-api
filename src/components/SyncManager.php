<?php

namespace Api\Components;

use Api\Repository\CityProvider;

class SyncManager
{
    private CityProvider $cityProvider;
    private TimeZoneParser $timeZoneParser;

    public function __construct(
        CityProvider $cityProvider,
        TimeZoneParser $timeZoneParser
    ) {
        $this->cityProvider = $cityProvider;
        $this->timeZoneParser = $timeZoneParser;
    }

    public function sync(): void
    {
        $cities = $this->cityProvider->getCities();
        foreach ($cities as $city) {
            $timeZone = $this->timeZoneParser->getTimeZone($city);
            if (!$timeZone) {
                continue;
            }
            $city->setOffset($timeZone);
            $this->cityProvider->updateCity($city);
        }
    }
}