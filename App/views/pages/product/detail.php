<div class="loader-wrapper">
    <div class="loader"></div>
</div>
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
<?php
if(isset($_GET['url'])){
    $url = explode("/",$_GET['url']);
    $id = $url[2];
    $id = explode("-",$id);
    $id = $id[0];
    $db = App::getInstance()->get_Db();
    $product = $db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id WHERE prod_code=?",[$id],true);
    if(is_object($product))
        if($url[1] === str_replace(" ","-",$product->category))
        {?>
        <div class="path">
        Home / product / <?=$product->category?> / <?= $product->name?>
        </div>
        <div class="detail_content">
            <div class="ligne">
                <div class="colonne-4 colonne-sm-12 colonne-md-5">
                    <div id="detail_carousel" class="owl-carousel owl-theme">
                    <?php
                    for($i = 1;$i <= 6; ++$i)
                    {
                        $picture ="picture".$i;
                        if(!empty($product->$picture))
                        {
                    ?>
                        <div class="item detail-element element_carousel">
                            <img height="100%" width="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($product->$picture);?>>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    </div>
                </div>
                <div class="colonne-6 colonne-sm-12 colonne-md-6">
                    <div class="detail-information">
                        <p class="detail-name"><?= $product->name;?></p>
                        <p><?= $product->category ?></p>
                        <p>PRICE : <span class="detail-price"><?= $product->devise." ".$product->price ;?></span></p>
                        <p>CONDITION : <span class="detail-condition"><?= $product->condition;?></span></p>
                        <input type="hidden" value=<?= $product->prod_code;?> id="product_code">
                        <hr>
                        <div class="detail-desciption">
                            <p>DESCRIPTION : </p>
                            <p class="detail-describe"><?= str_replace("\n","<br>", $product->describe);?></p>
                        </div>
                    </div>
                    <div class="detail-option-button">
                        <button type="button" class="btn-add">Buy</button>
                        <button type="button" class="btn-offer" id="btn-offer">Send offer</button>
                    </div>
                    <div class="detail-offer" <?php if(! (isset($_GET['offer']) && $_GET['offer'] === "1")) echo 'style="display: none"'  ?> >
                        <input type="number" name="offer" class="input-offer" placeholder="enter your price" id="offer-">
                        <button type="button" class="btn-send" id="btn-send-offer">Send</button>
                    </div>
                </div>
                <div class="colonne-2 colonne-sm-12 colonne-md-12">
                    <div class="detail-owner">
                        <p><?= $product->name." ".$product->surname ?></p>
                        <p><i class="fa fa-map-marker"></i> <?= $product->district ?></p>
                        <hr>
                        <a href="#" class="btn-profile">See profile</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        }

}