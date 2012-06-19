<?php
/*
Plugin Name: WP Megosztás
Plugin URI: http://www.wordpress.org/extend/plugins/wordpress-megosztas-bovitmeny/
Description: Ezzel a kiegészítővel számos látogatót szerezhetünk weboldalunkra. Egyszerűen helyezhetjük el a magyar és angol social network ikonokat (Facebook, Twitter, Iwiw, Startlap, Citromail, Tumblr, Google plus, So.cl, E-mail) bejegyzéseink végén, hogy tartalmainkat a felhasználok megosztassák a legnagyobb legnépszerűbb közösségi oldalakon. Így mások is értesülhetnek az értékes cikkeinkről. Bekapcsolás után azonnal működik! Semmilyen beállítást nem igényel!
Version: 1.5.2
Author: KardiWeb
Author URI: http://www.kardiweb.org/
License: GNU/GPL v2
*/

/** A 3 lehetőség közül válasszunk egyet és használjuk azt.
 *  Kikapcsolás példa: //add_filter('the_content', 'kw_megosztas');
 *  Shortcode (rövidkód) használathoz helyezzük el a bejegyzésben:
 *  [KW_MEGOSZTAS]  
 * */
/* Teljes bejegyzésnél való megjelenés */
add_filter('the_content', 'kw_megosztas');

/* Bemutató bejegyzésnél való megjelenés */
add_filter('the_excerpt', 'kw_megosztas');

/* Shortcode (rövidkód) használata. */
add_shortcode("KW_MEGOSZTAS", "kw_megosztas");

/* -------------------------------------------------------------------------- */

/* A Nyelv fejlesztés alatt áll! */
// Nyelvi fájlok betőltése
load_plugin_textdomain( 'wordpress-megosztas-bovitmeny', false, dirname( plugin_basename( __FILE__ ) ) . '/nyelv/' );

// Stílus hozzáadása a wp_header() funkcióhoz
add_filter('wp_head', 'kw_megosztas_css');
function kw_megosztas_css(){
	echo '<link id="'._("KardiWeb Megosztas Bővítmeny").'" rel="stylesheet" type="text/css" href="' . get_settings('siteurl') .'/wp-content/plugins/wordpress-megosztas-bovitmeny/css/stilus.css" />';
}

function kw_megosztas( $content ) {
	global $post;
	$bejegyzes_link  = get_permalink($post->ID);
	$bejegyzes_nev   = get_the_title($post->ID);
  $blog_neve       = get_bloginfo("name");
  $html = '<div class="megosztas">';
  $html .= "<span>". _("Tesztett a bejegyzés? Ossza meg másokkal is!"."</span><br>");
  // Facebook
	$html .= '<a target="_blank" class="facebook" title="'._("Megosztom a facebookon").'" rel="external" href="http://www.facebook.com/share.php?u=' . $bejegyzes_link . '"></a>';
  // Twitter
	$html .= '<a target="_blank" class="twitter" title="'._("Megosztom a twitteren").'" rel="external" href="http://twitter.com/share?text='.$bejegyzes_nev.'&url='.$bejegyzes_link.'"></a>';
  // IWIW
	$html .= '<a target="_blank" class="iwiw" title="'._("Megosztom az iwiwen").'" rel="external" href="http://iwiw.hu/pages/share/share.jsp?u='.$bejegyzes_link.'"></a>';  
  // Startlap
	$html .= '<a target="_blank" class="startlap" title="'._("Megosztom a startlapon").'" rel="external" href="http://www.startlap.hu/sajat_linkek/addlink.php?url='.$bejegyzes_link.'"></a>';
  // Citromail
	$html .= '<a target="_blank" class="citromail" title="'._("Megosztom a citromailen").'" rel="external" href="http://citromail.hu/share/?url='.$bejegyzes_link.'"></a>';
  // Tumblr
	$html .= '<a target="_blank" class="tumblr" title="'._("Megosztom a tumblren").'" rel="external" href="http://www.tumblr.com/share/link?url='.urlencode(get_permalink()).'&name='.urlencode(get_the_title()).'&description='.urlencode(get_the_content()).'"></a>';
  // Google plusz
	$html .= '<a target="_blank" class="gplusz" title="'._("Megosztom a Google pluszon").'" rel="external" href="https://plusone.google.com/_/+1/confirm?url=' . $bejegyzes_link . '"></a>';
	  // So.cl
  $html .= '<a target="_blank" class="socl" title="'._("Megosztom a So.cl -en").'" rel="extrenal" href="http://www.so.cl/#/search?v=results&bk=1.0&q='.$bejegyzes_link.'"></a>';
  // E-mail
  $html .= '<a target="_blank" class="email" href="mailto:?subject='.$bejegyzes_nev.'&amp;body='._("Kedves Barátom! Most Olvastam a(z) ") . $bejegyzes_nev . _(" című cikket a(z) ") . $blog_neve ._(" oldalon. Link: "). $bejegyzes_link.'" title="'._("Elküldöm E-mailben").'"></a>';
  $html .= "</div><br>";

		return $content . $html;
	}

// Információ link hozzáadása a bővítmények oldalhoz
function kw_megosztas_info_link($links) { 
  $info_link = '<a href="options-general.php?page=megosztas-admin">Információk</a>'; 
  array_unshift($links, $info_link); 
  return $links; 
}
$bovitmeny = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$bovitmeny", 'kw_megosztas_info_link' );

// Tumblr javascript hozzáadása a wp_footer() funkcióhoz
add_filter('wp_footer', 'kw_tumblr_js');
function kw_tumblr_js(){
	echo '<script type="text/javascript" src="http://platform.tumblr.com/v1/share.js"></script>';
}

/* Adminisztráció betőltése */
require_once( 'admin/admin.php' );