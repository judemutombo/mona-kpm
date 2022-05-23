<?php
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';
if(isset($_GET["url"]) && isset($_GET["type"]))
{
    if(\App\DbAuth\DbAuth::getAuth(App::getInstance()->get_Db())->isConnect())
    {
        $retour = [true];
        echo  json_encode($retour);
    }
    else{
        $retour = [false];
        if($_GET["type"]=="buy"){
            $_SESSION["temporary_link"] = $_GET["url"];
        }else{
            $_SESSION["temporary_link"] = $_GET["url"]."?offer=1";
        }
        
        echo json_encode($retour);
    }
}

