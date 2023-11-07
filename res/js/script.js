$(document).ready(function () {
    $('body').append('<i id="toTop" class="fa fa-arrow-circle-up fa-4x fa-fw hidden-print"></i>');
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $('#toTop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });

    $('ul.trending').each(function () {
        if (!$(this).find('li.active').length) {
            $(this).find('li:first').addClass('active');
        }
        var ticker = $(this);
        window.setInterval(function () {
            var active = ticker.find('li.active');
            active.fadeOut(function () {
                var next = active.next();
                if (!next.length) {
                    next = ticker.find('li:first');
                }
                next.addClass('active').fadeIn();
                active.removeClass('active');
            });
        }, 5000);
    });
});

$('#myCarousel').carousel({
    interval: 4000
});

var clickEvent = false;
$('#myCarousel').on('click', '.nav a', function () {
    clickEvent = true;
    $('.nav li').removeClass('active');
    $(this).parent().addClass('active');
}).on('slid.bs.carousel', function (e) {
    if (!clickEvent) {
        var count = $('.nav').children().length - 1;
        var current = $('.nav li.active');
        current.removeClass('active').next().addClass('active');
        var id = parseInt(current.data('slide-to'));
        if (count == id) {
            $('.nav li').first().addClass('active');
        }
    }
    clickEvent = false;
});
