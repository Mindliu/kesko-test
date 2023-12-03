<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Enums\DeliveryFeeWeekdaysEnum;
use App\Http\Repositories\DeliveryFeeConfigurationRepository;
use App\Models\DeliveryFeeConfiguration;
use Exception;
use Illuminate\Support\Facades\Log;

class DeliveryFeeService
{
    public function __construct(
        protected DeliveryFeeConfiguration $deliveryFeeConfiguration,
        protected DeliveryFeeConfigurationRepository $deliveryFeeConfigurationRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function updateDeliveryFeeConfiguration(
        DeliveryFeeConfiguration $deliveryFeeConfiguration,
        array $data
    ): DeliveryFeeConfiguration
    {
        try {
            $address = $this->deliveryFeeConfigurationRepository->update($deliveryFeeConfiguration, $data);
        } catch (Exception $exception) {
            Log::error('Failed to update an address', [
                'message' => $exception->getMessage(),
            ]);

            throw new Exception($exception->getMessage());
        }

        return $address;
    }

    public function additionalDeliveryFeeByWeekday(int $weekDay = null): int
    {
        return DeliveryFeeWeekdaysEnum::WEEKDAY_MAPPING[$weekDay ?? now()->weekday()];
    }
}
