<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Moderni_Form
 * @subpackage Moderni_Form/includes
 * @author     Niloy Rudra <contact@niloyrudra.com>
 */
class Moderni_Form_Tax {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->register_custom_taxonomies();
	}

    /**
	 * Register Custom Taxonomies functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_custom_taxonomies() {

		add_action( "init", array( $this, "register_custom_tax" ) );

	}

    /**
	 * Register custom Post Type "mvf_property"
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_custom_tax() {

        // Add new taxonomy, make it hierarchical (like Property Types)
        $labels = array(
            'name'              => _x( 'Property Types', 'taxonomy general name', 'moderni-form' ),
            'singular_name'     => _x( 'Property Type', 'taxonomy singular name', 'moderni-form' ),
            'search_items'      => __( 'Search Property Types', 'moderni-form' ),
            'all_items'         => __( 'All Property Types', 'moderni-form' ),
            'parent_item'       => __( 'Parent Property Type', 'moderni-form' ),
            'parent_item_colon' => __( 'Parent Property Type:', 'moderni-form' ),
            'edit_item'         => __( 'Edit Property Type', 'moderni-form' ),
            'update_item'       => __( 'Update Property Type', 'moderni-form' ),
            'add_new_item'      => __( 'Add New Property Type', 'moderni-form' ),
            'new_item_name'     => __( 'New Property Type Name', 'moderni-form' ),
            'menu_name'         => __( 'Property Type', 'moderni-form' ),
        );
    
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
			'show_in_rest'		=> true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => MODERNI_FORM_CT_SLUG ),
        );
    
        // Register Custom Taxonomy
        register_taxonomy( MODERNI_FORM_CT_NAME, array( MODERNI_FORM_CPT_NAME ), $args );

	}

}

new Moderni_Form_Tax();