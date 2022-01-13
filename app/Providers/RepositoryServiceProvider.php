<?php

namespace App\Providers;

use App\Repository\AssignPromotionCodeRepositoryInterface;
use App\Repository\Eloquent\AssignPromotionCodeRepositoryRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\PromotionCodesRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\WalletRepository;
use App\Repository\PromotionCodesRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\WalletRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PromotionCodesRepositoryInterface::class, PromotionCodesRepository::class);
        $this->app->bind(AssignPromotionCodeRepositoryInterface::class, AssignPromotionCodeRepositoryRepository::class);
        $this->app->bind(WalletRepositoryInterface::class,WalletRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
