<?php

namespace App\Providers;

use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\User\UserRepoInterface;
use App\Services\Posts\GetListAndFormServiceInterface;
use App\Services\Posts\GetListAndFormService;
use App\Services\User\CreateNewUserService;
use App\Services\User\CreateNewUserServiceInterface;
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
                    $app->make(UserRepoInterface::class),
                );
            });

        $this->app->bind(GetListAndFormServiceInterface::class,
            function ($app){
                return new GetListAndFormService(
                    $app->make(UserRepoInterface::class),
                    $app->make(PostRepositoryInterface::class),
                );
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
