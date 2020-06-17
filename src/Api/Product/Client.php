<?php declare(strict_types=1);

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api\Product;

use Xbhub\ShopDouyin\Api\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author jory <jorycn@163.com>
 */
class Client extends BaseClient
{

    /**
     * 获取商品分类列表
     *
     * @param string $cid 父分类id,根据父id可以获取子分类，一级分类cid=0
     * @return void
     */
    public function getGoodsCategory(string $cid = '0')
    {
        return $this->httpPost('product.getGoodsCategory', ['cid' => $cid]);
    }

    /**
     * 创建商品
     * http://openapidoc.jinritemai.com/documents/product/product_add.html
     *
     * @param string $name xxx补水液
     * @param string $pic 商品轮播图，每张图片用 | 分开，第一张图为主图数量限制 : 最少1张、最多5张=>img_url1|img_url2|img_url3 
     * @param string $description 商品描述，目前只支持图片多张图片用 | 分开不能用其他网站的文本粘贴，这样会出现css样式不兼容
     * @param string $out_product_id 外部商品id,接入方的商品id (需为数字字符串, max = int64)
     * @param string $market_price 市场价，单位分
     * @param string $first_cid 一级分类id
     * @param string $second_cid 二级分类id
     * @param string $third_cid 三级分类id
     * @param string $spec_id 规格id, 要先创建商品通用规格, 如颜色-尺寸
     * @param string $mobile 客服号码
     * @param string $weight 商品重量 (单位:克) 范围: 10克 - 9999990克
     * @param string $product_format  属性名称|属性值之间用|分隔, 多组之间用^分开 => 货号|8888^上市年份季节|2018年秋季
     * @param string $cos_ratio 佣金比率 0
     * @param string $pay_type 付款方式 (0货到付款 1在线支付 2两者都支持)
     *                  - discount_price 售卖价，单位分
     *                  - spec_pic 主规格id, 如颜色-尺寸, 颜色就是主规格, 颜色如黑,白,黄,它们的id|图片url=>1234|img_url^1235|img_url
     *                  - usp 商品卖点
     *                  - recommend_remark 商家推荐语
     *                  - extra 额外信息
     *                  - brand_id 品牌id (请求店铺授权品牌接口获取) (效果即为商品详情页面中的品牌字段)
     *                  - presell_type 预售类型，1-全款预售，0-非预售，默认0
     *                  - presell_delay 预售结束后，几天发货，可以选择2-30
     *                  - presell_end_time 预售结束时间，格式2020-02-21 18:54:27，最多支持设置距离当前30天
     *                  - delivery_delay_day 承诺发货时间，单位是天，可选值为: 2、3、5、7、10、15
     *                  - quality_report 商品创建和编辑操作支持设置质检报告链接,多个图片以逗号分隔
     *                  - class_quality 商品创建和编辑操作支持设置品类资质链接,多个图片以逗号分隔
     * @return void
     */
    public function add(array $options = [])
    {
        return $this->httpPost('product.add', $options);
    }


    /**
     * 修改商品
     *
     * @param array $id product_id，和接入方的out_product_id二选一
     * @param array $options name，spec_id，pic，description，first_cid，second_cid，third_cid，mobile
     *              product_format， usp，presell_type，presell_delay，presell_end_time
     * @return void
     */
    public function edit(array $id, array $options)
    {
        return $this->httpPost('product.edit', array_merge($options, $id));
    }


    /**
     * 删除商品
     *
     * @param array $id product_id | out_product_id
     * @return void
     */
    public function del(array $id)
    {
        return $this->httpPost('product.del', $id);
    }

    /**
     * 获取商品列表
     *
     * @param string $page
     * @param string $size
     * @param array $options
     *      - status 指定状态返回商品列表 0上架 1下架
     *      - check_status 指定审核状态返回商品列表 1未提审 2审核中 3审核通过 4审核驳回 5封禁
     * @return void
     */
    public function list(string $page = '0', string $size = '15', array $options = [])
    {
        return $this->httpPost('product.list', array_merge($options, [
            'page' => $page,
            'size' => $size
        ]));
    }

    /**
     * 获取商品详情
     *
     * @param array $id product_id|out_product_id
     * @return void
     */
    public function detail(array $id)
    {
        return $this->httpPost('product.detail', $id);
    }


}
