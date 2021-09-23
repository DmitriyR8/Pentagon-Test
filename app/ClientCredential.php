<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientCredential
 * @package App
 */
class ClientCredential extends Model
{
    protected $fillable = [
        'token_type',
        'expires_in',
        'access_token',
        'changePassword',
        'sellerId'
    ];
}
