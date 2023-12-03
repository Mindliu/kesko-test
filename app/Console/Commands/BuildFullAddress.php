<?php

namespace App\Console\Commands;

use App\Http\Services\AddressService;
use Illuminate\Console\Command;

class BuildFullAddress extends Command
{
    protected $signature = 'app:build-full-address';

    protected $description = 'Command description';

    public function __construct(private readonly AddressService $addressService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $inputFields = [
            'district' => 'Vilniaus apskr.',
            'city' => 'Vilniaus m. sav',
            'street' => 'Jogailos g.',
            'building' => '1',
            'postalCode' => '91301',
        ];

        $this->info($this->addressService->buildAddress($inputFields));
    }
}
