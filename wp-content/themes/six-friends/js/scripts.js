// Avoid `console` errors in browsers that lack a console.
(function () {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

jQuery(document).ready(function ($) {


    // HOME PAGE SLIDER
    $('#homeSlider').flexslider({  
        startAt: 0,
        start: function(slider){
            //initial load
            // positionSlide();
            // $(window).resize(positionSlide);
            var progressBar = $('.progressBar');
            progressBar.animate({'width': "100%"}, 6000, function(){
                $(this).css({'width' : 0})
            });

            $(".slideNavThumb").on("click", function(){
                 progressBar.animate({'width': "0"}, 0);
            });
        },
        before : function(){
            $(".slide-text").css("opacity" , "0");
            $('.progressBar').animate({'width': "100%"}, 6000, function(){
                $(this).css({'width' : 0})
            });
        },
        after: function(){
            $(".slide-text").animate({
                opacity : '1.0',
            },"slow");
            // $("h1.line2").delay(400).animate({
            //     opacity : '1.0',
            // },"slow");
            // $(".slide_details").delay(800).animate({
            //     opacity : '1.0',
            // });
        },
        animationSpeed : 1000,
        controlNav: false,
        customDirectionNav: $(".slider-direction-controls a")
    });






    // Expandable Content
    var question = $(".expand");

    question.click(function(){
        $(this).next(".hidden").slideToggle();
        $(this).toggleClass("open");
        var text = $(this).text();
        $(this).html((text == "Read more" ? "Read less" : "Read more"));
    });



    $('#nav-icon').click(function(){
        $(this).toggleClass('open');
        $("#dropmenu").toggleClass('open');
    });





    // window.onscroll = function() {scrollFunction()};
    // function scrollFunction() {
    //     if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            
    //     } else {
           
    //     }
    // }







});