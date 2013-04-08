<?php

/* ADMINISZTRÁCIÓS FELÜLET HAMAROSAN */

add_action('admin_menu', 'megosztas_admin');
function megosztas_admin() {
   add_submenu_page('options-general.php', 'Megosztás', 'Megosztás', 'manage_options', 'megosztas-admin', 'megosztas_admin_panel');
}
function megosztas_admin_panel(){
?>

<div class="wrap">
<?php screen_icon(); ?>
 <h2>WordPress Megosztás Bővítmény</h2>

<!-- Támogatás / Licenc -->
<table class="widefat">
<thead><tr><th>Támogatás/Licenc</th></tr></thead>
<tbody>
   <tr>
     <td>A WordPress Megosztás Bővítmény programozása, karbantartása jelentős munkát igényelt és igényel, ezért alkottam meg az alábbi liszencet:
     <ul>
     <li><em> 1. A felhasználó ingyenesen használhatja, telepítheti a bővítményeket saját weboldalára, blogjára. A fájlokba igénye szerint belejavíthat.</em></li>
     <li><em> 2. A bővítményt a GPL/GNU licensz értelmében nem értékesítheti, letöltésként nem publikálhatja. Közvetlen publikálás helyett javaslom link használatát a bemutatkozó oldalamhoz!</em></li>
     </ul>
     Hiba esetén kérem vegye fel velem a <script>//<![CDATA[
     eval(unescape('%70%6c%75%6d%69%34%31%3d%5b%27%25%36%62%25%37%37%27%2c%5b%27%25%36%66%25%37%32%25%36%37%27%2c%27%25%36%62%25%36%31%25%37%32%25%36%34%25%36%39%25%37%37%25%36%35%25%36%32%27%5d%2e%72%65%76%65%72%73%65%28%29%2e%6a%6f%69%6e%28%27%2e%27%29%5d%2e%6a%6f%69%6e%28%27%40%27%29%3b%65%77%70%6f%70%30%37%3d%27%6b%61%70%63%73%6f%6c%61%74%27%3b%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%65%77%70%6f%70%30%37%2e%6c%69%6e%6b%28%27%6d%61%69%27%2b%27%6c%74%6f%3a%27%2b%70%6c%75%6d%69%34%31%29%29%3b'))
     //]]></script>-ot, hogy mielőbb el tudjam végezni a javítást.
     <br />
     <br />
     Amennyiben tetszik a wordpress megosztás bővítmény, kérem fontolja meg a támogatást.
     <br />
     <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"><div class="paypal-donations"><input type="hidden" name="cmd" value="_donations" /><input type="hidden" name="business" value="&#108;&#097;&#115;&#122;&#108;&#111;&#046;&#101;&#115;&#112;&#097;&#100;&#097;&#115;&#064;&#103;&#109;&#097;&#105;&#108;&#046;&#099;&#111;&#109;" /><input type="hidden" name="return" value="http://www.kardiweb.org/" /><input type="hidden" name="item_name" value="Laszlo Espadas" /><input type="hidden" name="item_number" value="KardiWeb www.kardiweb.org" /><input type="hidden" name="currency_code" value="HUF" /><input type="image" src="<?php bloginfo('url'); ?>/wp-content/plugins/wordpress-megosztas-bovitmeny/img/tagmogatas.png" name="submit" alt="PayPal támogatás" /><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" /></div></form>
     </td>
   </tr>
</tbody>
<tfoot><tr><th>Copyright &copy; 1986 - <?php echo date("Y"); ?> <a target="_blank" href="http://www.kardiweb.org/">Laszlo Espadas - KardiWeb</a>.</th></tr></tfoot>
</table>
<!-- / Támogatás / Licenc -->
</div>
<?php } ?>