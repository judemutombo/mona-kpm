<?php
use App\DbAuth\DbAuth;
use App\Product\ProductGroup\ProductGroup;

session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT."/vendor/autoload.php";
require ROOT."/App/App.php";
$db = App::getInstance()->get_Db();
$result = $db->selectionner("SELECT picture1 FROM product WHERE prod_code=?",[$_POST["id"]],true);
$retour  = null;
if(!is_object($result)){
    $retour = array(false,"no product");
}else{
    $retour = $result->picture1; 
}
echo $retour;