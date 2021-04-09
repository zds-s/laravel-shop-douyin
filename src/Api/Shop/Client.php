<?php declare(strict_types=1);

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api\Shop;

use Xbhub\ShopDouyin\Api\Kernel\BaseClient;
use Illuminate\Support\Facades\Log;

/**
 * Class Client.
 *
 * @author jory <jorycn@163.com>
 */
class Client extends BaseClient
{

    /**
     * 获取商户所有授权品牌
     * @param array $options
     * @return array
     * @throws \Xbhub\ShopDouyin\Api\Kernel\Exceptions\ClientError
     */
    public function brandList(array $options = [])
    {
        return $this->httpPost('shop.brandList', $options);
    }

    /**
     * 获取店铺后台供商家发布商品的类目
     * @param string $cid 父类目id，根据父id可以获取子类目，一级类目cid=0
     * @param array $options 扩展参数
     * @return array
     */
    public function getShopCategory(string $cid,array $options=[])
    {
        return $this->httpPost('shop.getShopCategory',array_merge(compact('cid'),$options));
    }

}
