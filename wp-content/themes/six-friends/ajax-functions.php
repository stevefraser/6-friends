<?php

	
function crispshop_add_cart_single_ajax() {
	$product_id = $_POST['product_id'];
	$variation_id = $_POST['variation_id'];
	$quantity = $_POST['quantity'];

	if ($variation_id) {
		WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
	} else {
		WC()->cart->add_to_cart( $product_id, $quantity);
	}

	$items = WC()->cart->get_cart();
	global $woocommerce;
	$item_count = $woocommerce->cart->cart_contents_count; ?>

	<span style="display: none;" class="item-count"><?php echo $item_count; ?></span>

	<h4>In your wine bin...</h4>

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
					// 	echo '<p class="price"><strong>Price:</strong> <del>' . $currency; echo $price . '</del> ' . $currency .  $sale . '</p>';
				 //    } elseif($price) { 
					// 	echo '<p class="price"><strong>Price:</strong> ' . $currency . $price . '</p>';   
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
			<h6><?php echo WC()->cart->get_cart_total(); ?></h6>
		</div>

		<div class="clear"></div>
	</div>

	<?php $cart_url = $woocommerce->cart->get_cart_url();
	$checkout_url = $woocommerce->cart->get_checkout_url(); ?>

	<div class="dropdown-cart-wrap dropdown-cart-links">
		<div class="dropdown-cart-left dropdown-cart-link">
			<a href="<?php echo $cart_url; ?>">View Cart</a>
		</div>

		<div class="dropdown-cart-right dropdown-checkout-link">
			<a href="<?php echo $checkout_url; ?>">Checkout</a>
		</div>

		<div class="clear"></div>
	</div>

	<?php die();
}

add_action('wp_ajax_crispshop_add_cart_single', 'crispshop_add_cart_single_ajax');
add_action('wp_ajax_nopriv_crispshop_add_cart_single', 'crispshop_add_cart_single_ajax');










add_action('wp_ajax_remove_product_from_cart', 'remove_product_from_cart');
add_action('wp_ajax_nopriv_remove_product_from_cart', 'remove_product_from_cart');

function remove_product_from_cart() {
    
		$WC = WC();
        // Set the product ID to remove
        //$prod_to_remove = intval($_GET['pid']);
        $prod_to_remove = $_POST["prod_id"];

        // Cycle through each product in the cart
        foreach ( $WC->cart->get_cart() as $cart_item_key => $cart_item ) {
            // Get the Variation or Product ID
            $prod_id = $cart_item['product_id'];

            // Check to see if IDs match
            if( $prod_to_remove == $prod_id ) {
            	//echo '<h4>' . $prod_to_remove . '</h4>';
							//$WC->cart->set_quantity( $cart_item_key, $cart_item['quantity'] - 1, true  );
							$WC->cart->set_quantity( $cart_item_key, 0, true  );
							//$WC->cart->remove_cart_item( $cart_item_key);
							break;
            }
        }

        // 
        $items = WC()->cart->get_cart();
				global $woocommerce;
				$updated_item_count = $woocommerce->cart->cart_contents_count; 

				if ($updated_item_count >0) {
					echo '<span style="display: none;" class="updated-item-count">' . $updated_item_count . '</span>';

					echo '<div class="dropdown-cart-left">';
						echo '<h6>Subtotal</h6>';
					echo '</div>';

					echo '<div class="dropdown-cart-right">';
						echo '<h6>' . WC()->cart->get_cart_total() . '</h6>';
					echo '</div>';

					echo '<div class="clear"></div>';
				} else {
					echo '<span style="display: none;" class="updated-item-count">' . $updated_item_count . '</span>';
					echo '<p>Your cart is empty.</p>';
				}

		


		
		//die(); // if ajax call
}






add_action('wp_ajax_update_likes', 'update_likes');
add_action('wp_ajax_nopriv_update_likes', 'update_likes');

function update_likes() {

	$product_id = $_POST['product_id'];
	$count = $_POST['count'];
	//$new_count = $count + 1;

	update_post_meta($product_id,'likes',++$count);


}




?>