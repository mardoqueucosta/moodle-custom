<?php
require_once(__DIR__ . "/../config.php");
require_login();

$courseid = required_param("id", PARAM_INT);

$disc_to_hubs = [
    2 => [6], 3 => [6, 7], 5 => [6, 7], 8 => [6, 7], 9 => [6, 7],
    10 => [6], 4 => [7], 11 => [7],
];

$disc_names = [
    2 => "Metodologia Cientifica e do Ensino Superior",
    3 => "Metodos Matematicos para Analise de Dados",
    4 => "Topicos Avancados em Engenharia Biomedica",
    5 => "Fundamentos de Citologia e Histologia",
    8 => "Bioestatistica",
    9 => "Principios de Fisiologia e Eletrofisiologia",
    10 => "Bioetica",
    11 => "Seminarios em Engenharia Biomedica",
];

$hub_names = [
    6 => "Mestrado em Engenharia Biomedica",
    7 => "Doutorado em Engenharia Biomedica",
];

$hubs = isset($disc_to_hubs[$courseid]) ? $disc_to_hubs[$courseid] : [];

if (empty($hubs)) {
    redirect(new moodle_url("/"), "Disciplina invalida.", 2);
    exit;
}

// Check if already enrolled in discipline
$ctx = context_course::instance($courseid, IGNORE_MISSING);
if ($ctx && is_enrolled($ctx)) {
    redirect(new moodle_url("/course/view.php", ["id" => $courseid]));
    exit;
}

// Check if user is enrolled in at least one hub
$in_hub = false;
$user_hub_id = null;
foreach ($hubs as $hid) {
    $hctx = context_course::instance($hid, IGNORE_MISSING);
    if ($hctx && is_enrolled($hctx)) {
        $in_hub = true;
        $user_hub_id = $hid;
        break;
    }
}

$disc_name = isset($disc_names[$courseid]) ? $disc_names[$courseid] : "Disciplina";

if (!$in_hub) {
    // NOT in hub - show message with link to hub
    $PAGE->set_context(context_system::instance());
    $PAGE->set_url(new moodle_url("/enrol_discipline.php", ["id" => $courseid]));
    $PAGE->set_title("Matricula necessaria");
    echo $OUTPUT->header();

    $hub_slugs = [6 => "mestrado", 7 => "doutorado"];
    $hub_links = "";
    foreach ($hubs as $hid) {
        $hname = isset($hub_names[$hid]) ? $hub_names[$hid] : "Programa";
        $slug = isset($hub_slugs[$hid]) ? $hub_slugs[$hid] : $hid;
        $hub_links .= '<a href="/programa/' . $slug . '" class="btn btn-primary" style="margin: 5px;">' . $hname . '</a> ';
    }

    echo '<div style="max-width:600px; margin:40px auto; text-align:center; padding:30px;">';
    echo '<h2 style="color:#0E5089;">Matricula no Programa Necessaria</h2>';
    echo '<p style="font-size:1.1rem; margin:20px 0;">Para se inscrever na disciplina <strong>' . $disc_name . '</strong>, voce precisa primeiro estar matriculado no programa.</p>';
    echo '<p style="margin:20px 0;">Matricule-se no programa abaixo:</p>';
    echo '<div style="margin:20px 0;">' . $hub_links . '</div>';
    echo '<p style="margin-top:30px;"><a href="/" style="color:#666;">Voltar a pagina inicial</a></p>';
    echo '</div>';

    echo $OUTPUT->footer();
    exit;
}

// IN hub - show confirmation to enroll in discipline
if (optional_param("confirm", 0, PARAM_INT) == 1) {
    // Do the enrollment
    $enrol = $DB->get_record("enrol", ["enrol" => "manual", "courseid" => $courseid, "status" => 0]);
    if ($enrol) {
        $plugin = enrol_get_plugin("manual");
        $plugin->enrol_user($enrol, $USER->id, 5);
        redirect(new moodle_url("/course/view.php", ["id" => $courseid]),
            "Inscricao realizada com sucesso!", 2);
    } else {
        redirect(new moodle_url("/"), "Erro ao inscrever.", 2);
    }
    exit;
}

// Show confirmation page
$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url("/enrol_discipline.php", ["id" => $courseid]));
$PAGE->set_title("Inscrever na disciplina");
echo $OUTPUT->header();

echo '<div style="max-width:600px; margin:40px auto; text-align:center; padding:30px;">';
echo '<h2 style="color:#0E5089;">Inscrever na Disciplina</h2>';
echo '<p style="font-size:1.1rem; margin:20px 0;">Deseja se inscrever na disciplina <strong>' . $disc_name . '</strong>?</p>';
echo '<div style="margin:20px 0;">';
echo '<a href="/enrol_discipline.php?id=' . $courseid . '&confirm=1" class="btn btn-primary" style="margin:5px;">Confirmar Inscricao</a> ';
echo '<a href="/course/view.php?id=' . $user_hub_id . '" class="btn btn-secondary" style="margin:5px;">Voltar ao Programa</a>';
echo '</div>';
echo '</div>';

echo $OUTPUT->footer();
exit;
