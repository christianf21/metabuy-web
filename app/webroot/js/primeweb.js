/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
   // $("#login-btn").modal();
    $('#alert_messages').animate({opacity: 1.0}, 6000).fadeOut();
    
    // Validator methods
    $.validator.addMethod("uniqueUsername",function(value,element){
       var valido = false;
       
            $.ajax({
                url : window.app.url+"/users/isUniqueUsernameAjax",
                type : "POST",
                data : {username : value},
                async: false,
                success : function(data){
            
                    if(parseInt(data) === 1)
                    {
                        valido = true;
                    }
                }
            });
           
        return valido;
    }, "This username is already taken...");
    
    $.validator.addMethod("uniqueEmail",function(value,element){
       var valido = false;
       
            $.ajax({
                url : window.app.url+"/users/isUniqueEmailAjax",
                type : "POST",
                data : {username : value},
                async: false,
                success : function(data){
            
                    if(parseInt(data) === 1)
                    {
                        valido = true;
                    }
                }
            });
           
        return valido;
    }, "This email is linked to an existing account...");
    
    $.validator.addMethod("matchesPassword",function(value,element){
       var valido = false;
       
       var tester = $("#password").val();
       
            if(value === tester)
            {
                valido = true;
            }
           
        return valido;
    }, "Passwords don't match...");
    
    $.validator.addMethod("minlengthpass",function(value,element){
       var valido = false;
      
            if(value.length > 7)
            {
                valido = true;
            }
           
        return valido;
    }, "Passwords must be at least 8 characters long");
    
    
    // Validate Register and Login
    
    $("#loginForm").validate({
        
        rules: {
            "data[username]":{required: true},
            "data[password]":{required:true}
        },
        messages: {
            "data[username]":{required: "Required"},
            "data[password]":{required:"Required"}
        }
        
    });
    
    $("#registerForm").validate({
        
        rules: {
            "data[username]":{required: true,uniqueUsername:true},
            "data[email]":{required:true,email:true, uniqueEmail:true},
            "data[password]":{required:true,minlengthpass:true},
            "data[confirm_password]":{required:true,matchesPassword:true}
        },
        messages: {
            "data[username]":{required: "Required"},
            "data[email]":{required:"Required",email: "Enter a valid email"},
            "data[password]":{required:"Required"},
            "data[confirm_password]":{required:"Required"}
        }
        
    });
    
    $("#forgotAccountForm").validate({
        
        rules: {
            "data[email]":{required:true,email:true}
        },
        messages: {
            "data[email]":{required:"Required",email: "Enter a valid email"}
        }
        
    });
});
