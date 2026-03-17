<?php
define('AJAX_SCRIPT', true);
require_once(__DIR__ . "/../config.php");
header("Content-Type: application/json");
// Close session early to prevent race condition with login page token
\core\session\manager::write_close();

if (!isloggedin() || isguestuser()) {
    if (isset($_GET["check"])) {
        echo json_encode(["access" => false, "redirect" => "/login/index.php"]);
    } else {
        echo json_encode(["enrolled" => []]);
    }
    exit;
}

if (isset($_GET["check"])) {
    $courseid = (int)$_GET["check"];
    $context = context_course::instance($courseid, IGNORE_MISSING);
    if ($context && is_enrolled($context)) {
        echo json_encode(["access" => true]);
    } else {
        $disc_to_hubs = [
            2 => [6], 3 => [6, 7], 5 => [6, 7], 8 => [6, 7], 9 => [6, 7],
            10 => [6], 4 => [7], 11 => [7],
        ];
        $hubs = isset($disc_to_hubs[$courseid]) ? $disc_to_hubs[$courseid] : [];

        $in_hub = false;
        foreach ($hubs as $hid) {
            $ctx = context_course::instance($hid, IGNORE_MISSING);
            if ($ctx && is_enrolled($ctx)) { $in_hub = true; break; }
        }

        if ($in_hub) {
            echo json_encode(["access" => false, "redirect" => "/enrol_discipline.php?id=" . $courseid, "in_hub" => true]);
        } else {
            $redirect = !empty($hubs) ? "/course/view.php?id=" . $hubs[0] : "/";
            echo json_encode(["access" => false, "redirect" => $redirect, "in_hub" => false]);
        }
    }
    exit;
}

$courses = enrol_get_my_courses("id", "id ASC");
$ids = array_map(function($c) { return (int)$c->id; }, $courses);
echo json_encode(["enrolled" => array_values($ids)]);
