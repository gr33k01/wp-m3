<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_M3
 * @subpackage Wp_M3/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap wp-m3-settings">
    <h2><span class="dashicons dashicons-analytics"></span> <?php echo esc_html( get_admin_page_title() ); ?></h2>
    Place this shortcode on any page to display the M3 iframe: <pre>[m3]</pre>

    <form action="options.php" method="post">    
<?php       
settings_fields( $this->plugin_name );
do_settings_sections( $this->plugin_name );            
submit_button(); ?>
    </form>
</div>