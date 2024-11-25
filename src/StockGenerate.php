<?php

/*
 * This file is part of the zyan/stock-api.
 *
 * (c) 读心印 <aa24615@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zyan\StockGenerate;


/**
 * Class StockGenerate.
 *
 * @package Zyan\StockGenerate
 *
 * @author 读心印 <aa24615@qq.com>
 */
class StockGenerate
{
    protected $config = [
        'symbol' => 'SZ10000', // 股票代码
        'name' => '虚拟xx股', // 股票名称
        'start_date' => '2010-01-01', // 上市日期
        'end_date' => null, // 结束日期 未传则到今天 或 结束天数
        'end_day' => null, // 结束天数 未传则以结束日期 优先级最高
        'upper_limit_up' => 10, // 涨停百分比
        'upper_limit_donw' => 10, // 跌停百分比
        'init_price' => 10, // 上市价格
        'odds_limit_up' => 0.01, // 涨停机率
        'odds_limit_donw' => 0.01, // 跌停机率
        'continuity_odds_limit_up' => 0.01, //连续涨停机率
        'continuity_odds_limit_donw' => 0.01, //连续跌停机率
        'max_day_limit_up' => 10, //最大连续涨停天数
        'max_day_limit_donw' => 10, //最大连续跌停天数
    ];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function go()
    {

    }
}
