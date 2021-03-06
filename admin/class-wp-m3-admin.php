<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_M3
 * @subpackage Wp_M3/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_M3
 * @subpackage Wp_M3/admin
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_M3_Admin {

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
	 * The option prefix
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $option_prefix    The option prefix
	 */
	private $option_prefix = 'wp_m3';

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
		 * defined in Wp_M3_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_M3_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-m3-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wp_M3_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_M3_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-m3-admin.js', array( 'jquery' ), $this->version, false );	
	}

	/**
	 * Registers the settings
	 *
	 * @since    1.0.0
	 */	
	public function display_admin_page() {
		add_menu_page(
			'Mindoula M3',
			'M3',
			'manage_options',
			'wp_m3_admin',
			array( $this, 'show_page' ),
			'dashicons-analytics',
			'50.0'
			);
	}

	/**
	 * Display the admin page
	 *
	 * @since    1.0.0
	 */
	public function show_page() {
		include __DIR__ . '/partials/wp-m3-admin-display.php';
	}

	/**
	 * Registers the settings
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {
		// Adds a general section
		add_settings_section(
			$this->option_prefix . '_general',
			'General Settings',
			array( $this, $this->option_prefix . '_general_cb' ),
			$this->plugin_name
			);

		
		// Adds redirect_after_submission field
		add_settings_field(
			$this->option_prefix . '_api_key',
			'M3 API Key',
			array( $this, $this->option_prefix . '_api_key_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_general',
			array( 'label_for' => $this->option_prefix . '_api_key' )
			);

		// Adds redirect_after_submission field
		register_setting( $this->plugin_name, $this->option_prefix . '_api_key', array( $this, $this->option_prefix . '_sanitize_api_key' ) );

		// Adds _program_id field
		add_settings_field(
			$this->option_prefix . '_program_id',
			'M3 Program ID',
			array( $this, $this->option_prefix . '_program_id_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_general',
			array( 'label_for' => $this->option_prefix . '_program_id' )
			);

		// Adds _program_id field
		register_setting( $this->plugin_name, $this->option_prefix . '_program_id', array( $this, $this->option_prefix . '_sanitize_program_id' ) );

		// Adds _m3_base_url field
		add_settings_field(
			$this->option_prefix . '_m3_base_url',
			'M3 Base Url',
			array( $this, $this->option_prefix . '_m3_base_url_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_general',
			array( 'label_for' => $this->option_prefix . '_m3_base_url' )
			);

		// Adds _m3_base_url field
		register_setting( $this->plugin_name, $this->option_prefix . '_m3_base_url', array( $this, $this->option_prefix . '_sanitize_m3_base_url' ) );

		// Adds redirect_after_submission field
		add_settings_field(
			$this->option_prefix . '_redirect_after_submission',
			'Redirect After Submission',
			array( $this, $this->option_prefix . '_redirect_after_submission_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_general',
			array( 'label_for' => $this->option_prefix . '_redirect_after_submission' )
			);

		// Adds redirect_after_submission field
		register_setting( $this->plugin_name, $this->option_prefix . '_redirect_after_submission', array( $this, $this->option_prefix . '_sanitize_redirect_after_submission' ) );

	}

	public function wp_m3_general_cb() {
		echo '<hr />';
	}

	public function wp_m3_redirect_after_submission_cb() {
		$f_id = $this->option_prefix . '_redirect_after_submission';		
		$value = get_option($f_id);
		$pages = get_pages();		
	?>
		<div class="input-group">			
			<select name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"  value="<?php echo $value; ?>">
				<option>Select a Page</option>
			<?php foreach($pages as $page) : ?>
				<option value="<?php echo $page->ID; ?>" 
						<?php if($value == $page->ID) echo 'selected="selected"'; ?>>
						<?php echo $page->post_title; ?>
				</option>
			<?php endforeach; ?>
			</select>
			<em>Page to redirect to on submission.</em>
		</div>
	<?php
	}

	public function wp_m3_sanitize_redirect_after_submission($value) {
		return $value;
	}

	public function wp_m3_api_key_cb() {
		$f_id = $this->option_prefix . '_api_key';		
		$value = get_option($f_id);
	?>
		<div class="input-group">
			<input type="text" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"  value="<?php echo $value; ?>"/>
			<em>M3 API Key</em>
		</div>
	<?php
	}

	public function wp_m3_sanitize_api_key($value) {
		return $value;
	}

	public function wp_m3_program_id_cb() {
		$f_id = $this->option_prefix . '_program_id';		
		$value = get_option($f_id);
	?>
		<div class="input-group">
			<input type="text" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"  value="<?php echo $value; ?>"/>
			<em>M3 Program ID</em>
		</div>
	<?php
	}

	public function wp_m3_sanitize_program_id($value) {
		return $value;
	}


	public function wp_m3_m3_base_url_cb() {
		$f_id = $this->option_prefix . '_m3_base_url';		
		$value = get_option($f_id);
	?>
		<div class="input-group">	
			<select name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"  value="<?php echo $value; ?>">
				<option value="https://mindoula.com" <?php if($value == 'https://mindoula.com') echo 'selected="selected"'; ?>>Production (https://mindoula.com)</option>
				<option value="https://www.mindoula-staging.com" <?php if($value == 'https://www.mindoula-staging.com') echo 'selected="selected"'; ?>>Staging (https://www.mindoula-staging.com)</option>
			</select>
			<em>Base url for M3</em>
		</div>
	<?php
	}

	public function wp_m3_sanitize_m3_base_url($value) {
		return $value;
	}


	public function download_data() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpm3_results';
		$rows = $wpdb->get_results( 'SELECT * FROM ' . $table_name ); 		
		$objPHPExcel = new PHPExcel();		
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', 'Result ID')
		            ->setCellValue('B1', 'User Name')
		            ->setCellValue('C1', 'User Email')
		            ->setCellValue('D1', 'Total Score')
		            ->setCellValue('E1', 'Thoughts of Suicide')
		            ->setCellValue('F1', 'Drug Use')
		            ->setCellValue('G1', 'Depression')
		            ->setCellValue('H1', 'Anxiety')
		            ->setCellValue('I1', 'PTSD')
		            ->setCellValue('J1', 'Bipolar')
		            ->setCellValue('K1', 'Timestamp');

		foreach($rows as $index => $row) {				
			$i = $index + 2;
			$u = get_user_by('id', $row->user_id);
			$details = unserialize($row->details);
			$d_arr = [];

			foreach($details as $d) {
				$d_arr[strtolower($d->name)] = $d->score;
			}

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A' . strval($i), $row->id)
			            ->setCellValue('B' . strval($i), $u->name . ' (' . $u->ID . ')')
			            ->setCellValue('C' . strval($i), $u->user_email)
			            ->setCellValue('D' . strval($i), $row->total_score)
			            ->setCellValue('E' . strval($i), $row->thoughts_of_suicide == '1' ? 'Yes' : 'No')
			            ->setCellValue('F' . strval($i), $row->drug_use == '1' ? 'Yes' : 'No')
			            ->setCellValue('G' . strval($i), $d_arr['depression'])
			            ->setCellValue('H' . strval($i), $d_arr['anxiety'])
			            ->setCellValue('I' . strval($i), $d_arr['ptsd'])
			            ->setCellValue('J' . strval($i), $d_arr['bipolar'])
			            ->setCellValue('K' . strval($i), date('m-d-Y H:i:s', strtotime($row->timestamp)));

		}
		$title = 'WP-M3-Download-' . date('m-d-Y');
		$objPHPExcel->getActiveSheet()->setTitle($title);
		$objPHPExcel->setActiveSheetIndex(0);
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $title .'.xlsx"');
		header('Cache-Control: max-age=0');		
		header('Cache-Control: max-age=1');		
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Cache-Control: cache, must-revalidate');
		header ('Pragma: public');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
}
