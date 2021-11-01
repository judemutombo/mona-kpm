<?php
use App\DbAuth\DbAuth;
use App\User\User;

session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';
$user = User::getInstance(App::getInstance()->get_Db())->getfullidentity();
if (isset($_POST["code"]) && isset($_POST["state"]))
{
    if(strlen($_POST["code"]) == 6 && ($_POST["state"] === "accept" || $_POST["state"] === "refuse"))
    {
        $offer = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer WHERE code =?",[$_POST["code"]],true);
        if (is_object($offer))
        {
            $primitive = $offer->state;
            $state = null;
            $content=null;
            if($_POST["state"] === "accept"){
                $state = "progress";
                $content = $user->name." ".$user->surname." has accepted your offer, please proceed to the checkout";
            }
            else{
                $state = "refuse";
                $content = $user->name." ".$user->surname." has refused your offer";
            }
            if(App::getInstance()->get_Db()->update("UPDATE offer SET state  =? WHERE code =?",[$state,$_POST["code"]]))
            {
                $type = "response";
                if($_POST["state"] === "accept")
                {
                    $type ="purchase";
                }
                if(App::getInstance()->get_Db()->inserer("INSERT INTO notification(content,type,user,ref_offer) VALUES(?,?,?,?) ",[$content,$type,$offer->sender,$_POST["code"]]))
                {
                    $response = "Your answwer has been sent succesfully.";
                    if($_POST["state"] === "accept")
                    {
                        $response."/n While waiting for your customer to proceed with the payement, you can always accept another in case it is lagging.";
                    }
                    $retour = [true,$response];
                    echo json_encode($retour);
                }
                else{
                    App::getInstance()->get_Db()->update("UPDATE offer SET state  =? WHERE code =?",[$primitive,$_POST["code"]]);
                    $retour = [false,"error 213"];
                    echo json_encode($retour);
                }
            }
            else{
                $retour = [false,"error 567"];
                echo  json_encode($retour);
            }
        }else{
            $retour = [false,"error 562"];
            echo  json_encode($retour);
        }
    }else{
        $retour = [false,"error 564"];
        echo  json_encode($retour);
    }

}else{
    $retour = [false,"error 569"];
    echo  json_encode($retour);
}