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

use GuzzleHttp\Psr7\Response;
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
     * @return array|Response
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
        return $this->httpPost('order.list', $_data)['data'];
    }

    /**
     * 添加订单备注
     * @param string $order_id
     * @param string $remark
     * @return array
     */
    public function addOrderRemark(string $order_id,string $remark,$options=[])
    {
        $_data = array_merge(compact('order_id','remark'),$options);
        return $this->httpPost('order.addOrderRemark',$_data);
    }

    /**
     * 获取订单详情
     *
     * @param string $order_id
     * @return void|array
     */
    public function detail(string $order_id)
    {
        return $this->httpPost('order.detail', ['order_id' => $order_id]);
    }

    /**
     * 订单发货
     * @param $order_id string 订单id
     * @param $logistics_id string 物流id
     * @param $logistics_code string 运单号
     * @param $company string 物流公司名称
     * @return array
     * @throws \Xbhub\ShopDouyin\Api\Kernel\Exceptions\ClientError
     */
    public function logisticsAdd($order_id,$logistics_id,$logistics_code,$company,$access_token)
    {
        return $this->httpPost('order.logisticsAdd',compact('order_id','logistics_id','company','logistics_code'));
    }

}
