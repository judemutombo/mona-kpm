<?php

use App\MyDatabase\MyDatabase;

class App{
    private static $instance = null;
    private $db_instance = null;
    public $title = "Mona";
    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new App;
        }
        return self::$instance;
    }
    public function getTitle()
    {   if(isset($_SESSION["user"])){ $$this->title = $_SESSION["username"];}
        return $this->title;
    }
    public function get_Db()
    {
        if($this->db_instance == null)
        {
            $this->db_instance = MyDatabase::getInstance();
        }
        return $this->db_instance;
    }
    public function getDeliveryFees($sl,$currency){
        $fees = $this->extraCharge($sl);
        switch ($currency)
        {
            case "USD" : $fees /= 14.98; break;
            case "EUR" : $fees /= 15.53; break;
            case "GBP" : $fees /= 18.30; break;
            case "TRY" : $fees /= 1; break;
        }
        $_SESSION['lastFees'] = ceil($fees);
        return ceil($fees);
    }
    public  function extraCharge($sl){
        $user = $this->get_Db()->selectionner("SELECT * FROM user WHERE mona_id=?",[$_SESSION["user"]],true);
        $seller = $this->get_Db()->selectionner("SELECT * FROM user WHERE mona_id=?",[$sl],true);

        if($user->district == "Magusa"){
            switch($seller->district){
                case "Gazimagusa" : 
                    return 40;
                    break;
                case "Lefkosa":
                    return 70;
                    break;
                case "Girne":
                    return 90;
                    break;
                case "Iskele":
                    return 120;
                    break;
                case "Guzelyurt":
                    return 100;
                    break;
                case "Lefke":
                    return 50;
                    break;
            }
        }
        else if($user->district == "Lefkosa"){
            switch($seller->district){
                case "Gazimagusa" : 
                    return 90;
                    break;
                case "Lefkosa":
                    return 40;
                    break;
                case "Girne":
                    return 50;
                    break;
                case "Iskele":
                    return 60;
                    break;
                case "Guzelyurt":
                    return 50;
                    break;
                case "Lefke":
                    return 60;
                    break;
            }
        }
        else if($user->district == "Girne"){
            switch($seller->district){
                case "Gazimagusa" : 
                    return 40;
                    break;
                case "Lefkosa":
                    return 50;
                    break;
                case "Girne":
                    return 40;
                    break;
                case "Iskele":
                    return 80;
                    break;
                case "Guzelyurt":
                    return 60;
                    break;
                case "Lefke":
                    return 60;
                    break;
            }
        }
        else if($user->district == "Iskele"){
            switch($seller->district){
                case "Gazimagusa" : 
                    return 60;
                    break;
                case "Lefkosa":
                    return 60;
                    break;
                case "Girne":
                    return 50;
                    break;
                case "Iskele":
                    return 40;
                    break;
                case "Guzelyurt":
                    return 45;
                    break;
                case "Lefke":
                    return 70;
                    break;
            }
        }
        else if($user->district == "Guzelyurt"){
            switch($seller->district){
                case "Gazimagusa" : 
                    return 100;
                    break;
                case "Lefkosa":
                    return 50;
                    break;
                case "Girne":
                    return 60;
                    break;
                case "Iskele":
                    return 45;
                    break;
                case "Guzelyurt":
                    return 40;
                    break;
                case "Lefke":
                    return 60;
                    break;
            }
        }
        elseif($user->district == "Lefke"){
            switch($seller->district){
                case "Gazimagusa" : 
                    return 50;
                    break;
                case "Lefkosa":
                    return 60;
                    break;
                case "Girne":
                    return 60;
                    break;
                case "Iskele":
                    return 70;
                    break;
                case "Guzelyurt":
                    return 60;
                    break;
                case "Lefke":
                    return 40;
                    break;
            }
        }
    }
}
