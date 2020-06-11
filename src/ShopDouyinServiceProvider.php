<?php

namespace Xbhub\ShopDouyin;

use Illuminate\Support\ServiceProvider;
use Xbhub\ShopDouyin\Api\Application;

class ShopDouyinServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'shopDouyin'
        );
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('shopDouyin', function ($app) {
            $config = config('shopDouyin');
            return new Application($config);
        });
    }

    public function provides()
    {
        return ['shopDouyin'];
    }
}