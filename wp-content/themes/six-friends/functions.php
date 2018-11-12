<?php
/**
 * Six Friends functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Six_Friends
 */

if ( ! function_exists( 'six_friends_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function six_friends_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Six Friends, use a find and replace
		 * to change 'six-friends' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'six-friends', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top-menu' => esc_html__( 'Primary', 'six-friends' ),
			'drop-menu' => esc_html__( 'Mobile Drop Menu', 'six-friends' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			//'comment-form',
			//'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'six_friends_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'six_friends_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function six_friends_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'six_friends_content_width', 640 );
}
add_action( 'after_setup_theme', 'six_friends_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function six_friends_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'six-friends' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'six-friends' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'six_friends_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function six_friends_scripts() {
	wp_enqueue_style( 'six-friends-style', get_stylesheet_uri() );

	wp_enqueue_script( 'six-friends-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'six-friends-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }

	wp_register_script( 'main-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'jquery-ui-core' ), '1.0.0', false );
		wp_enqueue_script( 'main-scripts' );

	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'flexslider' );

	wp_register_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'fancybox' );

	// AJAX SCRIPT - AJAX SCRIPTS
	wp_register_script( 'ajax-functions', get_template_directory_uri() . '/js/ajax-functions.js', array( 'jquery' ), '1.0.0', false );
    wp_localize_script( 'ajax-functions', 'ajax_function', array(
    		'ajax_url' => admin_url( 'admin-ajax.php' )
    	) );
    wp_enqueue_script( 'ajax-functions' );


}
add_action( 'wp_enqueue_scripts', 'six_friends_scripts' );


// include ajax PHP file
	load_template(TEMPLATEPATH . '/ajax-functions.php');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/wtf.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


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


