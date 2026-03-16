<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

// ============================================
// 1. CONTEÚDO DA PÁGINA INICIAL (frontpage summary)
// ============================================

$frontpage_html = <<<'HTML'
<div style="font-family: 'DM Sans', sans-serif;">

<!-- HERO BANNER -->
<div style="background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%); border-radius: 18px; padding: 3rem 2.5rem; margin-bottom: 2rem; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(0,180,158,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -30px; left: 20%; width: 150px; height: 150px; background: radial-gradient(circle, rgba(22,120,194,0.12) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: relative; z-index: 1;">
        <p style="color: #00B49E; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 0.75rem;">Programa de Pós-Graduação</p>
        <h1 style="color: #fff; font-size: 2.2rem; font-weight: 700; margin-bottom: 0.5rem; letter-spacing: -0.02em; line-height: 1.15;">Engenharia Biomédica</h1>
        <div style="width: 60px; height: 3px; background: linear-gradient(90deg, #00B49E, #1678C2); border-radius: 2px; margin-bottom: 1rem;"></div>
        <p style="color: #A4D2F0; font-size: 1rem; line-height: 1.7; max-width: 600px; margin-bottom: 1.5rem;">Formando pesquisadores e profissionais de excelência na interface entre engenharia, tecnologia e ciências da saúde.</p>
        <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
            <div style="text-align: center;">
                <p style="color: #00B49E; font-size: 1.75rem; font-weight: 700; margin: 0;">2</p>
                <p style="color: #A4D2F0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">Programas</p>
            </div>
            <div style="text-align: center;">
                <p style="color: #00B49E; font-size: 1.75rem; font-weight: 700; margin: 0;">4</p>
                <p style="color: #A4D2F0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">Disciplinas</p>
            </div>
            <div style="text-align: center;">
                <p style="color: #00B49E; font-size: 1.75rem; font-weight: 700; margin: 0;">60h</p>
                <p style="color: #A4D2F0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">Carga Média</p>
            </div>
        </div>
    </div>
</div>

<!-- PROGRAMAS -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">

    <!-- MESTRADO -->
    <div style="background: #fff; border-radius: 14px; border: 1px solid #E0E4ED; padding: 0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.02);">
        <div style="background: linear-gradient(135deg, #0E5089, #1678C2); padding: 1.25rem 1.5rem;">
            <p style="color: #00B49E; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; margin: 0 0 0.25rem 0;">Programa</p>
            <h2 style="color: #fff; font-size: 1.35rem; font-weight: 700; margin: 0;">Mestrado</h2>
        </div>
        <div style="padding: 1.5rem;">
            <!-- Disciplina 1 -->
            <div style="display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1.25rem; padding-bottom: 1.25rem; border-bottom: 1px solid #F2F4F8;">
                <div style="min-width: 40px; height: 40px; background: linear-gradient(135deg, #EDF6FD, #D6ECFA); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 1.1rem;">📐</span>
                </div>
                <div>
                    <h3 style="font-size: 0.95rem; font-weight: 700; color: #0F1629; margin: 0 0 0.25rem 0;">Metodologia Científica e do Ensino Superior</h3>
                    <p style="font-size: 0.8rem; color: #6B7899; line-height: 1.5; margin: 0;">Pesquisa científica, redação acadêmica e práticas pedagógicas</p>
                    <div style="margin-top: 0.5rem;">
                        <span style="display: inline-block; background: #EDF6FD; color: #1264A5; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px; margin-right: 0.25rem;">60h</span>
                        <span style="display: inline-block; background: #E8FBF8; color: #009985; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px;">4 créditos</span>
                    </div>
                </div>
            </div>
            <!-- Disciplina 2 -->
            <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                <div style="min-width: 40px; height: 40px; background: linear-gradient(135deg, #EDF6FD, #D6ECFA); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 1.1rem;">📊</span>
                </div>
                <div>
                    <h3 style="font-size: 0.95rem; font-weight: 700; color: #0F1629; margin: 0 0 0.25rem 0;">Métodos Matemáticos para Análise de Dados</h3>
                    <p style="font-size: 0.8rem; color: #6B7899; line-height: 1.5; margin: 0;">Estatística, álgebra linear e aprendizado de máquina aplicados</p>
                    <div style="margin-top: 0.5rem;">
                        <span style="display: inline-block; background: #EDF6FD; color: #1264A5; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px; margin-right: 0.25rem;">60h</span>
                        <span style="display: inline-block; background: #E8FBF8; color: #009985; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px;">4 créditos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DOUTORADO -->
    <div style="background: #fff; border-radius: 14px; border: 1px solid #E0E4ED; padding: 0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.02);">
        <div style="background: linear-gradient(135deg, #003D36, #007A6A); padding: 1.25rem 1.5rem;">
            <p style="color: #2ECDB8; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; margin: 0 0 0.25rem 0;">Programa</p>
            <h2 style="color: #fff; font-size: 1.35rem; font-weight: 700; margin: 0;">Doutorado</h2>
        </div>
        <div style="padding: 1.5rem;">
            <!-- Disciplina 3 -->
            <div style="display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1.25rem; padding-bottom: 1.25rem; border-bottom: 1px solid #F2F4F8;">
                <div style="min-width: 40px; height: 40px; background: linear-gradient(135deg, #E8FBF8, #CCF6F0); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 1.1rem;">🔬</span>
                </div>
                <div>
                    <h3 style="font-size: 0.95rem; font-weight: 700; color: #0F1629; margin: 0 0 0.25rem 0;">Tópicos Avançados em Engenharia Biomédica</h3>
                    <p style="font-size: 0.8rem; color: #6B7899; line-height: 1.5; margin: 0;">Bioinstrumentação, IA em saúde e nanotecnologia biomédica</p>
                    <div style="margin-top: 0.5rem;">
                        <span style="display: inline-block; background: #EDF6FD; color: #1264A5; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px; margin-right: 0.25rem;">60h</span>
                        <span style="display: inline-block; background: #E8FBF8; color: #009985; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px;">4 créditos</span>
                    </div>
                </div>
            </div>
            <!-- Disciplina 4 -->
            <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                <div style="min-width: 40px; height: 40px; background: linear-gradient(135deg, #E8FBF8, #CCF6F0); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 1.1rem;">🧬</span>
                </div>
                <div>
                    <h3 style="font-size: 0.95rem; font-weight: 700; color: #0F1629; margin: 0 0 0.25rem 0;">Fundamentos de Citologia e Histologia</h3>
                    <p style="font-size: 0.8rem; color: #6B7899; line-height: 1.5; margin: 0;">Estrutura celular, microscopia e engenharia de tecidos</p>
                    <div style="margin-top: 0.5rem;">
                        <span style="display: inline-block; background: #EDF6FD; color: #1264A5; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px; margin-right: 0.25rem;">45h</span>
                        <span style="display: inline-block; background: #E8FBF8; color: #009985; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px;">3 créditos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- BARRA INFERIOR INFO -->
<div style="background: #fff; border-radius: 14px; border: 1px solid #E0E4ED; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <div style="width: 36px; height: 36px; background: #EDF6FD; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
            <span style="font-size: 1rem;">🎓</span>
        </div>
        <div>
            <p style="font-size: 0.8rem; font-weight: 700; color: #0F1629; margin: 0;">Inscrições Abertas</p>
            <p style="font-size: 0.7rem; color: #6B7899; margin: 0;">Turma 2026.1</p>
        </div>
    </div>
    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <div style="width: 36px; height: 36px; background: #E8FBF8; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
            <span style="font-size: 1rem;">📅</span>
        </div>
        <div>
            <p style="font-size: 0.8rem; font-weight: 700; color: #0F1629; margin: 0;">Início das Aulas</p>
            <p style="font-size: 0.7rem; color: #6B7899; margin: 0;">Março 2026</p>
        </div>
    </div>
    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <div style="width: 36px; height: 36px; background: #EDF6FD; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
            <span style="font-size: 1rem;">💻</span>
        </div>
        <div>
            <p style="font-size: 0.8rem; font-weight: 700; color: #0F1629; margin: 0;">Modalidade</p>
            <p style="font-size: 0.7rem; color: #6B7899; margin: 0;">Presencial + EAD</p>
        </div>
    </div>
</div>

</div>
HTML;

// ============================================
// 2. APLICAR NO MOODLE
// ============================================

// Configurar página inicial para mostrar summary
set_config('frontpage', '6'); // 6 = course categories
set_config('frontpageloggedin', '6');

// Atualizar o summary do site (course id=1)
$DB->update_record('course', (object)[
    'id' => 1,
    'summary' => $frontpage_html,
    'summaryformat' => 1 // HTML
]);

echo "Frontpage HTML atualizado!\n";

// Purge caches
purge_all_caches();
echo "Caches limpos!\n";
echo "Pronto! Acesse http://localhost:8080\n";
