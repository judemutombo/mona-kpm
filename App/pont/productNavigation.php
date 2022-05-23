<?php
use App\DbAuth\DbAuth;
use App\Product\ProductGroup\ProductGroup;

session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT."/vendor/autoload.php";
require ROOT."/App/App.php";
$db = App::getInstance()->get_Db();
if(isset($_POST["limit"]) && isset($_POST["token"]) && isset($_POST["type"])){
    
    if($_POST["type"] == "profile"){
        if(strlen($_POST["token"]) == 15){
            $query ="SELECT product.condition,product.price,product.devise,product.name_,product.state,product.prod_code,product.category FROM product WHERE owner = ? ORDER BY id LIMIT 5 OFFSET ".$_POST["limit"];
            $result = $db->selectionner($query,[$_POST["token"]],false);
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
            echo json_encode([false,"token size invalid"]);
        }
    }elseif($_POST["type"] == "main") {
        $query ="SELECT product.condition,product.price,product.devise,product.name_,product.state,product.prod_code,product.category FROM product ORDER BY id LIMIT 5 OFFSET ".$_POST["limit"];
        $result = $db->selectionner($query,null,false);
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
    }elseif($_POST["type"] == "search"){
        $token =$_POST["token"];
        $query ="SELECT product.condition,product.price,product.devise,product.name_,product.state,product.prod_code,product.category FROM product INNER JOIN user ON product.owner= user.mona_id WHERE name_ LIKE '%$token%'  LIMIT 5 OFFSET ".$_POST["limit"];
        $result = $db->selectionner($query,null,false);
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
    }elseif($_POST["type"] == "category"){
        $query ="SELECT product.condition,product.price,product.devise,product.name_,product.state,product.prod_code,product.category FROM product INNER JOIN user ON product.owner= user.mona_id WHERE category =? LIMIT 5 OFFSET ".$_POST["limit"];
        $result = $db->selectionner($query,[$_POST["token"]],false);
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
    }
    
}else{
    echo json_encode([false,"param missing"]);
}
