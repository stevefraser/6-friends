<?php
/**
 * @package Nybble Custom Functions
 * @version 1.2
 */
/*
Plugin Name: Nybble Custom Functions
Plugin URI: http://nybble.com.au/
Description: This plugin extends the Underscores bare-bones theme template and makes this website come to life!
Author: Nybble Digital
Version: 1.2
Author URI: http://nybble.com.au/
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// Include ncf-functions.php, use require_once to stop the script if ncf-functions.php is not found
require_once plugin_dir_path(__FILE__) . 'inc/ncf-functions.php';

// set up admin page
require_once plugin_dir_path(__FILE__) . 'inc/ncf-admin-page-setup.php';





