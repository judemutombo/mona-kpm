<?php
use App\DbAuth\DbAuth;
use App\Notification\Notification;

session_start();
define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';


if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){
    if(isset($_GET["cpt"])){
        $_GET["cpt"] = (int)$_GET["cpt"];
        if(is_int($_GET["cpt"])){
            if(Notification::setRead($_GET["cpt"])){
                echo json_encode([true,Notification::unreadNotification()]);
            }else{
                echo json_encode([false,"56"]);
            }
        }
    }else{
        echo json_encode([false,"failed"]);
    }

}else{
    echo json_encode([false,"Authentification failed"]);
}