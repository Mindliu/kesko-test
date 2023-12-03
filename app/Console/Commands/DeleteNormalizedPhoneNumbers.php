<?php

namespace App\Console\Commands;

use App\Http\Services\ContactService;
use Exception;
use Illuminate\Console\Command;

class DeleteNormalizedPhoneNumbers extends Command
{
    protected $signature = 'app:delete-normalized-phone-numbers';

    protected $description = 'Command description';

    public function __construct(
        protected ContactService $contactService
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $this->contactService->deleteDuplicates();
            $this->info('Success');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
