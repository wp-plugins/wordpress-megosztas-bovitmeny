   <tr>
     <td>
     <h4>Bevezető</h4>
     A WordPress megosztás bővítmény azzal a céllal jött létre, hogy segítse a WordPress felhasználóit a magyar és külföldi közösségi média oldalain való tartalmak megosztásában. A bővítmény tartalmazza a Facebook, Twitter, Linkedln, Startlap, Tumblr, Google +, RSS, Email, Nyomtatás közösségi media gombokat. A fenti Gomb szöveg beállítások résznél könnyedén beállítható a gomb szövege.

     <h4>Szövegmezők</h4>
     A szövegmezőkben levő példa tartalom nem jelenik meg a felhasználói oldalon. Minden esetben kell szöveget írni a szövegmezőkbe.

     <h4>Shortcode (rövidkód) használata</h4>
     Helyezzük el bejegyzésben vagy oldalban a rövidkódot és mentés után azonnal meg is jelenik.
     <pre><code>[KWM_MEGOSZTAS]</code></pre>
     
     <h4>Teljes tartalomnál való megjelenítés</h4>
     Használhatjuk a bővítményt akár a teljes tartalom megjelenítésénél is. Ehhez nyissuk meg szerkesztésre a megosztas.php fájlt és keressük meg a következő sort:
     <pre><code>add_filter('the_content', 'kwm_megosztas');</code></pre>
     Kikapcsolási példa: <pre><code>//add_filter('the_content', 'kwm_megosztas');</code></pre>
     
     <h4>Bemutató tartalomnál való megjelenítés</h4>
     Használhatjuk a bővítményt akár a bemutató tartalom megjelenítésénél is. Ehhez nyissuk meg szerkesztésre a megosztas.php fájlt és keressük meg a következő sort:
     <pre><code>add_filter('the_excerpt', 'kwm_megosztas');</code></pre>
     Kikapcsolási példa: <pre><code>//add_filter('the_excerpt', 'kwm_megosztas');</code></pre>
     </td>
   </tr>
