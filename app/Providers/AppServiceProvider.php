<?php

namespace App\Providers;
use Illuminate\Auth\Events\Login;
use App\Listeners\LogUserLogin;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider

{

    protected $listen = [
        Login::class => [
            LogUserLogin::class
        ],
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
       
    }
}
