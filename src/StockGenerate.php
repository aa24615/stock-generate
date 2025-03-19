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
    protected $upper_limit_down = 10;
    /**
     * @var int 上市价格
     */
    protected $init_price = 10;
    /**
     * @var int 涨停百分比
     */
    protected $odds_limit_up_percentage = 1;
    /**
     * @var int 跌停百分比
     */
    protected $odds_limit_down_percentage = 1;
    /**
     * @var int 连续涨停百分比
     */
    protected $continuity_odds_limit_up_percentage = 1;
    /**
     * @var int 连续跌停百分比
     */
    protected $continuity_odds_limit_down_percentage = 1;
    /**
     * @var int 最大连续涨停天数
     */
    protected $max_day_limit_up = 10;
    /**
     * @var int 最大连续跌停天数
     */
    protected $max_day_limit_down = 10;

    /**
     * @var array 股票数据
     */
    protected $list = [];

    /**
     * @var array 节假日列表
     */
    protected $holidays = [
        '2023-01-01', // 示例节假日
        '2023-01-21',
        '2023-01-22',
        '2023-01-23',
        '2023-01-24',
        '2023-01-25',
        '2023-01-26',
        '2023-01-27',
        // 添加更多节假日
    ];

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            if ($key === 'odds_limit_up') {
                $key = 'odds_limit_up_percentage';
                $value = $value * 100; // 转换为百分比
            } elseif ($key === 'odds_limit_down') {
                $key = 'odds_limit_down_percentage';
                $value = $value * 100; // 转换为百分比
            } elseif ($key === 'continuity_odds_limit_up') {
                $key = 'continuity_odds_limit_up_percentage';
                $value = $value * 100; // 转换为百分比
            } elseif ($key === 'continuity_odds_limit_down') {
                $key = 'continuity_odds_limit_down_percentage';
                $value = $value * 100; // 转换为百分比
            }
            $this->$key = $value;
        }
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        foreach ($config as $key => $value) {
            if ($key === 'odds_limit_up') {
                $key = 'odds_limit_up_percentage';
                $value = $value * 100; // 转换为百分比
            } elseif ($key === 'odds_limit_down') {
                $key = 'odds_limit_down_percentage';
                $value = $value * 100; // 转换为百分比
            } elseif ($key === 'continuity_odds_limit_up') {
                $key = 'continuity_odds_limit_up_percentage';
                $value = $value * 100; // 转换为百分比
            } elseif ($key === 'continuity_odds_limit_down') {
                $key = 'continuity_odds_limit_down_percentage';
                $value = $value * 100; // 转换为百分比
            }
            $this->$key = $value;
        }
    }

    public function go()
    {
        // 初始化变量
        $current_price = $this->init_price;
        $current_date = new \DateTime($this->start_date);
        $end_date = $this->end_date ? new \DateTime($this->end_date) : new \DateTime();
        $end_day = $this->end_day ? $this->end_day : null;
        $day_count = 0;
        $limit_up_count = 0;
        $limit_down_count = 0;
        $previous_price = $current_price; // 记录前一天的价格

        // 循环生成每一天的数据
        while (($end_day === null || $day_count < $end_day) && $current_date <= $end_date) {
            // 检查是否为周末或节假日
            if ($current_date->format('N') >= 6 || in_array($current_date->format('Y-m-d'), $this->holidays)) {
                $current_date->modify('+1 day');
                continue;
            }

            $price_change = 0;

            // 判断是否涨停
            if ($limit_up_count < $this->max_day_limit_up && mt_rand() / mt_getrandmax() < $this->continuity_odds_limit_up_percentage / 100) {
                $price_change = $current_price * ($this->upper_limit_up / 100);
                $limit_up_count++;
                $limit_down_count = 0;
            } 
            // 判断是否跌停
            elseif ($limit_down_count < $this->max_day_limit_down && mt_rand() / mt_getrandmax() < $this->continuity_odds_limit_down_percentage / 100) {
                $price_change = -$current_price * ($this->upper_limit_down / 100); // 使用正确的变量名
                $limit_down_count++;
                $limit_up_count = 0;
            } 
            // 正常波动
            else {
                $price_change = $current_price * (mt_rand() / mt_getrandmax() * 0.04 - 0.02); // 调整每日波动在-2%到2%之间
                $limit_up_count = 0;
                $limit_down_count = 0;
            }

            // 更新当前价格
            $current_price += $price_change;
            $current_price = max($current_price, 0); // 确保价格不低于0

            // 计算涨跌幅度
            $point_change = $current_price - $previous_price;
            $percentage_change = ($point_change / $previous_price) * 100; // 计算涨跌幅度
            $previous_price = $current_price; // 更新前一天的价格

            // 将数据添加到列表中
            $this->list[] = [
                'date' => $current_date->format('Y-m-d'),
                'price' => round($current_price, 2),
                'change' => round($price_change, 2),
                'percentage_change' => round($percentage_change, 2), // 添加涨跌幅度
            ];

            // 增加日期和天数计数
            $current_date->modify('+1 day');
            $day_count++;
        }
    }

    /**
     * 获取生成的股票数据
     *
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}