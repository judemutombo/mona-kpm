<?php

namespace App\Controller;

class ProductController extends MainController
{
    public function detail()
    {
        $this->render("product/detail","temp");
    }
}