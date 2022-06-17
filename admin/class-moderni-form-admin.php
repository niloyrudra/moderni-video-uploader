<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/admin
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . "includes/class-moderni-form-admin-settings.php";

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/admin
 * @author     Niloy Rudra <contact@niloyrudra.com>
 */
class Moderni_Form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The settings of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $settings    The current admin settings of this plugin.
	 */
	private $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		Moderni_Form_Admin_settings::init();

		$this->admin_pages();

	}

	/**
	 * Setup menus
	 *
	 * Source: http://stackoverflow.com/a/23002306
	 */
	public function admin_pages() {
		add_action( "admin_menu", array( $this, "register_admin_menu" ) );
	}

	/**
	 * Register Admin Menu
	 * Generate Admin Pages
	 */
	public function register_admin_menu() {
		$mvf_menu_slug = 'mvf-settings';
		// Dashboard Page
		add_menu_page(
			__( 'Moderni Video Uploader Plugin', 'moderni-form' ),
			__( 'Moderni Video Uploader', 'moderni-form' ),
			'manage_options', // 'edit_pages',
			$mvf_menu_slug,
			array( $this, 'admin_dashboard'),
			'dashicons-upload',
			30
		);
		add_submenu_page(
			$mvf_menu_slug,
			__( 'Moderni Video Uploader - Settings', 'moderni-form' ),
			__( 'Settings', 'moderni-form' ),
			'manage_options',
			$mvf_menu_slug,
			array( $this, 'admin_settings')
		);
		add_submenu_page(
			$mvf_menu_slug,
			__( 'Uploaded Projects', 'cbb' ),
			__( 'Uploaded Projects', 'cbb' ),
			'manage_options' ,
			'edit.php?post_type=' . MODERNI_FORM_CPT_NAME
		);
		add_submenu_page(
			$mvf_menu_slug,
			__( 'Project Types', 'cbb' ),
			__( 'Project Types', 'cbb' ),
			'manage_options' ,
			'edit-tags.php?taxonomy=' . MODERNI_FORM_CT_NAME
		);
	}

	/**
	 * Admin Page Callbacks
	 */
	public function admin_dashboard() {
		// echo "<h1>Moderni Video Uploader Plugin</h1>";
	}
	public function admin_settings() {
		require_once MODERNI_FORM_PLUGIN_DIR_PATH . 'admin/partials/moderni-form-admin-display.php';
	}

	/** --------------------------------------------------------------------------------------------------------------------------- */

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Moderni_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Moderni_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/moderni-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Moderni_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Moderni_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/moderni-form-admin.js', array( 'jquery' ), $this->version, false );

	}

}
