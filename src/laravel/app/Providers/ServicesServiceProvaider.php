<?php

namespace App\Providers;

use App\Repositries\UserRepoInterface;
use App\Services\CreateNewUserService;
use App\Services\CreateNewUserServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvaider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CreateNewUserServiceInterface::class,
            function ($app) {
                return new CreateNewUserService(
                    $app->make(UserRepoInterface::class)
                );
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
