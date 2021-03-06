<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    protected $fillable = [
        'SKU',
        'title'
    ];
}
