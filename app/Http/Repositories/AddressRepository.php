<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\Address;

class AddressRepository extends BaseRepository
{
    private string $tableName;
    public function __construct()
    {
        $this->tableName = (new Address())->getTable();
    }

    public function create(array $data): Address
    {
        return Address::create(array_merge($data, [
            'id' => $this->getNextStatementId($this->tableName),
        ]));
    }

    public function update(Address $address, array $data): Address
    {
        return tap($address)->update(array_merge($data, [
            'id' => $this->getNextStatementId($this->tableName),
        ]));
    }
}
