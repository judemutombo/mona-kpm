<?php
session_start();
define("ROOT", dirname(__DIR__, 2));
if(isset($_SESSION["prod_image"]))
{
    $key = count($_SESSION["prod_image"]);
    if(!is_dir(ROOT."/tmpfile/".$_SESSION['user']))
    {
        if(mkdir(ROOT."/tmpfile/".$_SESSION['user'],0777,true))
        {
            $path = ROOT."/tmpfile/".$_SESSION['user']."/".basename($_FILES['filedata']['name']);
            move_uploaded_file($_FILES["filedata"]["tmp_name"],$path);
            $tab = [$key => [$_FILES["filedata"]["name"],$path,$_FILES["filedata"]["size"]] ];
            $_SESSION["prod_image"] += $tab;
        }
        else{
            $retour = [false,"filesystem error"];
            echo  json_encode($retour);
        }
    }
    else{
        $path = ROOT."/tmpfile/".$_SESSION['user']."/".basename($_FILES['filedata']['name']);
        move_uploaded_file($_FILES["filedata"]["tmp_name"],$path);
        $tab = [$key => [$_FILES["filedata"]["name"],$path,$_FILES["filedata"]["size"]] ];
        $_SESSION["prod_image"] += $tab;
    }
}
else{
    $_SESSION["prod_image"] = [];
    $_SESSION["img_to_delete"]=[];
    $key = count($_SESSION["prod_image"]);
    if(!is_dir(ROOT."/tmpfile/".$_SESSION['user']))
    {
        if(mkdir(ROOT."/tmpfile/".$_SESSION['user'],0777,true))
        {
            $path = ROOT."/tmpfile/".$_SESSION['user']."/".basename($_FILES['filedata']['name']);
            move_uploaded_file($_FILES["filedata"]["tmp_name"],$path);
            $tab = [$key => [$_FILES["filedata"]["name"],$path,$_FILES["filedata"]["size"]] ];
            $_SESSION["prod_image"] += $tab;
        }
        else{
            $retour = [false,"filesystem error"];
            echo  json_encode($retour);
        }
    }
    else{
        $path = ROOT."/tmpfile/".$_SESSION['user']."/".basename($_FILES['filedata']['name']);
        move_uploaded_file($_FILES["filedata"]["tmp_name"],$path);
        $tab = [$key => [$_FILES["filedata"]["name"],$path,$_FILES["filedata"]["size"]] ];
        $_SESSION["prod_image"] += $tab;
    }
}

var_dump($_SESSION["prod_image"]);
