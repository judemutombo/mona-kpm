$(function (){
   $("#btn-offer").on("click",function (){
       table = new Array();
       $.get({
           url:"App/pont/verif_connection.php",
           data:{"url":window.location.href,"type":"offer"},
           dataType: "JSON",
           success : function (data){
                table = data;
                if(table[0])
                {
                    $(".detail-offer").show(1000);
                }
                else{
                    window.open("account","_self");
                }
           },
           error:function (){
               afficherPopupErreur("error");
           }
       });
   })
   $("#btn-send-offer").on("click",function (){
        $(".loader-wrapper").show();
        var x =  navigator.onLine;
        if(x)
        {
            let table = new Array();
            var id = $("#product_code").val();
            var offer = $("#offer-").val();
            var devise = $("#product-devise").children("option:selected").val();
            $.ajax({
                url:"App/pont/pontOffer.php",
                type: "POST",
                data: {"id" :id,"offer" : offer,"devise":devise},
                dataType: "json",
                success : function (data){
                    table = data;
                    if(table[0])
                    {
                        $(".loader-wrapper").hide();
                        afficherPopupInformation(table[1]);
                        console.log(table[1]);
                        $(".detail-offer").hide(1000);

                    }
                    else
                    {
                        $(".loader-wrapper").hide();
                        afficherPopupErreur(table[1]);
                        console.log(table[1]);
                    }

                },
                error : function (errors){
                    $(".loader-wrapper").hide();
                    console.log(errors);
                }
            })
        }
        else {
            alert("you are offline");
        }

    })
   var coll = document.getElementsByClassName("notification-offer-button");
   var i;
   for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function(e) {
            this.classList.toggle("ouvert");
            let id = e.target.getAttribute("data-id");
            if(this.classList.contains("unread")){
                $.get({
                    url:"App/pont/pont_notif.php",
                    data : {"cpt":id},
                    dataType:"JSON",
                    success:function(data){
                        if(data[0]){
                            e.target.classList.toggle("unread");
                            document.querySelector(".notifNbr").textContent=data[1]
                        }else{
                            console.log(data[1])
                        }
                    },
                    error:function (param){
                        console.log(param)
                      }
                })
            }
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
   $("#offer-accept").on("click",function (){
       table = new Array();
       $.get({
           url:"App/pont/verif_connection.php",
           data:{"url":window.location.href,"type":"offer"},
           dataType: "JSON",
           success : function (data){
               table = data;
               if(table[0])
               {
                   $(".detail-offer").show(1000);
               }
               else{
                   window.open("account","_self");
               }
           },
           error:function (){
               alert("error");
           }
       });
       const x = navigator.onLine;
       if(x)
       {
           var code = $("#offer-accept").attr("data-code");
           $.ajax({
               type:"POST",
               url:"App/pont/operationOffer.php",
               data:{"code":code,"state":"accept"},
               dataType:"JSON",
               success:function (data){
                    table = data;
                    if (table[0])
                    {

                        window.location.reload();
                    }
                    else {
                        console.log(table[1]);
                        afficherPopupErreur(table[1]);
                    }
               },
               error: function (errors){
                   console.log(errors);
                   afficherPopupErreur(errors);
               }
           })
       }
       else{
           alert("you are offline");
       }
   });
   $("#offer-decline").on("click",function (){
       table = new Array();
       $.get({
           url:"App/pont/verif_connection.php",
           data:{"url":window.location.href,"type":"offer"},
           dataType: "JSON",
           success : function (data){
               table = data;
               if(table[0])
               {
                   $(".detail-offer").show(1000);
               }
               else{
                   window.open("account","_self");
               }
           },
           error:function (){
               alert("error");
           }
       });
       const x = navigator.onLine;
       if(x)
       {
           var code = $("#offer-accept").attr("data-code");
           $.ajax({
               url:"App/pont/operationOffer.php",
               type:"POST",
               data:{"code":code,"state":"refuse"},
               dataType:"JSON",
               success:function (data){
                   table = data;
                   if (table[0])
                   {

                       window.location.reload();
                   }
                   else {
                       console.log(table[1]);
                       afficherPopupErreur(table[1]);
                   }
               },
               error: function (errors){
                   console.log(errors);
                   alert(errors);
               }
           })
       }
       else{
           alert("you are offline");
       }
   })

   $("#btn_payment").on("click",function(){
       var code = $(this).attr("data-off");
       var url = window.location.href;
       table = new Array();
       $.ajax({
           url:"App/pont/pont_checkout.php",
           type:"POST",
           dataType:"JSON",
           data:{"code":code,"type":"sxcc","url":url},
           success:function(data)
           {
               table = data;
               if(table[0])
               {
                   window.open(table[1],"_self");
               }
               else{
                   afficherPopupErreur(table[1]);
               }
           },
           error:function(thrownError)
           {
               alert(thrownError);
           }
       })
   })
    $("#chckContinue").on("click",function (e){
        var name = $("#name_order").val();
        if(name =='')
        {
            $('#name_order').css('border','1px solid red');
            return;
        }
        var reg = new RegExp("^[a-zA-Z]{1,}$");
        if(!reg.test(name))
        {
            $('.name_order_error').show();
            return;
        }
        $('#name_order').css("border","1px solid #767676");

        var lname = $("#lName_order").val();
        if(lname =='')
        {
            $('#lName_order').css('border','1px solid red');
            return;
        }
        if(!reg.test(lname))
        {
            $('.lname_order_error').show();
            return;
        }
        $('#lName_order').css("border","1px solid #767676");

        var phone = $("#phone_order").val();
        if(phone =='')
        {
            $('#phone_order').css('border','1px solid red');
            return;
        }
        var regphone = new RegExp("^[0-9]{10}$");
        if(!regphone.test(phone))
        {
            $('.phone_order_error').show();
            return;
        }
        $('#phone_order').css("border","1px solid #767676");

        var add = $("#address_order").val();
        var add2 = $("#address_order2").val();
        var district =  $("#district_order").val();
        if( district == null)
        {
            $("#district_order").css("border","1px solid red");
            return;
        }
        $("#district_order").css("border","1px solid #767676");
        if(add =='')
        {
            $('#address_order').css('border','1px solid red');
            return;
        }
        $("#address_order").css("border","1px solid #767676");

        $.ajax({
            url:"App/pont/pont_payment.php",
            type:"POST",
            data:{"name":name,"sname":lname,"address":add,"address2":add2,"phone":phone,"district":district,"type":"source"},
            dataType:"JSON",
            success:function (data){
                table = data;
                if(table[0])
                {
                    $(".tab-content>div:nth-child(1)").toggleClass("show");
                    $(".tab-content>div:nth-child(1)").toggleClass("active");
                    $(".tab-content>div:nth-child(2)").toggleClass("show");
                    $(".tab-content>div:nth-child(2)").toggleClass("active");
                }
                else {
                    afficherPopupErreur(table[1]);
                    console.log(table[1]);
                }
            },
            error:function (errorThrown){
                alert(errorThrown);
                console.log(errorThrown);
            }
        })
    })
    $("#chckBack").on("click",function (e){
        $(".tab-content>div:nth-child(2)").toggleClass("show");
        $(".tab-content>div:nth-child(2)").toggleClass("active");
        $(".tab-content>div:nth-child(1)").toggleClass("show");
        $(".tab-content>div:nth-child(1)").toggleClass("active");
    })

    $("#buy_direct").on("click",function (){
        table  = new Array();
        var code = $("#product_code").val();
        var url = window.location.href;
        $.get({
            url:"App/pont/verif_connection.php",
            data:{"url":window.location.href,"type":"buy"},
            dataType: "JSON",
            success : function (data){
                 table = data;
                 if(table[0])
                 {
                    $.ajax({
                        url:"App/pont/pont_checkout.php",
                        data:{"code":code,"type":"sxxc","url":url},
                        dataType:"JSON",
                        type:"POST",
                        success:function (data) {
                            table = data;
                            if(table[0])
                            {
                                window.open(table[1],"_self");
                            }
                            else{
                                afficherPopupErreur(table[1]);
                            }
                        },
                        error:function (data){
                            console.log(data);
                        }

                    })
                 }
                 else{
                     window.open("account","_self");
                 }
            },
            error:function (){
                afficherPopupErreur("error");
            }
        });
    })

    $(".loaders").hide();
});
