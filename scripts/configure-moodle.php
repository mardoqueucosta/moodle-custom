<?php
/**
 * Applies all Moodle production settings after fresh deploy.
 * Run inside container: docker exec moodle_app php /tmp/configure-moodle.php
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== Configuring Moodle Settings ===\n";

// Language
set_config('lang', 'pt_br');
set_config('autolang', 0);
set_config('langmenu', 0);
echo "[OK] Language: pt_br (autolang off, langmenu off)\n";

// Guest login
set_config('guestloginbutton', 0);
echo "[OK] Guest login button disabled\n";

// Clean slash arguments
set_config('cleanslasharguments', 1);
echo "[OK] Clean slash arguments enabled\n";

// Force all users to pt_br
$DB->execute("UPDATE {user} SET lang = 'pt_br' WHERE lang != 'pt_br'");
echo "[OK] All users forced to pt_br\n";

// Purge caches
purge_all_caches();
echo "[OK] Caches purged\n";

echo "\n=== Done! ===\n";
