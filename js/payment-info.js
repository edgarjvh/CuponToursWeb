$(document).ready(function () {
    var txt_key = $(document).find('#txt-access-key');
    var btn_access = $(document).find('.btn-access');
    var message = $(document).find('.message');
    var token = $(document).find('input#txt-token');
    var content_page = $(document).find('div.content-page');
    var auth = $(document).find('section.auth');

    btn_access.on('click',function () {
        message.css('background-color', '#9A0000');
        message.removeClass('shown');
        message.html('');

        if (txt_key.val().trim() === ""){
            message.css('background-color', '#9A0000');
            message.addClass('shown');
            message.html('You must enter the access key');
            return;
        }

        message.css('background-color', '#374e81');
        message.addClass('shown');
        message.html('<i class="fa fa-spin fa-spinner"></i> Accessing... Please wait.');

        $.ajax({
            type: 'post',
            url: '../controllers/signature_controller.php',
            dataType: 'json',
            data: {
                action: 'getPaymentInfo',
                accessKey: txt_key.val().trim(),
                token: token.val()
            },
            success: function (response) {
                console.log(response);
                switch (response.result){
                    case 'ok':
                        var html = '<div class="content">\n' +
                            '        <div class="payment-info">\n' +
                            '            <div class="customer-name row">\n' +
                            '                <div class="left-col">Invoice Number</div>\n' +
                            '                <div class="right-col">'+response.data[0].doc_number+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="customer-name row">\n' +
                            '                <div class="left-col">Customer Name</div>\n' +
                            '                <div class="right-col">'+response.data[0].customer_name+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="customer-alias row">\n' +
                            '                <div class="left-col">Customer Alias</div>\n' +
                            '                <div class="right-col">'+response.data[0].customer_alias+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="card-type row">\n' +
                            '                <div class="left-col">Card Type</div>\n' +
                            '                <div class="right-col">'+response.data[0].card_type+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="card-holder row">\n' +
                            '                <div class="left-col">Card Holder</div>\n' +
                            '                <div class="right-col">'+response.data[0].card_holder+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="card-number row">\n' +
                            '                <div class="left-col">Card Number</div>\n' +
                            '                <div class="right-col">'+response.data[0].card_number+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="expiration-date row">\n' +
                            '                <div class="left-col">Expiration Date</div>\n' +
                            '                <div class="right-col">'+response.data[0].card_expiration_date+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="cvv row">\n' +
                            '                <div class="left-col">CVV</div>\n' +
                            '                <div class="right-col">'+response.data[0].card_cvv+'</div>\n' +
                            '            </div>\n' +
                            '            <div class="billing-address row">\n' +
                            '                <div class="left-col">Card Address</div>\n' +
                            '                <div class="right-col">'+response.data[0].card_address+'</div>\n' +
                            '            </div>\n' +
                            '        </div>\n' +
                            '    </div>';

                        auth.hide();

                        content_page.html(html);
                        break;
                    case 'wrong key':
                        message.css('background-color', '#9A0000');
                        message.addClass('shown');
                        message.html('Wrong access key');
                        txt_key.val('');
                        txt_key.focus();
                        break;
                    case 'error token':
                        message.css('background-color', '#9A0000');
                        message.addClass('shown');
                        message.html('Invalid token');
                        txt_key.val('');
                        txt_key.focus();
                        break;
                    case 'no document':
                        message.css('background-color', '#9A0000');
                        message.addClass('shown');
                        message.html('This document doesn\'t exist');
                        txt_key.val('');
                        txt_key.focus();
                        break;
                    default:
                        message.css('background-color', '#9A0000');
                        message.addClass('shown');
                        message.html('Connection error');
                        txt_key.val('');
                        txt_key.focus();
                        break;
                }
            },
            error:function (a,b,c) {

            }
        });

        message.toggleClass('shown');
    });
});