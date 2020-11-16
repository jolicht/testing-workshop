<?php

declare(strict_types=1);

namespace App;

class Address
{
    private ?string $countryCode;


    private ?string $zipCode;

    private ?string $city;

    public function __construct(
        ?string $countryCode,
        ?string $zipCode,
        ?string $city
    ) {
        $this->countryCode = $countryCode;
        $this->zipCode     = $zipCode;
        $this->city        = $city;
    }


    public static function create(
        ?string $countryCode,
        ?string $zipCode,
        ?string $city
    ) {
        return new self($countryCode, $zipCode, $city);
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
}