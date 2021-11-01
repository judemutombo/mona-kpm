$(function (){
    $(".loaders").hide();
    var afficher = false;
    var app = false;
    var categorie = $('.categorie');
    var sidenav = $(".sidenav");
    function wait(ms)
    {
        var d = new Date();
        var d2 = null;
        do { d2 = new Date(); }
        while(d2-d < ms);
    }

    $('.recherche').on('click',function () {
        if(afficher == false)
        {
            $('.search-form').fadeIn("slow",function () {
                if($('.categorie').hasClass("open"))
                {
                    $('.categorie').toggleClass("open");
                    categorie.animate({
                        top: -500
                    },250);
                    $('.menu-categorie>i').removeClass('fa-times');
                    $('.menu-categorie>i').addClass('fa-bars');
                }
                $('.search-form').show();
            });
            afficher =true;
        }
        else{
            $('.search-form').fadeOut("slow",function () {
                $('.search-form').hide();
            });
            afficher = false;
        }
        return false;
    })

    $( window ).resize(function() {
        var largeur =$(window).width();
        if(largeur > 481)
        {
            $('.search-form').hide();
        }
    });

    $('.menu-categorie').on('click',function () {
        $('.categorie').toggleClass("open");
        if($('.categorie').hasClass("open"))
        {
            categorie.animate({
                top: "60px"
            });
            $('.menu-categorie>i').removeClass('fa-bars');
            $('.menu-categorie>i').addClass('fa-times');
            app = true;
        }
        else {
            categorie.animate({
                top: -500
            },250);
            app = false;
            $('.menu-categorie>i').removeClass('fa-times');
            $('.menu-categorie>i').addClass('fa-bars');
        }

        return false;
    })

    $("#accueil_carousel").owlCarousel({
        items: 1,
        loop:true,
        autoplay: true,
        autoPlaySpeed: 2000,
        autoPlayTimeout: 2000,
        dots:  false
    });
    $("#detail_carousel").owlCarousel({
        items: 1,
        loop:true,
        autoplay: true,
        autoPlaySpeed: 2000,
        autoPlayTimeout: 2000,
        dots:  false
    });
    $(".drawer-button").on('click',function () {
        $('.sidenav').toggleClass("open");
        if($('.sidenav').hasClass("open"))
        {
            sidenav.animate({
                left: "0"
            });
            $('.drawer-button>i').removeClass('fa-bars');
            $('.drawer-button>i').addClass('fa-times');
        }
        else {
            sidenav.animate({
                left: -500
            },250);
            $('.drawer-button>i').removeClass('fa-times');
            $('.drawer-button>i').addClass('fa-bars');
        }
        return false;
    })

})
