<?php

    require_once __DIR__ . "/../src/xpayapi_api.class.php";

    $xpayapi_config = [
        "merchant_id" => "Merchant ID",
        "merchant_password" => "Merchant Password",
        "api_id" => "API ID",
        "api_password" => "API Password",
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
     */
    $xPayApi_params = [
        "merchant_id" => $xpayapi_config["merchant_id"],
        "wallet" => [
            "address" => "TRdjwv1fHZvzs3m3fbLxh9fhguNtxLVfWD",
            "tag" => "",
        ],
        "amount" => "10.000000",
        "system" => "TRON_TRC20",
        "currency" => "USDT",
        "comment" => "Testing comment",
        "priority" => "low", // low, medium, high
    ];

    $xPayApi = new \xPayApi\xPayApiAPI(
        $xpayapi_config["api_id"],
        $xpayapi_config["api_password"],
        $xpayapi_config["config"]["test_mode"]
    );

    $res = $xPayApi->sendMoney(
        $xPayApi_params["merchant_id"],
        $xPayApi_params["wallet"],
        $xPayApi_params["amount"],
        $xPayApi_params["system"],
        $xPayApi_params["currency"],
        $xPayApi_params["priority"],
        $xPayApi_params["comment"]
    );


    if ($res['error']) {
        echo $res['message'];
        // more actions in case of an error, update database, send message or etc
    } else {
        //actions in case of success
        $merchant_id = $res["data"]["shop_id"];                     // merchant id that you originally made payment, example 122
        $transaction = $res["data"]["transaction"];                 // transaction number of the payment, example 123456
        $txid = $res["data"]["txid"];                               // txid 5b74e07821da048e4efe3182420fd717bbafd4c0f6f7f2f48a8fe8e55eb923df can be empty
        // In this case, the information about the transaction can be obtained using a universal link from the Explorer_Transaction_Link field, see below
        $payment_id = $res["data"]["payment_id"];                   // Payment transaction number in the payment system, example 59363855
        $amount = $res["data"]["amount"];                           // the amount of the payment, how much was written off from the balance of the merchant
        $amount_pay = $res["data"]["amount_pay"];                   // the amount of the payment, as it is the user
        $system = $res["data"]["system"];                           // the system of payment, which was made the payment, example: Bitcoin
        $currency = $res["data"]["currency"];                       // the payment currency, for example: BTC
        $number = $res["data"]["number"];                           // the address where you sent the funds
        $fee_percent = $res["data"]["fee_percent"];// the transfer fee percentage, example: 1.5 (in %)
        $fee_amount = $res["data"]["fee_amount"];  // the transfer fee amount, example: 1.00
        $paid_commission = $res["data"]["paid_commission"];         // who paid for the Commission, for example: shop
    
        $explorer_address_link =
            $res["data"]["explorer_address_link"];          // A link to view information about the address
        $explorer_transaction_link =
            $res["data"]["explorer_transaction_link"];      // Link to view transaction information
    
        echo sprintf(
            'We have sent the %s %s %s to %s. The txid is %s',
            $system,
            $amount,
            $currency,
            $explorer_address_link,
            $number,
            $explorer_transaction_link,
            $txid
        );
    }