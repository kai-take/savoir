/*
ハンバーガーメニュー 
———————————*/
jQuery('.mobile-menu__btn, .close-btn').on('click', function () {
    jQuery('body').toggleClass('active');

});

/*
1024px以下での、クラスとcssの付与
———————————*/
jQuery(window).on('load resize orientationchange', function () {
    if (jQuery(window).width() <= 1024) { // 1024px以下はhover解除
        jQuery('body').removeClass('active-hover');
        jQuery('.header-container').css('transition', 'all 1s');
    } else {
        jQuery('body').addClass('active-hover');
        jQuery('.header-container').css('transition', 'none');
    }
});

/*
ページトップボタン 
———————————*/
jQuery(window).on('load', function () {
    var pagetop = jQuery('.pagetop-btn');
    pagetop.hide(); // ボタン非表示

    // 100px スクロールしたらボタン表示
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 200) {
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });

    // クリックしたらページトップに遷移
    pagetop.click(function () {
        jQuery('body, html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});
