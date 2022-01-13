<?php

namespace App\Providers;

use App\Service\AssignPromotionCodeService;
use App\Service\AssignPromotionCodeServiceInterface;
use App\Service\PromotionCodesService;
use App\Service\PromotionCodesServiceInterface;
use App\Service\UserService;
use App\Service\UserServiceInterface;
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
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AssignPromotionCodeServiceInterface::class, AssignPromotionCodeService::class);
        $this->app->bind(PromotionCodesServiceInterface::class, PromotionCodesService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
