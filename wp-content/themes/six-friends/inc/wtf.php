<?php
/*
	WTF - Outputs page template from menu bar
*/


class WTF_Nag {	

	/**
	 * Parse the admin query string
	 *
	 * @return array
	 */
	private function get_admin_querystring_array() {
		parse_str( $_SERVER['QUERY_STRING'], $params );

		return $params;
	}
	
}


class WhatTheFile {

	/** @var string $template_name */
	private $template_name = '';

	/** @var array $template_parts */
	private $template_parts = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'frontend_hooks' ) );
		//add_action( 'admin_init', array( $this, 'admin_hooks' ) );
	}

	/**
	 * Setup the admin hooks
	 *
	 * @return void
	 */
	

	/**
	 * Setup the frontend hooks
	 *
	 * @return void
	 */
	public function frontend_hooks() {
		// Don't run in admin or if the admin bar isn't showing
		if ( is_admin() || ! is_admin_bar_showing() ) {
			return;
		}

		// WTF actions and filers
		//add_action( 'wp_head', array( $this, 'print_css' ) );
		add_filter( 'template_include', array( $this, 'save_current_page' ), 1000 );
		add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 1000 );

		// BuddyPress support
		// if ( class_exists( 'BuddyPress' ) ) {
		// 	add_action( 'bp_core_pre_load_template', array( $this, 'save_buddy_press_template' ) );
		// }

		// Template part hooks
		add_action( 'all', array( $this, 'save_template_parts' ), 1, 3 );
	}


	/**
	 * Get the current page
	 *
	 * @return string
	 */
	private function get_current_page() {
		return $this->template_name;
	}

	/**
	 * Check if file exists in child theme
	 *
	 * @param $file
	 *
	 * @return bool
	 */
	private function file_exists_in_child_theme( $file ) {
		return file_exists( STYLESHEETPATH . '/' . $file );
	}

	/**
	 * Returns if direct file editing through WordPress is allowed
	 *
	 * @return bool
	 */
	private function is_file_editing_allowed() {
		$allowed = true;
		if ( ( defined( 'DISALLOW_FILE_EDIT' ) && true == DISALLOW_FILE_EDIT ) || ( defined( 'DISALLOW_FILE_MODS' ) && true == DISALLOW_FILE_MODS ) ) {
			$allowed = false;
		}

		return $allowed;
	}

	/**
	 * Save the template parts in our array
	 *
	 * @param $tag
	 * @param null $slug
	 * @param null $name
	 */
	public function save_template_parts( $tag, $slug = null, $name = null ) {
		if ( 0 !== strpos( $tag, 'get_template_part_' ) ) {
			return;
		}

		// Check if slug is set
		if ( $slug != null ) {

			// Templates array
			$templates = array();

			// Add possible template part to array
			if ( $name != null ) {
				$templates[] = "{$slug}-{$name}.php";
			}

			// Add possible template part to array
			$templates[] = "{$slug}.php";

			// Get the correct template part
			$template_part = str_replace( get_template_directory() . '/', '', locate_template( $templates ) );
			$template_part = str_replace( get_stylesheet_directory() . '/', '', $template_part );

			// Add template part if found
			if ( $template_part != '' ) {
				$this->template_parts[] = $template_part;
			}
		}

	}

	/**
	 * Save the current page in our local var
	 *
	 * @param $template_name
	 *
	 * @return mixed
	 */
	public function save_current_page( $template_name ) {
		$this->template_name = basename( $template_name );

		// Do Roots Theme check
		if ( function_exists( 'roots_template_path' ) ) {
			$this->template_name = basename( roots_template_path() );
		} else if( function_exists( 'Roots\Sage\Wrapper\template_path' ) ) {
			$this->template_name = basename( Roots\Sage\Wrapper\template_path() );
		}

		return $template_name;
	}

	/**
	 * Add the admin bar menu
	 */
	public function admin_bar_menu() {
		global $wp_admin_bar;

		// Check if direct file editing is allowed
		$edit_allowed = $this->is_file_editing_allowed();

		// Add top menu
		$wp_admin_bar->add_menu( array(
			'id'     => 'wtf-bar',
			'parent' => 'top-secondary',
			'title'  => __( 'WTF', 'what-the-file' ),
			'href'   => false
		) );

		// Check if template file exists in child theme
		$theme = get_stylesheet();
		if ( ! $this->file_exists_in_child_theme( $this->get_current_page() ) ) {
			$theme = get_template();
		}

		// Add current page
		$wp_admin_bar->add_menu( array(
			'id'     => 'wtf-bar-template-file',
			'parent' => 'wtf-bar',
			'title'  => $this->get_current_page(),
			'href'   => ( ( $edit_allowed ) ? get_admin_url() . 'theme-editor.php?file=' . $this->get_current_page() . '&theme=' . $theme : false )
		) );

		// Check if theme uses template parts
		if ( count( $this->template_parts ) > 0 ) {

			// Add template parts menu item
			$wp_admin_bar->add_menu( array(
				'id'     => 'wtf-bar-template-parts',
				'parent' => 'wtf-bar',
				'title'  => 'Template Parts',
				'href'   => false
			) );

			// Loop through template parts
			foreach ( $this->template_parts as $template_part ) {

				// Check if template part exists in child theme
				$theme = get_stylesheet();
				if ( ! $this->file_exists_in_child_theme( $template_part ) ) {
					$theme = get_template();
				}

				// Add template part to sub menu item
				$wp_admin_bar->add_menu( array(
					'id'     => 'wtf-bar-template-part-' . $template_part,
					'parent' => 'wtf-bar-template-parts',
					'title'  => $template_part,
					'href'   => ( ( $edit_allowed ) ? get_admin_url() . 'theme-editor.php?file=' . $template_part . '&theme=' . $theme : false )
				) );
			}

		}

	}

}

/**
 * What The File main function
 */
function __what_the_file_main() {
	new WhatTheFile();
}


/* Initialise class */
__what_the_file_main();
