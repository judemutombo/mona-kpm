<?php
use App\DbAuth\DbAuth;
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT."/vendor/autoload.php";
require ROOT."/App/App.php";
if (isset($_POST["name"]) && isset($_POST["lname"]) && isset($_POST["phone"]) &&  isset($_POST["add"]) && isset($_POST["district"]))
{
    if(preg_match("#^[a-zA-Z]{2,}$#",$_POST["name"]))
    {
        if(preg_match("#^[a-zA-Z]{2,}$#",$_POST["lname"]))
        {
            if(preg_match("#^[0-9]{10}$#",$_POST["phone"]))
            {
                if(DbAuth::getAuth(App::getInstance()->get_Db())->inscription($_POST["name"],$_POST["lname"],$_POST["add"],$_SESSION["temp_mail"],$_SESSION["temp_pass"],$_POST["district"]))
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
                else{
                    $table = array(false,5);
                    echo json_encode($table);
                }
            }
            else{
                $table = array(false,2,3);
                echo json_encode($table);
            }
        }
        else{
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
    $table = array(false,"error 34");
    echo json_encode($table);
}
