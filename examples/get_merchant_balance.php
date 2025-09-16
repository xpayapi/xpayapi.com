<?php

    require_once __DIR__ . "/../src/xpayapi_api.class.php";

    $secret_keys_and_config = [
        "merchant_id" => "Merchant ID",
        "api_id" => "API ID",
        "api_password" => "API Password",
        "config" => [
            "test_mode" => false,
        ],
    ];

    include_once __DIR__ . "/../config/config-example.php";

    $xPayApi_params = [
        "merchant_id" => $secret_keys_and_config["merchant_id"],
    ];

    $xPayApi = new \xPayApi\xPayApiAPI(
        $secret_keys_and_config["api_id"],
        $secret_keys_and_config["api_password"],
        $secret_keys_and_config["config"]["test_mode"]
    );

    $res = $xPayApi->getMerchantBalances(
        $xPayApi_params["merchant_id"]
    );


    if ($res['error']) {
        echo $res['message'];
        // more actions in case of an error, update database, send message or etc
    } else {
        // actions in case of success
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
        * Ethereum_ERC20: [ USDT, BUSD, USDC, SHIB ],,
        * Solana: [ SOL ],
        * Ton: [ TON ]
        * Berty: [ USD, RUB ]
        */

        $system = "TRON";
        $currency = "TRX";

        $label = mb_strtolower(sprintf("%s_%s", $system, $currency));

        $data = $res["data"];

        echo sprintf(
            "Balance for %s %s %s",
            $system,
            $data[$label] ?? "0.0",
            $currency
        );
    }