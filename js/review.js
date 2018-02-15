$(document).ready(function () {

});

function sendDocument(doc_id) {

    var _canvas = document.getElementById("sig-canvas");
    var pop_up = $(document).find('div#dark-pop-up');
    var errors = $(document).find('div#errors');
    var error_msg = "";
    var isChecked = $('#cbox-agree-terms').prop('checked');

    if (isCanvasBlank(_canvas)){
        error_msg = error_msg === "" ? "You must supply your digital signature" : error_msg;
    }

    if($('#file').val() === "") {
        error_msg = error_msg === "" ? "You must select your document ID to upload" : error_msg;
    }

    if(!isChecked){
        error_msg = error_msg === "" ? "You must accept the terms of our services" : error_msg;
    }

    if (error_msg !== ""){
        errors.html(error_msg);
        errors.css('background-color', 'rgba(154,0,0,1)');
        errors.css('color', '#fff');
        errors.slideDown();

        setTimeout(function () {
            errors.slideUp();
        },2000);
        return;
    }

    var image = _canvas.toDataURL("image/png");
    image = image.replace('data:image/png;base64,', '');

    errors.html('<i class="fa fa-spin fa-spinner"></i>Sending Signature. Please wait...');
    errors.css('background-color', '#0A529F');
    errors.css('color', '#fff');
    errors.slideDown();
    pop_up.show();
    pop_up.css('opacity', 1);

    $.ajax({
        type: "post",
        url: '../controllers/signature_controller.php',
        dataType:'json',
        data: {
            action:'signDocument',
            token:doc_id,
            signature:image,
            docImage:$('#file-upload-64').val()
        },
        success: function (response) {
            console.log(response.result);

            switch (response.result){
                case 'signed':
                    errors.html("The document has been successfully e-signed");
                    errors.css('background-color', '#1b6e1d');
                    errors.css('color', '#fff');

                    setTimeout(function () {
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                        errors.slideUp();

                        window.location.href = '../';
                    },2000);
                    break;
                case 'error sending':
                    errors.html("Error sending the document");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();

                    setTimeout(function () {
                        errors.slideUp();
                    },2000);
                    break;
                default:
                    errors.html("This document doesn't exits");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();

                    setTimeout(function () {
                        errors.slideUp();
                    },2000);
                    break;
            }
        },
        failure: function () {
            errors.html("Connection error");
            errors.css('background-color', 'rgba(154,0,0,1)');
            errors.css('color', '#fff');
            errors.slideDown();

            setTimeout(function () {
                errors.slideUp();
            },2000);
        }
    });
}

function isCanvasBlank(canvas) {
    var blank = document.createElement('canvas');
    blank.width = canvas.width;
    blank.height = canvas.height;

    return canvas.toDataURL() === blank.toDataURL();
}

$('#file').change(function () {
    filePreview(this);
});

function filePreview(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-upload').attr('src',e.target.result);
            //$('#upload-form + img').remove();
            //$('#upload-form').after('<img src="' + e.target.result + '" id="img-upload" />');

            var result = e.target.result;
            var pos = result.indexOf("base64,");
            $('#file-upload-64').val(result.substring(pos + 7));

            $('#image-base').html(result.substring(pos + 7));
        };

        reader.readAsDataURL(input.files[0]);
    }
}