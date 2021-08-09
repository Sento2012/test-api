<?php

namespace Api\Model;

class City implements \JsonSerializable
{
    public const FIELD_ID = 'id';
    public const FIELD_COUNTRY_ISO = 'country_iso3';
    public const FIELD_NAME = 'name';
    public const FIELD_LATITUDE = 'latitude';
    public const FIELD_LONGITUDE = 'longitude';
    public const FIELD_OFFSET = 'offset';

    private string $id;
    private string $iso;
    private string $name;
    private string $latitude;
    private string $longitude;
    private string $offset;

    public function __construct(array $params)
    {
        $this->id = $params[self::FIELD_ID];
        $this->name = $params[self::FIELD_NAME];
        $this->iso = $params[self::FIELD_COUNTRY_ISO];
        $this->latitude = $params[self::FIELD_LATITUDE];
        $this->longitude = $params[self::FIELD_LONGITUDE];
        $this->offset = $params[self::FIELD_OFFSET];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIso(): string
    {
        return $this->iso;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getOffset(): string
    {
        return $this->offset;
    }

    public function setOffset(string $offset): void
    {
        $this->offset = $offset;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_COUNTRY_ISO => $this->getIso(),
            self::FIELD_NAME => $this->getName(),
            self::FIELD_LONGITUDE => $this->getLongitude(),
            self::FIELD_LATITUDE => $this->getLatitude(),
            self::FIELD_OFFSET => $this->getOffset(),
        ];
    }
}
