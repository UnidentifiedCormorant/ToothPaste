<?php

namespace App\Providers;

use App\Repositories\ComplaintEloquent;
use App\Repositories\Interfaces\ComplaintRepositoryInterface;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\PastaEloquent;
use App\Repositories\UserEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PastaRepositoryInterface::class => PastaEloquent::class,
        UserRepositoryInterface::class => UserEloquent::class,
        ComplaintRepositoryInterface::class => ComplaintEloquent::class,
    ];

    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}
