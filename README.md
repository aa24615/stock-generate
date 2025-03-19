### English Documentation for `zyan/stock-generate`

English | [中文](./README_CN.md)

#### **Overview**
The `zyan/stock-generate` package is designed to simulate and generate stock data based on configurable parameters. It allows developers to create realistic stock price movements, including limit up (price increase cap), limit down (price decrease cap), and normal fluctuations.

---

#### **Requirements**
1. PHP version >= 7.4
2. Composer version 2.x

---

#### **Installation**
To install the package via Composer, run the following command in your terminal:

```bash
composer require zyan/stock-generate -vvv
```


---

#### **Usage**
Below is an example of how to use the `StockGenerate` class to simulate stock data:

```php
<?php

use Zyan\StockGenerate\StockGenerate;

// Configuration for the stock simulation
$config = [
    'symbol' => 'SZ10000', // Stock code
    'name' => 'Virtual Stock', // Stock name
    'start_date' => '2010-01-01', // Listing date
    'end_date' => null, // End date (null means today's date) or end day count
    'end_day' => null, // End day count (optional, overrides end_date if provided)
    'upper_limit_up' => 10, // Limit up percentage
    'upper_limit_down' => 10, // Limit down percentage
    'init_price' => 10, // Initial stock price
    'odds_limit_up_percentage' => 1, // Probability of limit up (percentage)
    'odds_limit_down_percentage' => 1, // Probability of limit down (percentage)
    'continuity_odds_limit_up_percentage' => 1, // Probability of consecutive limit up (percentage)
    'continuity_odds_limit_down_percentage' => 1, // Probability of consecutive limit down (percentage)
    'max_day_limit_up' => 10, // Maximum consecutive limit up days
    'max_day_limit_down' => 10, // Maximum consecutive limit down days
];

// Initialize the StockGenerate object with the configuration
$stock = new StockGenerate($config);

// Generate the stock data
$stock->go();

// Retrieve the generated stock data
$list = $stock->getList();

// Output the generated data
print_r($list);
```


---

#### **Key Features**
1. **Customizable Parameters**:
    - Define stock symbol, name, start/end dates, initial price, and probability percentages.
    - Configure limit up/down percentages and maximum consecutive limit up/down days.

2. **Holiday and Weekend Handling**:
    - The generator automatically skips weekends and holidays defined in the `holidays` array.

3. **Random Price Fluctuations**:
    - Simulates daily price changes based on random probabilities within specified limits.

4. **Output Format**:
    - Generates a list of daily stock data, including date, price, change amount, and percentage change.

---

#### **Example Output**
Here’s an example of the generated stock data:

```php
Array
(
    [0] => Array
        (
            [date] => 2010-01-04
            [price] => 10.50
            [change] => 0.50
            [percentage_change] => 5.00
        )
    [1] => Array
        (
            [date] => 2010-01-05
            [price] => 10.00
            [change] => -0.50
            [percentage_change] => -4.76
        )
    ...
)
```


---

#### **Contributing**
1. Fork the repository to your account.
2. Make your changes locally, review them, and push to your forked repository.
3. Submit a Pull Request (PR) with a description of your changes, and wait for it to be reviewed and merged.

---

#### **License**
This package is released under the MIT License. See the [LICENSE](https://opensource.org/licenses/MIT) file for more details.

--- 

Let me know if you need further adjustments or additional sections!