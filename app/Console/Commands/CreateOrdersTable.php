<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Command
{
    protected $signature = 'app:create-orders-table';

    protected $description = 'Command description';

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->createOrdersTable();
        $this->info($this->generateOrderNumber());
    }

    /**
     * @throws Exception
     */
    private function generateOrderNumber(): ?string
    {
        DB::beginTransaction();

        try {
            DB::table('orders')->lockForUpdate()->get();

            $latestOrder = DB::table('orders')->latest('id')->first();
            $newOrderNumber = $latestOrder ? $latestOrder->id + 1 : 1;

            DB::table('orders')->insert(['uuid' => 'ORD-' . $newOrderNumber]);
            DB::commit();

            return 'ORD-' . $newOrderNumber;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function createOrdersTable(): void
    {
        if (!Schema::hasTable('orders')) {
            // Create the 'orders' table
            DB::statement('
                CREATE TABLE orders (
                    id SERIAL PRIMARY KEY,
                    uuid VARCHAR(255) UNIQUE,
                    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
                    updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
                )
            ');
        }

        // Check if the 'orders_id_seq' sequence does not exist before creating it
        if (!DB::select("SELECT to_regclass('orders_id_seq') as sequence_exist")[0]->sequence_exist) {
            // Create the sequence
            DB::statement('CREATE SEQUENCE orders_id_seq');
        }

        // Set the default value for 'id' using the sequence
        DB::statement('ALTER TABLE orders ALTER COLUMN id SET DEFAULT nextval(\'orders_id_seq\')');

    }
}
