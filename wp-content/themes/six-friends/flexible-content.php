<?php



// check if the flexible content field has rows of data
if( have_rows('flexible_content') ):

    // loop through the rows of data
    while ( have_rows('flexible_content') ) : the_row();




						// ACTIVE: IMAGE AND CONTENT ROW
            if ( get_row_layout() == 'image_and_content' ) {

                $rowLayout = get_sub_field('row_layout');
                $image = get_sub_field('image');
                $textBackground = get_sub_field('text_background');
                $textClass = ($textBackground == "#ffffff" ? "dark" : "light");
                $textContent = get_sub_field('text_content');
                $textFloat = ($rowLayout == "image-left" ? "right" : "left");
                $imageFloat = ($rowLayout == "image-right" ? "right" : "left");                
                $imageSide = get_sub_field('image_side');

                echo '<div class="container">';

		                echo '<div class="image-content-wrap">';

		                        echo '<div class="side-content ' . $textFloat . ' ' . $textClass . ' parent-element" style="background-color: ' . $textBackground . ';">';
		                            echo '<div class="child-element">';
		                                echo $textContent;
		                            echo '</div>';
		                        echo '</div>';

		                        echo '<div class="side-image ' . $imageFloat . ' ' . $textClass . '">';
		                            echo '<div style="background: url(' . $image . ') no-repeat center center; background-size: cover; width: 100%; height: 100%;"></div>';
		                        echo '</div>';

		                        echo '<div class="clear"></div>';

		                echo '</div>';

		            echo '</div>';

            }



						// ACTIVE: IMAGE AND CONTENT ROW
            elseif ( get_row_layout() == 'full_width_image' ) {

                $image = get_sub_field('image');

                echo '<div class="container">';

	                echo '<div class="full-width-image" style="background: url(' . $image . ') no-repeat center center; background-size: cover;">';		                        

	                echo '</div>';

	            echo '</div>';

            }



            // ACTIVE: IMAGE AND CONTENT ROW
            elseif ( get_row_layout() == 'full_width_content' ) {

                echo '<div class="container">';

                    echo '<div class="full-width-content">';                             
                        echo get_sub_field('content');
                    echo '</div>';

                echo '</div>';

            }



						// ACTIVE: IMAGE AND CONTENT ROW
            elseif ( get_row_layout() == 'cta_bar' ) {

                $backgroundColor = get_sub_field('background');
                $textColor = ($backgroundColor == "#ffffff" ? "#952c47" : "#ffffff");
                $heading = get_sub_field('heading');
                $content = get_sub_field('content');
                $padding = get_sub_field('padding');

                echo '<div class="container">';
	                echo '<div class="cta-bar" style="color: ' . $textColor . '; background-color: ' . $backgroundColor . '; padding-top: ' . $padding . 'px; padding-bottom: ' . $padding . 'px;">';		                        
                		echo '<h2>' . $heading . '</h2>';
                		echo $content;
	                echo '</div>';
		            echo '</div>';

            }



            


    endwhile;

else :

// no layouts found

endif;

?>