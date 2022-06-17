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
class Moderni_Form_CPT {

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

		$this->register_custom_post_type();
	}

    /**
	 * Register custom Post Type "mvf_property" functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_custom_post_type() {

		add_action( "init", array( $this, "Register_cpt" ) );

	}

    /**
	 * Register custom Post Type "mvf_property"
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function Register_cpt() {

        $labels = array(
            'name'                  => _x( 'Properties', 'Post type general name', 'moderni-form' ),
            'singular_name'         => _x( 'Property', 'Post type singular name', 'moderni-form' ),
            'menu_name'             => _x( 'Properties', 'Admin Menu text', 'moderni-form' ),
            'name_admin_bar'        => _x( 'Property', 'Add New on Toolbar', 'moderni-form' ),
            'add_new'               => __( 'Add New', 'moderni-form' ),
            'add_new_item'          => __( 'Add New Property', 'moderni-form' ),
            'new_item'              => __( 'New Property', 'moderni-form' ),
            'edit_item'             => __( 'Edit Property', 'moderni-form' ),
            'view_item'             => __( 'View Property', 'moderni-form' ),
            'all_items'             => __( 'All Properties', 'moderni-form' ),
            'search_items'          => __( 'Search properties', 'moderni-form' ),
            'parent_item_colon'     => __( 'Parent properties:', 'moderni-form' ),
            'not_found'             => __( 'No properties found.', 'moderni-form' ),
            'not_found_in_trash'    => __( 'No properties found in Trash.', 'moderni-form' ),
            'featured_image'        => _x( 'Property Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'moderni-form' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'moderni-form' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'moderni-form' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'moderni-form' ),
            'archives'              => _x( 'Property archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'moderni-form' ),
            'insert_into_item'      => _x( 'Insert into property', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'moderni-form' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this property', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'moderni-form' ),
            'filter_items_list'     => _x( 'Filter properties list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'moderni-form' ),
            'items_list_navigation' => _x( 'Properties list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'moderni-form' ),
            'items_list'            => _x( 'Properties list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'moderni-form' ),
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false, // true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => MODERNI_FORM_CPT_SLUG ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-upload',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ), // 'custom-fields'
            // 'taxonomies'         => array( 'category', 'tags' )
        );
     
        register_post_type( MODERNI_FORM_CPT_NAME, $args );

	}


}

new Moderni_Form_CPT();