<?php

namespace App\Console\Commands;

use App\Http\Services\AddressService;
use Illuminate\Console\Command;

class CreateOrUpdateAddress extends Command
{
    protected $signature = 'app:create-or-update-address';

    protected $description = 'Command description';

    public function __construct(private readonly AddressService $addressService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $newAddress = $this->addressService->createAddress([
                'full_address' => 'Test address',
                'atp_id' => 1,
            ]);

            $this->info('Address created');

            $this->addressService->updateAddress($newAddress, [
                'full_address' => 'Test address Updated',
            ]);

            $this->info('Address Updated');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
