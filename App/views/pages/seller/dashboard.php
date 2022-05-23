<?php use App\User\User; ?>
<?php $identity = User::getInstance(App::getInstance()->get_Db())->getfullidentity()?>
<div class="userInfo">
    <p class="userInfo-name"><?= $_SESSION['username'];?> </p>
    <p class="userInfo-mail"><?= $identity->mail; ?></p>
    <ul>
        <li class="userInfo-location"><i class="fa fa-map-marker"></i><?= $identity->district ?></li>
        <li class="userInfo-product"><i class="fa fa-th-large"></i><?= User::getInstance(App::getInstance()->get_Db())->numberOfproduct();?> Product(s)</li>
        <li class="userInfo-order"><i class="fa fa-clipboard"></i><?= User::getInstance(App::getInstance()->get_Db())->numberOfOrder();?> Order(s)</li>
    </ul>
</div>
<div class="userLastOperation">
    <p>Last operation</p>
</div>