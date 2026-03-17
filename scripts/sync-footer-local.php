<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

$footer = file_get_contents('/tmp/local_footer.txt');
set_config('additionalhtmlfooter', $footer);
purge_all_caches();

echo "Footer synced!\n";
$check = get_config('core', 'additionalhtmlfooter');
echo "Has slugMap: " . (strpos($check, 'slugMap') !== false ? 'YES' : 'NO') . "\n";
echo "Has localhost:4000: " . (strpos($check, 'localhost:4000') !== false ? 'YES' : 'NO') . "\n";
