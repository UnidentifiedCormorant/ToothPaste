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
        View::composer('layouts.layout', function ($view)
        {
            $myPastas = null;
            if (\Auth::check())
            {
                $myPastas = Pasta::where([
                    ['user_id', auth()->user()->id],
                    ['access_type', 1]
                ])->latest()->take(10)->get();
            }

            $lastPastas = Pasta::where('access_type', 1)->latest()->take(10)->get();

            $view->with([
                'myPastas' => $myPastas,
                'lastPastas' => $lastPastas
            ]);
        });
    }
}
