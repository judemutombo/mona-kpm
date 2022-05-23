<?php

use App\DbAuth\DbAuth;
use App\User\User;
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';
function generate_id()
{
    $aleatoire = 0;
    $dec='A'; 
    $de = array();
    for ($i = 0; $i < 8; $i++)
    {
        $aleatoire = rand(0,35);
        if($aleatoire >=26)
        {
            $aleatoire =35 - $aleatoire;
            switch ($aleatoire)
            {
                case 0:
                    $de[$i]='0';
                case 1:
                    $de[$i]='1';
                    break;
                case 2:
                    $de[$i]='2';
                    break;
                case 3:
                    $de[$i]='3';
                    break;
                case 4:
                    $de[$i]='4';
                    break;
                case 5:
                    $de[$i]='5';
                    break;
                case 6:
                    $de[$i]='6';
                    break;
                case 7:
                    $de[$i]='7';
                    break;
                case 8:
                    $de[$i]='8';
                    break;
                case 9:
                    $de[$i]='9';
                    break;
            }
        }
        else{
            for ($j=0; $j < $aleatoire; $j++) { 
                $dec= ++$dec;
            }
            $de[$i] = $dec;
        }
        $dec='A'; 
    }

return implode($de);
}
if( DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){
    
if(isset($_POST["type"]) && $_POST["type"] ==="source")
{
    if(isset($_POST["name"]) && isset($_POST["sname"]) && isset($_POST["address"]) && isset($_POST["address2"]) && isset($_POST["phone"]) && isset($_POST["district"]))
    {
        if(preg_match("#^[a-zA-Z]{2,}$#",$_POST["name"]))
        {
            if(preg_match("#^[a-zA-Z]{2,}$#",$_POST["sname"]))
            {
                if(preg_match("#^[0-9]{10}$#",$_POST["phone"]))
                {
                    $_POST["address"] = htmlspecialchars($_POST["address"]);
                    $_POST["address2"] = htmlspecialchars($_POST["address2"]);
                    $_SESSION["order"] = [true,$_POST["name"],$_POST["sname"],$_POST["address"],$_POST["address2"],$_POST["phone"],$_POST["district"]];

                    $retour = [true,"023"];
                    echo json_encode($retour);
                }
                else{
                    $table = array(false,"error 8459");
                    echo json_encode($table);
                }
            }
            else{
                $table = array(false,"error 8476");
                echo json_encode($table);
            }
        }
        else{
            $table = array(false,"error 8446");
            echo json_encode($table);
        }
    }
    else{
        $retour = [false,"error 8456"];
        echo json_encode($retour);
    }
}
else if(isset($_POST["type"]) && $_POST["type"] ==="confirm")
{
    $orderData=$_POST["order"];
    $px = (int)$orderData["purchase_units"][0]["amount"]["value"];
    $curr1 = $orderData["purchase_units"][0]["amount"]["currency_code"];
    $pxt = $_SESSION["temp_checkout"][5];
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
    if($curr1 != $curr && $px =! $pxt ){
        $retour = [false,"Wrong data"];
        echo json_encode($retour);
    }else{
        $order = App::getInstance()->get_Db()->selectionner("SELECT * FROM product WHERE prod_code =?",[$_SESSION["temp_checkout"][2]],true);
            $orderOffer = 1;
            $status = "progress";
            $orderCode=null;
            do{
                $orderCode = generate_id();
                $reuslt = App::getInstance()->get_Db()->selectionner("SELECT * FROM orders WHERE code=?",[$orderCode],false);
            }while(count($reuslt) > 0 );
            if(App::getInstance()->get_Db()->inserer("INSERT INTO orders(code,sellerInfo,product_id,amount,status_,buyerInfo,totalPrice,devise_,addr1,addr2) VALUES(?,?,?,?,?,?,?,?,?,?)",[$orderCode,$order->owner,$order->prod_code,$orderOffer,$status,$_SESSION["user"],$_POST["tPrice"],$_POST["currency_code"],$_SESSION["order"][3],$_SESSION["order"][4]]))
            {
                $owner = App::getInstance()->get_Db()->selectionner("SELECT * FROM user WHERE mona_id = ?",[$order->owner],true);
                $identity = User::getInstance(App::getInstance()->get_Db())->getfullidentity();
                App::getInstance()->get_Db()->inserer("INSERT INTO payment(user,system,date,currency,amount,payment_id,merchand_id) VALUES(?,?,?,?,?,?,?)",[$identity->profile_id,"paypal",date("Y-m-d h:m:s"),$_POST["currency_code"],$_POST["tPrice"],$_POST["order"]["id"],$owner->profile_id]);
                if($_SESSION["temp_checkout"][6])
                {
                    App::getInstance()->get_Db()->update("UPDATE offer SET state_=? WHERE code =?",["accept",$_SESSION["temp_checkout"][3]]);
                    App::getInstance()->get_Db()->update("UPDATE offer SET state_=? WHERE product=? AND code != ?",["sold",$_SESSION["temp_checkout"][2],$_SESSION["temp_checkout"][3]]);
                    $content = $_SESSION["username"]." has payed {$_POST["currency_code"]} {$_SESSION["temp_checkout"][5]} for your product, be ready our deliverer will be there by tomorrow to take the product for delivery";
                    App::getInstance()->get_Db()->inserer("INSERT INTO notification(content,type,user,ref_offer,lecture) VALUES(?,?,?,?,?)",[$content,"payment",$order->owner,$_SESSION["temp_checkout"][3],"UNREAD"]);
                }
                else{
                    App::getInstance()->get_Db()->update("UPDATE offer SET state_ =? WHERE product=?",["sold",$_SESSION["temp_checkout"][2]]);
                    $content = $_SESSION["username"]." has payed {$_POST["currency_code"]} {$_SESSION["temp_checkout"][5]} for your product, be ready our deliverer will be there by tomorrow to take the product for delivery";
                    App::getInstance()->get_Db()->inserer("INSERT INTO notification(content,type,user,prod_ref,lecture) VALUES(?,?,?,?,?)",[$content,"payment",$order->owner,$_SESSION["temp_checkout"][2],"UNREAD"]);
                }
                App::getInstance()->get_Db()->update("UPDATE product SET state=? WHERE prod_code=?",["sold",$order->prod_code]);
                $_SESSION["temp_checkout"][0] = false;
                unset($_SESSION["temp_checkout"]);
                $retour = [true,$_SESSION["temp_url"]];
                unset($_SESSION["temp_url"]);
                echo json_encode($retour);
            }else{
                $retour = [true,"error 59782"];
                echo json_encode($retour);
            }
        
    }
    
}
else{
    $retour = [false,"error 79863"];
    echo json_encode($retour);
}
}else{
    echo json_encode([false,"Authentification failed"]);
}

