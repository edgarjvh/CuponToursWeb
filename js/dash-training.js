$(document).ready(function () {
    $('div.main-content').on('click', '.curses-list ul li', function () {
        var li = $(this);
        var list = li.parent();

        console.log(li.text());

        if (!li.hasClass('active')){
            list.find('li').removeClass('active');
            li.addClass('active');
            $('.training').find('div.videos-list p.curses-title').html('Videos  -  ' + li.text() + '<i class="fa fa-chevron-down"></i>');
            $('.training').find('div.comments p.curses-title').html('Comentarios  -  ' + li.text() + '<i class="fa fa-chevron-down"></i>');
        }
    });
});