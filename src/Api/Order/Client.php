<?php declare(strict_types=1);

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api\Order;

use Xbhub\ShopDouyin\Api\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author jory <jorycn@163.com>
 */
class Client extends BaseClient
{
    /**
     * 同步订单
     *
     * @param string $start_at
     * @param string $end_at
     * @param array $options
     * @return void
     */
    public function list(string $start_at, string $end_at, array $options = [])
    {
        $_data = array_merge([
            'start_time' => $start_at,
            'end_time' => $end_at,
            'order_by' => 'create_time',
            'page' => '0',
            'size' => '100'
        ], $options);
        return $this->httpPost('order.list', $_data);
    }

    /**
     * 获取订单详情
     *
     * @param string $order_id
     * @return void
     */
    public function detail(string $order_id)
    {
        return $this->httpPost('order.detail', ['order_id' => $order_id]);
    }

}
