<?php
/*
Template Name: Home Page
*/
?>
<?php
/**
 *
 * @package Six_Friends
 */

get_header();

?>



<div id="homeSlider" class="flexslider">

	<div class="nav-logo">
      <img src="<?php bloginfo('template_directory'); ?>/img/six-friends-logo.png" alt="Six Friends" />
  </div>

	<div class="nav-icon">
    <span></span>
    <span></span>
    <span></span>
  </div>

   <ul class="slides">

   <?php
      if (have_rows('slides')) :
          while (have_rows('slides')) : the_row();
  
         	$showText = get_sub_field('show_text');
          $buttonText = get_sub_field('button_text');
          $buttonLink = get_sub_field('button_link');

			    echo '<li>';
	            echo '<div class="slide-wrapper parent-element" style="background: url(' . get_sub_field('image') . ') no-repeat; background-size: cover; background-position: center center;">';
	              	if ($showText == "yes") {
	              		echo '<div class="slide-text child-element keep">';
	                    echo '<div class="slide-delay-1">' . get_sub_field('hero_text') . '</div>';
	                    echo '<div class="slide-delay-2">' . get_sub_field('intro_text') . '</div>';
	                    if ($buttonText && $buttonLink) {
	                    	echo '<div class="slide-delay-3">';
	                    		echo '<a class="button white" href="' . $buttonLink . '">' . $buttonText . '</a>';
	                    	echo '</div>';
	                    }
	              		echo '</div>';
	                }	     
	            echo '</div>';
			    echo '</li>';
  
          endwhile;
      endif;
    ?>


  </ul>

  <div class="slider-navigation">
	  <a href="#" class="flex-prev">Prev</a>
	  <div class="slider-controls-container"></div>
	  <a href="#" class="flex-next">Next</a>
	</div>

  <div class="scrollDownPrompt animate-down"></div>

</div>


<?php get_template_part('flexible','content'); ?>




<?php


get_footer();
