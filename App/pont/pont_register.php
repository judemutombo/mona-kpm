<?php
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';

if(isset($_POST["mail"]) && isset($_POST["pass"]))
{
    if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$_POST["mail"]))
    {

        $result = App::getInstance()->get_Db()->selectionner("SELECT * FROM user WHERE mail=?",[$_POST["mail"]],false);
        if(count($result))
        {
            $table = array(false,3);
            echo json_encode($table);
        }
        else{
            if(preg_match("#^[a-zA-Z0-9]{4,15}$#",$_POST['pass']))
            {
                $_SESSION['temp_mail'] = $_POST['mail'];
                $_SESSION['temp_pass'] = $_POST['pass'];
                $_SESSION['temp_check'] = true;
                $link = "member/login_signIn?role=23/"."tsmkp3e3gbddgh?rb95sltzzdgvf=5zze?mg7367rsTby=SUN";

                $table = array(true,$link);
                echo json_encode($table);
            }else{
                $table = array(false,2);
                echo json_encode($table);
            }
        }
    }
    else{
        $table = array(false,1);
        echo json_encode($table);
    }
}
else{
    $table = array(false,"error 33");
    echo json_encode($table);
}