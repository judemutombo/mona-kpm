
<div class="categorie">
    <nav class="categorie-nav">
        <ul>
            <li><a href="#">Electronics</a></li>
            <hr class="barre">
            <li><a href="#">clothes and others</a></li>
            <hr class="barre">
            <li><a href="#">Sports</a></li>
            <hr class="barre">
            <li><a href="#">Health and beauty</a></li>
            <hr class="barre">
            <li><a href="#">Art and collectibles</a></li>
            <hr class="barre">
            <li><a href="#">Mechanical and electromechanical</a></li>
            <hr class="barre">
            <li><a href="#">children and toys</a></li>
            <hr class="barre">
            <li><a href="#">Artisan and agriculture</a></li>
            <hr class="barre">
            <li><a href="#">Music and others</a></li>
            <hr class="barre">
            <li><a href="#">Décoration et gardening</a></li>
        </ul>
    </nav>
</div>
<div id="accueil_carousel" class="owl-carousel owl-theme">
    <div class="item element_carousel">
        <img src="./public/assets/img/Sans titre-1.png" width="100%" height="100%" >
    </div>
    <div class="item element_carousel">
        <img src="./public/assets/img/7/iphone-wet.jpg" width="100%" height="100%" >
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
                    <p class="produit-name">Smart watch</p>
                </div>
            </div>
            <div class="enfant-case-2">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/fa.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Shirt</p>
                </div>
            </div>
            <div class="enfant-case-3">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/IMG_20210208_012821.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Nike</p>
                </div>
            </div>
            <div class="enfant-case-4">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/lol.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Jordan</p>
                </div>
            </div>
            <div class="enfant-case-5">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/pq.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Parfum</p>
                </div>
            </div>
            <div class="enfant-case-6">
                <div class="element">
                    <div class="div-img">
                        <img src="./public/assets/img/samm.jpg" width="100%" height="100%">
                    </div>
                    <p class="produit-name">Techno</p>
                </div>
            </div>
        </div>
    </div>
    <div class="enfant-case-2">
        <img src="./public/assets/img/s10/Sans t57itre-1.png" width="100%" height="100%">
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
<div class="ligne ajout_rec">
    <?php
     $db = App::getInstance()->get_Db();
     $products = $db->selectionner("SELECT * FROM product ",null,false);
     foreach ($products as $product) :
    ?>
    <div class="colonne-3 colonne-sm-6 colonne-md-6">
        <div class="carte">
            <div class="carte-top-content">
                <img class="carte-top-content-img" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1)?> height="100%" width="100%">
            </div>
            <div class="carte-bottom-content">
                <div class="carte-bottom-content-details">
                    <p><span >Price</span> : <?= $product->devise." ".$product->price ?></p>
                    <p><span>name</span> : <?= $product->name ?></p>
                    <p><span>Condition</span> : <?= $product->condition ?></p>
                </div>
                <div class="carte-bottom-content-button">
                    <a class="button-buy" href=<?= "product-detail/". str_replace(" ","-",$product->category."/".$product->prod_code." ".$product->name) ?>>See item</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="colonne-3 colonne-sm-6 colonne-md-6">
        <div class="carte">
            <div class="carte-top-content">
                <img class="carte-top-content-img" src="./public/assets/img/s10/Sans t57itre-1.png" height="100%" width="100%">
            </div>
            <div class="carte-bottom-content">
                <div class="carte-bottom-content-details">
                    <p><span >Price</span> : $45</p>
                    <p><span>name</span> : air jordan 1 mid se multicolor swoosh</p>
                    <p><span>Condition</span> : with tag</p>
                </div>
                <div class="carte-bottom-content-button">
                    <a class="button-buy" href="#">Buy item</a>
                </div>
            </div>
        </div>
    </div>
    <div class="colonne-3 colonne-sm-6 colonne-md-6">
        <div class="carte">
            <div class="carte-top-content">
                <img class="carte-top-content-img" src="./public/assets/img/s10/Sans t57itre-1.png" height="100%" width="100%">
            </div>
            <div class="carte-bottom-content">
                <div class="carte-bottom-content-details">
                    <p><span >Price</span> : $45</p>
                    <p><span>name</span> : air jordan 1 mid se multicolor swoosh</p>
                    <p><span>Condition</span> : with tag</p>
                </div>
                <div class="carte-bottom-content-button">
                    <a class="button-buy" href="#">Buy item</a>
                </div>
            </div>
        </div>
    </div>
    <div class="colonne-3 colonne-sm-6 colonne-md-6">
        <div class="carte">
            <div class="carte-top-content">
                <img class="carte-top-content-img" src="./public/assets/img/s10/Sans t57itre-1.png" height="100%" width="100%">
            </div>
            <div class="carte-bottom-content">
                <div class="carte-bottom-content-details">
                    <p><span >Price</span> : $45</p>
                    <p><span>name</span> : air jordan 1 mid se multicolor swoosh</p>
                    <p><span>Condition</span> : with tag</p>
                </div>
                <div class="carte-bottom-content-button">
                    <a class="button-buy" href="#">Buy item</a>
                </div>
            </div>
        </div>
    </div>
    <div class="colonne-3 colonne-sm-6 colonne-md-6">
        <div class="carte">
            <div class="carte-top-content">
                <img class="carte-top-content-img" src="./public/assets/img/s10/Sans t57itre-1.png" height="100%" width="100%">
            </div>
            <div class="carte-bottom-content">
                <div class="carte-bottom-content-details">
                    <p><span >Price</span> : $45</p>
                    <p><span>name</span> : air jordan 1 mid se multicolor swoosh</p>
                    <p><span>Condition</span> : with tag</p>
                </div>
                <div class="carte-bottom-content-button">
                    <a class="button-buy" href="#">Buy item</a>
                </div>
            </div>
        </div>
    </div>
    <div class="colonne-3 colonne-sm-6 colonne-md-6">
        <div class="carte">
            <div class="carte-top-content">
                <img class="carte-top-content-img" src="./public/assets/img/s10/Sans t57itre-1.png" height="100%" width="100%">
            </div>
            <div class="carte-bottom-content">
                <div class="carte-bottom-content-details">
                    <p><span >Price</span> : $45</p>
                    <p><span>name</span> : air jordan 1 mid se multicolor swoosh</p>
                    <p><span>Condition</span> : with tag</p>
                </div>
                <div class="carte-bottom-content-button">
                    <a class="button-buy" href="#">See item</a>
                </div>
            </div>
        </div>
    </div>
</div>
