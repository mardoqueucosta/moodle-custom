<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

// Configurar a página inicial (para visitantes e logados)
// 0 = nada, 1 = news, 2 = course list combo, 3 = categories list
// 4 = categories and courses, 5 = enrolled courses, 6 = course search
// Separados por vírgula para múltiplos itens

// Página inicial para visitantes: summary + categorias com cursos
set_config('frontpage', '6'); // summary do site + categorias

// Página inicial para LOGADOS: mostrar cursos em vez do Painel
set_config('frontpageloggedin', '6'); // categorias com cursos

// IMPORTANTE: Definir a página padrão após login como Página Inicial (não Painel)
set_config('defaulthomepage', 1); // 0=Página inicial, 1=Página inicial, 2=Painel, 3=Meus cursos

echo "defaulthomepage = " . get_config('core', 'defaulthomepage') . "\n";
echo "frontpage = " . get_config('core', 'frontpage') . "\n";
echo "frontpageloggedin = " . get_config('core', 'frontpageloggedin') . "\n";

purge_all_caches();
echo "\nPronto! Agora ao fazer login, o usuário vai direto para a Página Inicial com os cursos.\n";
