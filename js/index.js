$(document).ready(function () {
    var btn_prev = $('section.commentaries').find('#btn-prev');
    var btn_next = $('section.commentaries').find('#btn-next');
    var slider = $('section.commentaries').find('.comments');

    $('section.search-tabs .sec-container ul li a').on('click',function (e) {
        e.preventDefault();

        var parentLI = $(this).parent();
        var id = $(this).attr('id');

        console.log(id);

        $('section.search-tabs .sec-container ul li').removeClass('selected');
        $('section.search-tabs .sec-container section').removeClass('selected');
        parentLI.addClass('selected');
        $('section.search-tabs').find('section#'+id).addClass('selected');
    });

    $('.main-container').on('scroll', function () {
        if ($('.main-container').scrollTop() > 20){
            $('#btn-scroll-top').css('opacity',1);
        }else{
            $('#btn-scroll-top').css('opacity',0);
        }
    });

    $('section.recommended-hotels .sec-container .hotel-list .hotel-item .tour-statistics div').hover(function () {
       if ($(this).has('span').length > 0){
          $(this).find('span').show();
          $(this).find('i').hide();
       }
    });

    $('section.recommended-hotels .sec-container .hotel-list .hotel-item .tour-statistics div').mouseleave(function () {
        if ($(this).has('span').length > 0){
            $(this).find('span').hide();
            $(this).find('i').show();
        }
    });

    var commentsCount = slider.find('section').length;
    slider.css('width',commentsCount+'00'+'%');
    slider.find('section:last').insertBefore(slider.find('section:first'));
    slider.css('margin-left','-100%');

    btn_next.on('click',function () {
        if (commentsCount === 2){
            slider.find('section:first').insertAfter(slider.find('section:last'));
            slider.css('margin-left','0');


            slider.animate({
                marginLeft:'-'+100+'%'
            },700,function () {

            });
        }else{
            slider.animate({
                marginLeft:'-'+200+'%'
            },700,function () {
                slider.find('section:first').insertAfter(slider.find('section:last'));
                slider.css('margin-left','-100%');
            });
        }
    });

    btn_prev.on('click',function () {
        slider.animate({
            marginLeft:'0'
        },700,function () {
            slider.find('section:last').insertBefore(slider.find('section:first'));
            slider.css('margin-left','-100%');
        });
    });


});

function topFunction() {
    $('.main-container').animate({scrollTop:0},500);
}