<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

// Corrigir nomes dos cursos (adicionar acentos)
$cursos = [
    2 => ['fullname' => 'Metodologia Científica e do Ensino Superior', 'shortname' => 'MCES'],
    3 => ['fullname' => 'Métodos Matemáticos para Análise de Dados', 'shortname' => 'MMAD'],
    4 => ['fullname' => 'Tópicos Avançados em Engenharia Biomédica', 'shortname' => 'TAEB'],
    5 => ['fullname' => 'Fundamentos de Citologia e Histologia', 'shortname' => 'FCH'],
];
foreach ($cursos as $id => $data) {
    $DB->update_record('course', (object)array_merge(['id' => $id], $data));
    echo "Curso $id atualizado: {$data['fullname']}\n";
}

// Descrição da categoria principal
$pgDesc = '<div class="eb-cat-hero"><p class="eb-hero-label">Programa de Pós-Graduação</p><h1>Engenharia Biomédica</h1><div class="eb-hero-bar"></div><p>Formando pesquisadores e profissionais de excelência na interface entre engenharia, tecnologia e ciências da saúde. Selecione abaixo o programa desejado.</p></div>';
$DB->update_record('course_categories', (object)['id' => 2, 'description' => $pgDesc, 'descriptionformat' => 1]);
echo "Categoria principal atualizada com hero.\n";

purge_all_caches();
echo "Pronto!\n";
