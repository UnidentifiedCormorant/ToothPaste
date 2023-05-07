<?php

namespace App\Providers;

use App\Models\AccessType;
use App\Models\Pasta;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view)
        {
            $myPastas = null;
            if (\Auth::check())
            {
                $myPastas = Pasta::where([
                    ['user_id', auth()->user()->id],
                    ['access_type_id', 1]
                ])->latest()->take(10)->get();
            }

            $lastPastas = Pasta::where('access_type_id', 1)->latest()->take(10)->get();

            $accessTypes = AccessType::all();

            $view->with(compact('myPastas', 'lastPastas', 'accessTypes'));
        });
    }
}
