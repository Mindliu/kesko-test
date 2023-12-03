<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryFeeConfiguration extends Model
{
    protected $table = 'delivery_fee_configuration';

    protected $fillable = [
        'dty_id',
        'dft_id',
        'atp_id',
        'aov_id',
        'total_product_weight_from',
        'total_product_weight_to',
        'order_total_amount_from',
        'order_total_amount_to',
        'delivery_fee'
    ];

    public $timestamps = false;
}
