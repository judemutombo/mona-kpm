<?php
session_start();
if(isset($_POST["deleteAll"]))
{
    unset($_SESSION["prod_image"]);
    unset($_SESSION["img_to_delete"]);
    echo "deleted";
}
else{
    if(isset($_POST["number"]))
    {
        array_push($_SESSION["img_to_delete"],$_POST["number"]);
        var_dump($_SESSION["img_to_delete"]);
    }
}
