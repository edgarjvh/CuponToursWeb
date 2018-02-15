$(document).ready(function () {
    var logout = $('span.logout');
    logout.on('click',function () {
        if (confirm("Are you sure to leave your session?")){
            $.ajax({
                type:"post",
                url:'../controllers/logout.php',
                data: {
                    action:'logout'
                },
                success:function (response) {
                    if (response === 'ok'){
                        window.location.reload();
                    }
                },
                error:function (response) {
                    console.log(response);
                }
            });
        }
    });

    var li = $('section.sidebar').find('ul > li');

    li.on('click', function () {

       var parent = li.parent();

       parent.find('li').removeClass('active');

       $(this).addClass('active');

       var container = $('.main-container').find('.main-content');
       container.html('');

       if ($(this).find('i').hasClass('fa-tachometer')){
           window.location.href = '../views/dash-member.php';
       }else if ($(this).find('i').hasClass('fa-map-marker')){
           window.location.href = '../views/dash-map.php';
       }else if ($(this).find('i').hasClass('fa-file')){
           window.location.href = '../views/dash-guide.php';
       }else if ($(this).find('i').hasClass('fa-book')){
           window.location.href = '../views/dash-training.php';
       }else if ($(this).find('i').hasClass('fa-calendar')){
           window.location.href = '../views/dash-calendar.php';
       }else if ($(this).find('i').hasClass('fa-bell')){
           window.location.href = '../views/dash-alerts.php';
       }else if ($(this).find('i').hasClass('fa-pencil')){
           window.location.href = '../views/dash-esignature.php';
       }else if ($(this).find('i').hasClass('fa-phone')){
           window.location.href = '../views/dash-voip.php';
       }else if ($(this).find('i').hasClass('fa-money')){
           window.location.href = '../views/dash-leads.php';
       }else if ($(this).find('i').hasClass('fa-credit-card')){
           window.location.href = '../views/dash-payments.php';
       }else if ($(this).find('i').hasClass('fa-user-plus')){
           window.location.href = '../views/dash-subscriptions.php';
       }else if ($(this).find('i').hasClass('fa-cart-plus')){
           window.location.href = '../views/dash-store.php';
       }else if ($(this).find('i').hasClass('fa-list-alt')){
           window.location.href = '../views/dash-reservations.php';
       }
    });

    scrollIntoViewIfNeeded($('section.sidebar').find('li.active')[0]);

    function scrollIntoViewIfNeeded(target) {
        var rect = target.getBoundingClientRect();
        if (rect.bottom > window.innerHeight) {
            target.scrollIntoView(false);
        }
        if (rect.top < 0) {
            target.scrollIntoView();
        }
    }
});