<?php

    require_once __DIR__ . "/../src/xpayapi_sci.class.php";

    $secret_keys_and_config = [
        "merchant_id" => "Merchant ID",
        "merchant_password" => "Merchant Password",
        "config" => [
            "test_mode" => false,
        ],
    ];

    include_once __DIR__ . "/../config/config-example.php";

    /*
     * BitCoin: [ BTC ],
     * Ethereum: [ ETH ],
     * LiteCoin: [ LTC ],
     * DogeCoin: [ DOGE ],
     * Dash: [ DASH ],
     * BitcoinCash: [ BCH ],
     * Zcash: [ ZEC ],
     * EthereumClassic: [ ETC ],
     * Ripple: [ XRP ],
     * TRON: [ TRX ],
     * Stellar: [ XLM ],
     * BinanceCoin: [ BNB ],
     * TRON_TRC20: [ USDT ],
     * BinanceSmartChain_BEP20: [ USDT, BUSD, USDC, ADA, EOS, BTC, ETH, DOGE, SHIB ],
     * Ethereum_ERC20: [ USDT, BUSD, USDC, SHIB ],
     * Solana: [ SOL ],
     * Ton: [ ton ],
     */
    $xPayApi_params = [
        "amount" => null,
        "system" => "TRON_TRC20",
        "currency" => "USDT",
        "order_id" => "New order id "  . microtime(true),
        "comment" => "Testing comment",
        "address_callback" => "",
        "custom" => "",
    ];

    $xPayApi = new \xPayApi\xPayApiSCI(
        $secret_keys_and_config["merchant_id"],
        $secret_keys_and_config["merchant_password"],
        $secret_keys_and_config["config"]["test_mode"]
    );

    $res = $xPayApi->createAddress(
        $xPayApi_params["amount"],
        $xPayApi_params["system"],
        $xPayApi_params["currency"],
        $xPayApi_params["order_id"],
        $xPayApi_params["comment"],
        $xPayApi_params["address_callback"],
        $xPayApi_params["custom"]
    );


    if ($res['error']) {
        echo $res['message'];
        // more actions in case of an error, update database, send message or etc
    } else {
        // if you want to redirect your user to our payments gateway use this "pay_link"
        $pay_link = $res["data"]["pay_link"];

        // other wise use a data that given in callback
        $invoice_id = $res['data']['invoice'];
        $address = $res["data"]["address"];
        $tag = $res["data"]["tag"];
        $tag_name = $res["data"]["tag_name"];
        $is_tag = $res["data"]["is_tag"];

        $system = $res["data"]["system"];
        $currency = $res["data"]["currency"];

        $display = sprintf("address %s", $address);
        if ($is_tag) {
            $display = sprintf("address %s %s: %s", $address, mb_convert_case($tag_name, MB_CASE_TITLE), $tag);
        }

        if (null === $xPayApi_params["amount"]) {
            echo sprintf(
                "Send a money to the %s %s.",
                $system,
                htmlspecialchars($display,ENT_QUOTES, "UTF-8")
            );
        } else {
            echo sprintf(
                "Send %s %s to the %s %s.",
                $xPayApi_params["amount"],
                $currency,
                $system,
                htmlspecialchars($display, ENT_QUOTES, "UTF-8")
            );
        }

        //Creating QR
        $qr_request = $xPayApi->getQrLink($res['data'], $xPayApi_params["amount"]);
        if (!$qr_request["error"]) {
            echo sprintf(
                '<br><br>QR Code:<br><img alt="" src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=%s">',
                $qr_request["data"]["link"]
            );
        }
    }