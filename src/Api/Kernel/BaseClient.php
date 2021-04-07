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

use Carbon\Traits\Date;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Xbhub\ShopDouyin\Api\Application;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Middleware;

/**
 * Class BaseClient.
 *
 * @author jory <jorycn@163.com>
 */
class BaseClient
{
    use MakesHttpRequests;

    /**
     * @var  Xbhub\ShopDouyin\Api\Application
     */
    protected $app;

    /**
     *
     * @var array $commonParams 公共参数
     */
    protected static array $commonParams = [];

    protected $ShopDouyinHandlerStack;

    /**
     * @param  Xbhub\ShopDouyin\Api\Application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Make a get request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpGet(string $method, array $query = [])
    {
        $_methods = explode('.', $method);
        return $this->request('GET', implode('/', $_methods), [
            RequestOptions::QUERY => $this->_mergeBaseParams($method, $query)
        ]);
    }

    public function httpDelete(string $uri, array $query = [])
    {
        return $this->requestShopDouyin("DELETE", $uri, [RequestOptions::QUERY => $query]);
    }

    /**
     * @param string $method
     * @param array $query
     * @return array
     * @throws Exceptions\ClientError
     * @return array|Response
     */
    public function httpPost(string $method, array $query = [])
    {
        $_methods = explode('.', $method);
        return $this->request('POST', implode('/', $_methods), [
            RequestOptions::FORM_PARAMS => $this->_mergeBaseParams($method, $query)
        ]);
    }

    /**
     * 设置公共参数
     * @param array $commonParams
     */
    public static function setCommonParams(array $commonParams)
    {
        self::$commonParams = $commonParams;
    }

    /**
     * Make a post request.
     *
     * @param string $uri
     * @param array  $json
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpPostJson(string $uri, array $json = [], array $query = [])
    {
        return $this->requestShopDouyin('POST', $uri, [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON  => $json,
        ]);
    }

    /**
     * Upload files.
     *
     * @param string $uri
     * @param array  $files
     * @param array  $query
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function httpUpload(string $uri, array $files, array $query = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        return $this->requestShopDouyin('POST', $uri, [
            RequestOptions::QUERY     => $query,
            RequestOptions::MULTIPART => $multipart,
        ]);
    }

    /**
     * 构造sign
     *
     * @param string $method
     * @param array $params
     * @return void
     */
    protected function _mergeBaseParams(string $method, array $params)
    {
        $credt = $this->credentials();
        $public = [
            'app_key' => $credt['appkey'],
            'timestamp'  => Carbon::now()->format('Y-m-d H:i:s'),
            'v'          => '2',
            'method' => $method
        ];
        $common = array_merge($public,$params,self::$commonParams);
        $access_token = $params['access_token'];
        unset($common['access_token'],$common['sign_method'],$params['access_token']);
        ksort($params);
        $param_json = json_encode((object)$params,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $common['param_json'] = $param_json;
        $str = 'app_key'.$credt['appkey'].'method'.$method.'param_json'.$param_json
                .'timestamp'.$public['timestamp'].'v2';
        $md5_str = $credt['appsecret'] . $str . $credt['appsecret'];
        $sign = md5($md5_str);
        $public['sign_method'] = 'md5';
        $public['access_token']=$access_token;
        $ret = array_merge($public, [
            'param_json' => $param_json,
            'sign' => $sign
        ]);
        ksort($ret);
        return $ret;
    }

    /**
     * @return array
     */
    protected function credentials(): array
    {
        return [
            'appkey'     => $this->app['config']->get('app_id'),
            'appsecret' => $this->app['config']->get('app_secret'),
        ];
    }
}
