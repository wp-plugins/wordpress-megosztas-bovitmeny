<?php

/* WordPress verzió ellenőrzés */
function kwm_wp_verzio_ellenorzes() {
	global $wp_version;
	$plugin = plugin_basename( __FILE__ );
	$plugin_data = get_plugin_data( __FILE__, false );
	$require_wp = "3.5";
 
	if ( version_compare( $wp_version, $require_wp, "<" ) ) {
		if( is_plugin_active($plugin) ) {
			deactivate_plugins( $plugin );
			wp_die( "A <strong>".$plugin_data['Name']."</strong> bővítmény használatához legalább a <strong>WordPress ".$require_wp."</strong> verzióját javasolt telepíteni. Javasolt frissíteni a <strong>WordPresst a ".$require_wp."</strong> verzióra. A ".$plugin_data['Name']." bővítmény kikapcsolásra kerül amíg meg nem történik a frissítés. Frissítés után visszakapcsolható. <br /><br />Vissza a <a href='".get_admin_url(null, 'plugins.php')."'>Bővítmények</a> oldalra." );
		}
	}
}
add_action( 'admin_init', 'kwm_wp_verzio_ellenorzes' );
