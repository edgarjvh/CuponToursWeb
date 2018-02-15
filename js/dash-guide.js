$(document).ready(function () {

    $('div.small-charts').find('div.row-two p').on('click',function () {
        var wguide = $(this).parent().parent().parent().parent();
        var myid = $(this).parent().parent().attr('id');

        wguide.find('div.pop-up').css('left', 'calc(-100% - 40px)');
        wguide.find('#pop-'+myid).css('left', '0');
    });

    $('div.pop-up').find('div.header i').on('click',function () {
        var pop = $(this).parent().parent();

        pop.css('left', 'calc(-100% - 40px)');
    });

    $('div.main-content').on('click', '.pitch-title', function () {
        console.log('entro aqui');
        var pSection = $(this).parent().parent();
        var pContainer = $(this).parent();

        if (pContainer.hasClass('active')){
            pContainer.find('span.pitch-content').slideUp();
            pContainer.removeClass('active');
            $(this).css('border-bottom','0');
        }else{
            pSection.find('div.pitch-container span.pitch-content').slideUp();
            pSection.find('div.pitch-container').removeClass('active');
            pSection.find('div.pitch-container p.pitch-title').css('border-bottom', '0');

            pContainer.find('span.pitch-content').slideDown();
            pContainer.addClass('active');
            $(this).css('border-bottom','1px solid #000');
        }
    });


});