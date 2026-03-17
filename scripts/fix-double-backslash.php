<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB;

$fields = ['additionalhtmlfooter', 'additionalhtmlhead', 'additionalhtmltopofbody'];

foreach ($fields as $field) {
    // Use raw SQL to replace double backslash with single backslash
    $DB->execute(
        "UPDATE {config} SET value = REPLACE(value, '\\\\\\\\u', '\\\\u') WHERE name = ?",
        [$field]
    );

    // Check if it worked
    $val = $DB->get_field('config', 'value', ['name' => $field]);
    $has_double = (strpos($val, '\\\\u') !== false);
    echo "$field: " . ($has_double ? "STILL HAS DOUBLES" : "OK") . "\n";
}

purge_all_caches();
echo "\nDone!\n";
