<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\DeliveryFeeConfiguration;

class DeliveryFeeConfigurationRepository extends BaseRepository
{
    private string $tableName;
    public function __construct()
    {
        $this->tableName = (new DeliveryFeeConfiguration())->getTable();
    }

    public function findBy(array $attributes): ?DeliveryFeeConfiguration
    {
        $query = DeliveryFeeConfiguration::query();

        foreach ($attributes as $key => $value) {
            $query->where($key, $value);
        }

        /** @var DeliveryFeeConfiguration|null $result */
        $result = $query->latest('id')->first();

        return $result;
    }

    public function create(array $data): DeliveryFeeConfiguration
    {
        return DeliveryFeeConfiguration::create(array_merge($data, [
            'id' => $this->getNextStatementId($this->tableName),
        ]));
    }

    public function update(DeliveryFeeConfiguration $deliveryFeeConfiguration, array $data): DeliveryFeeConfiguration
    {
        return tap($deliveryFeeConfiguration)->update(array_merge($data, [
            'id' => $this->getNextStatementId($this->tableName),
        ]));
    }
}
