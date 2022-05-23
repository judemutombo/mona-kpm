<?php 
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT . '/vendor/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
$clientId = "Aa4LfsKMWaG4NTm1IwvB3yeW8bpWIBy0qmgJKV8vHYwnB-SkPTEpOuf_1A9UkkiRmMeqeNDI0BA5Z0mt";
$clientSecret = "EN9pc2MmP69DpLRvazKBmCLgs3O-I0CVd588dhOh2uHJc9ztLcq4TpEuXn8-W4Fv5mrVFjdpA76YOcM2";

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);
$request = new OrdersCreateRequest();
$request->prefer('return=representation');
$size = strlen($_SESSION["temp_checkout"][1]);
$currency = $_SESSION["temp_checkout"][1][$size-2].$_SESSION["temp_checkout"][1][$size-1];
$curr;

switch ($currency)
{
    case "02" : $currency ="€";$curr="EUR"; break;
    case "03" : $currency ="£";$curr="GBP"; break;
    case "04" : $currency ="$";$curr="USD"; break;
    case "05" : $currency ="₺";$curr="TRY";
}
$request->body = [
                     "intent" => "CAPTURE",
                     "purchase_units" => [[
                         "reference_id" => $_SESSION["temp_checkout"][1],
                         "amount" => [
                             "value" => (string)$_SESSION["temp_checkout"][5]+(int) $_SESSION['lastFees'],
                             "currency_code" => $curr
                         ]
                     ]],
                     "application_context" => [
                          "cancel_url" => $_SESSION["temp_url"],
                          "return_url" => $_SESSION["temp_url"]
                     ] 
                 ];

try {
    $response = $client->execute($request);
    echo json_encode($response->result);
}catch (HttpException $ex) {
    echo $ex->statusCode;
    print_r($ex->getMessage());
}