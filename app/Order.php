<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 */
class Order extends Model
{
    protected $fillable = [
        'order_id',
        'total',
        'shipping_total',
        'timezone',
        'created_at'
    ];
}
