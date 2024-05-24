// JavaScript Document

// スマホメニュー
$(function(){
    $('#panel-btn').on('click',
    function(){
        $(this).removeClass('off');
        $(this).addClass('on');
        $('#panel.slideMenu').addClass('on');
        $('body').addClass('fix');
    });
    $('#panel .close').on('click',
    function(){
        $('#panel.slideMenu').removeClass('on');
        $('body').removeClass('fix');
    });
});

