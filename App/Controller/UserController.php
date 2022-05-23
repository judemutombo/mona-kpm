<?php
namespace App\Controller;

class UserController extends MainController{

     public function home()
    {
        $this->render("home","temp");
    }

    public function account()
    {
        $this->render("account","temp2");
    }

    public function login_signIn()
    {
        $this->render("login","temp2");
    }

    public function page_selling()
    {
        $this->render("page_selling","temp4");
    }
    public function member()
    {
        $this->render("signInMember","temp2");
    }
    public function checkout()
    {
        $this->render("checkout","temp3");
    }
    public function search(){
        $this->render("search","temp");
    }
}