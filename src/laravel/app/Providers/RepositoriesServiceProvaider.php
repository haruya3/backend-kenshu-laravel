<?php

namespace App\Providers;

use App\Repositries\Posts\PostRepository;
use App\Repositries\Posts\PostRepositoryInterface;
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
            UserRepository::class
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
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
