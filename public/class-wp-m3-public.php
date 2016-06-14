<?php

use Firebase\JWT\JWT;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_M3
 * @subpackage Wp_M3/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_M3
 * @subpackage Wp_M3/public
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_M3_Public {

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
	 * The option prefix.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $option_prefix    The option prefix.
	 */
	private $option_prefix = 'wp_m3';

	/**
	 * The api key.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $api_key    The current api key.
	 */
	private $api_key;

	/**
	 * The program id.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $program_id    The current program id.
	 */
	private $program_id;

	/**
	 * The m3_base_url.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $m3_base_url    The current m3_base_url.
	 */
	private $m3_base_url;

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
		$this->api_key = get_option( $this->option_prefix . '_api_key' );
		$this->program_id = get_option( $this->option_prefix . '_program_id' );
		$this->m3_base_url = get_option( $this->option_prefix . '_m3_base_url' );

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
		 * defined in Wp_M3_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_M3_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-m3-public.css', array(), $this->version, 'all' );

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
		 * defined in Wp_M3_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_M3_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$localize_data = array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'm3BaseUrl' => $this->m3_base_url,
				'redirectAfterSubmission' =>  get_permalink(get_option($this->option_prefix . '_redirect_after_submission'))
				);

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-m3-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'wpM3', $localize_data);
		wp_enqueue_script( $this->plugin_name );
	}

	/**
	 * Callback for [M3] shortcode
	 *
	 * @since    1.0.0
	 */
	public function m3_shortcode($atts, $content = "") {		
		$src = $this->m3_base_url . '/embeddable-m3?program=' . $this->program_id; ?>
		<div class="m3-public">
			<iframe id="mindoula-m3" 
					type="text/html" 					
					frameborder="0"
					src="<?php echo $src; ?>"></iframe>
		</div>
		<?php
	}

	/**
	 * Callback for ajax function to decode jwt
	 *
	 * @since    1.0.0
	 */
	public function decode_jwt() {		
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {			
    		http_response_code(403);     		
			echo 'There was a problem with submission';
			wp_die();			
		}

		header('Content-Type: application/json');
		$api_key = get_option('wp_m3_api_key');
		$jwt = $_POST['m3_jwt'];
		$data = JWT::decode($jwt, $key, ['HS256']);
		echo json_encode($data);
		wp_die();
	}

	/**
	 * Callback for ajax function to encode jwt
	 *
	 * @since    1.0.0
	 */
	public function encode_jwt() {

	}
}
