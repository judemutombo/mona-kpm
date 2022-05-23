<?php

use App\DbAuth\DbAuth;

session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';

if( DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){
    if(isset($_POST["code"]))
    {
        if(strlen($_POST["code"])==24){
            $_POST["code"] = htmlspecialchars($_POST["code"]);
            $_POST["code"] = html_entity_decode($_POST["code"]);
            $_POST["code"] = trim($_POST["code"]);
            $db = App::getInstance()->get_Db();
            $order = $db->selectionner("SELECT * FROM orders WHERE product_id = ? AND status_=?",[$_POST["code"],"progress"],true);
            if(!is_object($order)){
                $db->delete("DELETE  FROM notification WHERE prod_ref=?",[$_POST["code"]]);
                $db->delete("DELETE  FROM offer WHERE product=?",[$_POST["code"]]);
                $result = $db->delete("DELETE  FROM product WHERE prod_code=? AND owner =?",[$_POST["code"],$_SESSION['user']]);
                if($result){
                    $retour = [true,$result];
                    echo json_encode($retour);
                }else{
                    $retour = [false,"error 217"];
                    echo json_encode($retour);
                }
            }else{
                    $retour = [false,"You cannot delete this item, there is an order in progress"];
                    echo json_encode($retour);
            }
            
        }else{
            $retour = [false,"error 218"];
            echo json_encode($retour);
        }
        
    }
    else{
    
        $retour = [false,"error 202"];
        echo json_encode($retour);
    }
}else{
    echo json_encode([false,"Authentification failed"]);
}
