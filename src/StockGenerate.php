<?php

/*
 * This file is part of the zyan/stock-generate.
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
    /**
     * @var string 股票代码
     */
    protected $symbol = 'SZ10000';
    /**
     * @var string 股票名称
     */
    protected $name = '虚拟xx股';
    /**
     * @var string 上市日期
     */
    protected $start_date = '2010-01-01';
    /**
     * @var null|string 结束日期 未传则到今天 或 结束天数
     */
    protected $end_date = null;
    /**
     * @var null 结束天数 未传则以结束日期 优先级最高
     */
    protected $end_day = null;
    /**
     * @var int 涨停百分比
     */
    protected $upper_limit_up = 10;
    /**
     * @var int 跌停百分比
     */
    protected $upper_limit_donw = 10;
    /**
     * @var int 上市价格
     */
    protected $init_price = 10;
    /**
     * @var int 涨停机率
     */
    protected $odds_limit_up = 0.01;
    /**
     * @var int 跌停机率
     */
    protected $odds_limit_donw = 0.01;
    /**
     * @var int 连续涨停机率
     */
    protected $continuity_odds_limit_up = 0.01;
    /**
     * @var int 连续跌停机率
     */
    protected $continuity_odds_limit_donw = 0.01;
    /**
     * @var int 最大连续涨停天数
     */
    protected $max_day_limit_up = 10;
    /**
     * @var int 最大连续跌停天数
     */
    protected $max_day_limit_donw = 10;

    /**
     * @var array 股票数据
     */
    protected $list = [];

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
    }

    public function go()
    {
        while (true){
            $this->list = [];
        }
    }
}
