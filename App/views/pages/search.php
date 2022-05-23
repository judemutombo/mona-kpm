<?php

use App\Product\ProductGroup\ProductGroup;

if(!isset($_GET["search"])){
    header("Location: home");
}

$joker = $_GET["search"];

$products = ProductGroup::getproductByJoker($joker)
?>
<p class="found"><?=count($products)." item(s) found(s)" ?></p>

<div class="ligne ajout_rec target" data-token=<?=$joker?> data-type="search">
    <?php
    /*  foreach($products as $product) :
        ?>
        <<div class="colonne-3 colonne-sm-6 colonne-md-6">
            <div class="carte">
                <div class="carte-top-content">
                    <img class="carte-top-content-img" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->images[0])?> height="100%" width="100%">
                </div>
                <div class="carte-bottom-content">
                    <div class="carte-bottom-content-details">
                        <p><span >Price</span> : <?= $product->devise." ".$product->price ?></p>
                        <p><span>name</span> : <?= $product->name_ ?></p>
                        <p><span>Condition</span> : <?= $product->condition ?></p>
                    </div>
                    <div class="carte-bottom-content-button">
                        <a class="button-buy" href=<?= "product-detail/". str_replace(" ","-",$product->category."/".$product->code." ".$product->name_) ?>>See item</a>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        endforeach; */
    ?>
</div>