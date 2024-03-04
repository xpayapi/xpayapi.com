# xPayapi.com PHP SCI/API Wrapper(Official).

This is an official module developed by xPayapi.com for easy integration into PHP-based applications.
Source code of the class files is in the ./src directory. The source code for the examples can be found at ./examples.


## Requirements
It's recommended to use a newer version of PHP. This library was written in a PHP v7.1+ environment + php-curl, php-json, php-mbstring modules.

A xPayapi.com account with **Merchant ID, Merchant Password, API ID, API Password**. You can get the credentials at the pages: [Add merchant](https://xPayapi.com/merchant/add/), [Add API](https://xPayapi.com/api/add/).

## Installation

Package available on [Composer](https://packagist.org/packages/xpayapi-com/xpayapi).

If you're using Composer to manage dependencies, you can use

```bash
$ composer require xpayapi-com/xpayapi
```

## Test examples with Docker

To quickly run examples you need to install Docker, git and make utility.

**Step 1:**

```bash
$ git clone https://github.com/xpayapi-com/xpayapi.git
$ cd xpayapi/
```

**Step 2:**

Setup config with credentials *config/config-example.php*

**Step 3:**

```bash
$ make run
```

**Step 4:**

Open examples in your browser *examples/*


**Example:**

Follow the link [http://localhost/examples/custom_payment_page.php](http://localhost/examples/custom_payment_page.php)

**Stop server:**

```bash
$ make stop
```

## Usage

<?php
    $examples = [
        [
                "file" => "custom_payment_page.php",
                "title" => "Custom payment page",
        ],
        [
            "file" => "create_address.php",
            "title" => "Get a payment address and a QR-code for him",
        ],
        [
            "file" => "processing_ipn_for_transaction.php",
            "title" => "Check an IPN of a transaction",
        ],
        [
            "file" => "create_payment_link.php",
            "title" => "Get a payment link(create an order)",
        ],
        [
            "file" => "processing_ipn_for_order.php",
            "title" => "Check an IPN of an order",
        ],
        [
            "file" => "send_money.php",
            "title" => "Send a money",
        ],
        [
            "file" => "get_merchant_balance.php",
            "title" => "Get a merchant balance",
        ],
        [
            "file" => "get_history.php",
            "title" => "Get a merchant history",
        ],
        [
            "file" => "get_merchant_info.php",
            "title" => "Get a merchant info",
        ],
        [
            "file" => "get_currency_rates.php",
            "title" => "Get cryptocurrency pair rates",
        ],
        [
            "file" => "get_available_currencies.php",
            "title" => "Get available currencies",
        ],
    ];

?>

<?php foreach ($examples as $item) { ?>
### <?php echo $item["title"]; ?>

```php
<?php echo file_get_contents(sprintf("%s%s%s", __DIR__, "/../examples/", $item["file"])); ?>

```

**Example:**
<?php $link = sprintf("%s%s", "http://localhost/examples/", $item["file"]); ?>
Follow the link [<?php echo $link; ?>](<?php echo $link; ?>)

<?php } ?>

## Contributing
If during your work with this wrapper you encounter a bug or have a suggestion to help improve it for others, you are welcome to open a Github issue on this repository and it will be reviewed by one of our development team members. The xPayapi.com bug bounty does not cover this wrapper.

## License
MIT - see LICENSE