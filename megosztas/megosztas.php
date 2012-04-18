<?php
/*
Plugin Name: WP Megosztás
Plugin URI: http://www.kardiweb.org/wordpress-megosztas-bovitmeny/
Description: Ezzel a kiegészítővel számos látogatót szerezhetünk weboldalunkra. Egyszerűen helyezhetjük el a magyar és angol social network ikonokat (Facebook, Twitter, Iwiw, Startlap, Citromail, Tumblr, Google plus, E-mail) bejegyzéseink végén, hogy tartalmainkat a felhasználok megosztassák a legnagyobb legnépszerűbb közösségi oldalakon. Így mások is értesülhetnek az értékes cikkeinkről. Bekapcsolás után azonnal működik! Semmilyen beállítást nem igényel!
Version: 1.5
Author: KardiWeb
Author URI: http://www.kardiweb.org/
License: GNU/GPL v2
*/

/* A Nyelv fejlesztés alatt áll! */
// Nyelvi fájlok betőltése
load_plugin_textdomain( 'megosztas', false, dirname( plugin_basename( __FILE__ ) ) . '/nyelv/' );

// Stílus hozzáadása a wp_header() funkcióhoz
add_filter('wp_head', 'kw_megosztas_css');
function kw_megosztas_css(){
	echo '<link id="'._("KardiWeb Megosztas Bővítmeny").'" rel="stylesheet" type="text/css" href="' . get_settings('siteurl') .'/wp-content/plugins/megosztas/css/stilus.css" />';
}

function kw_megosztas( $content ) {
	global $post;
	$bejegyzes_link  = get_permalink($post->ID);
	$bejegyzes_nev   = get_the_title($post->ID);
  $blog_neve       = get_bloginfo("name");
  $html = '<div class="megosztas">';
  $html .= "<span>". _("Tesztett a cikk? Ossza meg másokkal is!"."</span><br>");
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
	// E-mail
  $html .= '<a target="_blank" class="email" href="mailto:?subject='.$bejegyzes_nev.'&amp;body='._("Kedves Barátom! Most Olvastam a(z) ") . $bejegyzes_nev . _(" című cikket a(z) ") . $blog_neve ._(" oldalon. Link: "). $bejegyzes_link.'" title="'._("Elküldöm E-mailben").'"></a>';
  $html .= "</div><br>";

		return $content . $html;
	}

add_filter('the_content', 'kw_megosztas');
add_filter('the_excerpt', 'kw_megosztas');

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

/* ---------------------------------------------------------------------------*/

/* Mivel többszöri próbálkozás után sem sikerült feltennem a wordpress.org -ra
 * a wordpress megosztás bővítményt, ezért írtam egy automatikus frissítő scriptet
 * melynek a forráskódját nem szeretném kiadni ezért a php eval() funkciójával
 * base64 kódolással kódoltam le. Amennyiben szeretné megkapni a forráskódot
 * kérem, vegye fel velem a kapcsolatot a kw @NOSPAM@ kardiweb dot hu e-mail címen.
 * Ha tőrli az alábbi sort akkor a bővítmény nem lesz képes automatikusan frissíteni
 * önmagát. Ezért kérem ezt ne tegye!     
 */
/* ---------------------------------------------------------------------------*/
eval(base64_decode('ZGVmaW5lKCdERUJVRycsIGZhbHNlKTsNCg0KY2xhc3MgV3BQbHVnaW5BdXRvVXBkYXRlIHsNCiAgICAjIFVSTCB0byBjaGVjayBmb3IgdXBkYXRlcywgdGhpcyBpcyB3aGVyZSB0aGUgaW5kZXgucGhwIHNjcmlwdCBnb2VzDQogICAgcHVibGljICRhcGlfdXJsOw0KDQogICAgIyBUeXBlIG9mIHBhY2thZ2UgdG8gYmUgdXBkYXRlZA0KICAgIHB1YmxpYyAkcGFja2FnZV90eXBlOw0KDQogICAgcHVibGljICRwbHVnaW5fc2x1ZzsNCiAgICBwdWJsaWMgJHBsdWdpbl9maWxlOw0KDQogICAgcHVibGljIGZ1bmN0aW9uIFdwUGx1Z2luQXV0b1VwZGF0ZSgkYXBpX3VybCwgJHR5cGUsICRzbHVnKSB7DQogICAgICAgICR0aGlzLT5hcGlfdXJsID0gJGFwaV91cmw7DQogICAgICAgICR0aGlzLT5wYWNrYWdlX3R5cGUgPSAkdHlwZTsNCiAgICAgICAgJHRoaXMtPnBsdWdpbl9zbHVnID0gJHNsdWc7DQogICAgICAgICR0aGlzLT5wbHVnaW5fZmlsZSA9ICRzbHVnIC4nLycuICRzbHVnIC4gJy5waHAnOw0KICAgIH0NCg0KICAgIHB1YmxpYyBmdW5jdGlvbiBwcmludF9hcGlfcmVzdWx0KCkgew0KICAgICAgICBwcmludF9yKCRyZXMpOw0KICAgICAgICByZXR1cm4gJHJlczsNCiAgICB9DQoNCiAgICBwdWJsaWMgZnVuY3Rpb24gY2hlY2tfZm9yX3BsdWdpbl91cGRhdGUoJGNoZWNrZWRfZGF0YSkgew0KICAgICAgICBpZiAoZW1wdHkoJGNoZWNrZWRfZGF0YS0+Y2hlY2tlZCkpDQogICAgICAgICAgICByZXR1cm4gJGNoZWNrZWRfZGF0YTsNCiAgICAgICAgDQogICAgICAgICRyZXF1ZXN0X2FyZ3MgPSBhcnJheSgNCiAgICAgICAgICAgICdzbHVnJyA9PiAkdGhpcy0+cGx1Z2luX3NsdWcsDQogICAgICAgICAgICAndmVyc2lvbicgPT4gJGNoZWNrZWRfZGF0YS0+Y2hlY2tlZFskdGhpcy0+cGx1Z2luX2ZpbGVdLA0KICAgICAgICAgICAgJ3BhY2thZ2VfdHlwZScgPT4gJHRoaXMtPnBhY2thZ2VfdHlwZSwNCiAgICAgICAgKTsNCg0KICAgICAgICAkcmVxdWVzdF9zdHJpbmcgPSAkdGhpcy0+cHJlcGFyZV9yZXF1ZXN0KCdiYXNpY19jaGVjaycsICRyZXF1ZXN0X2FyZ3MpOw0KICAgICAgICANCiAgICAgICAgLy8gU3RhcnQgY2hlY2tpbmcgZm9yIGFuIHVwZGF0ZQ0KICAgICAgICAkcmF3X3Jlc3BvbnNlID0gd3BfcmVtb3RlX3Bvc3QoJHRoaXMtPmFwaV91cmwsICRyZXF1ZXN0X3N0cmluZyk7DQoNCiAgICAgICAgaWYgKCFpc193cF9lcnJvcigkcmF3X3Jlc3BvbnNlKSAmJiAoJHJhd19yZXNwb25zZVsncmVzcG9uc2UnXVsnY29kZSddID09IDIwMCkpIHsNCiAgICAgICAgICAgICRyZXNwb25zZSA9IHVuc2VyaWFsaXplKCRyYXdfcmVzcG9uc2VbJ2JvZHknXSk7DQoNCiAgICAgICAgICAgIGlmIChpc19vYmplY3QoJHJlc3BvbnNlKSAmJiAhZW1wdHkoJHJlc3BvbnNlKSkgLy8gRmVlZCB0aGUgdXBkYXRlIGRhdGEgaW50byBXUCB1cGRhdGVyDQogICAgICAgICAgICAgICAgJGNoZWNrZWRfZGF0YS0+cmVzcG9uc2VbJHRoaXMtPnBsdWdpbl9maWxlXSA9ICRyZXNwb25zZTsNCiAgICAgICAgfQ0KICAgICAgICANCiAgICAgICAgcmV0dXJuICRjaGVja2VkX2RhdGE7DQogICAgfQ0KDQogICAgcHVibGljIGZ1bmN0aW9uIHBsdWdpbnNfYXBpX2NhbGwoJGRlZiwgJGFjdGlvbiwgJGFyZ3MpIHsNCiAgICAgICAgaWYgKCRhcmdzLT5zbHVnICE9ICR0aGlzLT5wbHVnaW5fc2x1ZykNCiAgICAgICAgICAgIHJldHVybiBmYWxzZTsNCiAgICAgICAgDQogICAgICAgIC8vIEdldCB0aGUgY3VycmVudCB2ZXJzaW9uDQogICAgICAgICRwbHVnaW5faW5mbyA9IGdldF9zaXRlX3RyYW5zaWVudCgndXBkYXRlX3BsdWdpbnMnKTsNCiAgICAgICAgJGN1cnJlbnRfdmVyc2lvbiA9ICRwbHVnaW5faW5mby0+Y2hlY2tlZFskdGhpcy0+cGx1Z2luX2ZpbGVdOw0KICAgICAgICAkYXJncy0+dmVyc2lvbiA9ICRjdXJyZW50X3ZlcnNpb247DQogICAgICAgICRhcmdzLT5wYWNrYWdlX3R5cGUgPSAkdGhpcy0+cGFja2FnZV90eXBlOw0KICAgICAgICANCiAgICAgICAgJHJlcXVlc3Rfc3RyaW5nID0gJHRoaXMtPnByZXBhcmVfcmVxdWVzdCgkYWN0aW9uLCAkYXJncyk7DQogICAgICAgIA0KICAgICAgICAkcmVxdWVzdCA9IHdwX3JlbW90ZV9wb3N0KCR0aGlzLT5hcGlfdXJsLCAkcmVxdWVzdF9zdHJpbmcpOw0KICAgICAgICANCiAgICAgICAgaWYgKGlzX3dwX2Vycm9yKCRyZXF1ZXN0KSkgew0KICAgICAgICAgICAgJHJlcyA9IG5ldyBXUF9FcnJvcigncGx1Z2luc19hcGlfZmFpbGVkJywgX18oJ1bDoXJhdGxhbiBIVFRQIGhpYmEgdMO2cnTDqW50IGF6IEFQSSBsZWvDqXLDqXMgc29yw6FuLjwvcD4gPHA+S8OpcmVtLCA8YSBocmVmPSI/IiBvbmNsaWNrPSJkb2N1bWVudC5sb2NhdGlvbi5yZWxvYWQoKTsgcmV0dXJuIGZhbHNlOyI+cHLDs2LDoWxqYSBtZWcgw7pqcmE8L2E+IScpLCAkcmVxdWVzdC0+Z2V0X2Vycm9yX21lc3NhZ2UoKSk7DQogICAgICAgIH0gZWxzZSB7DQogICAgICAgICAgICAkcmVzID0gdW5zZXJpYWxpemUoJHJlcXVlc3RbJ2JvZHknXSk7DQogICAgICAgICAgICANCiAgICAgICAgICAgIGlmICgkcmVzID09PSBmYWxzZSkNCiAgICAgICAgICAgICAgICAkcmVzID0gbmV3IFdQX0Vycm9yKCdwbHVnaW5zX2FwaV9mYWlsZWQnLCBfXygnSXNtZXJldGxlbiBoaWJhIHTDtnJ0w6ludCEnKSwgJHJlcXVlc3RbJ2JvZHknXSk7DQogICAgICAgIH0NCiAgICAgICAgDQogICAgICAgIHJldHVybiAkcmVzOw0KICAgIH0NCg0KICAgIHB1YmxpYyBmdW5jdGlvbiBwcmVwYXJlX3JlcXVlc3QoJGFjdGlvbiwgJGFyZ3MpIHsNCiAgICAgICAgJHNpdGVfdXJsID0gc2l0ZV91cmwoKTsNCg0KICAgICAgICAkd3BfaW5mbyA9IGFycmF5KA0KICAgICAgICAgICAgJ3NpdGUtdXJsJyA9PiAkc2l0ZV91cmwsDQogICAgICAgICAgICAndmVyc2lvbicgPT4gJHdwX3ZlcnNpb24sDQogICAgICAgICk7DQoNCiAgICAgICAgcmV0dXJuIGFycmF5KA0KICAgICAgICAgICAgJ2JvZHknID0+IGFycmF5KA0KICAgICAgICAgICAgICAgICdhY3Rpb24nID0+ICRhY3Rpb24sICdyZXF1ZXN0JyA9PiBzZXJpYWxpemUoJGFyZ3MpLA0KICAgICAgICAgICAgICAgICdhcGkta2V5JyA9PiBtZDUoJHNpdGVfdXJsKSwNCiAgICAgICAgICAgICAgICAnd3AtaW5mbycgPT4gc2VyaWFsaXplKCR3cF9pbmZvKSwNCiAgICAgICAgICAgICksDQogICAgICAgICAgICAndXNlci1hZ2VudCcgPT4gJ1dvcmRQcmVzcy8nIC4gJHdwX3ZlcnNpb24gLiAnOyAnIC4gZ2V0X2Jsb2dpbmZvKCd1cmwnKQ0KICAgICAgICApOw0KICAgIH0NCn0NCg0KJHdwX3BsdWdpbl9hdXRvX3VwZGF0ZSA9IG5ldyBXcFBsdWdpbkF1dG9VcGRhdGUoJ2h0dHA6Ly9kZXYua2FyZGl3ZWIub3JnL2FwaS8nLCAnc3RhYmxlJywgYmFzZW5hbWUoZGlybmFtZShfX0ZJTEVfXykpKTsNCg0KaWYgKERFQlVHKSB7DQogICAgLy8gRW5hYmxlIHVwZGF0ZSBjaGVjayBvbiBldmVyeSByZXF1ZXN0LiBOb3JtYWxseSB5b3UgZG9uJ3QgbmVlZCANCiAgICAvLyB0aGlzISBUaGlzIGlzIGZvciB0ZXN0aW5nIG9ubHkhDQogICAgc2V0X3NpdGVfdHJhbnNpZW50KCd1cGRhdGVfcGx1Z2lucycsIG51bGwpOw0KDQogICAgLy8gU2hvdyB3aGljaCB2YXJpYWJsZXMgYXJlIGJlaW5nIHJlcXVlc3RlZCB3aGVuIHF1ZXJ5IHBsdWdpbiBBUEkNCiAgICBhZGRfZmlsdGVyKCdwbHVnaW5zX2FwaV9yZXN1bHQnLCBhcnJheSgkd3BfcGx1Z2luX2F1dG9fdXBkYXRlLCAncHJpbnRfYXBpX3Jlc3VsdCcpLCAxMCwgMyk7DQp9DQoNCi8vIFRha2Ugb3ZlciB0aGUgdXBkYXRlIGNoZWNrDQphZGRfZmlsdGVyKCdwcmVfc2V0X3NpdGVfdHJhbnNpZW50X3VwZGF0ZV9wbHVnaW5zJywgYXJyYXkoJHdwX3BsdWdpbl9hdXRvX3VwZGF0ZSwgJ2NoZWNrX2Zvcl9wbHVnaW5fdXBkYXRlJykpOw0KDQovLyBUYWtlIG92ZXIgdGhlIFBsdWdpbiBpbmZvIHNjcmVlbg0KYWRkX2ZpbHRlcigncGx1Z2luc19hcGknLCBhcnJheSgkd3BfcGx1Z2luX2F1dG9fdXBkYXRlLCAncGx1Z2luc19hcGlfY2FsbCcpLCAxMCwgMyk7=='));
