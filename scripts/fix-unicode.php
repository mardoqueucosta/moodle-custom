<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

$fields = ['additionalhtmlhead', 'additionalhtmltopofbody', 'additionalhtmlfooter'];

foreach ($fields as $field) {
    $val = get_config('core', $field);
    // Replace \\uXXXX with \uXXXX (mariadb CLI doubles backslashes on export)
    $fixed = str_replace('\\u', '\u', $val);
    // Also fix any remaining \\' sequences
    $fixed = str_replace("\\\\'", "\\'", $fixed);

    $changed = ($val !== $fixed);
    if ($changed) {
        set_config($field, $fixed);
    }
    echo "$field: " . ($changed ? "FIXED" : "OK") . "\n";
}

purge_all_caches();
echo "\nDone!\n";
