<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

/**
 * Class GuzzleServiceProvider
 * @package App\Services
 */
class GuzzleServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(Client::class, function () {
            return new Client(['base_uri' => env('API_URL')]);
        });
    }
}
