<?php
// Moodle 5.3 (26/10/2026): ajusta o SCSS do tema gravado no banco (o mesmo que scripts/apply-theme.php grava):
// 1. tira o @import url(...) da fonte DM Sans, que quebra a compilação do tema na 5.3 (a fonte continua
//    carregada pelo additionalhtmlhead);
// 2. acrescenta a regra do menu do topo, que na 5.3 virou .mds-nav-pill com fundo claro;
// 3. esconde o painel "Boas-vindas ao Moodle" do login novo e centraliza o formulário;
// 4. texto branco nos links com cara de botão primário (estava azul sobre azul).
// docker cp scripts/fix-scss-53.php moodle_app:/tmp/ && docker exec -u www-data moodle_app php /tmp/fix-scss-53.php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

$scss = get_config('theme_boost', 'scss');
$novo = preg_replace('~^\s*@import\s+url\([^)]*fonts\.googleapis\.com[^)]*\)\s*;\s*$~m', '', $scss);
if (strpos($novo, 'mds-nav-pill') === false) {
    $novo .= <<<'SCSS'


/* Moodle 5.3: o menu do topo virou "pílulas" (.mds-nav-pill) com fundo claro; volta ao texto branco */
.navbar .mds-nav-pill {
    color: #fff !important;
    background: transparent !important;
    border-radius: 0 !important;
}
.navbar .mds-nav-pill:hover { color: var(--eb-teal-400) !important; }
.navbar .mds-nav-pill--selected { box-shadow: inset 0 -2px 0 #fff !important; }
SCSS;
}
if (strpos($novo, 'a.btn-primary') === false) {
    $novo .= <<<'SCSS'


/* Link com cara de botão (<a class="btn btn-primary">, ex.: "Confirmar Inscrição"): a regra do "a" deixava o
   texto azul sobre o fundo azul. */
a.btn-primary, a.btn-primary:hover { color: #fff !important; }
SCSS;
}
if (strpos($novo, 'login-layout-left') === false) {
    $novo .= <<<'SCSS'


/* Moodle 5.3: o login virou tela dividida, com um painel "Boas-vindas ao Moodle" e números do Moodle.
   Esconde o painel e deixa o formulário num cartão central, como antes. */
#page-login-index .login-layout-left { display: none !important; }
#page-login-index #page { background: transparent !important; }
#page-login-index .login-layout-right {
    flex: 0 0 auto !important;
    width: 100% !important;
    max-width: 440px !important;
    margin: 6vh auto !important;
}
#page-login-index .login-layout-right-content {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    padding: 2rem 2rem 1.5rem;
}
SCSS;
}
if ($novo === $scss) {
    echo "Nada a mudar.\n";
    exit(0);
}
set_config('scss', $novo, 'theme_boost');
theme_reset_all_caches();
echo "SCSS do tema ajustado para a 5.3.\n";
