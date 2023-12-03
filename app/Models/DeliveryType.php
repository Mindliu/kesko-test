<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $table = 'delivery_types';

    protected $fillable = [
        'code',
        'name',
        'type',
        'default_atp_id'
    ];

    public $timestamps = false;
}
