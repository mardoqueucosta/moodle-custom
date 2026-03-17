<?php
require_once(__DIR__ . "/../config.php");
require_login();

// Slug mapping
$slugs = [
    "mestrado" => 6,
    "doutorado" => 7,
];

$slug = optional_param("slug", "", PARAM_ALPHA);
if ($slug && isset($slugs[$slug])) {
    $courseid = $slugs[$slug];
} else {
    $courseid = required_param("id", PARAM_INT);
}

$slug_map = [6 => "mestrado", 7 => "doutorado"];

if (!isset($slug_map[$courseid])) {
    redirect(new moodle_url("/"));
    exit;
}

$curso_slug = $slug_map[$courseid];
$curso_url = new moodle_url("/curso/" . $curso_slug);

// Already enrolled — go to course
$ctx = context_course::instance($courseid, IGNORE_MISSING);
if ($ctx && is_enrolled($ctx)) {
    redirect($curso_url);
    exit;
}

// Enroll the user
$enrol = $DB->get_record("enrol", ["enrol" => "self", "courseid" => $courseid, "status" => 0]);
if ($enrol) {
    $plugin = enrol_get_plugin("self");
    $plugin->enrol_user($enrol, $USER->id, 5);
    redirect($curso_url, "Matrícula realizada com sucesso!", 2);
} else {
    $enrol = $DB->get_record("enrol", ["enrol" => "manual", "courseid" => $courseid, "status" => 0]);
    if ($enrol) {
        $plugin = enrol_get_plugin("manual");
        $plugin->enrol_user($enrol, $USER->id, 5);
        redirect($curso_url, "Matrícula realizada com sucesso!", 2);
    }
    redirect(new moodle_url("/"), "Erro ao matricular.", 2);
}
exit;
