<?php
session_start();

define("ROOT", dirname(__DIR__, 2));
require ROOT.'/vendor/autoload.php';
require ROOT.'/App/App.php';


if(!isset($_SESSION["prod_image"]) || count($_SESSION["prod_image"]) < 4 )
{
    $retour =[false,"Please upload images (more than 3)"];
    echo json_encode($retour);
}
else{
    if(isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["devise"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["condition"]))
    {
        $_POST["name"] = htmlspecialchars($_POST["name"]);
        $_POST["name"] = html_entity_decode($_POST["name"]);
        $_POST["name"] = trim($_POST["name"]);

        $_POST["price"] = htmlspecialchars($_POST["price"]);
        $_POST["price"] = html_entity_decode($_POST["price"]);
        $_POST["price"] = trim($_POST["price"]);
        $_POST["price"] = (int)$_POST["price"];

        $_POST["devise"] = htmlspecialchars($_POST["devise"]);
        $_POST["devise"] = html_entity_decode($_POST["devise"]);
        $_POST["devise"] = trim($_POST["devise"]);

        $_POST["category"] = htmlspecialchars($_POST["category"]);
        $_POST["category"] = html_entity_decode($_POST["category"]);
        $_POST["category"] = trim($_POST["category"]);

        $_POST["description"] = htmlspecialchars($_POST["description"]);
        $_POST["description"] = html_entity_decode($_POST["description"]);
        $_POST["description"] = trim($_POST["description"]);

        $_POST["condition"] = htmlspecialchars($_POST["condition"]);
        $_POST["condition"] = html_entity_decode($_POST["condition"]);
        $_POST["condition"] = trim($_POST["condition"]);

        $code = null;
        $db = App::getInstance()->get_Db();
        do{
            $aleatoire = 0;
            $dec='A';
            $de = array();
            for ($i = 0; $i < 9; $i++)
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
            $result = $db->selectionner("SELECT * FROM product WHERE prod_code=?",[$code],false);
        }while(count($result) > 0 );

        $i=0;
        $part=" ";
        $part2=" ";
        while (count($_SESSION["prod_image"])>$i)
        {
            ++$i;
            $part = $part.",picture".$i;
            $part2 = $part2.",?";
        }
        $query = "INSERT INTO product (`describe`, `condition`, price, devise, owner, name, prod_code, category".$part.")VALUES (?,?,?,?,?,?,?,?".$part2.")";
        $parametres = [$_POST["description"],$_POST["condition"],$_POST["price"],$_POST["devise"],$_SESSION['user'],$_POST["name"],$code,$_POST["category"]];
        foreach ($_SESSION["prod_image"] as $key => $image)
        {
            $file = (file_get_contents($image[1]));
            array_push($parametres,$file);
        }
        if($db->inserer($query,$parametres))
        {
            $retour = [true,"new item added"];
            foreach ($_SESSION["img_to_delete"] as $index)
            {
                unset($_SESSION["prod_image"][(int)$index]);
            }
            echo json_encode($retour);
        }
        else{
            $retour = [false,"server error"];
            echo json_encode($retour);
        }

    }else{
        $retour =[false,$_POST];
        echo json_encode($retour);
    }
}
