<?php

namespace App\Console\Commands;

use App\Http\Repositories\DeliveryFeeConfigurationRepository;
use App\Http\Services\DeliveryFeeService;
use Illuminate\Console\Command;

class ChangeDeliveryFeeOnSaturdays extends Command
{
    protected $signature = 'app:change-delivery-fee-on-saturdays';

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
        $deliveryPrice = $this->deliveryFeeConfigurationRepository->findBy([
            'id' => 2,
        ])?->delivery_fee;

       $additionalPrice = $this->deliveryFeeService->additionalDeliveryFeeByWeekday(6);

       $totalPrice = $deliveryPrice + $additionalPrice;

       $this->info($totalPrice);
    }
}
