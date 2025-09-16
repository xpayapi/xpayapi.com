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
     * Ton: [ TON ],
     */
    $private_hash = $_POST["order_id"];

    $xPayApi = new \xPayApi\xPayApiSCI(
        $secret_keys_and_config["merchant_id"],
        $secret_keys_and_config["merchant_password"],
        $secret_keys_and_config["config"]["test_mode"]
    );

    $res = $xPayApi->checkOrderIpn(
        $private_hash
    );


    if ($res['error']) {
        echo $res['message'];
        // more actions in case of an error, update database, send message or etc
    } else {
        // actions in case of success
        $transaction = $res["data"]["transaction"]; // transaction number in the system xpayapi: 25487
        $id = $res["data"]["order_id"];        // unique numeric identifier of the payment in your system, example: 33fcc968212b343f749bc69c5
        $amount = $res["data"]["amount"];    // invoice amount example: 100.0000000
        $currency = $res["data"]["currency"];       // the currency of payment, for example: TRX
        $system = $res["data"]["system"];           // system, example: TRON
        $address = $res["data"]["address"];         // a cryptocurrency wallet address, for example: bc1qgd5jezucgjkrnp00h8fcq8wsxacwf65d88j7gf
        $tag = $res["data"]["tag"];                 // Tag for Ripple and Stellar
        $hash = $res["data"]["hash"];         // a txid if the payment is success or can be false

        // your code should here...

        echo $id.'|success'; // be sure to confirm the payment has been received
    }