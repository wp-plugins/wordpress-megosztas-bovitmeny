<?php

/* MEGOSZTÁS BŐVÍTMÉNY BEÁLLÍTÁSOK ELTÁVOLÍTÁSA AZ ADATBÁZISBÓL */

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
exit;

// Beállítások ellenörzése és tőrlése
if ( get_option( 'kwm_beallitasok' ) != false ) {
delete_option( 'kwm_beallitasok' );
}
?>
