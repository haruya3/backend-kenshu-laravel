<?php

namespace App\Providers;

use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\Posts\PostTagRepositoryInterface;
use App\Repositries\Tags\TagrepositoryInterface;
use App\Repositries\User\UserRepositoryInterface;
use App\Services\Posts\CreatePostService;
use App\Services\Posts\CreatePostServiceInterface;
use App\Services\Posts\GetListAndFormServiceInterface;
use App\Services\Posts\GetListAndFormService;
use App\Services\StoreFileService;
use App\Services\StoreFileServiceInterface;
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
        $this->app->bind(StoreFileServiceInterface::class, StoreFileService::class);

        $this->app->bind(
            CreateNewUserServiceInterface::class,
            function ($app) {
                return new CreateNewUserService(
                    $app->make(UserRepositoryInterface::class),
                    $app->make(StoreFileServiceInterface::class),
                );
            });

        $this->app->bind(GetListAndFormServiceInterface::class,
            function ($app){
                return new GetListAndFormService(
                    $app->make(UserRepositoryInterface::class),
                    $app->make(PostRepositoryInterface::class),
                    $app->make(ImageRepositoryInterface::class),
                    $app->make(TagrepositoryInterface::class),
                );
            });

        $this->app->bind(CreatePostServiceInterface::class,
            function ($app){
                return new CreatePostService(
                    $app->make(StoreFileServiceInterface::class),
                    $app->make(PostRepositoryInterface::class),
                    $app->make(ImageRepositoryInterface::class),
                    $app->make(PostTagRepositoryInterface::class),
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
