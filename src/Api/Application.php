<?php

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api;

use Pimple\Container;

/**
 * Class Application.
 *
 * @author jory <jorycn@163.com>
 *
 * @property \Xbhub\ShopDouyin\Api\Auth\Client  $auth
// * @property Xbhub\ShopDouyin\Api\Chat\Client $chat
// * @property Xbhub\ShopDouyin\Api\Role\Client $role
// * @property Xbhub\ShopDouyin\Api\User\Client $user
// * @property Xbhub\ShopDouyin\Api\Media\Client $media
 * @property \Xbhub\ShopDouyin\Api\Sku\Client $sku
 * @property \Xbhub\ShopDouyin\Api\Spec\Client $spec
 * @property \Xbhub\ShopDouyin\Api\Shop\Client $shop
 * @property \Xbhub\ShopDouyin\Api\Order\Client $order
 * @property \Xbhub\ShopDouyin\Api\Product\Client $product
// * @property Xbhub\ShopDouyin\Api\Jssdk\Client $jssdk
// * @property Xbhub\ShopDouyin\Api\Checkin\Client $checkin
// * @property Xbhub\ShopDouyin\Api\Message\Client $message
// * @property Xbhub\ShopDouyin\Api\Attendance\Client $attendance
 * @property \Xbhub\ShopDouyin\Api\Kernel\Credential $credential
// * @property Xbhub\ShopDouyin\Api\Department\Client $department
// * @property Xbhub\ShopDouyin\Api\Message\AsyncClient $async_message
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        Kernel\ServiceProvider::class,
        Spec\ServiceProvider::class,
        Product\ServiceProvider::class,
        Sku\ServiceProvider::class,
        Shop\ServiceProvider::class,
        Order\ServiceProvider::class,
        Auth\ServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this['config'] = function () use ($config) {
            return new Kernel\Config($config);
        };

        $this->registerProviders();
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }
}
