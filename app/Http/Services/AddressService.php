<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\DTO\AddressLtDTO;
use App\Http\Repositories\AddressRepository;
use App\Models\Address;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AddressService
{
    public function __construct(
        private readonly AddressRepository $addressRepository
    )
    {
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function createAddress(array $data): Address
    {
        $validatedData = Validator::make($data, [
            'full_address' => 'required|string',
            'atp_id' => 'required|numeric',
        ])->validate();

        try {
            $address = $this->addressRepository->create($validatedData);
        } catch (Exception $exception) {
            Log::error('Failed to create an address', [
                'message' => $exception->getMessage(),
            ]);

            throw new Exception($exception->getMessage());
        }

        return $address;
    }

    /**
     * @throws Exception
     */
    public function updateAddress(Address $address, array $data): Address
    {
        try {
            $address = $this->addressRepository->update($address, $data);
        } catch (Exception $exception) {
            Log::error('Failed to update an address', [
                'message' => $exception->getMessage(),
            ]);

            throw new Exception($exception->getMessage());
        }

        return $address;
    }

    public function buildAddress(array $addressData): string
    {
        $address = new AddressLtDTO(
            $addressData['district'],
            $addressData['city'],
            $addressData['street'],
            $addressData['building'],
            $addressData['postalCode']
        );

        return $address->combineAddress();
    }
}
