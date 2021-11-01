<?php
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';

if (isset($_POST["name"]) && isset($_POST["lastname"]) && isset($_POST["address"])  && isset($_POST["district"]) && isset($_POST["mail"]))
{
    $db = App::getInstance()->get_Db();
    if ($db->update("UPDATE user SET name =?,surname=?,address=?,mail=?,district=? WHERE mona_id=?",[$_POST["name"],$_POST["lastname"], $_POST["address"], $_POST["mail"],$_POST["district"],$_SESSION['user']]))
    {
        $retour = array(true,"ok");
        echo json_encode($retour);
    }
    else{
        $retour =array(false,"error 157");
        echo json_encode($retour);
    }

}
else{
    $retour =array(false,"error 156");
    echo json_encode($retour);
}
