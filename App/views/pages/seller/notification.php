<?php
        $notification = App::getInstance()->get_Db()->selectionner("SELECT * FROM notification WHERE user=? ORDER BY id DESC",[$_SESSION["user"]]);
        foreach ($notification as $item) :
            if($item->type ==="offer")
            {
                $classname = $item->lecture === "UNREAD" ? 'class="notification-offer-button unread"' : 'class="notification-offer-button read"';
                $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer INNER JOIN product ON  offer.product = product.prod_code WHERE  code =?",[$item->ref_offer],true);
                ?>
                <button type="button" <?=$classname?> id="offer-button" data-id=<?=$item->id?>><?=$item->content;?></button>
                <div class="notification-offer-content" id="offer-content">
                    <div class="offer-content-img">
                        <img width="100%" height="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1);?>>
                    </div>
                    <div class="offer-content-info">

                        <p><?=$product->name_."  "?>Price : <?=$product->devise." ".$product->price?></p>
                        <?php
                        $currency = null;
                        switch ($product->devise_)
                        {
                            case "EUR" : $currency ="€"; break;
                            case "GBP" : $currency ="£"; break;
                            case "USD" : $currency ="$"; break;
                            default : $currency ="₺";
                        }
                        ?>
                        <p>His(her) proposition : <?=$currency."".$product->price_?></p>
                        <div >
                            <?php
                            if($product->state_ === "waiting")
                            {
                            ?>
                                <button type="button" class="btn-accept" id="offer-accept" data-code=<?=$item->ref_offer?>>Accept</button>
                                <button type="button" class="btn-decline" id="offer-decline" data-code=<?=$item->ref_offer?>>Decline</button>
                            <?php
                            }
                            else{
                                echo '<p>'.$product->state_.'</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr class="limit-notif">
            <?php
            }
            else if($item->type === "purchase")
            {
                $classname = $item->lecture === "UNREAD" ? 'class="notification-offer-button unread"' : 'class="notification-offer-button read"';
                $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer INNER JOIN product ON  offer.product = product.prod_code WHERE  code =?",[$item->ref_offer],true);

                ?>
                <button type="button" <?=$classname ?> id="offer-button" data-id=<?=$item->id?>><?=$item->content;?></button>
                <div class="notification-offer-content" id="offer-content">
                    <div class="offer-content-img">
                        <img width="100%" height="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1);?>>
                    </div>
                    <div class="offer-content-info">

                        <p><?=$product->name_?></p>
                        <?php
                        $currency = null;
                        switch ($product->devise_)
                        {
                            case "EUR" : $currency ="€"; break;
                            case "GBP" : $currency ="£"; break;
                            case "USD" : $currency ="$"; break;
                            default : $currency ="₺";
                        }
                        ?>
                        <p>Price :  <?=$currency."".$product->price_?></p>
                        <div>
                            <?php if($product->state_ == "progress")
                            {?>
                                <button class="btn-accept payment" type="button" id="btn_payment" data-off=<?=$item->ref_offer?> >proceed to payment</button>
                                <?php
                            }else if($product->state_ == "accept" && $product->sender == $_SESSION["user"])
                            {?>
                                <p>Paid</p>
                                <?php
                            }else{
                                echo'<p>Sold</p>';
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <hr class="limit-notif">
            <?php
            }
            else if($item->type === "response")
            {
                $classname = $item->lecture === "UNREAD" ? 'class="notification-offer-button unread"' : 'class="notification-offer-button read"';
                ?>

                <button type="button" <?=$classname?> id="offer-button" data-id=<?=$item->id?>><?=$item->content;?></button>
                <div class="notification-offer-content" id="offer-content">
                    <button class="btn-send another" type="button" >send another offer</button>
                </div>
                <hr class="limit-notif">
           <?php 
           }
            else if($item->type === "payment")
            {
                $classname = $item->lecture === "UNREAD" ? 'class="notification-offer-button unread"' : 'class="notification-offer-button read"';
                ?>
                <button type="button" <?= $classname?> id="offer-button" data-id=<?=$item->id?>><?=$item->content;?></button>
                <?php
                if(!$item->ref_offer== null)
                {
                    $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM offer INNER JOIN product ON  offer.product = product.prod_code WHERE  code =?",[$item->ref_offer],true);
                    ?>
                    <div class="notification-offer-content" id="offer-content">
                    <div class="offer-content-img">
                        <img width="100%" height="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1);?>>
                    </div>
                    <div class="offer-content-info">

                        <p><?=$product->name_?></p>
                        <?php
                        $currency = null;
                        switch ($product->devise_)
                        {
                            case "EUR" : $currency ="€"; break;
                            case "GBP" : $currency ="£"; break;
                            case "USD" : $currency ="$"; break;
                            default : $currency ="₺";
                        }
                        ?>
                        <p>Price :  <?=$currency."".$product->price_?></p>
                        <div>
                            <button type="button" class="btn-accept" id="see-offer-accept" data-code=<?="product-detail/".str_replace(" ","-",$product->category."/".$product->prod_code." ".$product->name_)?>>See product</button>
                        </div>
                    </div>

                </div>
                    <?php
                }else{
                    $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM product WHERE prod_code =?",[$item->prod_ref],true);
                    ?>
                    <div class="notification-offer-content" id="offer-content">
                    <div class="offer-content-img">
                        <img width="100%" height="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1);?>>
                    </div>
                    <div class="offer-content-info">

                        <p><?=$product->name_?></p>
                        <?php
                        $currency = null;
                        switch ($product->devise)
                        {
                            case "EUR" : $currency ="€"; break;
                            case "GBP" : $currency ="£"; break;
                            case "USD" : $currency ="$"; break;
                            default : $currency ="₺";
                        }
                        ?>
                        <p>Price :  <?=$currency."".$product->price?></p>
                        <div>
                            <button type="button" class="btn-accept" id="see-offer-accept" data-code=<?="product-detail/".str_replace(" ","-",$product->category."/".$product->prod_code." ".$product->name_)?>>See product</button>
                        </div>
                    </div>

                </div>
                    <?php
                }
                ?>            
                <hr class="limit-notif">
            <?php 
            }
            endforeach;
            ?>