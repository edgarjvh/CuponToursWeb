$(document).ready(function () {
    var toggle_sidebar = $('#cbox-toggle-sidebar');

    toggle_sidebar.on('change',function () {
       if (toggle_sidebar.is(':checked')){
            $('section.sidebar').animate({
                marginLeft:'-270px'
            },500);
       }else{
           $('section.sidebar').animate({
               marginLeft:'0'
           },500);
       }
    });
});