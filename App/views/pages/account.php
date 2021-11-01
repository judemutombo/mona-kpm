<?php

use App\DbAuth\DbAuth;

if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect())
{
    header("Location: member/dashBoard");   
}else{
    Header("Location: login_signIn");
}