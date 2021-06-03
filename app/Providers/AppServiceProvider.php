<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\FoodRepositoryInterface',
            'App\Repositories\FoodRepository',
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository',
            'App\Repositories\SocialRepositoryInterface',
            'App\Repositories\SocialRepository',
            'App\Repositories\OrderRepositoryInterface',
            'App\Repositories\OrderRepository',
            'App\Repositories\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository',
            'App\Repositories\NotificationRepositoryInterface',
            'App\Repositories\NotificationRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
