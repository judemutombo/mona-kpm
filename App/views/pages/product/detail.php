<div class="loader-wrapper">
    <div class="loader"></div>
</div>
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
<?php

use App\Product\Product\Product;

if(isset($_GET['url'])){
    $url = explode("/",$_GET['url']);
    $id = $url[2];
    $id = explode("-",$id);
    $id = $id[0];
    $db = App::getInstance()->get_Db();
    $product = Product::getproductByCode($id);
    if(is_object($product)){
        if($url[1] === str_replace(" ","-",$product->category))
        {
            $currency = null;
            switch ($product->devise)
            {
                case "EUR" : $currency ="€"; break;
                case "GBP" : $currency ="£"; break;
                case "USD" : $currency ="$"; break;
                default : $currency ="₺";
            }
            ?>
        <div class="path">
        Home / product / <?=$product->category?> / <?= $product->name_?>
        </div>
        <div class="detail_content">
            <div class="ligne">
                <div class="colonne-4 colonne-sm-12 colonne-md-5">
                    <div id="detail_carousel" class="owl-carousel owl-theme">
                    <?php
                    foreach($product->images as $image)
                    {
                        if(!empty($image))
                        {
                    ?>
                        <div class="item detail-element element_carousel">
                            <img height="100%" width="100%" src=<?= 'data:image/jpeg;base64,'.base64_encode($image);?>>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    </div>
                </div>
                <div class="colonne-6 colonne-sm-12 colonne-md-6">
                    <div class="tsd">
                      <div class="detail-information">
                          <p class="detail-name"><?= $product->name_;?></p>
                          <p><?= $product->category ?></p>
                          <p>PRICE : <span class="detail-price"><?= $currency." ".$product->price ;?></span></p>
                          <p>CONDITION : <span class="detail-condition"><?= $product->condition;?></span></p>
                          <input type="hidden" id="product_code" value=<?= $product->code;?> >
                          <hr>
                          <div class="detail-desciption">
                              <p>DESCRIPTION : </p>
                              <p class="detail-describe"><?= str_replace("\n","<br>", $product->desc);?></p>
                          </div>
                      </div>
                      <?php
                      if($product->state =="sold"){
                          ?>
                          <p class="sold">Sold</p>
                          <?php
                      }else{
                          if(!\App\DbAuth\DbAuth::getAuth(App::getInstance()->get_Db())->isConnect() || $product->owner != $_SESSION["user"]){ ?>
                          <div class="detail-option-button">
                              <button type="button" class="btn-add" id="buy_direct">Buy</button>
                              <button type="button" class="btn-offer" id="btn-offer">Send offer</button>
                          </div>
                          <?php } ?>
                          <div class="detail-offer" <?php if(! (isset($_GET['offer']) && $_GET['offer'] === "1" && \App\DbAuth\DbAuth::getAuth(App::getInstance()->get_Db())->isConnect())) echo 'style="display: none"'  ?> >
                              <input type="number" name="offer" class="input-offer" placeholder="enter your price" id="offer-">
                              <select id="product-devise" class="detail-offer-devise">
                                      <option value="" disabled selected>Choose your devise</option>
                                      <option value="USD">Dollars $</option>
                                      <option value="GBP">Pounds £</option>
                                      <option value="TRY">Turkish Lira ₺</option>
                                      <option value="EUR">Euro €</option>
                                  </select>
                              <button type="button" class="btn-send" id="btn-send-offer">Send</button>
                          </div>
                      <?php }?>
                    </div>
                </div>
                <div class="colonne-2 colonne-sm-12 colonne-md-12">
                    <div class="detail-owner">
                        <p><?= $product->owner." ".$product->ownersurname ?></p>
                        <p><i class="fa fa-map-marker"></i> <?= $product->ownerdistrict ?></p>
                        <hr>
                        <a href=<?="member/user/".$product->ownerCode."-".$product->ownersurname."-".$product->owner?> class="btn-profile">See profile</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        }
    }else{
        header("Location: home");
    }
}
