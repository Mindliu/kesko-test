<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\DeliveryFeeConfiguration;
use App\Models\DeliveryType;

class DeliveryTypeRepository extends BaseRepository
{
    private string $tableName;
    public function __construct()
    {
        $this->tableName = (new DeliveryType())->getTable();
    }

    public function find(array $attributes): ?DeliveryType
    {
        $query = DeliveryType::query();

        foreach ($attributes as $key => $value) {
            $query->where($key, $value);
        }

        /** @var DeliveryType|null $result */
        $result = $query->latest('id')->first();

        return $result;
    }
}
