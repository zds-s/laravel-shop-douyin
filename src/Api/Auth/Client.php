<?php


namespace Xbhub\ShopDouyin\Api\Auth;


use GuzzleHttp\RequestOptions;

class Client extends \Xbhub\ShopDouyin\Api\Kernel\BaseClient
{

    /**
     * 通过code获取access
     * @param string $code 授权code
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function accessToken($code)
    {
        $grant_type = 'authorization_code';
        $_methods = explode('.', 'oauth2.access_token');

        [$app_id,$app_secret] = [$this->credentials()['appkey'],$this->credentials()['appsecret']];
        $query = compact('app_id','app_secret','code','grant_type');
        return $this->request('GET', implode('/', $_methods), [
            RequestOptions::QUERY => $query
        ]);
    }
}
