<?php
use App\DbAuth\DbAuth;
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';
if (isset($_POST["mail"]) && isset($_POST["pass"]))
{
    if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$_POST["mail"]))
    {
        if(preg_match("#^[a-zA-Z0-9]{4,15}$#",$_POST['pass']))
        {
            $result = DbAuth::getAuth(App::getInstance()->get_Db())->connexion($_POST["mail"],$_POST['pass']);
            if($result == 1)
            {
                if(isset($_SESSION["temporary_link"]))
                {
                    $link = $_SESSION["temporary_link"];
                    unset($_SESSION["temporary_link"]);
                }
                else{
                    $link = "member/dashBoard?role=83/"."tsmkp3e3gbddgh?rb95sltzzdgvf=5zze?mg7367rsTby=2";
                }

                $table = array(true,$link);
                echo json_encode($table);
            }
            else if($result == 2)
            {
                $table = array(false,4,"The account does not exist.");
                echo json_encode($table);
            }
            else if($result == 3)
            {
                $table = array(false,5,"Wrong password.");
                echo json_encode($table);
            }
        }else
        {
            $table = array(false,2);
            echo json_encode($table);
        }
    }
    else{
        $table = array(false,1);
        echo json_encode($table);
    }
}
else{
    $table = array(false,"erreur 59");
    echo json_encode($table);
}
