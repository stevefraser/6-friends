<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Six_Friends
 */

?>




<footer class="site-footer">
	<div class="container">
		<div class="twelve columns centered">
			<hr>
    	<?php
            echo '<span>Six Friends &copy; ' . date('Y') . '</span>';
            echo '<span class="hide"> | </span><span>All Rights Reserved</span>';
            echo '<span class="hide"> | </span><span><a href="' . get_bloginfo("url") . '/terms-and-conditions/">Terms &amp; Conditions</a></span>';
        ?>   
		</div>
	</div>

</footer><!-- #colophon -->


<div id="newsletter-signup" class="hidden">
	<h4>Keep Up To Date</h4>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor nibh eu nibh scelerisque malesuada. Morbi mollis eleifend turpis. Mauris consequat convallis volutpat. Integer quis erat vehicula</p>
	<?php echo do_shortcode('[gravityform id="1" ajax="true" title="false"]'); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
