jQuery(document).ready(function($){

    $('.equipment-menu').click(function(){
        var caretbtn = $(this).find(".download-btn");
        if(caretbtn.hasClass("icon-caret-down")) {
            caretbtn.removeClass("icon-caret-down").addClass("icon-caret-up");
            $(".equipment-dropdown").show();
        } else {
            caretbtn.removeClass("icon-caret-up").addClass("icon-caret-down");
            $(".equipment-dropdown").hide();
        }
    });

    $('.calendar-menu').click(function(){
        var caretbtn = $(this).find(".download-btn");
        if(caretbtn.hasClass("icon-caret-down")) {
            caretbtn.removeClass("icon-caret-down").addClass("icon-caret-up");
            $(".calendar-dropdown").show();
        } else {
            caretbtn.removeClass("icon-caret-up").addClass("icon-caret-down");
            $(".calendar-dropdown").hide();
        }
    });

    $('.jobs-menu').click(function(){
        var caretbtn = $(this).find(".download-btn");
        if(caretbtn.hasClass("icon-caret-down")) {
            caretbtn.removeClass("icon-caret-down").addClass("icon-caret-up");
            $(".jobs-dropdown").show();
        } else {
            caretbtn.removeClass("icon-caret-up").addClass("icon-caret-down");
            $(".jobs-dropdown").hide();
        }
    });

    $('.users-menu').click(function(){
        var caretbtn = $(this).find(".download-btn");
        if(caretbtn.hasClass("icon-caret-down")) {
            caretbtn.removeClass("icon-caret-down").addClass("icon-caret-up");
            $(".users-dropdown").show();
        } else {
            caretbtn.removeClass("icon-caret-up").addClass("icon-caret-down");
            $(".users-dropdown").hide();
        }
    });

    $('.assign-job-menu').click(function(){
        var caretbtn = $(this).find(".download-btn");
        if(caretbtn.hasClass("icon-caret-down")) {
            caretbtn.removeClass("icon-caret-down").addClass("icon-caret-up");
            $(".tasks-dropdown").show();
        } else {
            caretbtn.removeClass("icon-caret-up").addClass("icon-caret-down");
            $(".tasks-dropdown").hide();
        }
    });

});