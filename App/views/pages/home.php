
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
<div id="accueil_carousel" class="owl-carousel owl-theme">
    <div class="item element_carousel">
        <div class="slogan-wrap">
            <p class="slogan">Give a second life to your items,<br>sell them</p>
        </div>
    </div>
</div>
<div class="parent-case">
    <div class="enfant-case-1" style="border: none">
        <div class="parent-case-2">
            <div class="enfant-case-1">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/7.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Electronics</p>
                </div>
            </div>
            <div class="enfant-case-2">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/fa.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Sports</p>
                </div>
            </div>
            <div class="enfant-case-3">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/IMG_20210208_012821.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Decoration</p>
                </div>
            </div>
            <div class="enfant-case-4">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/lol.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Clothes</p>
                </div>
            </div>
            <div class="enfant-case-5">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/pq.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Beauty</p>
                </div>
            </div>
            <div class="enfant-case-6">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/samm.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Music</p>
                </div>
            </div>
        </div>
    </div>
    <div class="enfant-case-2">
        <img src="./public/assets/img/logo.png" width="100%" height="100%">
    </div>
    <div class="enfant-case-3" style="border: none">
        <div class="parent-case-3">
            <div class="enfant-case-7">
                <img src="./public/assets/img/iPhone-11-3-1.jpg" width="100%" height="100%">
            </div>
            <div class="enfant-case-8">
                <img src="./public/assets/img/iphone-11-lineup.jpg" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>

<h2 class="ajout_rec_title">Recently added</h2>
<div class="ligne ajout_rec target" data-token="none" data-type="main">
        <?php
            /*
            use App\Product\ProductGroup\ProductGroup;
            $db = App::getInstance()->get_Db();
            $products = ProductGroup::getAllProduct();
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
        <?php endforeach;*/?>    
</div>
