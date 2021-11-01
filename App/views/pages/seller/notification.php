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
            <li><a href="member/orders"><i class="fa fa-clipboard"></i> Orders</a></li>
            <li><a href="member/product"><i class="fa fa-th-large"></i> Products</a></li>
            <li><a href="member/profile"><i class="fa fa-user-circle"></i> Profile</a></li>
            <li class="actif"><a href="member/notification"><i class="fa fa-bell"></i> Notification</a></li>
            <li><a href="member/help_center"><i class="fa fa-question"></i> Help Center</a></li>
        </ul>
    </div>
    <div class="output">
        <?php
        $notification = App::getInstance()->get_Db()->selectionner("SELECT * FROM notification WHERE user=?",[$_SESSION["user"]]);

        foreach ($notification as $item) :
            if($item->type ==="offer")
            {
                $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer INNER JOIN product ON  offer.product = product.prod_code WHERE  code =?",[$item->ref_offer],true);
            ?>
                <button type="button" class="notification-offer-button" id="offer-button"><?=$item->content;?></button>
                <div class="notification-offer-content" id="offer-content">
                    <div class="offer-content-img">
                        <img width="100%" height="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1);?>>
                    </div>
                    <div class="offer-content-info">

                        <p><?=$product->name?></p>
                        <p>Price : <?=$product->devise." ".$product->price?></p>
                        <p>His(her) proposition : <?=$product->devise_." ".$product->price_?></p>
                        <div >
                            <?php
                            if($product->state === "waiting")
                            {
                            ?>
                                <button type="button" class="btn-accept" id="offer-accept" data-code=<?=$item->ref_offer?>>Accept</button>
                                <button type="button" class="btn-decline" id="offer-decline" data-code=<?=$item->ref_offer?>>Decline</button>
                            <?php
                            }
                            else{
                                echo '<p>'.$product->state.'</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr class="limit-notif">
            <?php
            }
            else if($item->type === "purchase")
            {?>
                <button type="button" class="notification-offer-button" id="offer-button"><?=$item->content;?></button>
                <div class="notification-offer-content" id="offer-content">
                    <p>proceed to payment</p>
                </div>
                <hr class="limit-notif">
            <?php
            }
            endforeach;
            ?>
    </div>
</div>
