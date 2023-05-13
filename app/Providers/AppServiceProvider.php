<?php

namespace App\Providers;

use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Repositories\PastaRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PastaRepositoryInterface::class, PastaRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
