<?php


namespace Xbhub\ShopDouyin\Api\Auth;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['auth'] = function ($app){
            return new Client($app);
        };
    }
}
