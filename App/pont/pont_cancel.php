<?php
if(isset($_POST["code"])){
    $verif = App::getInstance()->get_Db()->selectionner("SELECT * FROM orders WHERE product_id=?",[$_POST["code"]],false);
    if(count($verif) == 1)
    {
        $nbr = App::getInstance()->get_Db()->update("UPDATE orders SET status_=? WHERE product_id=?",[canceled,$_POST["code"]]);
        if($nbr == 1)
        {
            $retour = array(true,"145");
            echo json_encode($retour);
        }else{
            $retour = array(false,"error 8477");
            echo json_encode($retour);
        }
    }else{
        $retour = array(false,"error 8475");
        echo json_encode($retour);
    }
}
else{
    $retour = array(false,"error 8465");
    echo json_encode($retour);
}