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

    $res = $xPayApi->getTransaction(
        $private_hash
    );


    if ($res['error']) {
        echo $res['message'];
        // more actions in case of an error, update database, send message or etc
    } else {
        // actions in case of success
        $transaction = $res["data"]["transaction"];         // transaction number in the system paykassa: 2431038
        $txid = $res["data"]["txid"];                       // A transaction in a cryptocurrency network, an example: e2be8b51ad0ccbae2a2433f8c940035ce97903c7de1a1cefa1db40cc1cabb0e5
        $shop_id = $res["data"]["shop_id"];                 // Your merchant's number, example: 138
        $id = $res["data"]["order_id"];                     // unique numeric identifier of the payment in your system, example: ae2a2433f8c940035de1a1cece979
        $amount = $res["data"]["amount"];            // received amount, example: 100.0000000
        $fee = $res["data"]["fee"];                  // Payment processing commission: 0.0000000
        $currency = $res["data"]["currency"];               // the currency of payment, for example: TRX
        $system = $res["data"]["system"];                   // system, example: TRON
        $address_from = $res["data"]["address"];       // address of the payer's cryptocurrency wallet, example: DKpzDZuFoTpPpnpsMro8NBtmDz8rinCjqp
        $tag = $res["data"]["tag"];                         // Tag for Ripple and Stellar is an integer
        $status = $res["data"]["status"];                   //"no" - not confirmed, "yes" - confirmed and credited
        $date_update = $res["data"]["date_update"];         // last updated information, example: "2020-07-23 15:06:58"

        $explorer_address_link =
            $res["data"]["explorer_address_link"];          // A link to view information about the address, example:  https://explorer.xpayapi.com/dogecoin/address/DKpzDZuFoTpPpnpsMro8NBtmDz8rinCjqp
        $explorer_transaction_link =
            $res["data"]["explorer_transaction_link"];      // Link to view transaction information, example: https://explorer.xpayapi.com/dogecoin/transaction/e2be8b51ad0ccbae2a2433f8c940035ce97903c7de1a1cefa1db40cc1cabb0e5

        // your code should here...

        echo $id.'|success'; // be sure to confirm the payment has been received
    }