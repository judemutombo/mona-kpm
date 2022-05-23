<?php
namespace App\Controller;

use App;
use App\DbAuth\DbAuth;
class RoleController extends MainController{
    function __construct(){
        if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect()){
            App::getInstance()->title = $_SESSION["username"];
        }else{
            App::getInstance()->title ="Mona";
        }
    }

    public function dashBoard()
    {
        $this->render("seller/dashboard","temp1");
    }

    public function orders()
    {
        $this->render("seller/order","temp1");
    }

    public function product()
    {
        $this->render("seller/product","temp1");
    }

    public function profile()
    {
        $this->render("seller/profile","temp1");
    }
    public function deconnection()
    {
        $this->render("seller/deconnect","temp1");
    }
    public function notification()
    {
        $this->render("seller/notification","temp1");
    }
}
