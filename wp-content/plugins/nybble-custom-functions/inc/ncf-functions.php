<?php


if ( ! function_exists( 'custom_theme_setup' ) ) :

	function custom_theme_setup() {

			// register menus
			register_nav_menus( array(
				'top-menu' => esc_html__( 'Top Menu', 'six-friends' ),
				'drop-menu' => esc_html__( 'Mobile Drop Menu', 'six-friends' ),
			) );

			require get_template_directory() . '/inc/wtf.php';

			// Changes the default Gravity Forms AJAX spinner.
			add_filter( 'gform_ajax_spinner_url', 'custom_gforms_spinner' );
			function custom_gforms_spinner( $src ) {
			    return get_stylesheet_directory_uri() . '/img/gravity-forms-spinner.gif';
			}

			// Remove WP Admin Bar bump
			add_action('get_header', 'my_filter_head');

			function my_filter_head() {
			remove_action('wp_head', '_admin_bar_bump_cb');
			}




	}

endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );



function custom_theme_scripts() {

	wp_enqueue_style( 'ncf-flexslider',  get_template_directory_uri() . '/css/flexslider.min.css' );
	wp_enqueue_style( 'ncf-fancybox',  get_template_directory_uri() . '/css/jquery.fancybox.min.css' );

	wp_register_script( 'main-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'jquery-ui-core' ), '1.0.0', false );
		wp_enqueue_script( 'main-scripts' );

	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'flexslider' );

	wp_register_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'fancybox' );

	// wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '1.0.0', false );
	// wp_enqueue_script( 'modernizr' );

	// AJAX SCRIPT - AJAX SCRIPTS
	wp_register_script( 'ajax-functions', get_template_directory_uri() . '/js/ajax-functions.js', array( 'jquery' ), '1.0.0', false );
    wp_localize_script( 'ajax-functions', 'ajax_function', array(
    		'ajax_url' => admin_url( 'admin-ajax.php' )
    	) );
    wp_enqueue_script( 'ajax-functions' );



}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );


// include ajax PHP file
//load_template(TEMPLATEPATH . '/ajax-functions.php');
require get_template_directory() . '/ajax-functions.php';




function ncf_styles() {
  wp_enqueue_style( 'style',  plugin_dir_url( __FILE__ ) . "/css/ncf-styles.css");
}
add_action( 'admin_print_styles', 'ncf_styles' );


function ncf_scripts()
{   
    wp_enqueue_script( 'ncf-scripts', plugin_dir_url( __FILE__ ) . 'js/ncf-scripts.js' );
}
add_action('admin_enqueue_scripts', 'ncf_scripts');





// CODE TO ADD CUSTOM DROP DOWN FORMATS IN EDITOR META BOX =======================================
 function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

function my_mce_before_init_insert_formats( $init_array ) {

	// Define the style_formats array

	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Ghost Button',
			'inline' => 'a',
			'classes' => 'ghost-button',
			'wrapper' => true,
		),
		array(
			'title' => 'Solid Button',
			'inline' => 'a',
			'classes' => 'solid-button',
			'wrapper' => true,
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );





?>