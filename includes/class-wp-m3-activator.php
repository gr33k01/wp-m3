<?php

/**
 * Fired during plugin activation
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_M3
 * @subpackage Wp_M3/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_M3
 * @subpackage Wp_M3/includes
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_M3_Activator {
	const WP_M3_DB_VERSION = '1.0';

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {		
		global $wpdb;

		$table_name = $wpdb->prefix . 'wpm3_results';
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE $table_name (
		  id bigint(20) NOT NULL AUTO_INCREMENT,
		  user_id bigint(20) unsigned NOT NULL default 0,
		  timestamp datetime NOT NULL,		  
		  total_score mediumint NOT NULL,
		  details text, 
		  thoughts_of_suicide bit NOT NULL default 0,
		  drug_use bit NOT NULL default 0,
		  PRIMARY KEY id (id),
		  KEY user_id (user_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		add_option( 'wp_m3_db_version', self::WP_M3_DB_VERSION );

	}

}
