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
               alert("error");
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
            $.ajax({
                url:"App/pont/pontOffer.php",
                type: "POST",
                data: {"id" :id,"offer" : offer},
                dataType: "json",
                success : function (data){
                    table = data;
                    if(table[0])
                    {
                        $(".loader-wrapper").hide();
                        alert(table[1]);
                        console.log(table[1]);
                        $(".detail-offer").hide(1000);

                    }
                    else
                    {
                        $(".loader-wrapper").hide();
                        alert(table[1]);
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
        coll[i].addEventListener("click", function() {
            this.classList.toggle("ouvert");
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
                        alert(table[1]);
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
                       alert(table[1]);
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
});