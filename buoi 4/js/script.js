$(document).ready(
    function(){
        //valite from Register
        $("#frmRegForm").validate({
            rules:{
                firstname:{
                    required:true,
                    minlength: 2                    
                },
                lastname:{
                    required: true,
                    minlength: 2
                },
                email:{
                    required: true,
                    email: true,
                },
                password:{
                    required: true,                    
                },
                repassword:{
                    required: true,
                    equalTo: '#password'                    
                },                
            },
            messagses:{
                firstname:{
                    required: 'Pls enter a valid first name',
                    minlength: 'at least 2 characters long' 
                },
                lastname:{
                    required: 'Pls enter a valid first name',
                    minlength: 'at least 2 characters long' 
                },
                email:{
                    required: 'pls enter an email',
                    email: 'it is not an email'
                },
                password:{
                    required: 'need a password',                    
                },
                repassword:{
                    required: 'need repasswrod',
                    equalTo: 'need equal to password before'                    
                },  
            }            
        })
        //validate form input book
        $("#frmInBook").validate({

        })
    }
);