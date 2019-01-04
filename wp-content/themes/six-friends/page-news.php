<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Six_Friends
 */

get_header();
?>

<div class="header-spacer s90"></div>

	<div class="container">

		<h2>Six Friends Newsletters</h2>

		<?php
		
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 12,
        'paged' => $paged,
        'orderby' =>'title',
        'order' => 'ASC',
    );

    $loop = new WP_Query( $args );

        if ( $loop->have_posts() ) {

            while ( $loop->have_posts() ) : $loop->the_post();

                $theID = $loop->post->ID;
                $the_id = get_the_ID();

                    $imgID = get_post_meta($the_id,'header_image',true);
                    $image = wp_get_attachment_url($imgID);

                    
                    echo '<div class="news-item">';
                        echo '<a class="image" style="background: url(' . $image . '); background-size: cover; background-repeat: no-repeat; background-position: center center;" href="' . get_permalink($the_id) . '"></a>';
                          echo '<div class="content-wrap">';
                            $newsDate = get_post_meta($the_id,'news_date',true);
                            $tempDate = new DateTime($newsDate);
                            $postDate = $tempDate->format('j F, Y');
                            //echo '<div class="date">' . $postDate . '</div>';
                            //$newsTitle = (get_post_meta($the_id,'alternative_title',$the_id,true) ? get_post_meta($the_id,'alternative_title',$the_id,true) : get_the_title($the_id));
                            echo '<h5 class="title">' . get_the_title() . '</h5>';
                            echo '<div class="excerpt">';
                                echo get_post_meta($the_id,'post_excerpt',$the_id,true);
                            echo '</div>';
                            echo '<a class="button" href="' . get_the_permalink($the_id) . '">Read More</a>';
                          echo '</div>';
                    echo '</div>';




            endwhile;

        } else {
            echo '<h4>No news items found.</h4><br>';
            echo '<a class="button orange" href="' . get_bloginfo('url') . '">Home page</a>';
        }

        echo '<div class="clear"></div>';

        $pagination_args = array(
              'base'            => get_pagenum_link(1) . '%_%',
              'format'          => 'page/%#%',
              'total'           => $loop->max_num_pages,
              'current'         => $paged,
              'show_all'        => true,
              'end_size'        => 1,
              //'mid_size'        => $pagerange,
              'prev_next'       => false,
              'prev_text'       => __('&laquo;'),
              'next_text'       => __('&raquo;'),
              'type'            => 'list',
              'add_args'        => false,
              'add_fragment'    => ''
        );

        $paginate_links = paginate_links($pagination_args);

        if ($paginate_links) {
            echo "<nav class='result_pagination centered'>";
              echo '<hr>';
              echo $paginate_links;
              echo '<div class="prev-next centered">';
                  $prev = get_previous_posts_link('&laquo; Previous page',$loop->max_num_pages);
                  $next = get_next_posts_link('Next page &raquo;',$loop->max_num_pages);
                  if ($prev && $next) {
                      previous_posts_link('&laquo; Previous page',$loop->max_num_pages);
                      echo ' | ';
                      next_posts_link('Next page &raquo;',$loop->max_num_pages);
                  } else {
                      previous_posts_link('&laquo; Previous page',$loop->max_num_pages);
                      next_posts_link('Next page &raquo;',$loop->max_num_pages);
                  }
              echo '</div>';
            echo "</nav>";
        }		        

		wp_reset_postdata();



		?>

		</div>

<?php


get_footer();
