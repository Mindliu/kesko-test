<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    private string $tableName;
    public function __construct()
    {
        $this->tableName = (new Contact())->getTable();
    }

    public function update(Contact $address, array $data): Contact
    {
        return tap($address)->update(array_merge($data, [
            'id' => $this->getNextStatementId($this->tableName),
        ]));
    }
}
