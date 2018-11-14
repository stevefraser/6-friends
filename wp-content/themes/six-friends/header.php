<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Six_Friends
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



<header>
  <div class="container">
        <a href="<?php echo get_bloginfo('url'); ?>">
            <div class="nav-logo">
                <img src="<?php bloginfo('template_directory'); ?>/img/six-friends-logo.jpg" alt="Six Friends" />
            </div>
        </a>
        <!-- <a class="search-icon-link" data-fancybox data-src="#search_popup" href="javascript:;">
            <i class="fas fa-search"></i>
        </a> -->
        <div id="nav-icon">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'sort_column' => 'menu_order', 'menu_class'=>'topmenu' ) ); ?>
        <div class="clear"></div>
  </div>
  <!-- <div id="screen-menu-wrap">
    <?php 
        //wp_nav_menu( array( 'theme_location' => 'drop-menu', 'sort_column' => 'menu_order', 'menu_class'=>'screen-menu' ) ); 
    ?>
  </div> -->

  

</header>

<div class="overlay overlay-scale">
	<button type="button" class="overlay-close">Close</button>
		<?php
			wp_nav_menu( array( 'theme_location' => 'drop-menu', 'sort_column' => 'menu_order', 'menu_class'=>'screen-menu' ) ); 
		?>
</div>

<div class="header-spacer"></div>



