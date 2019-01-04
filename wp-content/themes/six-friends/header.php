<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Six_Friends
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Frank+Ruhl+Libre" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<div id="preloader">
  <div id="status">&nbsp;</div>
</div>



<header>
  <div class="">

      <div class="cart-dropdown">
        <div class="close-dropdown"><i class="fas fa-times"></i></div>
        <div class="cart-dropdown-inner">
          <span style="display: none;" class="item-count"></span>

          <h4>In your wine bin...</h4>
          
          <!-- <div class="dropdown-cart-wrap product-row">
              <div class="dropdown-cart-left">
                  <img width="150" height="150" src="https://hansentasmania.com/wp-content/uploads/2018/05/carton-150x150.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="Hansen Cider Carton" srcset="https://hansentasmania.com/wp-content/uploads/2018/05/carton-150x150.jpg 150w, https://hansentasmania.com/wp-content/uploads/2018/05/carton-100x100.jpg 100w, https://hansentasmania.com/wp-content/uploads/2018/05/carton-300x300.jpg 300w" sizes="100vw">
              </div>
              <div class="dropdown-cart-right">
                <h5>Hansen Cider Carton</h5>
                <p>Quantity: 6</p>
                <button class="remove-product" data-prod-id="">Remove</button>
              </div>
              <div class="clear"></div>
          </div> -->
          <?php
            $items = WC()->cart->get_cart();
            global $woocommerce;
            $item_count = $woocommerce->cart->cart_contents_count; 
            ?>

          <span style="display: none;" class="item-count"><?php echo $item_count; ?></span>

          <?php foreach($items as $item => $values) { 
            $_product = $values['data']->post; ?>
            
            <div class="dropdown-cart-wrap product-row">
              <div class="dropdown-cart-left">
                <?php $variation = $values['variation_id'];
                    if ($variation) {
                        echo get_the_post_thumbnail( $values['variation_id'], 'thumbnail' ); 
                    } else {
                        echo get_the_post_thumbnail( $values['product_id'], 'thumbnail' ); 
                    } 
                ?>
              </div>

              <div class="dropdown-cart-right">
                <h5><?php echo $_product->post_title; ?></h5>
                <p>Quantity: <?php echo $values['quantity']; ?></p>
                <button class="remove-product" data-prod-id="<?php echo $values['product_id']; ?>">Remove</button>
                <?php 
                  global $woocommerce;
                  $currency = get_woocommerce_currency_symbol();
                  $price = get_post_meta( $values['product_id'], '_regular_price', true);
                  $sale = get_post_meta( $values['product_id'], '_sale_price', true);
                  
                  // if($sale) {
                  //  echo '<p class="price"><strong>Price:</strong> <del>' . $currency; echo $price . '</del> ' . $currency .  $sale . '</p>';
                 //    } elseif($price) { 
                  //  echo '<p class="price"><strong>Price:</strong> ' . $currency . $price . '</p>';   
                 //    } 
                ?>
              </div>

              <div class="clear"></div>
            </div>
          <?php } ?>


      
          <div class="dropdown-cart-wrap dropdown-cart-subtotal">
              <div class="dropdown-cart-left">
                <h6>Subtotal:</h6>
              </div>
              <div class="dropdown-cart-right">
                <h6><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>0.00</span></h6>
              </div>
              <div class="clear"></div>
          </div>

      
          <div class="dropdown-cart-wrap dropdown-cart-links">
              <div class="dropdown-cart-left dropdown-cart-link">
                <a href="<?php echo get_bloginfo('url'); ?>/cart/">View Cart</a>
              </div>
              <div class="dropdown-cart-right dropdown-checkout-link">
                <a href="<?php echo get_bloginfo('url'); ?>/checkout/">Checkout</a>
              </div>
              <div class="clear"></div>
          </div>

          <div class="clear"></div>
        </div>
      </div>



      <div class="secondary-cart">
        <?php $items = WC()->cart->get_cart();
        global $woocommerce;
        $item_count = $woocommerce->cart->cart_contents_count; ?>
        <a class="cart-totals" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fas fa-shopping-cart"></i> (<span><?php echo $item_count; ?></span>)</a>
      </div>


      <a href="<?php echo get_bloginfo('url'); ?>">
          <div class="nav-logo">
              <img src="<?php bloginfo('template_directory'); ?>/img/six-friends-logo.jpg" alt="Six Friends" />
          </div>
      </a>
      <!-- <a class="search-icon-link" data-fancybox data-src="#search_popup" href="javascript:;">
          <i class="fas fa-search"></i>
      </a> -->
      <div class="nav-icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'sort_column' => 'menu_order', 'menu_class'=>'topmenu' ) ); ?>
      <div class="clear"></div>

  </div>
  <!-- <div id="screen-menu-wrap">
    <?php 
        //wp_nav_menu( array( 'theme_location' => 'drop-menu', 'sort_column' => 'menu_order', 'menu_class'=>'screen-menu' ) ); 
    ?>
  </div> -->

  

</header>

<div class="overlay overlay-scale">
	<button type="button" class="overlay-close">Close</button>
		<?php
			wp_nav_menu( array( 'theme_location' => 'drop-menu', 'sort_column' => 'menu_order', 'menu_class'=>'screen-menu' ) ); 
		?>
</div>





