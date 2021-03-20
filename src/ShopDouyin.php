<?php

namespace Xbhub\ShopDouyin;

use Illuminate\Support\Facades\Facade;
/**
 * Class ShopDouyin
 * @package Xbhub\ShopDouyin
// * @property Xbhub\ShopDouyin\Api\Auth\Client  $auth
// * @property Xbhub\ShopDouyin\Api\Chat\Client $chat
// * @property Xbhub\ShopDouyin\Api\Role\Client $role
// * @property Xbhub\ShopDouyin\Api\User\Client $user
// * @property Xbhub\ShopDouyin\Api\Media\Client $media
 * @method static \Xbhub\ShopDouyin\Api\Sku\Client  sku()
 * @method static \Xbhub\ShopDouyin\Api\Spec\Client spec()
 * @method static \Xbhub\ShopDouyin\Api\Shop\Client shop()
 * @method static \Xbhub\ShopDouyin\Api\Order\Client order()
 * @method static \Xbhub\ShopDouyin\Api\Product\Client product()
// * @property Xbhub\ShopDouyin\Api\Jssdk\Client jssdk()
// * @property Xbhub\ShopDouyin\Api\Checkin\Client $checkin
// * @property Xbhub\ShopDouyin\Api\Message\Client $message
// * @property Xbhub\ShopDouyin\Api\Attendance\Client $attendance
 * @method static \Xbhub\ShopDouyin\Api\Kernel\Credential credential()
// * @property Xbhub\ShopDouyin\Api\Department\Client $department
// * @property Xbhub\ShopDouyin\Api\Message\AsyncClient $async_message
 */
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
