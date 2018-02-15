jQuery.fn.ForceNumericOnly = function(control,decimal,date) {
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal

            return (
                key === 8 ||
                key === 9 ||
                key === 13 ||
                key === 46 ||
                (decimal ? (control.val().indexOf('.') < 0 ? (key === 110 || key === 190) : 0) : 0) ||
                (date ? key === 109 || key === 173 : 0) ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));

        });
    });
};

var card_type = "";
var customer_id = 0;

$(document).ready(function () {
    getDocuments();
    getCustomersCount();

   $(document).on('click','li.menu-item', function () {
       var ul = $(this).parent();

       if (!$(this).hasClass('active')){
           ul.find('li').removeClass('active');
           $(this).addClass('active');

           $(document).find('div.signature-content').html('');

            switch ($(this).attr('id')){
                case 'documents':
                    var html = '<span class="btn-new-document"><i class="fa fa-file"></i>New Document</span>\n' +
                        '\n' +
                        '                    <div class="signature-description">\n' +
                        '\n' +
                        '                        <div class="tbl">\n' +
                        '                            <div class="tbl-head">\n' +
                        '                                <div class="tbl-row">\n' +
                        '                                    <div class="tbl-cell doc-id hidden">Doc Id</div>\n' +
                        '                                    <div class="tbl-cell show-pdf"></div>\n' +
                        '                                    <div class="tbl-cell customer">Customer</div>\n' +
                        '                                    <div class="tbl-cell doc-number">Number</div>\n' +
                        '                                    <div class="tbl-cell doc-date">Date</div>\n' +
                        '                                    <div class="tbl-cell doc-total">Total</div>\n' +
                        '                                    <div class="tbl-cell doc-status">Status</div>\n' +
                        '                                    <div class="tbl-cell doc-sent">Sent</div>\n' +
                        '                                    <div class="tbl-cell doc-signed">Signed</div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                            <div class="tbl-body">\n' +
                        '                                <div class="docs-message">\n' +
                        '                                    <i class="fa fa-spin fa-spinner"></i>\n' +
                        '                                </div>\n'+
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                    </div>';

                    $(document).find('div.signature-content').append(html);

                    $.ajax({
                        type:'post',
                        url:'../controllers/signature_controller.php',
                        dataType:'json',
                        data:{
                          action:'getUserDocs'
                        },
                        success:function (response) {

                            switch (response.result){
                                case 'ok':
                                    var count = response.data.length;
                                    var row = '';

                                    for (var i = 0; i < count; i++){
                                        var doc_id = response.data[i].doc_id;
                                        var customer_name = response.data[i].customer_name;
                                        var doc_number = response.data[i].doc_number;
                                        var doc_date = response.data[i].doc_date;
                                        var doc_total = accounting.formatMoney(response.data[i].doc_total,'$',2,'.',',');
                                        var status = Number(response.data[i].doc_paid_amount) < Number(response.data[i].doc_total) ? 'Unpaid' : 'Paid';
                                        var sent = response.data[i].doc_sent === "1" ? 'Yes' : 'No';
                                        var signed = response.data[i].doc_signed === "1" ? 'Yes' : 'No';

                                        row += '<div class="tbl-row">\n' +
                                            '          <div class="tbl-cell doc-id hidden">'+ doc_id +'</div>\n' +
                                            '          <div class="tbl-cell show-pdf"><i class="fa fa-file-pdf-o"></i></div>\n' +
                                            '          <div class="tbl-cell customer">'+ customer_name +'</div>\n' +
                                            '          <div class="tbl-cell doc-number">'+ doc_number +'</div>\n' +
                                            '          <div class="tbl-cell doc-date">'+ doc_date +'</div>\n' +
                                            '          <div class="tbl-cell doc-total">'+ doc_total +'</div>\n' +
                                            '          <div class="tbl-cell doc-status">'+ status +'</div>\n' +
                                            '          <div class="tbl-cell doc-sent">'+ sent +'</div>\n' +
                                            '          <div class="tbl-cell doc-signed">'+ signed +'</div>\n' +
                                            '      </div>';
                                    }

                                    $(document).find('div.tbl-body').css('display','none');
                                    $(document).find('div.tbl-body').html(row);
                                    $(document).find('div.tbl-body').fadeIn(500);
                                    $(document).find('span.document-count').text(count);

                                    break;
                                case 'no docs':
                                    $(document).find('div.tbl-body').css('display','none');
                                    $(document).find('div.tbl-body').html('' +
                                        '<div class="docs-message">\n' +
                                        '    <i>No documents to show</i>\n' +
                                        '</div>');
                                    $(document).find('div.tbl-body').fadeIn(500);
                                    $(document).find('span.document-count').text(0);
                                    break;
                                default:

                                    break;
                            }
                        },
                        error:function (a,b,c) {
                            $(document).find('div.tbl-body').css('display','none');
                            $(document).find('div.tbl-body').html('' +
                                '<div class="docs-message">\n' +
                                '    <i>Connection error</i>\n' +
                                '</div>');
                            $(document).find('div.tbl-body').fadeIn(500);
                            $(document).find('span.document-count').text(0);
                        }
                    });

                    break;
                case 'customers':
                    html = '<div class="signature-description">\n' +
                        '           <div class="tbl">\n' +
                        '               <div class="tbl-head">\n' +
                        '                   <div class="tbl-row">\n' +
                        '                       <div class="tbl-cell customer-id hidden">Id</div>\n' +
                        '                       <div class="tbl-cell customer-alias">Alias</div>\n' +
                        '                       <div class="tbl-cell customer-name">Name</div>\n' +
                        '                       <div class="tbl-cell customer-email">E-mail</div>\n' +
                        '                       <div class="tbl-cell customer-phone">Phone</div>\n' +
                        '                       <div class="tbl-cell customer-address">Address</div>\n' +
                        '                       <div class="tbl-cell customer-status">Status</div>\n' +
                        '                       <div class="tbl-cell edit-customer"></div>\n' +
                        '                       <div class="tbl-cell delete-customer"></div>\n' +
                        '                   </div>\n' +
                        '               </div>\n' +
                        '               <div class="tbl-body">\n' +
                        '                   <div class="docs-message">\n' +
                        '                       <i class="fa fa-spin fa-spinner"></i>\n' +
                        '                   </div>\n'+
                        '               </div>\n' +
                        '           </div>\n' +
                        '       </div>';

                    $(document).find('div.signature-content').append(html);

                    $.ajax({
                        type:'post',
                        url:'../controllers/signature_controller.php',
                        dataType:'json',
                        data:{
                            action:'getUserCustomers'
                        },
                        success:function (response) {

                            switch (response.result){
                                case 'ok':
                                    var count = response.data.length;
                                    var row = '';

                                    for (var i = 0; i < count; i++){
                                        var customer_id = response.data[i].customer_id;
                                        var customer_name = response.data[i].customer_name;
                                        var customer_alias = response.data[i].customer_alias;
                                        var customer_email = response.data[i].customer_email;
                                        var customer_address = response.data[i].customer_address;
                                        var customer_phone_number = response.data[i].customer_phone_number;
                                        var customer_status = response.data[i].customer_status === "1" ? "Active" : "Inactive";
                                        var checked = response.data[i].customer_status === "1" ? 'checked' : '';

                                        row += '<div class="tbl-row">\n' +
                                            '        <div class="tbl-cell customer-id hidden">'+customer_id+'</div>\n' +
                                            '        <div class="tbl-cell customer-alias"><input type="text" id="txt-customer-alias" value="'+customer_alias+'" readonly></div>\n' +
                                            '        <div class="tbl-cell customer-name"><input type="text" id="txt-customer-name" value="'+customer_name+'" readonly></div>\n' +
                                            '        <div class="tbl-cell customer-email"><input type="text" id="txt-customer-email" value="'+customer_email+'" readonly></div>\n' +
                                            '        <div class="tbl-cell customer-phone"><input type="text" id="txt-customer-phone" value="'+customer_phone_number+'" readonly></div>\n' +
                                            '        <div class="tbl-cell customer-address"><input type="text" id="txt-customer-address" value="'+customer_address+'" readonly></div>\n' +
                                            '        <div class="tbl-cell customer-status"><input type="checkbox" id="cbox-customer-status" '+checked+' disabled><span>'+customer_status+'</span></div>\n' +
                                            '        <div class="tbl-cell edit-customer"><i class="fa fa-pencil" title="edit"></i></div>\n' +
                                            '        <div class="tbl-cell delete-customer"><i class="fa fa-trash" title="delete"></i></div>\n' +
                                            '   </div>';
                                    }

                                    $(document).find('div.tbl-body').css('display','none');
                                    $(document).find('div.tbl-body').html(row);
                                    $(document).find('div.tbl-body').fadeIn(500);
                                    $(document).find('span.customer-count').text(count);

                                    break;
                                case 'no customers':
                                    $(document).find('div.tbl-body').css('display','none');
                                    $(document).find('div.tbl-body').html('' +
                                        '<div class="docs-message">\n' +
                                        '    <i>No customers to show</i>\n' +
                                        '</div>');
                                    $(document).find('div.tbl-body').fadeIn(500);
                                    $(document).find('span.document-count').text(0);
                                    break;
                                default:

                                    break;
                            }
                        },
                        error:function (a,b,c) {
                            $(document).find('div.tbl-body').css('display','none');
                            $(document).find('div.tbl-body').html('' +
                                '<div class="docs-message">\n' +
                                '    <i>Connection error</i>\n' +
                                '</div>');
                            $(document).find('div.tbl-body').fadeIn(500);
                            $(document).find('span.customer-count').text(0);
                        }
                    });
                    break;
            }
       }
   });

   $(document).on('click', 'div.tbl-body div.show-pdf i', function () {
        var row = $(this).parent().parent();
        var doc_number = row.find('div.doc-number').text();
        var doc_sent = row.find('div.doc-sent').text();
        var doc_signed = row.find('div.doc-signed').text();
        var errors = $(document).find('div#errors');

        if (doc_sent === 'No'){
            errors.html("This invoice hasn't been sent to the customer's email!");
            errors.css('background-color', 'rgba(154,0,0,1)');
            errors.css('color', '#fff');
            errors.slideDown();
            setTimeout(function () {
                errors.slideUp();
            },2000);
            return;
        }

        if (doc_signed === 'No'){
            errors.html("This invoice hasn't been signed yet!");
            errors.css('background-color', 'rgba(154,0,0,1)');
            errors.css('color', '#fff');
            errors.slideDown();
            setTimeout(function () {
                errors.slideUp();
            },2000);
            return;
        }

        $.ajax({
            type:'post',
            url:'../controllers/signature_controller.php',
            dataType:'json',
            data:{
                action:'getFilePath',
                docNumber:doc_number
            },
            success:function (response) {
                switch (response.result){
                    case 'no file':
                        errors.html("This file doesn't exist!");
                        errors.css('background-color', 'rgba(154,0,0,1)');
                        errors.css('color', '#fff');
                        errors.slideDown();
                        setTimeout(function () {
                            errors.slideUp();
                        },2000);
                        break;
                    case 'ok':
                        var filename = response.data;

                        var pdfViewer = $(document).find('.pdf-viewer');
                        pdfViewer.find('iframe').attr('src','../files/signed/'+filename);
                        pdfViewer.css('display','flex');
                        pdfViewer.find('iframe').fadeIn(500);

                        break;
                    default:
                        errors.html("An error occured while fetching the file");
                        errors.css('background-color', 'rgba(154,0,0,1)');
                        errors.css('color', '#fff');
                        errors.slideDown();
                        setTimeout(function () {
                            errors.slideUp();
                        },2000);
                        break;
                }
            },
            error:function (a,b,c) {
                errors.html("An error occured while fetching the file");
                errors.css('background-color', 'rgba(154,0,0,1)');
                errors.css('color', '#fff');
                errors.slideDown();
                setTimeout(function () {
                    errors.slideUp();
                    pop_up.css('opacity', 0);
                    pop_up.hide();
                },2000);
            }
        });
   });

   $(document).on('click', 'div.tbl-row i', function () {
       var row = $(this).parent().parent();
       switch ($(this).attr('title')){
           case 'edit':
               row.addClass('edit-mode');
               row.find('input[type=text]').attr('readonly',false);
               row.find('input[type=checkbox]').css('display','initial');
               row.find('input[type=checkbox]').attr('disabled',false);
               row.find('span').css('display','none');

               row.parent().find('i').addClass('disabled');
               row.find('div.edit-customer').html('<i class="fa fa-save" title="save"></i>');
               row.find('div.delete-customer').html('<i class="fa fa-ban" title="cancel"></i>');
               break;
           case 'delete':
               errors = $(document).find('div#errors');
               pop_up = $(document).find('div#dark-pop-up');

               if (confirm('Are you sure you want to delete this customer? Remember that if so, the associated documents will also be deleted')){
                   row = $(this).parent().parent();
                   var customer_id = row.find('div.customer-id').text();

                   errors.html('<i class="fa fa-spin fa-spinner"></i>Deleting customer. Please wait...');
                   errors.css('background-color', '#0A529F');
                   errors.css('color', '#fff');
                   errors.slideDown();

                   pop_up.show();
                   pop_up.css('opacity', 1);

                   $.ajax({
                       type:'post',
                       url:'../controllers/signature_controller.php',
                       dataType:'json',
                       data:{
                           action:'deleteCustomer',
                           customerId:customer_id
                       },
                       success:function (response) {
                           switch (response.result){
                               case 'ok':
                                   errors.html("The customer has been successfully deleted!");
                                   errors.css('background-color', '#1b6e1d');
                                   errors.css('color', '#fff');
                                   errors.slideDown();
                                   setTimeout(function () {
                                       errors.slideUp();
                                       pop_up.css('opacity', 0);
                                       pop_up.hide();
                                       getCustomersList();
                                   },3000);
                                   break;
                               default:
                                   errors.html("Connection error!");
                                   errors.css('background-color', 'rgba(154,0,0,1)');
                                   errors.css('color', '#fff');
                                   errors.slideDown();
                                   setTimeout(function () {
                                       errors.slideUp();
                                       pop_up.css('opacity', 0);
                                       pop_up.hide();
                                   },2000);
                                   break;
                           }
                       },
                       error:function (a,b,c) {
                           errors.html("Connection error!");
                           errors.css('background-color', 'rgba(154,0,0,1)');
                           errors.css('color', '#fff');
                           errors.slideDown();
                           setTimeout(function () {
                               errors.slideUp();
                               pop_up.css('opacity', 0);
                               pop_up.hide();
                           },2000);
                       }
                   });
               }

               break;
           case 'save':
               row = $(this).parent().parent();
               customer_id = row.find('div.customer-id').text();
               var customer_alias = row.find('input#txt-customer-alias').val().trim();
               var customer_name = row.find('input#txt-customer-name').val().trim();
               var customer_email = row.find('input#txt-customer-email').val().trim();
               var customer_phone = row.find('input#txt-customer-phone').val().trim();
               var customer_address = row.find('input#txt-customer-address').val().trim();
               var customer_status = row.find('input[type=checkbox]').is(':checked') ? "1" : "0";
               var errors = $(document).find('div#errors');
               var pop_up = $(document).find('div#dark-pop-up');

               if (customer_alias === ""){
                   errors.html("Customer's alias cannot be empty!");
                   errors.css('background-color', 'rgba(154,0,0,1)');
                   errors.css('color', '#fff');
                   errors.slideDown();
                   setTimeout(function () {
                       errors.slideUp();
                   },2000);
                   return;
               }

               if (customer_name === ""){
                   errors.html("Customer's name cannot be empty!");
                   errors.css('background-color', 'rgba(154,0,0,1)');
                   errors.css('color', '#fff');
                   errors.slideDown();
                   setTimeout(function () {
                       errors.slideUp();
                   },2000);
                   return;
               }

               if (customer_email === ""){
                   errors.html("Customer's email cannot be empty!");
                   errors.css('background-color', 'rgba(154,0,0,1)');
                   errors.css('color', '#fff');
                   errors.slideDown();
                   setTimeout(function () {
                       errors.slideUp();
                   },2000);
                   return;
               }

               if (!validateEmail(customer_email)){
                   errors.html("Customer's email has a wrong or invalid format!");
                   errors.css('background-color', 'rgba(154,0,0,1)');
                   errors.css('color', '#fff');
                   errors.slideDown();
                   setTimeout(function () {
                       errors.slideUp();
                   },2000);
                   return;
               }

               if (customer_phone === ""){
                   errors.html("Customer's phone number cannot be empty!");
                   errors.css('background-color', 'rgba(154,0,0,1)');
                   errors.css('color', '#fff');
                   errors.slideDown();
                   setTimeout(function () {
                       errors.slideUp();
                   },2000);
                   return;
               }

               if (customer_address === ""){
                   errors.html("Customer's address cannot be empty!");
                   errors.css('background-color', 'rgba(154,0,0,1)');
                   errors.css('color', '#fff');
                   errors.slideDown();
                   setTimeout(function () {
                       errors.slideUp();
                   },2000);
                   return;
               }

               errors.html('<i class="fa fa-spin fa-spinner"></i>Updating customer. Please wait...');
               errors.css('background-color', '#0A529F');
               errors.css('color', '#fff');
               errors.slideDown();

               pop_up.show();
               pop_up.css('opacity', 1);

               $.ajax({
                   type:'post',
                   url:'../controllers/signature_controller.php',
                   dataType:'json',
                   data:{
                       action:'updateCustomer',
                       customerId:customer_id,
                       customerAlias:customer_alias,
                       customerName:customer_name.toUpperCase(),
                       customerEmail:customer_email.toLowerCase(),
                       customerPhone:customer_phone,
                       customerAddress:customer_address.toUpperCase(),
                       customerStatus:customer_status
                   },
                   success:function (response) {
                       switch (response.result){
                           case 'ok':
                               errors.html("The customer has been successfully updated!");
                               errors.css('background-color', '#1b6e1d');
                               errors.css('color', '#fff');
                               errors.slideDown();
                               setTimeout(function () {
                                   errors.slideUp();
                                   pop_up.css('opacity', 0);
                                   pop_up.hide();
                                   getCustomersList();
                               },3000);
                               break;
                           default:
                               errors.html("Connection error!");
                               errors.css('background-color', 'rgba(154,0,0,1)');
                               errors.css('color', '#fff');
                               errors.slideDown();
                               setTimeout(function () {
                                   errors.slideUp();
                                   pop_up.css('opacity', 0);
                                   pop_up.hide();
                               },2000);
                               break;
                       }
                   },
                   error:function (a,b,c) {
                       errors.html("Connection error!");
                       errors.css('background-color', 'rgba(154,0,0,1)');
                       errors.css('color', '#fff');
                       errors.slideDown();
                       setTimeout(function () {
                           errors.slideUp();
                           pop_up.css('opacity', 0);
                           pop_up.hide();
                       },2000);
                   }
               });

               break;
           case 'cancel':
               getCustomersList();
               break;
       }


   });


   $(document).on('click', '.pdf-viewer .title span', function () {
       var pdfViewer = $(document).find('.pdf-viewer');
       pdfViewer.find('iframe').fadeIn(500);
       pdfViewer.find('iframe').attr('src','');
       pdfViewer.css('display','none');
   });

   $(document).on('click','div.signature-content span.btn-new-document', function () {
       $(document).find('div.new-document').html('');
       $(document).find('div.new-document').append(getNewDocHtml());
       getCustomers();
       $(document).find('div.signature').find('div.new-document').css('left','0');
       $(document).find('input#txt-invoice-date').ForceNumericOnly($(document).find('input#txt-invoice-date'),false,true);
       $(document).find('input#txt-invoice-due-days').ForceNumericOnly($(document).find('input#txt-invoice-due-days'),false,false);
       $(document).find('input#txt-item-qty').ForceNumericOnly($(document).find('input#txt-item-qty'),true,false);
       $(document).find('input#txt-item-price').ForceNumericOnly($(document).find('input#txt-item-price'),true,false);
       $(document).find('input#txt-item-total').ForceNumericOnly($(document).find('input#txt-item-total'),true,false);
       $(document).find('input#txt-card-number').ForceNumericOnly($(document).find('input#txt-card-number'),false,false);
       $(document).find('input#txt-card-expiration-date').ForceNumericOnly($(document).find('input#txt-card-expiration-date'),false,true);
       $(document).find('input#txt-card-cvv').ForceNumericOnly($(document).find('input#txt-card-cvv'),false,false);
       $(document).find('input#txt-tax-value').ForceNumericOnly($(document).find('input#txt-tax-value'),true,false);
   });

   $(document).on('click','div.new-document div.title p i', function () {
       var parent = $(this).parent().parent().parent();
       parent.css('left', 'calc(-100% - 40px)');
   });

   $(document ).on( "click", function( event ) {
        $('div.signature').find('div.new-document section').removeClass('highlight');
        $( event.target ).closest( "section" ).addClass( "highlight" );
    });

   $(document).on('mousedown','div.btn-proceed', function (event) {
       if (event.which === 1){
            $(this).css('transform','scale(0.99,0.95)');
       }
   });

   $(document).on('mouseup','div.btn-proceed', function (event) {
        if (event.which === 1){
            $(this).css('transform','scale(1,1)');
        }
    });

   $(document).on('click','div.btn-proceed', function () {
        saveDoc();
    });

   $(document).on('keyup','input#txt-item-qty',function () {
        var parent = $(this).parent().parent();
        var _qty = $(this).val().trim() === '' ? 0 : Number($(this).val());
        var _price = parent.find('#txt-item-price').val().trim() === '' ? 0 : Number(parent.find('#txt-item-price').val());
        parent.find('input#txt-item-total').val(parseFloat(_qty * _price).toFixed(2));

        calculateTotals();
    });

   $(document).on('blur', 'input#txt-item-qty', function () {
        var parent = $(this).parent().parent();
        var _qty = $(this).val().trim() === '' ? 0 : Number($(this).val());
        var _price = parent.find('input#txt-item-price') .val().trim() === '' ? 0 : Number(parent.find('input#txt-item-price').val());
        $(this).val(parseFloat(_qty).toFixed(2));
        parent.find('input#txt-item-total').val(parseFloat(_qty * _price).toFixed(2));

        calculateTotals();
    });

   $(document).on('keyup','input#txt-item-price',function () {
        var parent = $(this).parent().parent();
        var _price = $(this).val().trim() === '' ? 0 : Number($(this).val());
        var _qty = parent.find('input#txt-item-qty') .val().trim() === '' ? 0 : Number(parent.find('input#txt-item-qty') .val());
        parent.find('input#txt-item-total').val(parseFloat(_qty * _price).toFixed(2));

        calculateTotals();
    });

   $(document).on('blur','input#txt-item-price',function () {
        var parent = $(this).parent().parent();
        var _price = $(this).val().trim() === '' ? 0 : Number($(this).val());
        var _qty = parent.find('input#txt-item-qty') .val().trim() === '' ? 0 : Number(parent.find('input#txt-item-qty') .val());
        $(this).val(parseFloat(_price).toFixed(2));
        parent.find('input#txt-item-total').val(parseFloat(_qty * _price).toFixed(2));

        calculateTotals();
    });

   $(document).on('keyup','input#txt-tax-value',function () {
        calculateTotals();
    });

   $(document).on('blur','input#txt-tax-value',function () {
        var parent = $(this).parent().parent();
        var tax = $(this).val().trim() === '' ? 0 : $(this).val().trim();
        $(this).val(parseFloat(tax).toFixed(2));

        calculateTotals();
    });

   $(document).on('click','i#delete',function () {
        var parent = $(this).parent().parent();
        parent.remove();

        if ($(document).find('.tbody').find('div.row').length === 0){
            $(document).find('.tbody').append('<div class="row">\n' +
                '                    <div class="col col-1">\n' +
                '                        1\n' +
                '                    </div>\n' +
                '                    <div class="col col-2">\n' +
                '                        <input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" placeholder="quantity">\n' +
                '                    </div>\n' +
                '                    <div class="col col-3">\n' +
                '                        <input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" placeholder="description">\n' +
                '                    </div>\n' +
                '                    <div class="col col-4 money">\n' +
                '                        <input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" placeholder="unit price">\n' +
                '                    </div>\n' +
                '                    <div class="col col-5 money">\n' +
                '                        <input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" placeholder="total amount" readonly>\n' +
                '                    </div>\n' +
                '                    <div class="col col-6">\n' +
                '                        <input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax">\n' +
                '                    </div>\n' +
                '                    <div class="col col-7">\n' +
                '                        <i id="delete" class="fa fa-times"></i>\n' +
                '                    </div>\n' +
                '                </div>');
        }

        setRowItemsCount();
        calculateTotals();
    });

   $(document).on('change', 'input[type=checkbox]', function () {
        calculateTotals();
    });

   $(document).on('click','div.add-item',function () {
       console.log('entro');
        $(document).find('.tbody').append('<div class="row">\n' +
            '                    <div class="col col-1">\n' +
            '                        1\n' +
            '                    </div>\n' +
            '                    <div class="col col-2">\n' +
            '                        <input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" placeholder="quantity">\n' +
            '                    </div>\n' +
            '                    <div class="col col-3">\n' +
            '                        <input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" placeholder="description">\n' +
            '                    </div>\n' +
            '                    <div class="col col-4 money">\n' +
            '                        <input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" placeholder="unit price">\n' +
            '                    </div>\n' +
            '                    <div class="col col-5 money">\n' +
            '                        <input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" placeholder="total amount" readonly>\n' +
            '                    </div>\n' +
            '                    <div class="col col-6">\n' +
            '                        <input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax">\n' +
            '                    </div>\n' +
            '                    <div class="col col-7">\n' +
            '                        <i id="delete" class="fa fa-times"></i>\n' +
            '                    </div>\n' +
            '                </div>');

        setRowItemsCount();
        calculateTotals();
    });

   $(document).on('click','i#add-new-customer',function () {
        $(document).find('select#cbo-select-customer').prop('selectedIndex',0);
        $(document).find('input.customer-info').prop('disabled',false);
        $(document).find('input.customer-info').val('');
        $(document).find('input#txt-customer-alias').focus();
    });

   $(document).on('change','select#cbo-select-customer',function () {
        if ($(this).prop('selectedIndex') > 0){
            $(document).find('input.customer-info').prop('disabled',true);

            var obj = JSON.parse($(this).val());
            $(document).find('#txt-customer-alias').val(obj.customer_alias);
            $(document).find('#txt-customer-name').val(obj.customer_name);
            $(document).find('#txt-customer-email').val(obj.customer_email);
            $(document).find('#txt-customer-phone-number').val(obj.customer_phone_number);
            $(document).find('#txt-customer-address').val(obj.customer_address);

            customer_id = obj.customer_id;
        }else{
            $(document).find('input.customer-info').val('');
            customer_id = 0;
        }
    });

   $(document).on('change','input[type=radio]',function () {
       card_type = $(this).attr('title');
    });
});

function getDocuments() {
    $.ajax({
        type:'post',
        url:'../controllers/signature_controller.php',
        dataType:'json',
        data:{
            action:'getUserDocs'
        },
        success:function (response) {

            switch (response.result){
                case 'ok':
                    var count = response.data.length;
                    var row = '';

                    for (var i = 0; i < count; i++){
                        var doc_id = response.data[i].doc_id;
                        var customer_name = response.data[i].customer_name;
                        var doc_number = response.data[i].doc_number;
                        var doc_date = response.data[i].doc_date;
                        var doc_total = accounting.formatMoney(response.data[i].doc_total,'$',2,'.',',');
                        var status = Number(response.data[i].doc_paid_amount) < Number(response.data[i].doc_total) ? 'Unpaid' : 'Paid';
                        var sent = response.data[i].doc_sent === "1" ? 'Yes' : 'No';
                        var signed = response.data[i].doc_signed === "1" ? 'Yes' : 'No';

                        row += '<div class="tbl-row">\n' +
                            '          <div class="tbl-cell doc-id hidden">'+ doc_id +'</div>\n' +
                            '          <div class="tbl-cell show-pdf"><i class="fa fa-file-pdf-o"></i></div>\n' +
                            '          <div class="tbl-cell customer">'+ customer_name +'</div>\n' +
                            '          <div class="tbl-cell doc-number">'+ doc_number +'</div>\n' +
                            '          <div class="tbl-cell doc-date">'+ doc_date +'</div>\n' +
                            '          <div class="tbl-cell doc-total">'+ doc_total +'</div>\n' +
                            '          <div class="tbl-cell doc-status">'+ status +'</div>\n' +
                            '          <div class="tbl-cell doc-sent">'+ sent +'</div>\n' +
                            '          <div class="tbl-cell doc-signed">'+ signed +'</div>\n' +
                            '      </div>';
                    }

                    $(document).find('div.tbl-body').css('display','none');
                    $(document).find('div.tbl-body').html(row);
                    $(document).find('div.tbl-body').fadeIn(500);
                    $(document).find('span.document-count').text(count);

                    break;
                case 'no docs':
                    $(document).find('div.tbl-body').css('display','none');
                    $(document).find('div.tbl-body').html('' +
                        '<div class="docs-message">\n' +
                        '    <i>No documents to show</i>\n' +
                        '</div>');
                    $(document).find('div.tbl-body').fadeIn(500);
                    $(document).find('span.document-count').text('0');
                    break;
                default:

                    break;
            }
        },
        error:function (a,b,c) {

        }
    });
}

function getCustomersList(){
    html = '<div class="signature-description">\n' +
        '           <div class="tbl">\n' +
        '               <div class="tbl-head">\n' +
        '                   <div class="tbl-row">\n' +
        '                       <div class="tbl-cell customer-id hidden">Id</div>\n' +
        '                       <div class="tbl-cell customer-alias">Alias</div>\n' +
        '                       <div class="tbl-cell customer-name">Name</div>\n' +
        '                       <div class="tbl-cell customer-email">E-mail</div>\n' +
        '                       <div class="tbl-cell customer-phone">Phone</div>\n' +
        '                       <div class="tbl-cell customer-address">Address</div>\n' +
        '                       <div class="tbl-cell customer-status">Status</div>\n' +
        '                       <div class="tbl-cell edit-customer"></div>\n' +
        '                       <div class="tbl-cell delete-customer"></div>\n' +
        '                   </div>\n' +
        '               </div>\n' +
        '               <div class="tbl-body">\n' +
        '                   <div class="docs-message">\n' +
        '                       <i class="fa fa-spin fa-spinner"></i>\n' +
        '                   </div>\n'+
        '               </div>\n' +
        '           </div>\n' +
        '       </div>';

    $(document).find('div.signature-content').html(html);

    $.ajax({
        type:'post',
        url:'../controllers/signature_controller.php',
        dataType:'json',
        data:{
            action:'getUserCustomers'
        },
        success:function (response) {

            switch (response.result){
                case 'ok':
                    var count = response.data.length;
                    var row = '';

                    for (var i = 0; i < count; i++){
                        var customer_id = response.data[i].customer_id;
                        var customer_name = response.data[i].customer_name;
                        var customer_alias = response.data[i].customer_alias;
                        var customer_email = response.data[i].customer_email;
                        var customer_address = response.data[i].customer_address;
                        var customer_phone_number = response.data[i].customer_phone_number;
                        var customer_status = response.data[i].customer_status === "1" ? "Active" : "Inactive";
                        var checked = response.data[i].customer_status === "1" ? 'checked' : '';

                        row += '<div class="tbl-row">\n' +
                            '        <div class="tbl-cell customer-id hidden">'+customer_id+'</div>\n' +
                            '        <div class="tbl-cell customer-alias"><input type="text" id="txt-customer-alias" value="'+customer_alias+'" readonly></div>\n' +
                            '        <div class="tbl-cell customer-name"><input type="text" id="txt-customer-name" value="'+customer_name+'" readonly></div>\n' +
                            '        <div class="tbl-cell customer-email"><input type="text" id="txt-customer-email" value="'+customer_email+'" readonly></div>\n' +
                            '        <div class="tbl-cell customer-phone"><input type="text" id="txt-customer-phone" value="'+customer_phone_number+'" readonly></div>\n' +
                            '        <div class="tbl-cell customer-address"><input type="text" id="txt-customer-address" value="'+customer_address+'" readonly></div>\n' +
                            '        <div class="tbl-cell customer-status"><input type="checkbox" id="cbox-customer-status" '+checked+' disabled><span>'+customer_status+'</span></div>\n' +
                            '        <div class="tbl-cell edit-customer"><i class="fa fa-pencil" title="edit"></i></div>\n' +
                            '        <div class="tbl-cell delete-customer"><i class="fa fa-trash" title="delete"></i></div>\n' +
                            '   </div>';
                    }

                    $(document).find('div.tbl-body').css('display','none');
                    $(document).find('div.tbl-body').html(row);
                    $(document).find('div.tbl-body').fadeIn(500);
                    $(document).find('span.customer-count').text(count);

                    break;
                case 'no customers':
                    $(document).find('div.tbl-body').css('display','none');
                    $(document).find('div.tbl-body').html('' +
                        '<div class="docs-message">\n' +
                        '    <i>No customers to show</i>\n' +
                        '</div>');
                    $(document).find('div.tbl-body').fadeIn(500);
                    $(document).find('span.document-count').text(0);
                    break;
                default:

                    break;
            }
        },
        error:function (a,b,c) {
            $(document).find('div.tbl-body').css('display','none');
            $(document).find('div.tbl-body').html('' +
                '<div class="docs-message">\n' +
                '    <i>Connection error</i>\n' +
                '</div>');
            $(document).find('div.tbl-body').fadeIn(500);
            $(document).find('span.customer-count').text(0);
        }
    });
}

function getCustomersCount() {
    $.ajax({
        type:'post',
        url:'../controllers/signature_controller.php',
        dataType:'json',
        data:{
            action:'getUserCustomers'
        },
        success:function (response) {
            switch (response.result){
                case 'ok':
                    var count = response.data.length;
                    $(document).find('span.customer-count').text(count);
                    break;
                default:
                    $(document).find('span.document-count').text(0);
                    break;
            }
        },
        error:function (a,b,c) {
            $(document).find('span.customer-count').text(0);
        }
    });
}

function getCustomers() {
    $.ajax({
        type:'post',
        url: '../controllers/user_controller.php',
        dataType:'json',
        data: {
            action:'getCustomers'
        },
        success: function (response) {
            var count = response.data.length;

            $(document).find('select#cbo-select-customer option').remove();

            var cbo_customers = $(document).find('select#cbo-select-customer');

            cbo_customers.append('<option value="0">Select your customer</option>')


            for (var i = 0;i < count; i++){
                cbo_customers.append('<option value="' + (JSON.stringify(response.data[i])).replace(/"/g, '&quot;') +'">' + response.data[i].customer_alias + '</option>');
            }
        },
        error: function (a,b,c) {

        }
    });
}

function calculateTotals(){
    var table = $(document).find('div.tbody');
    var tax_value = $(document).find('input#txt-tax-value').val().trim() === "" ? 0 : Number($(document).find('input#txt-tax-value').val().trim()).toFixed(2);
    var _subtotal = 0;
    var _tax = 0;
    var _total = 0;

    var count = $('div.tbody').find('div.row').length;

    for (var i = 0; i < count; i++){
        var total_item = $('div.tbody div.row').eq(i).find('div.col-5 input').val().trim() === "" ? 0 : parseFloat($('div.tbody div.row').eq(i).find('div.col-5 input').val().trim()).toFixed(2);
        var tax_item = 0;

        if ($('div.tbody div.row').eq(i).find('div.col-6 input').is(':checked')){
            tax_item = Number((Number(total_item) * Number(tax_value)) / 100).toFixed(2);
        }

        _subtotal += Number(total_item);
        _tax += Number(tax_item);
        _total = Number(_subtotal) + Number(_tax);

        $(document).find('span#txt-subtotal').text(Number(_subtotal).toFixed(2));
        $(document).find('span#txt-tax-amount').text(Number(_tax).toFixed(2));
        $(document).find('span#txt-total').text(Number(_total).toFixed(2));
    }
}

function setRowItemsCount() {
    var table = $(document).find('div.tbody');
    var rowLength = table.find('div.row').length;
    var count = 0;

    $('div.row', table).each(function () {
        count++;
        $(this).find('div.col-1').html(count);
    });
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email.toLowerCase());
}

function saveDoc() {
    var pop_up = $(document).find('div#dark-pop-up');
    var customer_alias = $(document).find('input#txt-customer-alias');
    var customer_name = $(document).find('input#txt-customer-name');
    var customer_email = $(document).find('input#txt-customer-email');
    var customer_phone = $(document).find('input#txt-customer-phone-number');
    var customer_address = $(document).find('input#txt-customer-address');
    var invoice_number = $(document).find('input#txt-invoice-number');
    var invoice_date = $(document).find('input#txt-invoice-date');
    var invoice_due_days = $(document).find('input#txt-invoice-due-days');
    var card_holder = $(document).find('input#txt-card-holder');
    var card_number = $(document).find('input#txt-card-number');
    var card_expiration_date = $(document).find('input#txt-card-expiration-date');
    var card_cvv = $(document).find('input#txt-card-cvv');
    var card_address = $(document).find('input#txt-card-address');
    var tax_value = $(document).find('input#txt-tax-value');
    var subtotal = $(document).find('span#txt-subtotal');
    var tax_amount = $(document).find('span#txt-tax-amount');
    var total = $(document).find('span#txt-total');
    var observations = $(document).find('textarea#txt-invoice-observations');
    var tbody = $(document).find('.tbody');
    var invoice_data;
    var items_data = '';
    var errors = $(document).find('div#errors');
    var error_msg = "";
    var field = null;

    if (customer_alias.val().trim() === ""){
        error_msg = error_msg === "" ? "Customer's alias cannot be empty" : error_msg;
        field = field === null ? customer_alias : field;
    }

    if (customer_name.val().trim() === ""){
        error_msg = error_msg === "" ? "Customer's name cannot be empty" : error_msg;
        field = field === null ? customer_name : field;
    }

    if (customer_email.val().trim() === ""){
        error_msg = error_msg === "" ? "Customer's email cannot be empty" : error_msg;
        field = field === null ? customer_email : field;
    }

    if (!validateEmail(customer_email.val().trim())){
        error_msg = error_msg === "" ? "Customer's email has a wrong format" : error_msg;
        field = field === null ? customer_email : field;
    }

    if (customer_phone.val().trim() === ""){
        error_msg = error_msg === "" ? "Customer's phone number cannot be empty" : error_msg;
        field = field === null ? customer_phone : field;
    }

    if (customer_address.val().trim() === ""){
        error_msg = error_msg === "" ? "Customer's address cannot be empty" : error_msg;
        field = field === null ? customer_address : field;
    }

    if (invoice_number.val().trim() === ""){
        error_msg = error_msg === "" ? "The invoice number cannot be empty" : error_msg;
        field = field === null ? invoice_number : field;
    }

    if (invoice_date.val().trim() === ""){
        error_msg = error_msg === "" ? "The invoice date cannot be empty" : error_msg;
        field = field === null ? invoice_date : field;
    }

    if (invoice_due_days.val().trim() === ""){
        error_msg = error_msg === "" ? "The invoice due days cannot be empty" : error_msg;
        field = field === null ? invoice_due_days : field;
    }

    for (var i = 0; i < tbody.find('div.row').length; i++){
        var txt_qty = tbody.find('div.row').eq(i).find('input#txt-item-qty');
        var txt_desc = tbody.find('div.row').eq(i).find('input#txt-item-desc');
        var txt_price = tbody.find('div.row').eq(i).find('input#txt-item-price');
        var txt_total = tbody.find('div.row').eq(i).find('input#txt-item-total');
        var isTax = tbody.find('div.row').eq(i).find('input#cbox-item-tax');

        if (txt_qty.val().trim() === ""){
            error_msg = error_msg === "" ? "The item's quantity cannot be empty" : error_msg;
            field = field === null ? txt_qty : field;
            break;
        }else{
            items_data = items_data + ',{"qty":"' + txt_qty.val().trim().replace(",",".") + '",';
        }

        if (txt_desc.val().trim() === ""){
            error_msg = error_msg === "" ? "The item's description cannot be empty" : error_msg;
            field = field === null ? txt_desc : field;
            break;
        }else{
            items_data = items_data + '"desc":"' + txt_desc.val().trim().toUpperCase() + '",';
        }

        if (txt_price.val().trim() === ""){
            error_msg = error_msg === "" ? "The item's price cannot be empty" : error_msg;
            field = field === null ? txt_price : field;
            break;
        }else{
            items_data = items_data + '"price":"' + txt_price.val().trim().replace(",",".") + '",';
        }

        items_data = items_data + '"total":"' + txt_total.val().trim().replace(",",".") + '",';
        items_data = items_data + '"taxed":' + isTax.is(':checked') + '}';
    }

    if (card_holder.val().trim() === ""){
        error_msg = error_msg === "" ? "The card holder's name cannot be empty" : error_msg;
        field = field === null ? card_holder : field;
    }

    if (card_number.val().trim() === ""){
        error_msg = error_msg === "" ? "The card number cannot be empty" : error_msg;
        field = field === null ? card_number : field;
    }

    if (card_expiration_date.val().trim() === ""){
        error_msg = error_msg === "" ? "The card expiration date cannot be empty" : error_msg;
        field = field === null ? card_expiration_date : field;
    }

    if (card_cvv.val().trim() === ""){
        error_msg = error_msg === "" ? "The card cvv cannot be empty" : error_msg;
        field = field === null ? card_cvv : field;
    }

    if (card_address.val().trim() === ""){
        error_msg = error_msg === "" ? "The card billing address cannot be empty" : error_msg;
        field = field === null ? card_address : field;
    }

    if (card_type === ""){
        error_msg = error_msg === "" ? "You must select the card type" : error_msg;
        field = $(document).find('input#cbox-visa');
    }

    if (total.text() === "0.00"){
        error_msg = error_msg === "" ? "the total amount must be greater than 0" : error_msg;
        field = field === null ? total : field;
    }

    if (error_msg !== ""){
        errors.html(error_msg);
        errors.css('background-color', 'rgba(154,0,0,1)');
        errors.css('color', '#fff');
        errors.slideDown();
        setTimeout(function () {
            errors.slideUp();
        },2000);

        if (field !== null){
            field.focus();
        }

        return;
    }

    invoice_data = '{' +
        '"customerId":"[customerId]",'+
        '"customerAlias":"[customerAlias]",'+
        '"customerName":"[customerName]",'+
        '"customerEmail":"[customerEmail]",'+
        '"customerPhone":"[customerPhone]",'+
        '"customerAddress":"[customerAddress]",'+
        '"invoiceNumber":"[invoiceNumber]",'+
        '"invoiceDate":"[invoiceDate]",'+
        '"invoiceDueDays":"[invoiceDueDays]",'+
        '"cardType":"[cardType]",'+
        '"cardHolder":"[cardHolder]",'+
        '"cardNumber":"[cardNumber]",'+
        '"cardExpirationDate":"[cardExpirationDate]",'+
        '"cardCvv":"[cardCvv]",'+
        '"cardAddress":"[cardAddress]",'+
        '"taxValue":"[taxValue]",'+
        '"subTotal":"[subTotal]",'+
        '"taxAmount":"[taxAmount]",'+
        '"total":"[total]",'+
        '"observations":"[observations]"'+
        '}';

    invoice_data = invoice_data.replace("[customerId]",customer_id);
    invoice_data = invoice_data.replace("[customerAlias]",customer_alias.val().trim().toLowerCase());
    invoice_data = invoice_data.replace("[customerName]",customer_name.val().trim().toUpperCase());
    invoice_data = invoice_data.replace("[customerEmail]",customer_email.val().trim().toLowerCase());
    invoice_data = invoice_data.replace("[customerPhone]",customer_phone.val().trim());
    invoice_data = invoice_data.replace("[customerAddress]",customer_address.val().trim().toUpperCase());
    invoice_data = invoice_data.replace("[invoiceNumber]",invoice_number.val().trim());
    invoice_data = invoice_data.replace("[invoiceDate]",invoice_date.val().trim());
    invoice_data = invoice_data.replace("[invoiceDueDays]",invoice_due_days.val().trim());
    invoice_data = invoice_data.replace("[cardType]",card_type);
    invoice_data = invoice_data.replace("[cardHolder]",card_holder.val().trim().toUpperCase());
    invoice_data = invoice_data.replace("[cardNumber]",card_number.val().trim());
    invoice_data = invoice_data.replace("[cardExpirationDate]",card_expiration_date.val().trim());
    invoice_data = invoice_data.replace("[cardCvv]",card_cvv.val().trim());
    invoice_data = invoice_data.replace("[cardAddress]",card_address.val().trim().toUpperCase());
    invoice_data = invoice_data.replace("[taxValue]",tax_value.val().trim());
    invoice_data = invoice_data.replace("[subTotal]",subtotal.text().trim());
    invoice_data = invoice_data.replace("[taxAmount]",tax_amount.text().trim());
    invoice_data = invoice_data.replace("[total]",total.text().trim());
    invoice_data = invoice_data.replace("[observations]",observations.val().trim().toUpperCase());

    items_data = '{"Items":[' + items_data.substr(1) + ']}';

    errors.html('<i class="fa fa-spin fa-spinner"></i>Sending document. Please wait...');
    errors.css('background-color', '#0A529F');
    errors.css('color', '#fff');
    errors.slideDown();

    pop_up.show();
    pop_up.css('opacity', 1);

    $.ajax({
        type:'post',
        url: '../controllers/signature_controller.php',
        dataType:'json',
        data:{
            action: 'sendDocument',
            invoice: invoice_data,
            items: items_data
        },
        success:function (response) {
            console.log(response);

            switch (response.result){
                case 'inactive' :
                    errors.html("Your account have been DEACTIVATED! Please contact us for more details...");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        window.location.href = '../controllers/logout.php?logout=yes';
                    },5000);
                    break;
                case 'duplicate customer' :
                    errors.html("The customer alias already exists!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    customer_alias.focus();
                    break;
                case 'error customer' :
                    errors.html("An error ocurred while checking the customer's info!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    customer_alias.focus();
                    break;
                case 'duplicate invoice' :
                    errors.html("The invoice number already exists!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    invoice_number.focus();
                    break;
                case 'error invoice' :
                    errors.html("An error ocurred while checking the invoice info!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    invoice_number.focus();
                    break;
                case 'invoice date error' :
                    errors.html("The invoice date has a wrong format!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    invoice_date.focus();
                    break;
                case 'card date error' :
                    errors.html("The card expiration date has a wrong format!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    card_expiration_date.focus();
                    break;
                case 'document error' :
                    errors.html("An error ocurred while saving the document!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    customer_alias.focus();
                    break;
                case 'details error' :
                    errors.html("An error ocurred while saving the document details!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    customer_alias.focus();
                    break;
                case 'error sending' :
                    errors.html("An error ocurred while sending the document!");
                    errors.css('background-color', 'rgba(154,0,0,1)');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                    },3000);
                    customer_alias.focus();
                    break;
                case 'sent' :
                    errors.html("The document has been sent!");
                    errors.css('background-color', '#1b6e1d');
                    errors.css('color', '#fff');
                    errors.slideDown();
                    setTimeout(function () {
                        errors.slideUp();
                        pop_up.css('opacity', 0);
                        pop_up.hide();
                        $(document).find('div.signature').find('div.new-document').css('left','calc(-100% - 40px)');

                        //load documents
                    },3000);

                    break;
            }



        },
        error:function (a,b,c) {
            setTimeout(function () {
                errors.slideUp();
                pop_up.css('opacity', 0);
                pop_up.hide();
            },3000);
        }
    });

}

function getNewDocHtml() {
    return '<div class="title"><p class="new-doc-title">New Document<i class="fa fa-window-close-o"></i></p></div>\n' +
        '\n' +
        '    <section class="invoice-header">\n' +
        '        <section class="customer-info">\n' +
        '            <div class="title">Customer Info</div>\n' +
        '            <div class="select-customer">\n' +
        '                <span class="label">Select Customer</span>\n' +
        '                <select name="cbo-select-customer" id="cbo-select-customer" title="cbo-select-customer">\n' +
        '                    <option value="0">Select your customer</option>\n' +
        '                </select>\n' +
        '                <i class="fa fa-plus" id="add-new-customer"></i>\n' +
        '            </div>\n' +
        '            <div class="new-customer">\n' +
        '                <div class="row row-1">\n' +
        '                    <span class="label">Alias</span>\n' +
        '                    <input type="text" id="txt-customer-alias" class="customer-info" title="Alias" name="txt-customer-alias" placeholder="Your customer\'s alias" disabled>\n' +
        '                    <span class="label">Name</span>\n' +
        '                    <input type="text" id="txt-customer-name" class="customer-info" title="Name" name="txt-customer-name" placeholder="Your customer\'s name" disabled>\n' +
        '                </div>\n' +
        '                <div class="row row-2">\n' +
        '                    <span class="label">E-mail</span>\n' +
        '                    <input type="text" id="txt-customer-email" class="customer-info" title="E-mail" name="txt-customer-email" placeholder="Your customer\'s email" disabled>\n' +
        '                    <span class="label">Phone Number</span>\n' +
        '                    <input type="text" id="txt-customer-phone-number" class="customer-info" title="Phone Number" name="txt-customer-phone-number" placeholder="Your customer\'s phone number" disabled>\n' +
        '                </div>\n' +
        '                <div class="row row-3">\n' +
        '                    <span class="label">Address</span>\n' +
        '                    <input type="text" id="txt-customer-address" class="customer-info" title="Address" name="txt-customer-address" placeholder="Your customer\'s address" disabled>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </section>\n' +
        '\n' +
        '        <section class="invoice-info">\n' +
        '            <div class="row row-1">\n' +
        '                <div class="title">Invoice Number</div>\n' +
        '                <input type="text" id="txt-invoice-number" title="Number" name="txt-invoice-number" placeholder="Number">\n' +
        '            </div>\n' +
        '            <div class="row row-2">\n' +
        '                <div class="title">Invoice Date</div>\n' +
        '                <input type="text" id="txt-invoice-date" title="Date" name="txt-invoice-date" placeholder="Date (yyyy-mm-dd)" maxlength="10">\n' +
        '            </div>\n' +
        '            <div class="row row-3">\n' +
        '                <div class="title">Invoice Due Days</div>\n' +
        '                <input type="text" id="txt-invoice-due-days" title="Due Days" name="txt-invoice-due-days" placeholder="Due Days" maxlength="4">\n' +
        '            </div>\n' +
        '\n' +
        '        </section>\n' +
        '    </section>\n' +
        '\n' +
        '    <section class="invoice-items">\n' +
        '        <section class="tbl">\n' +
        '            <div class="thead">\n' +
        '                <div class="row title">\n' +
        '                    <div class="col-1">Ítem</div>\n' +
        '                    <div class="col-2">Qty</div>\n' +
        '                    <div class="col-3">Description</div>\n' +
        '                    <div class="col-4">Unit Price</div>\n' +
        '                    <div class="col-5">Total Amount</div>\n' +
        '                    <div class="col-6">Tax</div>\n' +
        '                    <div class="col-7"></div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '            <div class="tbody">\n' +
        '                <div class="row">\n' +
        '                    <div class="col col-1">\n' +
        '                        1\n' +
        '                    </div>\n' +
        '                    <div class="col col-2">\n' +
        '                        <input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" placeholder="quantity">\n' +
        '                    </div>\n' +
        '                    <div class="col col-3">\n' +
        '                        <input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" placeholder="description">\n' +
        '                    </div>\n' +
        '                    <div class="col col-4 money">\n' +
        '                        <input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" placeholder="unit price">\n' +
        '                    </div>\n' +
        '                    <div class="col col-5 money">\n' +
        '                        <input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" placeholder="total amount" readonly>\n' +
        '                    </div>\n' +
        '                    <div class="col col-6">\n' +
        '                        <input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax">\n' +
        '                    </div>\n' +
        '                    <div class="col col-7">\n' +
        '                        <i id="delete" class="fa fa-times"></i>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '\n' +
        '            <div class="tfoot">\n' +
        '                <div class="row add-item title">\n' +
        '                    add new item\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </section>\n' +
        '    </section>\n' +
        '\n' +
        '    <section class="invoice-footer">\n' +
        '        <section class="payment-info">\n' +
        '            <div class="title">Payment Info</div>\n' +
        '            <div class="payment-details">\n' +
        '                <div class="row">\n' +
        '                    <span class="label">Card Type</span>\n' +
        '                    <div class="card-type">\n' +
        '                        <input type="radio" id="cbox-visa" name="rbtn-tdc" title="VISA">\n' +
        '                        <label for="cbox-visa"><span class="fa fa-cc-visa"></span>Visa</label>\n' +
        '                        <input type="radio" id="cbox-mastercard" name="rbtn-tdc" title="MASTERCARD">\n' +
        '                        <label for="cbox-mastercard"><span class="fa fa-cc-mastercard"></span>Master Card</label>\n' +
        '                        <input type="radio" id="cbox-amex" name="rbtn-tdc" title="AMERICAN EXPRESS">\n' +
        '                        <label for="cbox-amex"><span class="fa fa-cc-amex"></span>American Express</label>\n' +
        '                        <input type="radio" id="cbox-diners" name="rbtn-tdc" title="DINERS CLUB">\n' +
        '                        <label for="cbox-diners"><span class="fa fa-cc-diners-club"></span>Diners Club</label>\n' +
        '                        <input type="radio" id="cbox-discover" name="rbtn-tdc" title="DISCOVER">\n' +
        '                        <label for="cbox-discover"><span class="fa fa-cc-discover" title=""></span>Discover</label>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                <div class="row">\n' +
        '                    <span class="label">Card Holder</span>\n' +
        '                    <input type="text" id="txt-card-holder" name="txt-card-holder" title="Card Holder" placeholder="card holder">\n' +
        '                </div>\n' +
        '                <div class="row">\n' +
        '                    <span class="label">Card Number</span>\n' +
        '                    <input type="text" id="txt-card-number" name="txt-card-number" title="Card Number" placeholder="card number" maxlength="20">\n' +
        '                </div>\n' +
        '                <div class="row">\n' +
        '                    <span class="label">Card Expiration Date</span>\n' +
        '                    <input type="text" id="txt-card-expiration-date" name="txt-card-expiration-date" title="Card Expiration Date" placeholder="card expiration date (mm-yy)" maxlength="5">\n' +
        '                </div>\n' +
        '                <div class="row">\n' +
        '                    <span class="label">Card CVV</span>\n' +
        '                    <input type="text" id="txt-card-cvv" name="txt-card-cvv" title="Card CVV" placeholder="card cvv" maxlength="4">\n' +
        '                </div>\n' +
        '                <div class="row">\n' +
        '                    <span class="label">Address</span>\n' +
        '                    <input type="text" id="txt-card-address" name="txt-card-address" title="Card Address" placeholder="card address">\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </section>\n' +
        '\n' +
        '        <section class="invoice-totals">\n' +
        '            <div class="row money">\n' +
        '                <div class="title">Sub Total</div>\n' +
        '                <span id="txt-subtotal">0.00</span>\n' +
        '            </div>\n' +
        '            <div class="row money">\n' +
        '                <div class="title">Tax <input type="text" id="txt-tax-value" name="txt-tax-value" title="Tax" placeholder="Tax" value="0.00" maxlength="5" /> %</div>\n' +
        '                <span id="txt-tax-amount">0.00</span>\n' +
        '            </div>\n' +
        '            <div class="row money">\n' +
        '                <div class="title">Total</div>\n' +
        '                <span id="txt-total">0.00</span>\n' +
        '            </div>\n' +
        '        </section>\n' +
        '    </section>\n' +
        '\n' +
        '    <section class="invoice-observations">\n' +
        '        <section class="observations">\n' +
        '            <div class="title">Observations</div>\n' +
        '            <textarea class="observations-text" id="txt-invoice-observations" placeholder="place the observations here" rows="20"></textarea>\n' +
        '        </section>\n' +
        '    </section>\n' +
        '\n' +
        '    <section class="buttons">\n' +
        '        <div class="btn-proceed">Proceed</div>\n' +
        '    </section>';
}