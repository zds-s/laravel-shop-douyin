<?php

namespace Xbhub\ShopDouyin;

use Illuminate\Support\Facades\Facade;

class ShopDouyin extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'ShopDouyin';
    }

    public static function __callStatic($name, $args)
    {
        return app('ShopDouyin')->$name;
    }
}
