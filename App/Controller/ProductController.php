<?php

namespace App\Controller;

class ProductController extends MainController
{
    public function detail()
    {
        $this->render("product/detail","temp");
    }
    public function category()
    {
        $this->render("product/category","temp");
    }
    public function userProfile(){
        $this->render("product/userProfile","temp");
    }
}
