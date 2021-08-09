<?php

namespace Api\Components;

use Api\Repository\CityProvider;

class DstManager
{
    private TimeConverter $timeConverter;
    private CityProvider $cityProvider;

    public function __construct(
        TimeConverter $timeConverter,
        CityProvider $cityProvider
    ) {
        $this->timeConverter = $timeConverter;
        $this->cityProvider = $cityProvider;
    }

    public function getLocalTime(string $id): ?string
    {
        $city = $this->cityProvider->getCity($id);
        if (!$city) {
            return null;
        }

        return $this->timeConverter->getLocalTime($city);
    }

    public function getUtcTime(string $id, string $localTime): ?string
    {
        $city = $this->cityProvider->getCity($id);
        if (!$city) {
            return null;
        }

        return $this->timeConverter->getUtcTime($city, $localTime);
    }
}