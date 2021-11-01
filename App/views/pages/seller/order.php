<?php

use App\DbAuth\DbAuth;

unset($_SESSION['temp_check']);
if(!Dbauth::getAuth(App::getInstance()->get_Db())->isConnect())
{
    header("Location: ../home");
}
?>
<div class="menu-control">
    <div class="sidenav">
        <ul class="sideMenu">
            <li ><a href="member/dashBoard"><i class="fa fa-home"></i> Overview</a></li>
            <li class="actif"><a href="member/orders"><i class="fa fa-clipboard"></i> Orders</a></li>
            <li><a href="member/product"><i class="fa fa-th-large"></i> Products</a></li>
            <li><a href="member/profile"><i class="fa fa-user-circle"></i> Profile</a></li>
            <li><a href="member/notification"><i class="fa fa-bell"></i> Notification</a></li>
            <li><a href="member/help_center"><i class="fa fa-question"></i> Help Center</a></li>        
        </ul>
    </div>
    <div class="output">

    </div>
</div>
