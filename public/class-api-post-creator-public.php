<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://theyoricktouch.com
 * @since      1.0.0
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Api_Post_Creator
 * @subpackage Api_Post_Creator/public
 * @author     Yorick Brown <info@theyoricktouch.com>
 */
class Api_Post_Creator_Public {

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
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/api-post-creator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/api-post-creator-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	* Returns a post object of api posts
	* @param array $params An array of optional parameters
	* quantity number of posts to return
	*
	* @return object A post object
	*/
	
	public function get_api_posts($params) {
		$return = '';
		$args = array(
			'post_type' => 'api-post',
			'posts_per_page' => $params,
			'orderby' => 'rand'
		);
	
		$query = new WP_Query( $args );
	
		if ( is_wp_error( $query ) ) {
			$return = 'Oops! No posts coming up!';
		} else {
			$return = $query->posts;
		}
	
		return $return;
	} // get_api_posts()

	/**
	* Registers all shortcodes at once
	*
	* @return [type] [description]
	*/
	
	public function register_shortcodes() {
		add_shortcode( 'apipost', array( $this, 'list_posts' ) );
	} // register_shortcodes()

	
	/**
	 * Adds a default single view template for a api post
	 *
	 * @param 	string 		$template 		The name of the template
	 * @return 	mixed 						The single template
	 */

	public function single_cpt_template( $template ) {
		
				global $post;
		
				$return = $template;
		
				if ( $post->post_type == 'api-post' ) {
					
					$return = api_post_creator_get_template( 'single-api-post' );
		
				}
		
				return $return;
		
			} // single_cpt_template()



	/**
	* Processes shortcode apipost
	*
	* @param array $atts The attributes from the shortcode
	*
	*
	* @return mixed $output Output of the buffer
	*/
	
	public function list_posts( $atts = array() ) {
		ob_start();
	
		$args = shortcode_atts( array(
			'num-posts' => 5,
			'posts-title' => 'Artist gigs',),
			$atts
		);
	
		$items = $this->get_api_posts($args['num-posts']);
		//var_dump($items);

		if ( is_array( $items ) || is_object( $items ) ) {
			include ('partials/api-post-creator-public-display.php');
		}
	
		$output = ob_get_contents();
		ob_end_clean();
	
		return $output;
	
	} // list_posts()
}
