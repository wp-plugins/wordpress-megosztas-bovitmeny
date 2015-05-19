<?php
/* ADMINISZTRÁCIÓS FELÜLET - FEJLESZTÉS ALATT */

add_action('admin_init', 'kwm_admin_init' );
add_action('admin_menu', 'kwm_admin_oldal_hozzaadas');

// Beállítások regisztrálása az admin_init funkciók közé
function kwm_admin_init(){
	register_setting( 'kwm_beallitas_mezok', 'kwm_beallitasok', 'kwm_beallitasok_ervenyesites' );
}

// Oldal hozzáadása a Beállítások almenühöz
function kwm_admin_oldal_hozzaadas() {
	add_options_page('WP Megosztás beállítások', 'WP Megosztás', 'manage_options', 'kwm_admin', 'kwm_admin_oldal');
}

// Adminisztrációs felület
function kwm_admin_oldal() {
	?>
	<div class="wrap">
	<?php screen_icon(); ?>
	<h2>WP Megosztás beállítások | <a href="#segedlet">Segédlet / Használati útmutató</a></h2>
<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<!-- Megosztás gomb felirat beállítások -->
<div id="post-body-content">
<div class="meta-box-sortables ui-sortable">
<div class="postbox">
<div class="inside">
<table class="widefat" cellspacing="0">
<thead><tr><th class="row-title">Gomb szöveg beállítások</th><th></th></tr></thead>
<tbody>

		<form name="form" method="post" action="options.php">
			<?php settings_fields('kwm_beallitas_mezok'); ?>
			<?php $options = get_option('kwm_beallitasok'); ?>
				
				<tr valign="top">
                                <td scope="row">
				<dd>Megosztás szöveg:</dd>
				<dd><input type="text" name="kwm_beallitasok[msz_felirat]" placeholder="Megosztás" value="<?php echo $options['msz_felirat']; ?>" /></dd></td>
				
				
				<td><dd>Facebook szöveg:</dd>
				<dd><input type="text" name="kwm_beallitasok[fb_felirat]" placeholder="Megosztom a facebookon" value="<?php echo $options['fb_felirat']; ?>" /> </dd></td>
				</tr>
				
				<tr valign="top">
                                <td scope="row">
				<dd>Twitter szöveg:</dd>
				<dd><input type="text" name="kwm_beallitasok[tw_felirat]" placeholder="Megosztom a twitteren" value="<?php echo $options['tw_felirat']; ?>" /> </dd></td>
				
				<td><dd>Linkedin szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[linkedin_felirat]" placeholder="Megosztom a Linkedinen" value="<?php echo $options['linkedin_felirat']; ?>" /> </dd></td>
                                </tr>
                                
                                <tr valign="top">
                                <td scope="row">
                                <dd>Startlap szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[slap_felirat]" placeholder="Megosztom a startlapon" value="<?php echo $options['slap_felirat']; ?>" /> </dd></td>

                                <td><dd>Tumblr szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[tumblr_felirat]" placeholder="Megosztom a tumblren" value="<?php echo $options['tumblr_felirat']; ?>" /></dd></td>
                                
                                <tr valign="top">
                                <td scope="row">
                                <dd>Google+ szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[gplusz_felirat]" placeholder="Megosztom a google plusszon" value="<?php echo $options['gplusz_felirat']; ?>" /></dd></td>
                              
                                <td><dd>RSS hírcsatorna szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[rss_felirat]" placeholder="Felíratkozok az rss hírcsatornára" value="<?php echo $options['rss_felirat']; ?>" /></dd></td>
                                </tr>
                                
                                <tr valign="top">
                                <td scope="row">
                                <dd>Email szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[email_felirat]" placeholder="Elküldöm e-mailben" value="<?php echo $options['email_felirat']; ?>" /></dd></td>
                                
                                <td><dd>Nyomtatás szöveg:</dd>
                                <dd><input type="text" name="kwm_beallitasok[nyomtat_felirat]" placeholder="Nyomtatás" value="<?php echo $options['nyomtat_felirat']; ?>" /></dd></td>
                                </tr>
				
				<tr valign="top">
                                <td scope="row">
			        <dd><p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p></dd></td>
			        </tr>
		</form>

</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- /Megosztás gomb felirat beállítások -->

<!-- Oldalsáv -->
<?php require_once('oldalsav.php'); ?>
<!-- /Oldalsáv -->

<!-- Segédlet / Használati útmutató -->
<div id="post-body-content">
<div class="meta-box-sortables ui-sortable">
<div class="postbox">
<div class="inside">
<table class="widefat" cellspacing="0">
<thead><tr><th class="row-title"><a name="segedlet">Segédlet / Használati útmutató</a></th><th></th></tr></thead>
<tbody>
<?php require_once('segedlet.php'); ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- /Segédlet / Használati útmutató -->
</div>
</div>
<?php }

// Beállítások érvényesítése
function kwm_beallitasok_ervenyesites($input) {

	/* SZÖVEGEK ÉRVÉNYESÍTÉSE */
	// Megosztás szöveg felirat
	$input['msz_felirat'] =     wp_filter_nohtml_kses($input['msz_felirat']);
	// Facebook felirat
	$input['fb_felirat'] =      wp_filter_nohtml_kses($input['fb_felirat']);
	// Twitter felirat
	$input['tw_felirat'] =      wp_filter_nohtml_kses($input['tw_felirat']);
	// Linkedin felirat
	$input['linkedin_felirat'] = wp_filter_nohtml_kses($input['linkedin_felirat']);
	// Startlap felirat
	$input['slap_felirat'] =    wp_filter_nohtml_kses($input['slap_felirat']);
	// Tumblr felirat
	$input['tumblr_felirat'] =  wp_filter_nohtml_kses($input['tumblr_felirat']);
	// Google+ felirat
	$input['gplusz_felirat'] =  wp_filter_nohtml_kses($input['gplusz_felirat']);
	// Rss hírcsatorna felirat
	$input['rss_felirat'] =     wp_filter_nohtml_kses($input['rss_felirat']);
	// Email felirat
	$input['email_felirat'] =   wp_filter_nohtml_kses($input['email_felirat']);
	
	return $input;
}
