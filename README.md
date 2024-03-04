# xPayapi.com PHP SCI/API Wrapper(Official).

This is an official module developed by xPayapi.com for easy integration into PHP-based applications.
Source code of the class files is in the ./src directory. The source code for the examples can be found at ./examples.


## Requirements
It's recommended to use a newer version of PHP. This library was written in a PHP v7.1+ environment + php-curl, php-json, php-mbstring modules.

A xPayapi.com account with **Merchant ID, Merchant Password, API ID, API Password**. You can get the credentials at the pages: [Add merchant](https://xPayapi.com/merchant/add/), [Add API](https://xPayapi.com/api/add/).

## Installation

Package available on [Composer](https://packagist.org/packages/xpayapi/xpayapi_com).

If you're using Composer to manage dependencies, you can use

```bash
$ composer require xpayapi/xpayapi_com
```

## Test examples with Docker

To quickly run examples you need to install Docker, git and make utility.

**Step 1:**

```bash
$ git clone https://github.com/xpayapi/xpayapi.com.git
$ cd xpayapi-com/
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

## Usage, see examples folder

**Example:**
Follow the link [http://localhost/examples/](http://localhost/examples/)

## Contributing
If during your work with this wrapper you encounter a bug or have a suggestion to help improve it for others, you are welcome to open a Github issue on this repository and it will be reviewed by one of our development team members. The xPayapi.com bug bounty does not cover this wrapper.

## License
MIT - see LICENSE