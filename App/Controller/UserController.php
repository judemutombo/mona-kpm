<?php
namespace App\Controller;

class UserController extends MainController{

     public function home()
    {
        $this->render("home","temp");
    }

    public function account()
    {
        $this->render("account","temp1");
    }

    public function login_signIn()
    {
        $this->render("login","temp1");
    }

    public function page_selling()
    {
        $this->render("page_selling","temp");
    }
    public function member()
    {
        $this->render("signInMember","temp1");
    }
}