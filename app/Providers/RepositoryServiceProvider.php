<?php

namespace App\Providers;

use App\Repositories\Contracts\OauthRepositoryInterface;
use App\Repositories\RestApi\OauthRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(OauthRepositoryInterface::class, OauthRepository::class);
    }
}
