<?php

use App\User\User;
use App\Product\ProductGroup\ProductGroup;
$url = $_GET["url"];
$url = explode("/",$_GET['url']);
$code = explode("-",$url[2]);

if(User::getInstance(App::getInstance()->get_Db())->checkUser($code[0])){
    $user = User::getInstance(App::getInstance()->get_Db())->getUserById($code[0])
?>
<div class="personnal_information userProfile">
    <div class="ligne">
        <div class="colonne-4 colonne-sm-12 ">
            <span class="user"><?=$user->name?></span>
            <span class="user"><?=$user->surname?></span>
        </div>
        <div class="colonne-4 colonne-sm-12">
            <p> <i class="fa fa-map-marker"></i> <?=$user->district?></p>
        </div>
    </div>
</div>
<div class="ligne target" data-token=<?=$code[0]?> data-type="profile">
        <?php
            /* $db = App::getInstance()->get_Db();
            $products = ProductGroup::getProductByOwner($code[0]);
            foreach ($products as $product) :
            ?>
            <div class="colonne-3 colonne-sm-6 colonne-md-6">
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
            <?php endforeach; */?>
</div>

<?php
}
else{
    header("Location: 404NotFound");
}
?>

