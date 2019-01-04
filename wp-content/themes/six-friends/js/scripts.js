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


    $("#status").delay(1000).fadeOut();
        // will fade out the whole DIV that covers the website.
    $("#preloader").delay(1000).fadeOut("slow");




    // HOME PAGE SLIDER
    $('#homeSlider').flexslider({  
        startAt: 0,
        start: function(slider){
            //initial load
            // positionSlide();
            // $(window).resize(positionSlide);
            // var progressBar = $('.progressBar');
            // progressBar.animate({'width': "100%"}, 6000, function(){
            //     $(this).css({'width' : 0})
            // });

            // $(".slideNavThumb").on("click", function(){
            //      progressBar.animate({'width': "0"}, 0);
            // });
            $(".slide-text, .slide-delay-1, .slide-delay-2, .slide-delay-3").css("opacity" , "0");
            // $(".slide-text").delay(100).animate({
            //     opacity : '1.0',
            // });
            $(".slide-text, .slide-delay-1").delay(1200).animate({
                opacity : '1.0',
            });
            $(".slide-delay-2").delay(2200).animate({
                opacity : '1.0',
            });
            $(".slide-delay-3").delay(3200).animate({
                opacity : '1.0',
            });
        },
        before : function(){
            $(".slide-text, .slide-delay-1, .slide-delay-2, .slide-delay-3").css("opacity" , "0");
            // $('.progressBar').animate({'width': "100%"}, 2000, function(){
            //     $(this).css({'width' : 0})
            // });
        },
        after: function(){
            // $(".slide-text").delay(100).animate({
            //     opacity : '1.0',
            // });
            $(".slide-text, .slide-delay-1").delay(400).animate({
                opacity : '1.0',
            });
            $(".slide-delay-2").delay(1400).animate({
                opacity : '1.0',
            });
            $(".slide-delay-3").delay(2400).animate({
                opacity : '1.0',
            });
        },
        animationSpeed : 1000,
        //controlNav: false,
        controlsContainer: $(".slider-controls-container"),
        directionNav: false,
        customDirectionNav: $(".slider-navigation a")
    });






    // Expandable Content
    var question = $(".expand");

    question.click(function(){
        $(this).next(".hidden").slideToggle();
        $(this).toggleClass("open");
        var text = $(this).text();
        $(this).html((text == "Read more" ? "Read less" : "Read more"));
    });

    // $(".expand").click(function(){
    //         $(this).next(".hiddenContent").slideToggle();
    //         $(this).toggleClass("down");
    // });



    $('.nav-icon, button.overlay-close').click(function(){
        //$(this).toggleClass('open');
        //$("#dropmenu").toggleClass('open');
        $(".overlay-scale").toggleClass('open');
    });



    $('.home-page-content .image-content-wrap').addClass('hideme');
    $('body.home header').addClass('invisible');




    // window.onscroll = function() {scrollFunction()};
    // function scrollFunction() {
    //     if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            
    //     } else {
           
    //     }
    // }















    // new scripts from HC ============================================================================= 

    /* Love button for Design it & Code it
    * http://designitcodeit.com/i/9 */
    $('.like-btn-counter').on('click', function(event, count) {
        
        event.preventDefault();

        //console.log("clicked");
      
        var $this = $(this),
          count = $this.attr('data-count'),
          product_id = $this.attr('data-product-id'),
          liked = $this.hasClass('liked');
          //multiple = $this.hasClass('multiple-count');

         //  if (multiple) {
            // $this.attr('data-count', ++count);
            // // Your code here
         //  } else {
            // $this.attr('data-count', liked ? --count : ++count).toggleClass('liked');
            // // Your code here
         //  } 

        if (!liked) {
            //$this.attr('data-count', ++count).addClass('liked');
            $.ajax({
                //cache: false,
                //timeout: 80000,
                url: ajax_function.ajax_url,
                type: "POST",
                data: ({
                    action : 'update_likes',
                    count : count,
                    product_id : product_id
                }),
                //dataType: "html",
                //dataType: "json",
                //contentType:'application/json',
                beforeSend: function() {
                    $(".like-loading").html( '<div class="no_results"><i class="fa fa-cog fa-spin"></i> We love you too!</div>' );
                },
                success: function( data, textStatus, jqXHR ){
                    var ajax_response = $( data );
                    $this.attr('data-count', ++count).addClass('liked');
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    $(".like-loading").html( 'Thanks anyway.');
                },
                complete: function( jqXHR, textStatus ){
                    $(".like-loading").html("");
                }
            });
        } 
      
        // Second method, use when ... I dunno when but it looks cool and that's why it is here
        // $.fn.noop = $.noop;
        // $this.attr('data-count', ! liked || multiple ? ++count : --count  )[multiple ? 'noop' : 'toggleClass']('liked');
      
    });



    $(".secondary-cart").click(function(e){
        e.preventDefault();
        //console.log("Moused Over");
        $("#modal-overlay").toggleClass("show");
        var $slidey = $(".cart-dropdown"); 
        $slidey.animate({ 
            right: parseInt($slidey.css('right'),10) == 0 ? -$slidey.outerWidth()-20 : 0 
            //right: 0
        }); 
    });

    
    $(".close-dropdown").click(function(){
        //console.log("Cross Clicked");
        var $slidey = $(".cart-dropdown"); 
        $slidey.animate({ 
            right: -$slidey.outerWidth()-20
        }); 
        $("#modal-overlay").removeClass("show");
    });

    // hide nav menu on click outside 
    $(document).on("click", function (event) {
      // If the target is not the container or a child of the container, then process
      if ($(event.target).closest("header").length === 0) {
        var $slidey = $(".cart-dropdown"); 
        $slidey.animate({ 
            right: -$slidey.outerWidth()-20
        }); 
        $("#modal-overlay").removeClass("show");
      }
    });



    //var addInput = "#cart-quantity";
    var set_cart_qty = 1;
    $('input[name="quantity"]').val(set_cart_qty);

    // var regular_price = $("#regular-price").text();

    $('.plus').on('click', function(){
        //$(addInput).val(++cart_qty);
        var cart_qty = $(this).closest(".quantity").find("input.qty").val();
        $(this).closest(".quantity").find("input.qty").val(++cart_qty);
        var regular_price = $(this).closest("form").find(".regular-price").val();
        var new_price = (regular_price * cart_qty);
        //console.log(new_price);
        $(this).closest(".single-product-item").find(".price-point span").html(new_price.toFixed(2));
    })
    $('.minus').on('click', function(){
        var cart_qty = $(this).closest(".quantity").find("input.qty").val();
        if (cart_qty > 1) {
          //$(addInput).val(--cart_qty);
          $(this).closest(".quantity").find("input.qty").val(--cart_qty);
        }
        var regular_price = $(this).closest("form").find(".regular-price").val();
        var new_price = (regular_price * cart_qty);
        //console.log(new_price);
        $(this).closest(".single-product-item").find(".price-point span").html(new_price.toFixed(2));
    });




    //

    $(".single_add_to_cart_button").click(function(e) {
        e.preventDefault();

        var this_button = $(this);
        //$(this).addClass('adding-cart');
        //var product_id = $(this).val();
        //var product_id = $("#add-to-cart-id").val();
        var product_id = $(this).attr("data-product-id");
        //var variation_id = $('input[name="variation_id"]').val();
        var variation_id = $(this).closest("form").find('input[name="variation_id"]').val();
        //var quantity = $('input[name="quantity"]').val();
        var quantity = $(this).closest("form").find("input.qty").val();
        //console.log(quantity+'-'+product_id);
        $('.cart-dropdown-inner').empty();

        if (variation_id != '') {

            $.ajax({
                //cache: false,
                //timeout: 80000,
                url: ajax_function.ajax_url,
                type: "POST",
                data: ({
                    action : 'crispshop_add_cart_single',
                    product_id : product_id,
                    variation_id : variation_id,
                    quantity : quantity,
                }),
                //dataType: "html",
                //dataType: "json",
                //contentType:'application/json',
                beforeSend: function() {
                    this_button.html( '<div class="no_results"><i class="fa fa-cog fa-spin"></i> &nbsp; Updating cart...</div>' );
                },
                // success: function( data, textStatus, jqXHR ){
                //     var ajax_response = $( data );
                //     $("#ajax-report-number").html(ajax_response);
                // },
                success:function(results) {
                    $('.cart-dropdown-inner').append(results);
                    var cartcount = $('.item-count').html();
                    $('.cart-totals span').html(cartcount);
                    //$("span",this).removeClass('adding-cart');
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    // $('.cart-dropdown').addClass('show-dropdown');
                    //    setTimeout(function () { 
                    //         $('.cart-dropdown').removeClass('show-dropdown');
                    //    }, 3000);
                    $("#modal-overlay").addClass("show");
                    var $slidey = $(".cart-dropdown"); 
                    $slidey.animate({ 
                        right: 0 
                    }); 
                    // setTimeout(function () { 
                    //      right: -$slidey.outerWidth()
                    // }, 3000);
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    this_button.html( 'Something went wrong...');
                },
                complete: function( jqXHR, textStatus ){
                    this_button.html("Add to Cart");
                }
            });

        } else {

            $.ajax({
                //cache: false,
                //timeout: 80000,
                url: ajax_function.ajax_url,
                type: "POST",
                data: ({
                    action : 'crispshop_add_cart_single',
                    product_id : product_id,
                    quantity : quantity,
                }),
                //dataType: "html",
                //dataType: "json",
                //contentType:'application/json',
                beforeSend: function() {
                    this_button.html( '<div class="no_results"><i class="fa fa-cog fa-spin"></i> &nbsp; Updating...</div>' );
                },
                // success: function( data, textStatus, jqXHR ){
                //     var ajax_response = $( data );
                //     $("#ajax-report-number").html(ajax_response);
                // },
                success:function(results) {
                    $('.cart-dropdown-inner').append(results);
                    var cartcount = $('.item-count').html();
                    $('.cart-totals span').html(cartcount);
                    //$("span",this).removeClass('adding-cart');
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    // $('.cart-dropdown').addClass('show-dropdown');
                    // setTimeout(function () { 
                    //   $('.cart-dropdown').removeClass('show-dropdown');
                    // }, 3000);
                    $("#modal-overlay").addClass("show");
                    var $slidey = $(".cart-dropdown"); 
                    $slidey.animate({ 
                        right: 0 
                    }); 
                    // setTimeout(function () { 
                    //      right: -$slidey.outerWidth()
                    // }, 3000);
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    this_button.html( 'Something went wrong...');
                },
                complete: function( jqXHR, textStatus ){
                    this_button.html("Add to Cart");
                }
            });
        }

    });




    $('.remove-product').live("click", function(e) {

    e.preventDefault();
    var this_button = $(this);

    //console.log("clocked");

    var prod_id = $(this).attr('data-prod-id');
      
      // Start AJAX Call
      $.ajax({
          cache: false,
          //async: false,
          timeout: 80000,
          //url: 'url',
          url: ajax_function.ajax_url,
          type: "POST",
          data: ({
              action : 'remove_product_from_cart',
              prod_id : prod_id,
          }),
          beforeSend: function() {
              this_button.html( '<div class="no_results"><i class="fa fa-cog fa-spin"></i> &nbsp; Removing...</div>' );
          },
          success: function( data, textStatus, jqXHR ){
              var ajax_response = $( data );
              $(".dropdown-cart-subtotal").html(ajax_response);
              this_button.closest(".dropdown-cart-wrap").remove();
              var newTotal = $(".updated-item-count").html();
              console.log(newTotal);
              $('.cart-totals span').html(newTotal);
          },
          error: function( jqXHR, textStatus, errorThrown ){
              this_button.html( 'Oops...');
          },
          complete: function( jqXHR, textStatus ){
              this_button.html("Remove");
          }
      });


  });








    // WINDOW.SCROLL =================================================================================
    $(window).scroll(function () {

        // Back to top arrow
        if ($(this).scrollTop() > 200) {
            //if (!Modernizr.touch) {
                $('a.backtotop').fadeIn();
                $('.scrollDownPrompt').fadeOut();
            //}
        } else {
            //if (!Modernizr.touch) {
                $('a.backtotop').fadeOut();
                $('.scrollDownPrompt').fadeIn();
            //}
        }

        // STICKY HEADER ON SCROLL (if not fixed)
        var header = $(document).scrollTop();
        if (header > 178) { // Change this number to the amount you want to scroll before the header sticks
            //$('header').addClass('white');
            $('body.home header').removeClass('invisible');
        } else {
            //$('header').removeClass('white');
            $('body.home header').addClass('invisible');
        }


        /* Check the location of each desired element */
        $('.hideme').each( function(i){          
            
            var bottom_of_object = $(this).position().top + $(this).outerHeight();
            var middle_of_object = $(this).position().top + ($(this).outerHeight() / 2);
            var bottom_of_window = $(window).scrollTop() + $(window).height() ;
            
            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > middle_of_object ){
                
                $(this).animate({'opacity':'1'},3000);
                    
            }
            
        }); 



    });











});