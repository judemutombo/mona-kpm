<?php
namespace App\Controller;

class RoleController extends MainController{

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