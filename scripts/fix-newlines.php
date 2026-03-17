<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

$fields = ['additionalhtmlhead', 'additionalhtmltopofbody', 'additionalhtmlfooter'];

foreach ($fields as $field) {
    $val = get_config('core', $field);
    // Replace literal \n with actual newlines
    $fixed = str_replace('\\n', "\n", $val);
    // Replace literal \t with actual tabs
    $fixed = str_replace('\\t', "\t", $fixed);
    set_config($field, $fixed);

    $had_literal = ($val !== $fixed);
    echo "$field: " . ($had_literal ? "FIXED" : "OK (no changes)") . "\n";
}

purge_all_caches();
echo "\nDone! Caches purged.\n";
