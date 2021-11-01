<?php
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';

if(isset($_POST["code"]))
{
    $_POST["code"] = htmlspecialchars($_POST["code"]);
    $_POST["code"] = html_entity_decode($_POST["code"]);
    $_POST["code"] = trim($_POST["code"]);
    $db = App::getInstance()->get_Db();

    $result = $db->delete("DELETE  FROM product WHERE prod_code=? AND owner =?",[$_POST["code"],$_SESSION['user']]);

    $retour = [true,$result];
    echo json_encode($retour);
}
else{

    $retour = [false,"erreur 202"];
    echo json_encode($retour);
}