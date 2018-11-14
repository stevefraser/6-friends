<?php

/*
 * Add a page to the Admin Control Panel
 */
 
// Add a new top level menu link to the ACP
function ncf_add_menu_page() {
  
  add_menu_page(
      'Custom Theme Settings', // Title of the page
      'Theme Settings', // Text to show on the menu link
      'manage_options', // Capability requirement to see the link
      'theme-settings', // The 'slug' - file to display when clicking the link
      'ncf_settings_page'
  );

}
add_action( 'admin_menu', 'ncf_add_menu_page' );




// function to display content on the theme settings admin page
function ncf_settings_page() {

	echo '<div class="wrap">';
	  echo '<h1>Theme Settings</h1>';
	  echo '<p>This is the settings page for the ' . get_bloginfo('name') . ' website.</p>';
	  
	echo '</div>';

}

?>