<?php

use App\DbAuth\DbAuth;

unset($_SESSION['temp_check']);
if(!Dbauth::getAuth(App::getInstance()->get_Db())->isConnect())
{
    header("Location: ../home");
}
?>
<div class="loader-wrapper">
    <div class="loader"></div>
</div>

<div class="menu-control">
    <div class="sidenav">
        <ul class="sideMenu">
            <li><a href="member/dashBoard"><i class="fa fa-home"></i> Overview</a></li>
            <li><a href="member/orders"><i class="fa fa-clipboard"></i> Orders</a></li>
            <li class="actif"><a href="member/product"><i class="fa fa-th-large"></i> Products</a></li>
            <li><a href="member/profile"><i class="fa fa-user-circle"></i> Profile</a></li>
            <li><a href="member/notification"><i class="fa fa-bell"></i> Notification</a></li>
            <li><a href="member/help_center"><i class="fa fa-question"></i> Help Center</a></li>        
        </ul>
    </div>
    <div class="output">
       <div class="product-output">
            <ul class="nav  onglets" id="productTab">
                <li class="nav-item">
                    <a class="nav-link active" href="#allProduct">All your products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#addProduct">Add product</a>
                </li>
            </ul>
            <div class="tab-content">
                <div  class="tab-pane fade show active" id="allProduct" >
                    <?php
                        $db = App::getInstance()->get_Db();
                        $result = $db->selectionner("SELECT * FROM product WHERE owner =?",[$_SESSION['user']],false);
                    if(!$result)
                    {
                    ?>
                    <p class="no_product">No results</p>
                    <?php
                    }
                    else{
                    ?>
                    <table class="product-table">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Devise</th>
                            <th scope="col">Condition</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $position = 1;
                            foreach($result as $produit) : 
                            ?>
                            <tr>
                            <td data-label="Product"><?=$produit->name?></td>
                            <td data-label="Price"><?=$produit->price?></td>
                            <td data-label="Devise"><?=$produit->devise?></td>
                            <td data-label="Condition"><?=$produit->condition?></td>
                            <td data-label=""><button class="delete-product-tab" data-code=<?=$produit->prod_code?> data-position=<?=$position?>>delete</button></td>
                            </tr>
                            <?php
                            $position +=1;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php
                    }?>
                </div>
                <div  class="tab-pane fade" id="addProduct" >
                    <div class="product_upload_output">
                        <div class="product-upload-photo">
                            <p>Add up to 6 photos</p>
                            <button type="button" class="fileup-btn">
                                Select file
                                <input type="file" id="upload-demo" multiple accept="image/*">
                            </button>
                            <div id="upload-demo-queue" class="queue"></div>

                        </div> 
                    </div>
                    <div class="product_description">
                        <div class="info-group">
                            <label>Item name</label>
                            <input type="text" name="name" id="product-name" placeholder="product name">
                        </div>
                        <hr>
                        <div class="info-group">
                            <label>Item price</label>
                            <input type="number" name="price" id="product-price" placeholder="product price" min="1">
                        </div>
                        <hr>
                        <div class="info-group">
                            <label>Item devise</label>
                            <select id="product-devise">
                                <option value="" disabled selected>Choose your devise</option>
                                <option value="Dollars $">Dollars $</option>
                                <option value="Pounds £">Pounds £</option>
                                <option value="Turkish Lira ₺">Turkish Lira ₺</option>
                                <option value="Euro €">Euro €</option>
                            </select>
                        </div>
                        <hr>
                        <div class="info-group">
                            <label>Describe your item</label>
                            <textarea placeholder="Item description" id="product-description"></textarea>
                        </div>
                        <hr>
                        <div class="info-group">
                            <label>Category</label>
                            <select id="product-category">
                                <option value="" disabled selected>choose category</option>
                                <option value="Electronics">Electronics </option>
                                <option value="clothes and others">clothes and others</option>
                                <option value="Sports">Sports </option>
                                <option value="Health and beauty">Health and beauty</option>
                                <option value="Art and collectibles">Art and collectibles</option>
                                <option value="Mechanical and electromechanical">Mechanical and electromechanical</option>
                                <option value="children and toys">Children and toys</option>
                                <option value="Artisan and agriculture">Artisan and agriculture</option>
                                <option value="Music and others">Music and others</option>
                                <option value="Decoration et gardening">Decoration et gardening</option>
                            </select>
                        </div>
                        <hr>
                        <div class="info-group">
                            <label>Condition</label>
                            <select class="select" id="product-condition">
                                <option value="" disabled selected>Choose condition</option>
                                <option value="new with tag" data-description="unused item with tags, in the original packaging.">New with tag</option>
                                <option value="New without tag" data-description="unused item without tag,or original packaging.">New without tag</option>
                                <option value="Very good" data-description="A little used but have any imperfection.">Very good</option>
                                <option value="Good" data-description="used, may have some imperfections.">Good</option>
                                <option value="Lightly good" data-description="used,have some imperfections">Lightly good</option>
                            </select>
                    </div>
                    <div class="upload-button">
                        <button type="button" class="btn-add" id="btn-add-product">Upload item</button>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>
</div>
