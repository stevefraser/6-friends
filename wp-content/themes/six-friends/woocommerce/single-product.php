<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); the_post(); ?>

<div class="header-spacer s90"></div>

<div class="container">

	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php 

		the_content(); 

		//echo '<hr>';
		
		echo '<div class="product-wrapper">';

			echo '<div class="single-product-item">';
				global $product;
				$product_ID = get_the_ID();

				echo '<div class="image-wrap">' . get_the_post_thumbnail() . '</div>';

				echo '<div class="side-content">';

	        $top_name = get_field('product_top_name');
					$sub_name = get_field('product_sub_name');

					echo '<h3>' . $top_name . '</h3>';
					echo '<h4>' . $sub_name . '</h4>';
					//the_post_thumbnail();
					the_excerpt();

					$likes = get_field('likes');
					echo '<a href="#" title="Love it" class="like-btn like-btn-counter" data-product-id="' . $product_ID . '" data-count="' . $likes . '"><span><i class="fas fa-heart"></i></span></a>';
					echo '<div class="like-loading"></div>';
					//echo wc_price($product->get_regular_price());
					//echo '<div id="regular-price">' . $product->get_regular_price() . '</div>';
					echo '<div class="price-point">$<span>' . $product->get_regular_price() . '</span></div>';
					echo '<div class="sub-price">(Plus shipping)</div>';

					// display list of product categories
					// $cats = get_the_terms($product->get_id(),'product_cat');
					// foreach ($cats as $key => $cat) {
					// 	echo $cat->name;
					// }

					?>
					<form class="cart" method="post" enctype="multipart/form-data">
						<div class="quantity">
				        	<div class="minus"><span class="tm-icon-minus"></span></div>
				        	<input type="text" step="1" min="1" max="96" name="quantity" value="1" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
				        	<div class="plus"><span class="tm-icon-plus"></span></div>
				    	</div>					
				    	<input type="hidden" name="regular-price" class="regular-price" value="<?php echo $product->get_regular_price(); ?>">			
						<!-- <input type="hidden" name="add-to-cart-id" class="add-to-cart-id" value="<?php //echo $product->get_id(); ?>"> -->
						<button type="submit" data-product-id="<?php echo $product_ID; ?>" class="single_add_to_cart_button button alt">Add to cart </button>
					</form>

					<?php

					$smLinks = get_field('social_media_icons');
					if($smLinks) {
						echo '<hr class="half_margin">';
						echo '<div class="smLinksBar">';

						foreach($smLinks as $smLink) {
							switch ($smLink) {
								case 'Facebook':
									$link = 'http://www.facebook.com/sharer/sharer.php?u=' . $permalink . '&title=' . get_the_title();
									$icon = '<i class="fab fa-facebook-f"></i>';
									break;

								case 'Twitter':
									$link = 'http://twitter.com/intent/tweet?status=' . get_the_title() . '+' . $permalink;
									$icon = '<i class="fab fa-twitter"></i>';
									break;

								case 'Google Plus':
									$link = 'https://plus.google.com/share?url=' . $permalink;
									$icon = '<i class="fab fa-google-plus-g"></i>';
									break;

								default:
									# code...
									break;
							}
							echo '<a href="' . $link . '" target="_blank">';
							echo $icon;
							echo '</a>';
						}

						echo '</div>';
						// echo '<hr class="half_margin">';
					}

				echo '</div>';

				echo '<div class="clear"></div>';

				// EXPANDABLE SECTIONS
				while (have_rows('info_sections')) : the_row();
		        	echo '<div class="expand">' . get_sub_field('title') . '</div>';
		        	echo '<div class="hidden">';
			           	echo get_sub_field('content');
			        echo '</div>';
		        endwhile;




				
				echo '<div class="clear"></div>';
			echo '</div>';

		echo '</div>';



	?>



	</div>

</div>

<?php get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
