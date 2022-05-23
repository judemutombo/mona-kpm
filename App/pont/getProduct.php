<?php
use App\DbAuth\DbAuth;
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT."/vendor/autoload.php";
require ROOT."/App/App.php";
if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){
    $db = App::getInstance()->get_Db();
    $result = $db->selectionner("SELECT product.condition,product.price,product.devise,product.name_,product.state,product.prod_code FROM product WHERE owner =?",[$_SESSION['user']],false);
    $retour  = null;
    if(!$result){
        $retour = array(false,"no product");
    }else{
        if(count($result) == 0){
            $retour = array(false,"no product"); 
        }else{
            $retour = array(true,$result);
        }   
    }
    
    echo json_encode($retour);
}else{
    echo json_encode([false,"Authentification failed"]);
}
if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){

}else{
    echo json_encode([false,"Authentification failed"]);
}