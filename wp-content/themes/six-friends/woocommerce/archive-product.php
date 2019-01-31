<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


get_header(); ?>


<div class="header-spacer s90"></div>

<?php //get_template_part('snippet','header'); ?>

<!-- <div class="header-image"></div> -->

<div class="container">
		
    <?php 

    	the_content(); 

    	//echo '<hr>';

    	$params = array(
    		'posts_per_page' => 5,	
    		'post_type' => 'product',
    	); 
		$wc_query = new WP_Query($params); 
		
		echo '<div class="shop-wrapper">';
			
			if ($wc_query->have_posts()) : 
				while ($wc_query->have_posts()) :
					echo '<div class="single-product-item">';
		                $wc_query->the_post(); 
		                $product = get_product(get_the_ID());

		                $top_name = get_field('product_top_name');
						$sub_name = get_field('product_sub_name');

						echo '<a href="' . get_permalink( $the_id ) . '">';
						echo '<h3>' . $top_name . '</h3>';
						echo '</a>';
						echo '<h4>' . $sub_name . '</h4>';
						the_post_thumbnail();
						the_excerpt();

						
						//echo wc_price($product->get_regular_price());
						//echo '<div id="regular-price">' . $product->get_regular_price() . '</div>';
						echo '<div class="price-point">$<span>' . $product->get_regular_price() . '</span></div>';

						// $cats = get_the_terms($product->get_id(),'product_cat');
						// foreach ($cats as $key => $cat) {
						// 	echo $cat->name;
						// }

						

						// echo '<a href="' . get_permalink( $the_id ) . '">View Product</a>';

						// EXPANDABLE SECTIONS
						// while (have_rows('info_sections')) : the_row();
				  //       	echo '<div class="expand">' . get_sub_field('title') . '</div>';
				  //       	echo '<div class="hiddenContent">';
					 //           	echo get_sub_field('content');
					 //        echo '</div>';
				  //       endwhile;

						?>
						<form class="cart" method="post" enctype="multipart/form-data">
							<div class="quantity">
					        	<div class="minus"><span class="tm-icon-minus"></span></div>
					        	<input type="text" step="1" min="1" max="96" name="quantity" value="1" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
					        	<div class="plus"><span class="tm-icon-plus"></span></div>
					    	</div>					
					    	<input type="hidden" name="regular-price" class="regular-price" value="<?php echo $product->get_regular_price(); ?>">		
							<button type="submit" data-product-id="<?php echo $product->get_id(); ?>" class="single_add_to_cart_button button alt">Add to cart </button>
						</form>

						<?php


						$smLinks = get_field('social_media_icons');
						if($smLinks) {
							//echo '<hr class="half_margin">';
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
							//echo '<hr class="half_margin">';
						}


						echo '<div class="clear"></div>';
					echo '</div>';
				endwhile;
				wp_reset_postdata(); 
			else: 
				echo '<p>';
				    echo _e( "No Products Found" );
				echo '</p>';
			endif;

			echo '<div class="clear"></div>';
		echo '</div>';


    ?>

</div>











<?php get_footer(); ?>
