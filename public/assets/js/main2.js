$(function(){
    
    $("#myTab a").click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#register_mail').focus(function(){
        $(this).css('border','1px solid rgb(163, 161, 161)');
    })

    $('#register_pass').focus(function(){
        $(this).css('border','1px solid rgb(163, 161, 161)');
    })

    $('#Register_button').on('click',function()
    {
        var mail = $('#register_mail').val();
        if(mail == '')
        {
            $('#register_mail').css('border','1px solid red');
            return;
        }

        var reg = new RegExp("^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$");
        if(!reg.test(mail))
        {
            $('#register_mail').css('border','1px solid red');
            $('.reg_mail_error_message').show();
            return;
        }

        var pass = $('#register_pass').val();
        var regPass = new RegExp("^[a-zA-Z0-9]{4,15}$");
        if(pass == '')
        {
            $('#register_pass').css('border','1px solid red');
            return;
        }
        if(!regPass.test(pass))
        {
            $('#register_pass').css('border','1px solid red');
            $('.reg_pass_error_message').show();
            return;
        }

        table = new Array();
        $.ajax({
            url:'App/pont/pont_register.php',
            type:'POST',
            data:{'mail':mail,'pass':pass},
            success:function(data){
                table = data;
                if(table[0])
                {
                    window.open(table[1],"_self");
                }
                else{
                    if(table[1] == 1)
                    {
                        $('#register_mail').css('border','1px solid red');
                        $('.reg_mail_error_message').show();
                    }
                    else if(table[1] == 2)
                    {
                        $('#register_pass').css('border','1px solid red');
                        $('.reg_pass_error_message').show();      
                    }
                    else if(table[1] == 3)
                    {
                        $('#register_mail').css('border','1px solid red');
                        $('.reg_mail_error_message').html("This e-mail is already used.");
                        $('.reg_mail_error_message').show();
                    }
                }
            },
            dataType:'json',
            error: function(data){
                alert("fail");
            }
        })

    })

    $('#name_register').focus(function(){
        $(this).css('border','1px solid rgb(163, 161, 161)');
        $('.name_register_error').hide();
    })

    $('#lName_register').focus(function(){
        $(this).css('border','1px solid rgb(163, 161, 161)');
        $('.lname_register_error').hide();
    })

    $('#phone_register').focus(function(){
        $(this).css('border','1px solid rgb(163, 161, 161)');
        $('.phone_register_error').hide();
    })

    $('#address_register').focus(function(){
        $(this).css('border','1px solid rgb(163, 161, 161)');
    })

    $("#district_register").focus(function(){
        $("#district_register").css('border','1px solid rgb(163, 161, 161)');
    })

    $('#agree_register_button').on('click',function(){

        var name = $("#name_register").val();
        if(name =='')
        {
            $('#name_register').css('border','1px solid red');
            return;
        }
        var reg = new RegExp("^[a-zA-Z]{1,}$");
        if(!reg.test(name))
        {
            $('.name_register_error').show();
            return;
        }

        var lname = $("#lName_register").val();
        if(lname =='')
        {
            $('#lName_register').css('border','1px solid red');
            return;
        }
        if(!reg.test(lname))
        {
            $('.lname_register_error').show();
            return;
        } 

        var phone = $("#phone_register").val();
        if(phone =='')
        {
            $('#phone_register').css('border','1px solid red');
            return;
        }
        var regphone = new RegExp("^[0-9]{10}$");
        if(!regphone.test(phone))
        {
            $('.phone_register_error').show();
            return;
        }

        var add = $("#address_register").val();

        var district =  $("#district_register").val();
        if( district == null)
        {
            $("#district_register").css("border","1px solid red");
            return;
        }
        if(add =='')
        {
            $('#address_register').css('border','1px solid red');
            return;
        }
        $.ajax({
            url:'App/pont/pont_confirm_register.php',
            type:'POST',
            data:{"name":name,"lname":lname,"phone":phone,"add":add,"district":district},
            success:function(data){
                table = data;
                if(table[0])
                {
                    window.open(table[1],"_self");
                }
                else{
                    if(table[1] == 1)
                    {
                        $('.name_register_error').show();
                    }
                    else if(table[1] == 2)
                    {
                        $('.lname_register_error').show();
                    }
                    else if(table[1] == 3)
                    {
                        $('.phone_register_error').show();
                    }
                    else if(table[1] == 5)
                    {
                        alert("error");
                    }
                }
            },
            dataType:'json',
            error: function(thrownError) {
                //this is going to happen when you send something different from a 200 OK HTTP
                alert('Ooops, something happened: ' +thrownError);
                console.log(thrownError);
            }
        })
    })

    $('#log_champs').focus(function(){
        $('#log_champs').css('border','1px solid rgb(163, 161, 161)');
        $('.log_mail_error_message').hide();
    })

    $('#log_pass').focus(function(){
        $('#log_pass').css('border','1px solid rgb(163, 161, 161)');
        $('.log_pass_error_message').hide();
    })
    $('#log_button').on('click',function(){
        var mail = $('#log_champs').val();
        if(mail =='')
        {
            $('#log_champs').css('border','1px solid red');
            return;
        }

        var reg = new RegExp("^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$");
        if(!reg.test(mail))
        {
            $('#log_champs').css('border','1px solid red');
            $('.log_mail_error_message').show();
            return;
        }

        var pass = $('#log_pass').val();
        if(pass =='')
        {
            $('#log_pass').css('border','1px solid red');
            return;
        }

        var regPass = new RegExp('^[a-zA-Z0-9]{4,15}$')
        if(!regPass.test(pass))
        {
            $('#log_pass').css('border','1px solid red');
            $('.log_pass_error_message').show();
            return;
        }
        $.ajax({
            url:'App/pont/pont_connect.php',
            type:'POST',
            data:{"mail":mail,"pass":pass },
            success:function(data){
                table = data;
                if(table[0])
                {
                    window.open(table[1],"_self");
                }
                else{
                    if(table[1] == 1)
                    {
                        $('#log_champs').css('border','1px solid red');
                        $('.log_mail_error_message').show();
                    }
                    else if(table[1] == 2)
                    {
                        $('#log_pass').css('border','1px solid red');
                        $('.log_pass_error_message').show();
                    }
                    else if(table[1] == 4)
                    {
                        $('.log_sys_error_message').html(table[2]);
                        $('.log_sys_error_message').show();
                    }
                    else if(table[1] == 5)
                    {
                        $('.log_sys_error_message').html(table[2]);
                        $('.log_sys_error_message').show();
                    }
                }
            },
            dataType:'json',
            error: function(thrownError) {
                //this is going to happen when you send something different from a 200 OK HTTP
                alert('Ooops, something happened: ' +thrownError);
                console.log(thrownError);
            }

        })
    })
})