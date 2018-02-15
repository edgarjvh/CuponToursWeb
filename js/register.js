$(document).ready(function () {
   var reg_btn = $('div.register-btn');

   reg_btn.on('click',function () {
       var first = $('#txt-first-name');
       var last = $('#txt-last-name');
       var email = $('#txt-email');
       var pass = $('#txt-pass');
       var conf = $('#txt-pass-confirmation');
       var phone = $('#txt-phone');
       var country = $('#cbo-country');
       var error = $('div.errors');
       var err_msg = "";

       if (first.val().trim() === ""){
           err_msg = "Enter your first name";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
                           error.slideUp();
                       },3000);
           return;
       }

       if (last.val().trim() === ""){
           err_msg = "Enter your last name";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
                           error.slideUp();
                       },3000);
           return;
       }

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

       if (conf.val().trim() === ""){
           err_msg = "Must confirm your password";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
                           error.slideUp();
                       },3000);
           return;
       }

       if (pass.val().trim() !== conf.val().trim()){
           err_msg = "Password confirmation doesn't match";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
                           error.slideUp();
                       },3000);
           return;
       }

       if (phone.val().trim() === ""){
           err_msg = "Enter your phone number";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
                           error.slideUp();
                       },3000);
           return;
       }

       if (country.val() === "NON"){
           err_msg = "You must select your country";
           error.css('color','#7E0303');
           error.html(err_msg);
           error.slideDown();

           setTimeout(function () {
                           error.slideUp();
                       },3000);
           return;
       }

       error.css('color','green');
       error.html('<p><i class="fa fa-spin fa-spinner"></i>  Sending registration. Please wait...</p>');
       error.slideDown();

       $.ajax({
           type: "POST",
           url: '../controllers/user_controller.php',
           dataType:'json',
           data: {
               action:'registration',
               first:first.val().trim(),
               last:last.val().trim(),
               email:email.val().trim(),
               pass:pass.val().trim(),
               phone:phone.val().trim(),
               countryCode:country.val(),
               countryName:country.find('option:selected').text()
           },
           success: function (response) {
               console.log(response.result);

               switch (response.result){
                   case 'duplicate':
                       err_msg = "This email is already registered!";
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
                   default:
                       err_msg = "Registration sent for approval";
                       error.css('color','blue');
                       error.html(err_msg);
                       error.slideDown();

                       setTimeout(function () {
                           window.location.href = "../";
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