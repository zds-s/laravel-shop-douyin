<?php declare(strict_types=1);

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api\Spec;

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
     * 获取规格列表
     *
     * @param [type] $params
     * @return void
     */
    public function list(array $options = [])
    {
        return $this->httpPost('spec.list', $options);
    }

    /**
     * 新增
     *
     * @param string $specs 颜色|黑色,白色,黄色^尺码|S,M,L
     * @param string $name 规格1
     * @param array $options
     * @return void
     */
    public function add(string $name, string $specs, array $options = [])
    {
        return $this->httpPost('spec.add', array_merge([
            'name' => $name,
            'specs' => $specs
        ], $options));
    }

    /**
     * 规格详情
     *
     * @param string $id 134
     * @return void
     */
    public function specDetail(string $id)
    {
        return $this->httpPost('spec.specDetail', ['id' => $id]);
    }

    /**
     * 删除规格
     * 注意 : 删除spec后将导致原有绑定该spec的sku全部失效, 请慎重操作
     *
     * @param string $id
     * @return void
     */
    public function del(string $id)
    {
        return $this->httpPost('spec.del', ['id' => $id]);
    }

}
