<div class="order-tables">
    <div>
        <?php
        $orders = App::getInstance()->get_Db()->selectionner("SELECT * FROM orders INNER JOIN product ON orders.product_id=product.prod_code WHERE sellerInfo=?",[$_SESSION['user']],false);
        //var_dump($orders);
        ?>
        <p class="order-title">Awaiting delivery</p>
        <table class="product-table">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Devise</th>
                <?php 
                if(1<0){ 
                    ?>
                    <th scope="col">Action</th>
                <?php 
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $position = 1;
            foreach($orders as $order) :
                ?>
                <tr>
                    <td data-label="Product"><a class="order-link" href=<?="product-detail/".str_replace(" ","-",$order->category."/".$order->prod_code." ".$order->name_)?> ><?=$order->name_?></a></td>
                    <td data-label="Status"><?=$order->status_?></td>
                    <td data-label="Price"><?=$order->totalPrice?></td>
                    <td data-label="Devise"><?=$order->devise_?></td>
                    <?php
                    if(1<0){
                    ?>
                    <td data-label="">
                        <?php
                        if($order->status_ == "progress"){ ?>
                            <button class="cancel-order-tab" data-code=<?=$order->product_id?> data-position=<?=$position?>>cancel</button>
                        <?php
                        }else{?>
                            <p>None</p>
                        <?php
                        } ?>
                    </td>
                    <?php
                    } ?>
                </tr>
                <?php
                $position +=1;
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <div>
        <?php
        $orders = App::getInstance()->get_Db()->selectionner("SELECT * FROM orders INNER JOIN product ON orders.product_id=product.prod_code WHERE buyerInfo=?",[$_SESSION['user']],false);
        //var_dump($orders);
        ?>
        <hr>
        <p class="order-title">Awaiting shipment</p>
        <table class="product-table">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Devise</th>
                <?php 
                if(1<0){ 
                    ?>
                    <th scope="col">Action</th>
                <?php 
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($orders as $order) :
                ?>
                <tr>
                    <td data-label="Product"><a class="order-link" href=<?="product-detail/".str_replace(" ","-",$order->category."/".$order->prod_code." ".$order->name_)?> ><?=$order->name_?></a></td>
                    <td data-label="Status"><?=$order->status_?></td>
                    <td data-label="Price"><?=$order->totalPrice?></td>
                    <td data-label="Devise"><?=$order->devise_?></td>
                    <?php
                    if(1<0){
                    ?>
                    <td data-label="">
                        <?php
                        if($order->status_ == "progress"){ ?>
                            <button class="cancel-order-tab" data-code=<?=$order->product_id?> data-position=<?=$position?>>cancel</button>
                        <?php
                        }else{?>
                            <p>None</p>
                        <?php
                        } ?>
                    </td>
                    <?php
                    } ?>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>
<!--
<div class="order-pics-1">
<div class="order-pics">
<div class="order-pic">
    <img src="" height="100%" width="100%">
</div>
</div>
</div>
--!>
