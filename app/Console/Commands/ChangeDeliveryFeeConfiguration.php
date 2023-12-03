<?php

namespace App\Console\Commands;

use App\Http\Repositories\DeliveryFeeConfigurationRepository;
use App\Http\Repositories\DeliveryTypeRepository;
use App\Http\Services\DeliveryFeeService;
use Exception;
use Illuminate\Console\Command;

class ChangeDeliveryFeeConfiguration extends Command
{
    protected $signature = 'app:change-delivery-fee-configuration';

    protected $description = 'Command description';

    public function __construct(
        private readonly DeliveryFeeService $deliveryFeeService,
        private readonly DeliveryFeeConfigurationRepository $deliveryFeeConfigurationRepository,
        private readonly DeliveryTypeRepository $deliveryTypeRepository
    )
    {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $deliveryType = $this->deliveryTypeRepository->find([
            'code' => 'DPD',
        ]);

        $deliveryFeeConfiguration = $this->deliveryFeeConfigurationRepository->findBy([
            'dty_id' => $deliveryType->id,
        ]);

        $newFee = (float) ($deliveryFeeConfiguration->delivery_fee ?? 0) - 5.0;
        $newFee = max($newFee, 0);

        $this->deliveryFeeService->updateDeliveryFeeConfiguration($deliveryFeeConfiguration, [
            'delivery_fee' => $newFee,
        ]);

    }
}
