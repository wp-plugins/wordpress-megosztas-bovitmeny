<?php
/*
Plugin Name: WP Megosztás
Plugin URI: http://www.wordpress.org/extend/plugins/wordpress-megosztas-bovitmeny/
Description: Ezzel a bővítménnyel számos látogatót szerezhetünk weboldalunkra a Magyar és külföldi közösségi oldalak segítségével.
Version: 2.3
Author: Laszlo Espadas - KardiWeb
Author URI: http://kardiweb.github.io/
License: GNU/GPL v3
Tags: facebook, twitter, linkedin, tumblr, startlap, tumblr, google plus, google+, g+, rss, email, print
*/

/** A 3 lehetőség közül válasszunk egyet és használjuk azt.
 *  Kikapcsolás példa: //add_filter('the_content', 'kwm_megosztas');
 *  Shortcode (rövidkód) használathoz helyezzük el a bejegyzésben:
 *  [KWM_MEGOSZTAS]  
 * */
/* Teljes bejegyzésnél való megjelenés */
add_filter('the_content', 'kwm_megosztas');

/* Bemutató bejegyzésnél való megjelenés */
add_filter('the_excerpt', 'kwm_megosztas');

/* Shortcode (rövidkód) használata. */
add_shortcode("KWM_MEGOSZTAS", "kwm_megosztas");

/* -------------------------------------------------------------------------- */

/* BŐVÍTMÉNY ÚTVONAL */
define( 'KWM_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

// Stílus hozzáadása a wp_head() funkcióhoz
add_filter('wp_head', 'kwm_css');
function kwm_css(){
	echo '<link id="WordPress Megosztás Bővítmény" rel="stylesheet" type="text/css" href="' . KWM_PLUGIN_DIR . '/css/stilus.css" />',"\r\n";
}
// Nyomtatás hozzáadása a wp_head() funkcióhoz 
add_filter('wp_head', 'kwm_nyomtatas');
function kwm_nyomtatas(){
        $options = get_option('kwm_nyomtat_css_beallitasok'); 
echo '<script>var pfHeaderImgUrl = \'\';var pfHeaderTagline = \'\';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = \'right\';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = \'\';var pfBtVersion=\'1\';(function(){var js, pf;pf = document.createElement(\'script\');pf.type = \'text/javascript\';if(\'https:\' == document.location.protocol){js=\'https://pf-cdn.printfriendly.com/ssl/main.js\'}else{js=\'http://cdn.printfriendly.com/printfriendly.js\'}pf.src=js;document.getElementsByTagName(\'head\')[0].appendChild(pf)})();</script>',"\n\r";
}
/*kwm_megosztas funkció - ez a rész íratja ki a megosztás gombokat és a gombok szövegeit */
function kwm_megosztas( $content ) {
	global $post;
	$bejegyzes_link  = get_permalink($post->ID);
	$bejegyzes_nev   = get_the_title($post->ID);
        $blog_neve       = get_bloginfo("name");
        $blog_url        = get_bloginfo("url");
        $rss_url         = get_bloginfo("rss2_url");
        $options 	 = get_option("kwm_beallitasok");
        $html = '<span>'.$options['msz_felirat'].'</span><br>';
  // Facebook
	$html .= '<a target="_blank" class="facebook" title="'.$options['fb_felirat'].'" rel="external" href="https://www.facebook.com/share.php?u=' . $bejegyzes_link . '&title='.$bejegyzes_nev.'"></a>';
  // Twitter
	$html .= '<a target="_blank" class="twitter" title="'.$options['tw_felirat'].'" rel="external" href="https://twitter.com/home?status='.$bejegyzes_nev.'+'.$bejegyzes_link.'"></a>';
  // Linkedin
	$html .= '<a target="_blank" class="linkedin" title="'.$options['linkedin_felirat'].'" rel="external" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'&amp;summary='.urlencode(get_the_content()).'&amp;source='.urlencode(get_bloginfo('name')).'"></a>';  
  // Startlap
	$html .= '<a target="_blank" class="startlap" title="'.$options['slap_felirat'].'" rel="external" href="http://www.startlap.hu/sajat_linkek/addlink.php?url='.$bejegyzes_link.'"></a>';
  // Tumblr
	$html .= '<a target="_blank" class="tumblr" title="'.$options['tumblr_felirat'].'" rel="external" href="http://www.tumblr.com/share/link?url='.urlencode(get_permalink()).'&name='.urlencode(get_the_title()).'&description='.urlencode(get_the_content()).'"></a>';
  // Google plusz
	$html .= '<a target="_blank" class="gplusz" title="'.$options['gplusz_felirat'].'" rel="external" href="https://plusone.google.com/_/+1/confirm?url=' . $bejegyzes_link . '"></a>';
  // RSS Hírcsatorna
        $html .= '<a class="rss" title="'.$options['rss_felirat'].'" href="'.$rss_url.'"></a>';
  // E-mail
        $html .= '<a target="_blank" rel="nofollow" class="email" href="mailto:?subject='.$blog_neve.' - '.$bejegyzes_nev.'&amp;body=Kedves Barátom! Most olvastam a(z) ' . $bejegyzes_nev . '  című cikket a(z) ' . $blog_neve . '  oldalon. Hivatkozás:  '. $bejegyzes_link.'" title="'.$options['email_felirat'].'"></a>';
  // Nyomtatás 
        $html .= '<a class="nyomtatas" title="'.$options['nyomtat_felirat'].'" href="http://www.printfriendly.com" onclick="window.print();return false;"></a>';
  		return $content .$html;
}

// Információ link hozzáadása a bővítmények oldalhoz
function kwm_info_link($links) { 
  $info_link = '<a href="options-general.php?page=kwm_admin">Beállítások</a>'; 
  array_unshift($links, $info_link); 
  return $links; 
}
$bovitmeny = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$bovitmeny", 'kwm_info_link' );

// Tumblr javascript hozzáadása a wp_footer() funkcióhoz
add_filter('wp_footer', 'kwm_tumblr_js');
function kwm_tumblr_js(){
	echo '<script type="text/javascript" src="http://platform.tumblr.com/v1/share.js"></script>',"\r\n";
}

/* Adminisztrációs felület betőltése */
require_once( 'admin/admin.php' );

/* WordPress verzió ellenőrzés */
require_once( 'admin/verzio.php' );
