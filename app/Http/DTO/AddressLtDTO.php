<?php

declare(strict_types=1);

namespace App\Http\DTO;

class AddressLtDTO
{
    private string $district;
    private ?string $municipality = null;
    private string $city;
    private ?string $village = null;
    private ?string $settlement = null;
    private string $street;
    private string $building;
    private ?string $flat = null;
    private string $postalCode;

    public function __construct(
        string $district,
        string $city,
        string $street,
        string $building,
        string $postalCode
    )
    {
        $this->district = $district;
        $this->city = $city;
        $this->street = $street;
        $this->building = $building;
        $this->postalCode = $postalCode;
    }

    public function combineAddress(): string
    {
        // Combine street, city, postal code, etc. into a formatted address
        return "$this->district, $this->city, $this->street, $this->building, LT-$this->postalCode";
    }
}
