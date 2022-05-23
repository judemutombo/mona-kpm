$(function(){
    
    //check for Navigation Timing API support
    if (window.performance) {
        console.info("window.performance works fine on this browser");
    }
    console.info(performance.navigation.type);
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        console.info( "This page is reloaded" );
        $.ajax({
            url:'App/pont/pont_del_image.php',
            type:"POST",
            data:{"deleteAll":true},
            success:function() {
               console.info("all images were deleted");
            }
        })
    } else {
        console.info( "This page is not reloaded");
    }
    $("#productTab a").click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    

    $.fileup({
        url: 'App/pont/pont_image.php',
        inputID: 'upload-demo',
        queueID: 'upload-demo-queue',
        autostart: true,
        filesLimit: 6,
        method: 'post',

        onSelect: function(file) {
            $('#types .control-button').show();
        },
        onRemove: function(file, total,file_number) {
            $.ajax({
                url:'App/pont/pont_del_image.php',
                type:"POST",
                data:{"number":file_number},
                success:function(data) {
                    console.info(data);
                }
            })
            if (file === '*' || total === 1) {
                $('#types .control-button').hide();
            }
        },
        onSuccess: function(response, file_number, file) {
            console.info(response);
            $.growl.notice({ title: "Upload success!", message: file.name });
        },
        onError: function(event, file, file_number) {
            $.growl.error({ message: "Upload error!" });
        }
    });
    $('#product-name').on("focus",function(){
        $('#product-name').css("border","0.5px solid #D9D2D2");
    });

    $('#product-price').on("focus",function(){
        $('#product-price').css("border","0.5px solid #D9D2D2");
    });

    $('#product-description').on("focus",function(){
        $('#product-description').css("border","0.5px solid #D9D2D2");
    });

    $('#product-devise').on("focus",function(){
        $('#product-devise').css("border","0.5px solid #D9D2D2");
    });
    
    $('#product-category').on("focus",function(){
        $('#product-category').css("border","0.5px solid #D9D2D2");
    });

    $('#product-condition').on("focus",function(){
        $('#product-condition').css("border","0.5px solid #D9D2D2");
    });

    $("#btn-add-product").on('click',function(){ 
        var name =$('#product-name').val();
        if(name ==" " || name == "")
        {
            $('#product-name').css("border","0.5px solid red");
            return;
        }
        var price = $("#product-price").val();
        if(price ==" " || price == "")
        {
            $('#product-price').css("border","0.5px solid red");
            return;
        }
        var description = $("#product-description").val();
        if(description ==" " || description == "")
        {
            $('#product-description').css("border","0.5px solid red");
            return;
        }
        var devise = $("#product-devise").children("option:selected").val();
        if(devise == "")
        {
            $("#product-devise").css("border","0.5px solid red");
            return;
        }
        var category = $("#product-category").children("option:selected").val();
        if(category == "")
        {
            $("#product-category").css("border","0.5px solid red");
            return;
        }
        var condition = $("#product-condition").children("option:selected").val();
        if(condition == "")
        {
            $("#product-condition").css("border","0.5px solid red");
            return;
        }
        table = new Array();
        $(".loader-wrapper").show();
        $(".drawer-button").prop("disabled",true);
        $("btn-deconnect").attr("disabled", "disabled");
        $.ajax({
            url:"App/pont/add_product.php",
            data:{"price":price,"name":name,"description":description,"devise":devise,"category":category,"condition":condition},
            type:'POST',
            dataType:'json',
            success:function(data){
                table = data;
                if(table[0])
                {
                    $(".loader-wrapper").hide();
                    $(".drawer-button").prop("disabled",false);
                    $("btn-deconnect").attr("disabled", false);
                    $.ajax({
                        url:'App/pont/pont_del_image.php',
                        type:"POST",
                        data:{"deleteAll":true},
                        success:function() {
                            console.info("all images were deleted");
                        }
                    });
                    $.fileup('upload-demo', 'remove', '*');
                    $('#product-name').val("");
                    $("#product-price").val("");
                    $("#product-description").val("");
                    $("#product-devise").val("").change();
                    $("#product-category").val("").change();
                    $("#product-condition").val("").change();
                    alert(table[1]);
                }
                else{
                    console.error(table[1]);
                    afficherPopupErreur(table[1]);
                    $(".loader-wrapper").hide();
                    $(".drawer-button").prop("disabled",false);
                    $("btn-deconnect").attr("disabled", false);
                }
                onAddProduct()
            },
            error:function ()
            {
                $(".loader-wrapper").hide();
                $(".drawer-button").prop("disabled",false);
                $("btn-deconnect").attr("disabled", false);
            }
        })
    })
    $("#btn-modify").on("click",function (){
        $("#btn-change").show();
        $("#_user_name").toggleClass("modify_deactived");
        $("#_user_lastname").toggleClass("modify_deactived");
        $("#_user_email").toggleClass("modify_deactived");
        $("#_user_district").toggleClass("modify_deactived");
        $("#_user_address").toggleClass("modify_deactived");
        $("#_user_role").css("-moz-appearance","inherit");
        $("#btn-modify").prop('disabled',true);

    })
    $("#btn-change").on("click",function (){
        var name =  $("#_user_name").val();
        if(name == "" || name== " ")
        {
            $("#_user_name").css("border-bottom-color","red");
            return;
        }
        var lastname = $("#_user_lastname").val();
        if(lastname == "" || lastname== " ")
        {
            $("#_user_lastname").css("border-bottom-color","red");
            return;
        }
        var mail = $("#_user_email").val();
        if(mail == "" || mail == " ")
        {
            $("#_user_email").css("border-bottom-color","red");
            return;
        }
        var reg = new RegExp("^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$");
        if(!reg.test(mail))
        {
            $("#_user_email").css("border-bottom-color","red");
            return;
        }
        var district = $("#_user_district").val();
        if(district == "" || district == " ")
        {
            $("#_user_district").css("border-bottom-color","red");
            return;
        }
        var address = $("#_user_address").val();
        if(address == "" || address == " ")
        {
            $("#_user_address").css("border-bottom-color","red");
            return;
        }
        table = new  Array();
        $.ajax({
            url:"App/pont/pont_modfy_profile.php",
            data:{"name":name,"lastname":lastname,"mail":mail,"district":district,"address":address},
            type:"POST",
            dataType:"JSON",
            success:function (data) {
                table = data;
                if(table[0])
                {
                    window.location.reload();
                }
                else{
                    afficherPopupErreur(table[1]);
                }
            },
            error:function (data) {
                afficherPopupErreur(data);
            }
        })
    })
    $("#see-offer-accept").on("click",function (){
        var code = $(this).data("code");
        window.open(code,"_self");
    })
    $(".cancel-order-tab").on("click",function (){
        var product = $(this).data("code");
        $(".glass").show();
        CancelOrder("Do you really want to cancel this order ?");
        /*table = new Array();
        $.ajax({
            type:"POST",
            dataType:"JSON",
            url:"App/pont/....",
            data:{"code":product},
            success:function (data){
                    table = data;
                    if(table[0])
                    {
                        alert(table[1]);
                    }else{
                        console.log(table[1])
                    }
            },
            error:function (data) {}
        })*/
    })
   /* $(".order-hover").hover(
        function (){
            const data = $(this).data("pic");
            console.log(data);
            $(".order-pic>img").attr("src",data);
            $(".order-pics-1").show();
        },
        function (){
            $(".order-pics-1").hide();
        })
        */
    
    

})