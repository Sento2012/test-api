<?php

namespace Api\Repository;

use Api\Model\City;

class CityProvider extends BaseDatabase
{
    protected function getTable(): string
    {
        return 'city';
    }

    public function getCity(string $id): ?City
    {
        $city = $this->getOneByField($id, City::FIELD_ID);
        if ($city) {
            return new City($city);
        }

        return null;
    }

    public function getCities(): array
    {
        $cities = $this->getAll();

        return array_map(function ($city) {
            return new City(get_object_vars($city));
        }, $cities);
    }

    public function updateCity(City $city): bool
    {
        return $this->updateRecord($city->jsonSerialize());
    }
}