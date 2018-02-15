$(document).ready(function () {
    var btn = $('div.login-btn');

    btn.on('click',function () {
        var email = $('#txt-email');
        var pass = $('#txt-pass');
        var error = $('div.errors');
        var err_msg = "";

        if (email.val().trim() === ""){
            err_msg = "Enter your email";
            error.css('color','#7E0303');
            error.html(err_msg);
            error.slideDown();

            setTimeout(function () {
                            error.slideUp();
                            },3000);
            return;
        }

        if (pass.val().trim() === ""){
            err_msg = "Enter your password";
            error.css('color','#7E0303');
            error.html(err_msg);
            error.slideDown();

            setTimeout(function () {
                            error.slideUp();
                            },3000);
            return;
        }

        error.css('color','green');
        error.html('<p><i class="fa fa-spin fa-spinner"></i>  Logging In. Please wait...</p>');
        error.slideDown();

        $.ajax({
            type: "POST",
            url: '../controllers/user_controller.php',
            dataType:'json',
            data: {
                action:'login',
                email:email.val().trim(),
                pass:pass.val().trim()
            },
            success: function (response) {
                switch (response.result){
                    case 'no user':
                        err_msg = "Invalid email or password";
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    case 'error':
                        err_msg = "Connection error";
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    case 'not confirmed':
                        err_msg = "You must wait for the admin to approve your request";
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    case 'inactive':
                        err_msg = "Inactive user";
                        error.css('color','#7E0303');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            error.slideUp();
                        },3000);
                        break;
                    default:
                        err_msg = "Welcome";
                        error.css('color','blue');
                        error.html(err_msg);
                        error.slideDown();

                        setTimeout(function () {
                            window.location.href = "../views/dash-member.php";
                        },1000);
                        break;
                }
            },
            error: function () {
                err_msg = "Error";
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