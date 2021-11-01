<?php
require "vendor/autoload.php";
require './App/App.php';

use App\Controller\ProductController;
use App\Controller\RoleController;
use App\Controller\UserController;

define("ROOT",__DIR__);
session_start();

if(isset($_GET['url']))
{
    $_GET['url'] =htmlentities( $_GET['url']);
    $_GET['url'] = htmlspecialchars( $_GET['url']);

    $url = explode("/", $_GET['url']);
}
else{
    header("Location:home");
}
$controller = new UserController;
if($url[0] === "home")
{
    $controller->home();
}
else if($url[0] ==="login_signIn")
{
    $controller->login_signIn();
}
else if($url[0] ==="account")
{
    $controller->account();
}
else if($url[0]==="sell")
{
    if($url[1] === "sell-base")
    {
        $controller->page_selling();
    }
}
else if($url[0] === "member")
{
    if($url[1] === "login_signIn")
    {
        $controller->member();
    }
    else if($url[1] === "dashBoard")
    {
        $controller = new RoleController;
        $controller->dashBoard();
    }
    else if($url[1] === "orders")
    {
        $controller = new RoleController;
        $controller->orders();
    }
    else if($url[1] === "product")
    {
        $controller = new RoleController;
        $controller->product();
    }
    else if($url[1] ==="deconnection")
    {
        $controller = new RoleController;
        $controller->deconnection();
    }
    else if($url[1] === "profile")
    {
        $controller = new RoleController;
        $controller->profile();
    }
    else if($url[1] === "notification")
    {
        $controller = new RoleController;
        $controller->notification();
    }
}
else if($url[0] === "product-detail")
{
    $controller = new ProductController();
    $controller->detail();
}