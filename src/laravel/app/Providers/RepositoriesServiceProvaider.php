<?php

namespace App\Providers;

use App\Repositries\User\UserRepoInterface;
use App\Repositries\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvaider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepoInterface::class,
            UserRepository::class,
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
