<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Six_Friends
 */

get_header();
?>

<div class="header-spacer s90"></div>

	

		<?php
		 while ( have_posts() ) : the_post();

			//get_template_part( 'template-parts/content', get_post_type() );
			echo '<div class="post-header parent-element" style="background: url(' . get_field('header_image') . ') no-repeat; background-size: cover; background-position: center center;">';
				echo '<h1 class="child-element keep">Friends of Six Friends</h1>';
			echo '</div>';

			echo '<div class="container post-intro">';

				echo '<h2>' . get_the_title() . '</h2>';
				$newsDate = get_field('news_date');
				$tempDate = new DateTime($newsDate);
				$postDate = $tempDate->format('j F, Y');
				echo '<div class="post-date">' . $postDate . '</div>';

			echo '</div>';

			get_template_part('flexible','content');

			the_post_navigation();


		endwhile; // End of the loop.
		?>

		
	

<?php


get_footer();
