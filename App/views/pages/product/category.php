<?php

use App\Product\ProductGroup\ProductGroup;

$url = $_GET["url"];
$url = explode("/",$url);
$category = $url[1];

$category = str_replace("-"," ",$category);
$category = trim($category);
if(ProductGroup::verifyCategory($category)){
    $products = ProductGroup::getProductByCategory($category);
}else{
    header("Location: 404");
}
?>
<div class="categorie">
    <nav class="categorie-nav">
        <ul>
            <li><a href="category/Electronics">Electronics</a></li>
            <hr class="barre">
            <li><a href="category/Clothes-and-Cthers">Clothes and Others</a></li>
            <hr class="barre">
            <li><a href="category/Sports">Sports</a></li>
            <hr class="barre">
            <li><a href="category/Health-and-Beauty">Health and Beauty</a></li>
            <hr class="barre">
            <li><a href="category/Art-and-Collectibles">Art and Collectibles</a></li>
            <hr class="barre">
            <li><a href="category/Mechanical-and-Electromechanical">Mechanical and Electromechanical</a></li>
            <hr class="barre">
            <li><a href="category/Children-and-Toys">Children and Toys</a></li>
            <hr class="barre">
            <li><a href="category/Artisan-and-Agriculture">Artisan and Agriculture</a></li>
            <hr class="barre">
            <li><a href="category/Music-and-Others">Music and Others</a></li>
            <hr class="barre">
            <li><a href="category/Decoration-and-Gardening">Decoration and Gardening</a></li>
        </ul>
    </nav>
</div>
<div class="ligne ajout_rec target" data-token=<?=$category?> data-type="category">
<?php
    /*if(is_array($products)):
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
            <?php endforeach; 
        endif; */?>
</div>