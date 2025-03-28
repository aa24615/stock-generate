# zyan/stock-generate

生成一只股票数据

## 要求

1. php >= 7.4
2. composer 2.x

## 安装

```shell
composer require zyan/stock-generate -vvv
```
## 用法

```php
$config = [
    'symbol' => 'SZ10000', // 股票代码
    'name' => '虚拟xx股', // 股票名称
    'start_date' => '2010-01-01', // 上市日期
    'end_date' => null, // 结束日期 未传则到今天 或 结束天数
    'end_day' => null, // 结束天数 未传则以结束日期 优先级最高
    'upper_limit_up' => 10, // 涨停百分比
    'upper_limit_down' => 10, // 跌停百分比
    'init_price' => 10, // 上市价格
    'odds_limit_up' => 0.01, // 涨停机率
    'odds_limit_down' => 0.01, // 跌停机率
    'continuity_odds_limit_up' => 0.01, //连续涨停机率
    'continuity_odds_limit_down' => 0.01, //连续跌停机率
    'max_day_limit_up' => 10, //最大连续涨停天数
    'max_day_limit_down' => 10, //最大连续跌停天数
];

$stock = new StockGenerate($config);
$stock->go();

```

## 参与贡献

1. fork 当前库到你的名下。
2. 在你的本地修改完成审阅过后提交到你的仓库。
3. 提交 PR 并描述你的修改，等待合并。
## License

[MIT license](https://opensource.org/licenses/MIT)
