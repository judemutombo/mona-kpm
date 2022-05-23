<?php
use App\DbAuth\DbAuth;
use App\User\User;

session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';
if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){
    if(isset($_POST["code"]) && isset($_POST["type"]) && isset($_POST["url"]))
    {
        if($_POST["type"] === "sxcc")
        {
            $offer = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer INNER JOIN product ON offer.product = product.prod_code INNER JOIN user ON offer.sender = user.mona_id WHERE sender =? AND code=?",[$_SESSION["user"],$_POST["code"]],true);
            if(is_object($offer))
            {
                $verif = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer WHERE state_ = ? AND product = ?",["accept",$offer->product]);
                if(count($verif) === 0)
                {
                    $currency = "00";
                    $price = $offer->price_;
                    switch ($offer->devise_)
                    {
                        case "EUR" : $currency ="02"; break;
                        case "GBP" : $currency ="03"; break;
                        case "USD" : $currency ="04"; break;
                        default : $currency ="05";
                    }
                    $id = rand(1245727,477437672);
                    $_SESSION["temp_checkout"]= [true, $id.$currency,$offer->product, $_POST["code"],$_SESSION["user"],$price,true];
                    $_SESSION["temp_url"] = $_POST["url"];
                    $retour = [true,"checkout?transaction_id=".$id.$currency];
                    echo json_encode($retour);
                }
                else{
                    $retour = [false,"This product has already been sold "];
                    echo json_encode($retour);
                }
            }else{
                $retour = [false,"error 10211"];
                echo json_encode($retour);
            }
        }
        else if ($_POST["type"] === "sxxc"){
            $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM product WHERE prod_code =?",[$_POST["code"]],true);
            if(is_object($product))
            {
                if($product->state == "sale")
                {
                    $currency = "00";
                    $price = $product->price;
                    switch ($product->devise)
                    {
                        case "EUR" : $currency ="02"; break;
                        case "GBP" : $currency ="03"; break;
                        case "USD" : $currency ="04"; break;
                        default : $currency ="05";
                    }
                    $id = rand(1245727,477437672);
                    $_SESSION["temp_checkout"]= [true, $id.$currency,$_POST["code"], $_POST["code"],$_SESSION["user"],$price,false];
                    $_SESSION["temp_url"] = $_POST["url"];
                    $retour = [true,"checkout?transaction_id=".$id.$currency];
                    echo json_encode($retour);

                }else{
                    $retour = [false,"This product has already been sold "];
                    echo json_encode($retour);
                }

            }else{
                $retour = [false,"error 1029"];
                echo json_encode($retour);
            }
        }
        else{
            $retour = [false,"error 1021"];
            echo json_encode($retour);
        }
    }
    else{
        $retour = [false,"error 1023"];
        echo json_encode($retour);
    }
}else{
    echo json_encode([false,"Authentification failed"]);}
