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
     <li><em> 2. A bővítményt a GPL/GNU licensz értelmében nem értékesítheti, letöltésként nem publikálhatja. Közvetlen publikálás helyett javaslom link használatát a Blogom-hoz!</em></li>
     </ul>
     Hiba esetén kérem a <a target="_blank" href="http://www.kardiweb.org/kapcsolat-felvetel/">Kapcsolat</a> menüpontban jelezzen vissza, hogy mielőbb el tudjam végezni a javítást.
     <br />
     <br />
     Amennyiben tetszik a wordpress megosztás bővítmény, kérem fontolja meg a támogatást.
     <br />
     <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"><div class="paypal-donations"><input type="hidden" name="cmd" value="_donations" /><input type="hidden" name="business" value="&#112;&#097;&#121;&#064;&#106;&#099;&#111;&#114;&#101;&#046;&#104;&#117;" /><input type="hidden" name="return" value="http://www.kardiweb.org/" /><input type="hidden" name="item_name" value="Laszlo Espadas" /><input type="hidden" name="item_number" value="KardiWeb www.kardiweb.org" /><input type="hidden" name="currency_code" value="HUF" /><input type="image" src="<?php bloginfo('url'); ?>/wp-content/plugins/megosztas/img/tagmogatas.png" name="submit" alt="PayPal támogatás" /><img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" /></div></form>
     </td>
   </tr>
</tbody>
<tfoot><tr><th>Copyright &copy; 1986 - <?php echo date("Y"); ?> <a target="_blank" href="http://www.kardiweb.org/">KardiWeb</a>. Minden Jog Fenntartva!</th></tr></tfoot>
</table>
<!-- / Támogatás / Licenc -->
</div>
<?php } ?>