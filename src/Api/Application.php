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
 * @property \namespace Xbhub\ShopDouyin\Api\Auth\Client $auth
 * @property \namespace Xbhub\ShopDouyin\Api\Chat\Client $chat
 * @property \namespace Xbhub\ShopDouyin\Api\Role\Client $role
 * @property \namespace Xbhub\ShopDouyin\Api\User\Client $user
 * @property \namespace Xbhub\ShopDouyin\Api\Media\Client $media
 * @property \namespace Xbhub\ShopDouyin\Api\Jssdk\Client $jssdk
 * @property \namespace Xbhub\ShopDouyin\Api\Checkin\Client $checkin
 * @property \namespace Xbhub\ShopDouyin\Api\Message\Client $message
 * @property \namespace Xbhub\ShopDouyin\Api\Attendance\Client $attendance
 * @property \namespace Xbhub\ShopDouyin\Api\Kernel\Credential $credential
 * @property \namespace Xbhub\ShopDouyin\Api\Department\Client $department
 * @property \namespace Xbhub\ShopDouyin\Api\Message\AsyncClient $async_message
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
