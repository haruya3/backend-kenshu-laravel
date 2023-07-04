<?php

namespace App\Providers;

use App\Repositries\Posts\ImageRepository;
use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepository;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\Tags\TagRepository;
use App\Repositries\Tags\TagrepositoryInterface;
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

        $this->app->bind(
            ImageRepositoryInterface::class,
            ImageRepository::class
        );

        $this->app->bind(
            TagrepositoryInterface::class,
            TagRepository::class
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
