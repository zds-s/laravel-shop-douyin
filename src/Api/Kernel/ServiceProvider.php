<?php

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api\Kernel;

use GuzzleHttp\Client as GuzzleHttp;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ServiceProvider.
 *
 * @author jory <jorycn@163.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['request'] = function () {
            return Request::createFromGlobals();
        };

        $app['http_client'] = function () {
            return new GuzzleHttp([
                'base_uri' => 'https://openapi.jinritemai.com',
                'headers'  => [
                    'Content-Type' => 'text/html;charset=utf8',
                ],
                'timeout'  => 5.0,
            ]);
        };

        $app['credential'] = function ($app) {
            return new Credential($app);
        };

        $app['cache'] = function () {
            return new FilesystemAdapter();
        };
    }
}
