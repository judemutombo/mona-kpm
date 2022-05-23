<?php 
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT . '/vendor/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;
$clientId = "Aa4LfsKMWaG4NTm1IwvB3yeW8bpWIBy0qmgJKV8vHYwnB-SkPTEpOuf_1A9UkkiRmMeqeNDI0BA5Z0mt";
$clientSecret = "EN9pc2MmP69DpLRvazKBmCLgs3O-I0CVd588dhOh2uHJc9ztLcq4TpEuXn8-W4Fv5mrVFjdpA76YOcM2";

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);
$request = new OrdersCaptureRequest($_GET["id"]);
$request->prefer('return=representation');
try {
    $response = $client->execute($request);
    echo json_encode($response->result);
}catch (HttpException $ex) {
    echo $ex->statusCode;
    print_r($ex->getMessage());
}