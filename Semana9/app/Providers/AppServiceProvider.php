<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 1. Importa la clase Schema
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Agrega esta línea para limitar la longitud de los índices
        Schema::defaultStringLength(191);
    }
}