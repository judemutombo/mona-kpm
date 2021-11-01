<?php use App\DbAuth\DbAuth; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if(isset($_GET['url']))
    {
        $url = explode("/",$_GET['url']);
    }
    else{
        $url = array("");
    }
    if(count($url) == 1)
    {
        $base = "public";
    }elseif(count($url) == 3)
    {
        $base ="../../";
    }elseif(count($url) == 2)
    {
        $base ="../";
    }elseif(count($url) == 4)
    {
        $base ="../../../";
    }elseif(count($url) == 5)
    {
        $base ="../../../../";
    }
    
    ?>
    <?= '<base href="'.$base.'">' ?>
    <meta charset="utf-8">
    <title>Mona</title>
    <link type="text/css" rel="stylesheet" href="./public/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="./public/assets/css/style_login.css">
    <link type="text/css" rel="stylesheet" href="./public/assets/css/sell_style.css">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.theme.default.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./public/assets/uploader/jquery.growl.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="./public/assets/uploader/src/fileup.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1" >
</head>
<body>
    <header class="header1 grille1">
        <div class="temp1-drawer-button">
            <?php
            if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect())
            {
            ?>
            <button type="button" class="drawer-button"><i class="fa fa-bars"></i></button>
            <?php }?>
        </div>
        <div class="temp1_title">
        <p>Mona</p>
        </div>
        <div class="temp1-bar-buttons">
            <?php
            if(DbAuth::getAuth(App::getInstance()->get_Db())->isConnect())
            {
            ?>
            <a href="member/deconnection" class="btn-deconnect">Log out <i class="fa fa-power-off"></i></a>
            <?php } ?>
        </div>
    </header>
    <div class="space"></div>
    <?= $content;?>
    <script src="./public/assets/js/jquery.js"></script>
    <script src="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/owl.carousel.js"></script>
    <script src="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/src/js/owl.autoplay.js"></script>
    <script src="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/src/js/owl.navigation.js"></script>
    <script src="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/src/js/owl.animte.js"></script>
    <script src="./public/assets/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/src/js/owl.support.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
    <script src="./public/assets/uploader/src/fileup.js"></script>
    <script src="./public/assets/js/main.js"></script>
    <script src="./public/assets/js/main2.js"></script>
    <script src="./public/assets/js/sell_js.js"></script>
    <script src="./public/assets/js/buy_js.js"></script>
    


</body>
</html>