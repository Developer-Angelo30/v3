$(document).ready(()=>{

    const errorReset = () =>{
        $(document).on('click', '.input' , ()=>{
            $('.error').text('')
            $('.errorGlobal').addClass('d-none')
        } )
    }
    errorReset()

    const loginAccounts  = () =>{
        $(document).on('click','#login-form-submit' , ()=>{
            
            const submitBtn = $('#login-form-submit');
            const email = $('#login-email').val().toLowerCase();
            var errorEmail = $('.error-email'); 

            const password = $("#login-password").val();
            var errorPassword = $('.error-password');

            var errorGlobal = $('.errorGlobal');

            if(!email == ''){
                if(!password == ''){

                    if(email.includes("@gmail.com")){
                        if(password.length >= 8){
                            const data = {
                                "email": email,
                                "password": password,
                                "action-key": "2e8b348babede40bb697381a22d01f07"
                            }

                            $.ajax({
                                "method": $('#login-form').attr('method'),
                                "url": $('#login-form').attr('action'),
                                "data": data,
                                "dataType": "JSON",
                                beforeSend: ()=>{
                                    submitBtn.html('')
                                    submitBtn.html('<span><i class="fa fa-spin fa-spinner" >&nbsp;</i><strong>Please wait.</strong></span>');
                                    submitBtn.attr('disabled', true)
                                },
                                success: (response)=>{
                                    if(response.status == true){
                                        location.href = response.location
                                    }
                                    else{
                                        switch(response.error){
                                            case 'email':{
                                                errorEmail.text(response.message);
                                                break;
                                            }
                                            case 'password':{
                                                errorPassword.text(response.message);
                                                break;
                                            }
                                            default:{
                                                $('#login-email').val('')
                                                $('#login-password').val('')
                                                $('.errorGlobal').removeClass('d-none')
                                                $('.error').text('')
                                                errorGlobal.text(response.message)
                                                break;
                                            }
                                        }
                                    }
                                },
                                complete: ()=>{
                                    submitBtn.html('')
                                    submitBtn.html('<span><strong>Login </strong><i class="fa fa-arrow-right" ></i></span>');
                                    submitBtn.removeAttr('disabled')
                                }
                            })

                        }
                        else{
                            errorPassword.text("Password must be atleast 8 characters.");
                        }
                    }
                    else{
                        errorEmail.text("Please input valid email address.");
                    }
                }
                else{
                    errorPassword.text("This field is required.");
                }
            }
            else{
                errorEmail.text("This field is required.");
            }
        })
    }
    loginAccounts()

})