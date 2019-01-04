<?php
/*
Template Name: Style Guide
*/
?>

<?php get_header(); ?>

<?php
    global $post;
    $permalink = get_permalink($post->ID);
?>


<div class="header-spacer s90"></div>


<div class="container">
    <div class="row">
        <div class="twelve columns styleguide-page">

        	<br><br>

            <?php echo get_bloginfo('name') . ' Style Guide'; ?>

            <?php the_post(); ?>
            <?php the_content(); ?>

            <hr>


						<h1>heading h1</h1>
						<h2>heading h2</h2>
						<h3>heading h3</h3>
						<h4>heading h4</h4>
						<h5>heading h5</h5>
						<h6>heading h6</h6>

						<br><br>

						<p>Paragraph (General BODY Styles):<br>

						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>



						<a href="#">I'm a hyperlink - hover over me!</a>




        </div>
    </div>
</div>

<?php get_footer(); ?>