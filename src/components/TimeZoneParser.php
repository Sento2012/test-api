<?php

namespace Api\Components;

use Api\Model\City;

class TimeZoneParser
{
    private const API_URL = 'https://api.timezonedb.com/v2.1/get-time-zone';

    public function getTimeZone(City $city): ?int
    {
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, self::API_URL . http_build_query($this->getQueryParams($city)));
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $phoneList = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $jsonArrayResponse = json_decode($phoneList, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $jsonArrayResponse['gmtOffset'] ?? null;
    }

    private function getQueryParams(City $city): array
    {
        return [
            'key' => \ConfigManager::getTimezoneApiKey(),
            'format' => 'json',
            'by' => 'position',
            'lat' => $city->getLatitude(),
            'lng' => $city->getLongitude(),
        ];
    }
}