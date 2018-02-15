$(document).ready(function () {
    var btn_access = $(document).find('.btn-access');
    var txt_key = $(document).find('#txt-access-key');
    var message = $(document).find('.message');

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

        loadAccounts(txt_key.val().trim());
    });
    
    $(document).on('click','div.switch',function () {
        var _switch = $(this);
        _switch.toggleClass('active');

        var row = $(this).parent().parent();
        var user_id = row.find('div.user-id').html();
        var disabling_switch = _switch.parent().find('div.disabling-switch');

        console.log(user_id);

        disabling_switch.css('display','flex');
        disabling_switch.css('opacity','1');

        if (_switch.hasClass('active')){
            $.ajax({
                type:'post',
                url:'../controllers/user_controller.php',
                dataType:'json',
                data:{
                    action:'updateUserStatus',
                    userId:user_id,
                    userStatus:'1'
                },
                success:function (response) {
                    switch (response.result){
                        case 'ok':
                            _switch.find('.status-label').html('Active');
                            _switch.parent().parent().removeClass('unconfirmed');

                            disabling_switch.css('opacity','0');
                            disabling_switch.css('display','none');
                            break;
                        default:
                            disabling_switch.css('opacity','0');
                            disabling_switch.css('display','none');
                            break;
                    }
                },
                error:function (a,b,c) {
                    disabling_switch.css('opacity','0');
                    disabling_switch.css('display','none');
                }
            });

        }else{
            $.ajax({
                type:'post',
                url:'../controllers/user_controller.php',
                dataType:'json',
                data:{
                    action:'updateUserStatus',
                    userId:user_id,
                    userStatus:'0'
                },
                success:function (response) {
                    switch (response.result){
                        case 'ok':
                            _switch.find('.status-label').html('Inactive');

                            disabling_switch.css('opacity','0');
                            disabling_switch.css('display','none');
                            break;
                        default:
                            disabling_switch.css('opacity','0');
                            disabling_switch.css('display','none');
                            break;
                    }
                },
                error:function (a,b,c) {
                    disabling_switch.css('opacity','0');
                    disabling_switch.css('display','none');
                }
            });
        }
    });

    //loadAccounts('');
});

function loadAccounts(accessKey) {
    accessKey = accessKey === '' ? 'GT*access?key' : accessKey;
    var auth = $(document).find('form.auth');
    var message = $(document).find('.message');
    var txt_key = $(document).find('#txt-access-key');

    message.css('background-color', '#374e81');
    message.addClass('shown');
    message.html('<i class="fa fa-spin fa-spinner"></i> Accessing... Please wait.');

    $.ajax({
        type: 'post',
        url: '../controllers/user_controller.php',
        dataType: 'json',
        data: {
            action: 'getUserList',
            accessKey: accessKey
        },
        success: function (response) {
            switch (response.result){
                case 'ok':
                    var html = '<div class="users">\n' +
                        '        <div class="tbl">\n' +
                        '            <div class="tbl-head">\n' +
                        '                <div class="tbl-row">\n' +
                        '                    <div class="tbl-col user-id hidden">Id</div>\n' +
                        '                    <div class="tbl-col confirmed hidden">Confirmed</div>\n' +
                        '                    <div class="tbl-col user-status hidden">Status</div>\n' +
                        '                    <div class="tbl-col first-name">First Name</div>\n' +
                        '                    <div class="tbl-col last-name">Last Name</div>\n' +
                        '                    <div class="tbl-col email">E-mail</div>\n' +
                        '                    <div class="tbl-col phone">Phone Number</div>\n' +
                        '                    <div class="tbl-col country">Country</div>\n' +
                        '                    <div class="tbl-col since">Since</div>\n' +
                        '                    <div class="tbl-col status">Status</div>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '            <div class="tbl-body">\n' +
                        '            </div>\n' +
                        '            <div class="tbl-foot">\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </div>';

                    $(document).find('div.content-page').html(html);

                    var rowCount = response.data.length;
                    var tblRow = '';

                    for (var i = 0; i < rowCount; i++){
                        var row = response.data[i];
                        var status = row.confirmed === "0" ? 'Inactive' : row.status === "0" ? 'Inactive' : 'Active';
                        var date = new Date(row.registration_date);

                        date = dateFormat(date, "yyyy-mm-dd");

                        console.log(date);

                        var row_status = row.confirmed === '0' ? 'unconfirmed' : '';

                        tblRow += '<div class="tbl-row '+ row_status +'">\n' +
                                        '<div class="tbl-col user-id hidden">'+row.user_id +'</div>\n' +
                                        '<div class="tbl-col confirmed hidden">'+row.confirmed+'</div>\n' +
                                        '<div class="tbl-col user-status hidden">'+row.status+'</div>\n' +
                                        '<div class="tbl-col first-name">'+row.first_name +'</div>\n' +
                                        '<div class="tbl-col last-name">'+row.last_name +'</div>\n' +
                                        '<div class="tbl-col email">'+row.email + '</div>\n' +
                                        '<div class="tbl-col phone">'+row.phone +'</div>\n' +
                                        '<div class="tbl-col country">'+row.country_name + ' (' + row.country_code + ')' +'</div>\n' +
                                        '<div class="tbl-col since">'+date+'</div>\n' +
                                        '<div class="tbl-col status">\n' +
                                            '<div class="switch '+status.toLowerCase()+'">\n' +
                                                '<div class="roll"></div>\n' +
                                                '<div class="status-label">'+status+'</div>\n' +
                                            '</div>\n' +
                                            '<div class="disabling-switch">\n' +
                                                '<i class="fa fa-spin fa-spinner"></i>\n' +
                                            '</div>\n' +
                                        '</div>\n' +
                                    '</div>';
                    }
                    auth.hide();
                    $(document).find('div.tbl-body').html(tblRow);

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
}