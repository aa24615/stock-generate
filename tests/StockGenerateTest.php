<?php

namespace Zyan\Tests;

use PHPUnit\Framework\TestCase;
use Zyan\StockGenerate\StockGenerate;

class StockGenerateTest extends TestCase
{
    public function testGo_WithLimitUpCondition_ShouldApplyLimitUp()
    {
        $stockGenerate = new StockGenerate([
            'symbol' => 'SZ10000', // 股票代码
            'name' => '虚拟xx股', // 股票名称
            'start_date' => '2025-01-01', // 上市日期
            'end_date' => null, // 结束日期 未传则到今天 或 结束天数
            'end_day' => null, // 结束天数 未传则以结束日期 优先级最高
            'upper_limit_up' => 10, // 涨停百分比
            'upper_limit_down' => 10, // 跌停百分比
            'init_price' => 10, // 上市价格
            'odds_limit_up_percentage' => 10, // 涨停百分比
            'odds_limit_down_percentage' => 20, // 跌停百分比
            'continuity_odds_limit_up_percentage' => 10, //连续涨停百分比
            'continuity_odds_limit_down_percentage' => 20, //连续跌停百分比
            'max_day_limit_up' => 10, //最大连续涨停天数
            'max_day_limit_down' => 10, //最大连续跌停天数
        ]);

        $stockGenerate->go();
        $list = $stockGenerate->getList();

        print_r($list);

        // 检查是否有跌停的情况
        $hasLimitDown = false;
        foreach ($list as $item) {
            if ($item['change'] < 0) {
                $hasLimitDown = true;
                break;
            }
        }

        $this->assertTrue($hasLimitDown, '应至少有一次跌停');
    }
}