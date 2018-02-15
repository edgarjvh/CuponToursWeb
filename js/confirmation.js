$(document).ready(function () {
    var confirmation_btn = $('.confirmation-btn');
    var new_code_btn = $('#btn-new-code');


    confirmation_btn.on('click',function () {
       var txt_code = $('#txt-code');
       var lbl_email = $('#lbl-email');
       var error = $('div.errors');
       var err_msg = "";

       if (txt_code.val().trim() === ""){
           err_msg = "Enter the confirmation code";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
               error.slideUp();
           },3000);
           return;
       }

       if (txt_code.val().trim().length < 8){
           err_msg = "The confirmation code must contain 8 characters";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
               error.slideUp();
           },3000);
           return;
       }

        error.css('color','green');
        error.html('<p><i class="fa fa-spin fa-spinner"></i>  Sending code. Please wait...</p>');
        error.slideDown();

        $.ajax({
            type: "POST",
            url: '../controllers/user_controller.php',
            dataType:'json',
            data: {
                action:'confirmation',
                email:lbl_email.text(),
                code:txt_code.val().trim()
            },
            success: function (response) {
                console.log(response.result);

                switch (response.result){
                    case 'wrong code':
                        err_msg = "Wrong code";
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    case 'error':
                        err_msg = response.message;
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    default:
                        err_msg = "Your registration has been confirmed!";
                        error.css('color','blue');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            window.location.href = "../views/login.php";
                        },1000);
                        break;
                }
            },
            error: function () {
                err_msg = "Connection error";
                error.css('color','#7E0303');
                error.html(err_msg);
                error.slideDown();

                setTimeout(function () {
                    error.slideUp();
                },3000);
            }
        });
    });

    new_code_btn.on('click',function () {
        var lbl_email = $('#lbl-email');
        var error = $('div.errors');
        var err_msg = "";

        error.css('color','green');
        error.html('<p><i class="fa fa-spin fa-spinner"></i>  Getting new code. Please wait...</p>');
        error.slideDown();

        $.ajax({
            type: "POST",
            url: '../controllers/user_controller.php',
            dataType:'json',
            data: {
                action:'newCode',
                email:lbl_email.text()
            },
            success: function (response) {
                console.log(response.result);

                switch (response.result){
                    case 'error':
                        err_msg = response.message;
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    case 'no user':
                        err_msg = "This email is not registered!";
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    default:
                        err_msg = "A new code has been sent!";
                        error.css('color','blue');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                }
            },
            error: function () {
                err_msg = "Connection error";
                error.css('color','#7E0303');
                error.html(err_msg);
                error.slideDown();

                setTimeout(function () {
                    error.slideUp();
                },3000);
            }
        });
    });
});