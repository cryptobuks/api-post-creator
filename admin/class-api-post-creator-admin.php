<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://theyoricktouch.com
 * @since      1.0.0
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/admin
 * @author     Yorick Brown <info@theyoricktouch.com>
 */
class Api_Post_Creator_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

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
		 * defined in Api_Post_Creator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Api_Post_Creator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/api-post-creator-admin.css', array(), $this->version, 'all' );

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
		 * defined in Api_Post_Creator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Api_Post_Creator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/api-post-creator-admin.js', array( 'jquery' ), $this->version, false );

	} // enqueue_scripts()

	/**
	 * Creates a new custom post type
	 *
	 * @since 1.0.0
	 * @access public
	 * @uses register_post_type()
	 */
	public static function new_cpt_api_post() {
		$cap_type = 'post';
		$plural = 'API posts';
		$single = 'API post';
		$cpt_name = 'api-post';
		$opts['can_export'] = TRUE;
		$opts['capability_type'] = $cap_type;
		$opts['description'] = '';
		$opts['exclude_from_search'] = FALSE;
		$opts['has_archive'] = TRUE;
		$opts['hierarchical'] = FALSE;
		$opts['map_meta_cap'] = TRUE;
		$opts['menu_icon'] = 'dashicons-format-audio';
		$opts['menu_position'] = 25;
		$opts['public'] = TRUE;
		$opts['publicly_querable'] = TRUE;
		$opts['query_var'] = TRUE;
		$opts['register_meta_box_cb'] = '';
		$opts['rewrite'] = FALSE;
		$opts['show_in_admin_bar'] = TRUE;
		$opts['show_in_menu'] = TRUE;
		$opts['show_in_nav_menu'] = TRUE;

		$opts['supports'] = array('title', 'thumbnail', 'custom-fields');
		
		$opts['labels']['add_new'] = esc_html__( "Add New {$single}", 'api post' );
		$opts['labels']['add_new_item'] = esc_html__( "Add New {$single}", 'api post' );
		$opts['labels']['all_items'] = esc_html__( $plural, 'api post' );
		$opts['labels']['edit_item'] = esc_html__( "Edit {$single}" , 'api post' );
		$opts['labels']['menu_name'] = esc_html__( $plural, 'api post' );
		$opts['labels']['name'] = esc_html__( $plural, 'api post' );
		$opts['labels']['name_admin_bar'] = esc_html__( $single, 'api post' );
		$opts['labels']['new_item'] = esc_html__( "New {$single}", 'api post' );
		$opts['labels']['not_found'] = esc_html__( "No {$plural} Found", 'api post' );
		$opts['labels']['not_found_in_trash'] = esc_html__( "No {$plural} Found in Trash", 'api post' );
		$opts['labels']['parent_item_colon'] = esc_html__( "Parent {$plural} :", 'api post' );
		$opts['labels']['search_items'] = esc_html__( "Search {$plural}", 'api post' );
		$opts['labels']['singular_name'] = esc_html__( $single, 'api post' );
		$opts['labels']['view_item'] = esc_html__( "View {$single}", 'api post' );
		register_post_type( strtolower( $cpt_name ), $opts );
	} // new_cpt_api_post()
	
	/**
	* Register the administration menu for this plugin into the WordPress Dashboard menu.
	*
	* @since 1.0.0
	*/
	
	public function add_plugin_admin_menu() {
		add_options_page( 'API Posts Creator Options Settings', 'API posts', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
	}
	

	/**
	* Add settings action link to the plugins page.
	*
	* @since 1.0.0
	*/
	
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge( $settings_link, $links );
	}

	/**
	* Render the settings page for this plugin.
	*
	* @since 1.0.0
	*/
	
	public function display_plugin_setup_page() {
		include_once( 'partials/api-post-creator-admin-display.php' );
	}

	// form validation
	public function validate($input) {
		// All checkboxes inputs        
		$valid = array();
	 
		//post title
		$valid['post-title'] = (isset($input['post-title']) && !empty($input['post-title'])) ? 1 : 0;
		//return 1;
		return $valid;
	 }

	 public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
}
