<?php

namespace App\Providers;

use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Repositories\PastaEloquent;
use App\Services\Interfaces\PastaServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\PastaService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PastaServiceInterface::class => PastaService::class,
        UserServiceInterface::class => UserService::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
