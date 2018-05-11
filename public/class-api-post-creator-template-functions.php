<?php

/**
 * The public-facing functionality of the plugin.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://theyoricktouch.com
 * @since      1.0.0
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/admin/partials
 */
?>
<?php

class Api_Post_Creator_Template_Functions {

	/**
	 * Private static reference to this class
	 * Useful for removing actions declared here.
	 *
	 * @var 	object 		$_this
 	 */
	private static $_this;

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		self::$_this = $this;

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	} // __construct()

	/**
	 * Includes the api post creator template
	 *
	 * @hooked 		api-post-creator-loop-content 		10
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function content_api_post_title( $item, $meta ) {

		include api_post_creator_get_template( 'api-post-title' );

	} // content_api_post_title()


	/**
	 * Includes the single job post content
	 *
	 * @hooked 		api-post-creator-single-content 	15
	 */
	public function single_api_post_content() {

		include api_post_creator_get_template( 'single-api-post-content' );

	} // single_post_content()

		/**
	 * Includes the link start template file
	 *
	 * @hooked 		api_post-before-loop-content 		15
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function content_link_start( $item, $meta ) {
		include api_post_creator_get_template( 'api-post-content-link-start' );
	} // content_link_start()


	/**
	 * Includes the single api post title
	 *
	 * @hooked 		api-post-creator-single-content 		10
	 */
	public function single_api_post_title() {

		include api_post_creator_get_template( 'single-api-post-title' );

	} // single_post_title()

	
	/**
	 * Returns a reference to this class. Used for removing
	 * actions and/or filters declared using an object of this class.
	 *
	 * @see  	http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins/
	 * @return 	object 		This class
	 */
	static function this() {

		return self::$_this;

	} // this()

} // class