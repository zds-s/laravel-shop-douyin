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
     *
     * @param [type] $params
     * @return void
     */
    public function brandList(array $options = [])
    {
        return $this->httpPost('shop.brandList', $options);
    }

}
