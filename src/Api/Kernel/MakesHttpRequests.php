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

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

/**
 * Trait MakesHttpRequests.
 *
 * @author jory <jorycn@163.com>
 */
trait MakesHttpRequests
{
    /**
     * @var bool
     */
    protected $transform = true;


    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws Exceptions\ClientError
     */
    public function request(string $method, string $uri, array $options = [])
    {
        try {
            $response = $this->app['http_client']->request($method, $uri, $options);

            return $this->transform ? $this->transformResponse($response) : $response;
        } catch (RequestException $e) {
            Log::error(\GuzzleHttp\Psr7\str($e->getRequest()));
            if ($e->hasResponse()) {
                Log::error(\GuzzleHttp\Psr7\str($e->getResponse()));
            }
            throw new Exceptions\ClientError('request error');
        }
    }

    /**
     * @return $this
     */
    public function dontTransform()
    {
        $this->transform = false;

        return $this;
    }


    /**
     * @param $response
     * @return array
     * @throws Exceptions\ClientError
     */
    protected function transformResponse($response)
    {
        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['code']) && !in_array($result['code'], [0, 200000])) {
            // throw new Exceptions\ClientError($result['errmsg'], $result['errcode']);
            throw new Exceptions\ClientError(json_encode($result));
        }

        if (isset($result['error_response'])) {
            throw new Exceptions\ClientError(json_encode($result['error_response']));
        }

        return $result;
    }
}
