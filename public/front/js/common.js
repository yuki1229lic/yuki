$(document).ready(function(){
    $(function() {
      $("#panel-btn").click(function() {
        $(".menu-box").slideToggle(200);
        if($("#panel-btn-icon").hasClass("fa-bars")){
            $("#panel-btn-icon").removeClass("fa-bars");
            $("#panel-btn-icon").addClass("fa-times");
        }else{
            $("#panel-btn-icon").removeClass("fa-times");
            $("#panel-btn-icon").addClass("fa-bars");
        }
        return false;
      });
    });

    $(function() {
        var topBtn = $('#pageTop');
        var stickyFoot = $('.stickyFoot');
        topBtn.hide();
        $(window).scroll(function () {
            if ($(this).scrollTop() > 150) {
                topBtn.fadeIn();
                stickyFoot.addClass('on')
            } else {
                topBtn.fadeOut();
                stickyFoot.removeClass('on')
            }
            var $width = $(this).width();
            if($width < 641) {
                if ($(this).scrollTop() > 1) {
                    $('header').addClass('fixed');
                } else {
                    $('header').removeClass('fixed');
                }
            }
        });
        topBtn.click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });


    $(function() {
        $('.tab li').click(function() {
            var index = $('.tab li').index(this);
            $('.content > li').css('display','none');
            $('.content > li').eq(index).css('display','block');
            $('.tab li').removeClass('select');
            $(this).addClass('select')
        });
    });
    $(function() {
        $('.tab2 li').click(function() {
            var index = $('.tab2 li').index(this);
            $('.content2 > li').css('display','none');
            $('.content2 > li').eq(index).css('display','block');
            $('.tab2 li').removeClass('select');
            $(this).addClass('select')
        });
    });
    $(function() {
        $('.tab3 li').click(function() {
            var index = $('.tab3 li').index(this);
            $('.content3 > li').css('display','none');
            $('.content3 > li').eq(index).css('display','block');
            $('.tab3 li').removeClass('select');
            $(this).addClass('select')
        });
    });

    $('.ow-car').owlCarousel({
        loop: true,
        margin: 5,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        autoplay: true,
        navbar:true,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 4,
                nav: true
            }
        }
    });
    $('.accordion a').click(function(){
        $(this).toggleClass('active');
        $(this).next('.text-content').slideToggle(400);
    });
});



