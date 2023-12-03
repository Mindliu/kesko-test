<?php

namespace App\Console\Commands;

use App\Http\Enums\AddressTypeEnum;
use App\Http\Enums\DeliveryTypeEnum;
use App\Http\Repositories\DeliveryFeeConfigurationRepository;
use App\Http\Services\DeliveryFeeService;
use Exception;
use Illuminate\Console\Command;

class CreateCustomDeliveryFeeConfiguration extends Command
{
    protected $signature = 'app:create-custom-delivery-fee-configuration';

    protected $description = 'Command description';

    public function __construct(
        private readonly DeliveryFeeService $deliveryFeeService,
        private readonly DeliveryFeeConfigurationRepository $deliveryFeeConfigurationRepository,
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $deliveryFeeConfiguration1 = $this->deliveryFeeConfigurationRepository->create([
                'dty_id' => DeliveryTypeEnum::DELIVERY_TYPE_DPD,
                'dft_id' => 1,
                'atp_id' => AddressTypeEnum::ADDRESS_TYPE_MAPPING[AddressTypeEnum::ADDRESS_TYPE_LT],
                'aov_id' => null,
                'total_product_weight_from' => NULL,
                'total_product_weight_to' => 10,
                'order_total_amount_from' => null,
                'order_total_amount_to' => null,
                'delivery_fee' => 10.0,
            ]);

            $this->info($deliveryFeeConfiguration1);

            $deliveryFeeConfiguration2 =$this->deliveryFeeConfigurationRepository->create([
                'dty_id' => DeliveryTypeEnum::DELIVERY_TYPE_DPD,
                'dft_id' => 1,
                'atp_id' => AddressTypeEnum::ADDRESS_TYPE_MAPPING[AddressTypeEnum::ADDRESS_TYPE_LT],
                'aov_id' => null,
                'total_product_weight_from' => 10,
                'total_product_weight_to' => null,
                'order_total_amount_from' => null,
                'order_total_amount_to' => null,
                'delivery_fee' => 20.0,
            ]);

            $this->info($deliveryFeeConfiguration2);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }

    }
}
