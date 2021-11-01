<?php
use App\DbAuth\DbAuth;
use App\User\User;

session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';

if(isset($_POST["id"]) && isset($_POST["offer"]))
{
    $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM product WHERE prod_code = ?",[$_POST["id"]]);
    $db = App::getInstance()->get_Db();
    $user = User::getInstance($db)->getfullidentity();
    if(count($product) == 1)
    {
        $code = null;
        do{
            $aleatoire = 0;
            $dec='A';
            $de = array();
            for ($i = 0; $i < 6; $i++)
            {
                $aleatoire = rand(0,35);
                if($aleatoire >=26)
                {
                    $aleatoire =35 - $aleatoire;
                    switch ($aleatoire)
                    {
                        case 0:
                            $de[$i]='0';
                        case 1:
                            $de[$i]='1';
                            break;
                        case 2:
                            $de[$i]='2';
                            break;
                        case 3:
                            $de[$i]='3';
                            break;
                        case 4:
                            $de[$i]='4';
                            break;
                        case 5:
                            $de[$i]='5';
                            break;
                        case 6:
                            $de[$i]='6';
                            break;
                        case 7:
                            $de[$i]='7';
                            break;
                        case 8:
                            $de[$i]='8';
                            break;
                        case 9:
                            $de[$i]='9';
                            break;
                    }
                }
                else{
                    for ($j=0; $j < $aleatoire; $j++) {
                        $dec= ++$dec;
                    }
                    $de[$i] = $dec;
                }
                $dec='A';
            }
            $code = $_SESSION['user'].''.implode($de);
            $result = $db->selectionner("SELECT * FROM offer WHERE code=?",[$code],false);
        }while(count($result) > 0 );

        if($db->inserer("INSERT INTO offer(product,sender,receiver,state,date,price_,code) VALUES(?,?,?,?,?,?,?)",[$_POST["id"],$_SESSION["user"],$product[0]->owner,"waiting",date("Y-m-d"),$_POST["offer"],$code]))        {
            $content = $user->name." ".$user->surname." sent you an offer";
            if ($db->inserer("INSERT INTO notification(content,type,user,ref_offer) VALUES(?,?,?,?) ",[$content,"offer",$product[0]->owner,$code]))
            {
                $retour = [true,"Your offer has been sent succesfully"];
                echo json_encode($retour);
            }
            else{
                $db->delete("DELETE FROM offer WHERE code=?",[$code]);
                $retour = [false,"error 213"];
                echo json_encode($retour);
            }
        }
        else{
            $retour = [false,"error 216"];
            echo json_encode($retour);
        }
    }
    else{
        $retour = [false,"error 219"];
        echo json_encode($retour);
    }
}else{
    $retour = [false,"error 217"];
    echo json_encode($retour);
}
