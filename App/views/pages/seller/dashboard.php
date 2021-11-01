<?php

use App\DbAuth\DbAuth;
use App\User\User;
unset($_SESSION['temp_check']);
if(!Dbauth::getAuth(App::getInstance()->get_Db())->isConnect())
{
    header("Location: ../home");
}
?>
<div class="menu-control">
    <div class="sidenav">
        <ul class="sideMenu">
            <li class="actif"><a href="member/dashBoard"><i class="fa fa-home"></i> Overview</a></li>
            <li><a href="member/orders"><i class="fa fa-clipboard"></i> Orders</a></li>
            <li><a href="member/product"><i class="fa fa-th-large"></i> Products</a></li>
            <li><a href="member/profile"><i class="fa fa-user-circle"></i> Profile</a></li>
            <li><a href="member/notification"><i class="fa fa-bell"></i> Notification</a></li>
            <li><a href="member/help_center"><i class="fa fa-question"></i> Help Center</a></li>        
        </ul>
    </div>
    <div class="output">
        <?php $identity = User::getInstance(App::getInstance()->get_Db())->getfullidentity()?>
        <div class="userInfo">
            <p class="userInfo-name"><?= $_SESSION['username'];?> surname</p>
            <p class="userInfo-mail"><?= $identity->mail; ?></p>
            <ul>
                <li class="userInfo-location"><i class="fa fa-map-marker"></i><?= $identity->district ?></li>
                <li class="userInfo-product"><i class="fa fa-th-large"></i><?= User::getInstance(App::getInstance()->get_Db())->numberOfproduct();?> Product(s)</li>
                <li class="userInfo-order"><i class="fa fa-clipboard"></i> 4 Order(s)</li>
            </ul>
        </div>
        <div class="userLastOperation">
            <p>Last operation</p>
        </div>
    </div>
</div>
