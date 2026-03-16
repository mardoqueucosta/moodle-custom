<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

// 1. Limpar o summary (não funciona com estilos inline)
$DB->update_record('course', (object)[
    'id' => 1,
    'summary' => '',
    'summaryformat' => 1
]);

// 2. Adicionar CSS das classes + HTML do layout via additionalhtmlhead
$existing_head = get_config('core', 'additionalhtmlhead');

// Adicionar CSS para o frontpage layout
$frontpage_css = <<<'CSSEOF'

<style id="eb-frontpage">
/* FRONTPAGE HERO */
.eb-hero {
    background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%);
    border-radius: 18px;
    padding: 3rem 2.5rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}
.eb-hero-glow1 {
    position: absolute; top: -50px; right: -50px; width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(0,180,158,0.15) 0%, transparent 70%);
    border-radius: 50%;
}
.eb-hero-glow2 {
    position: absolute; bottom: -30px; left: 20%; width: 150px; height: 150px;
    background: radial-gradient(circle, rgba(22,120,194,0.12) 0%, transparent 70%);
    border-radius: 50%;
}
.eb-hero-content { position: relative; z-index: 1; }
.eb-hero-label {
    color: #00B49E; font-size: 0.75rem; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 0.75rem;
}
.eb-hero-title {
    color: #fff !important; font-size: 2.2rem; font-weight: 700 !important;
    margin-bottom: 0.5rem; letter-spacing: -0.02em; line-height: 1.15;
}
.eb-hero-bar {
    width: 60px; height: 3px;
    background: linear-gradient(90deg, #00B49E, #1678C2);
    border-radius: 2px; margin-bottom: 1rem;
}
.eb-hero-desc {
    color: #A4D2F0 !important; font-size: 1rem; line-height: 1.7; max-width: 600px; margin-bottom: 1.5rem;
}
.eb-hero-stats { display: flex; gap: 2rem; flex-wrap: wrap; }
.eb-stat-num { color: #00B49E !important; font-size: 1.75rem; font-weight: 700; margin: 0; }
.eb-stat-label {
    color: #A4D2F0 !important; font-size: 0.75rem; text-transform: uppercase;
    letter-spacing: 0.08em; margin: 0;
}

/* PROGRAM GRID */
.eb-programs { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }
@media (max-width: 768px) { .eb-programs { grid-template-columns: 1fr; } }
.eb-program-card {
    background: #fff; border-radius: 14px; border: 1px solid #E0E4ED;
    overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.02);
}
.eb-program-header-blue { background: linear-gradient(135deg, #0E5089, #1678C2); padding: 1.25rem 1.5rem; }
.eb-program-header-teal { background: linear-gradient(135deg, #003D36, #007A6A); padding: 1.25rem 1.5rem; }
.eb-program-type {
    font-size: 0.65rem; font-weight: 600; letter-spacing: 0.12em;
    text-transform: uppercase; margin: 0 0 0.25rem 0;
}
.eb-program-type-blue { color: #00B49E; }
.eb-program-type-teal { color: #2ECDB8; }
.eb-program-name { color: #fff !important; font-size: 1.35rem; font-weight: 700 !important; margin: 0; }
.eb-program-body { padding: 1.5rem; }

/* DISCIPLINE ITEM */
.eb-discipline { display: flex; align-items: flex-start; gap: 0.75rem; }
.eb-discipline + .eb-discipline {
    margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #F2F4F8;
}
.eb-disc-icon-blue {
    min-width: 40px; height: 40px; background: linear-gradient(135deg, #EDF6FD, #D6ECFA);
    border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
}
.eb-disc-icon-teal {
    min-width: 40px; height: 40px; background: linear-gradient(135deg, #E8FBF8, #CCF6F0);
    border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
}
.eb-disc-title {
    font-size: 0.95rem; font-weight: 700 !important; color: #0F1629 !important;
    margin: 0 0 0.25rem 0;
}
.eb-disc-desc { font-size: 0.8rem; color: #6B7899; line-height: 1.5; margin: 0; }
.eb-disc-tags { margin-top: 0.5rem; }
.eb-tag-blue {
    display: inline-block; background: #EDF6FD; color: #1264A5;
    font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem;
    border-radius: 4px; margin-right: 0.25rem;
}
.eb-tag-teal {
    display: inline-block; background: #E8FBF8; color: #009985;
    font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px;
}

/* INFO BAR */
.eb-infobar {
    background: #fff; border-radius: 14px; border: 1px solid #E0E4ED;
    padding: 1.5rem 2rem; display: flex; justify-content: space-between;
    align-items: center; flex-wrap: wrap; gap: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04); margin-bottom: 1rem;
}
.eb-info-item { display: flex; align-items: center; gap: 0.75rem; }
.eb-info-icon-blue {
    width: 36px; height: 36px; background: #EDF6FD; border-radius: 8px;
    display: flex; align-items: center; justify-content: center; font-size: 1rem;
}
.eb-info-icon-teal {
    width: 36px; height: 36px; background: #E8FBF8; border-radius: 8px;
    display: flex; align-items: center; justify-content: center; font-size: 1rem;
}
.eb-info-title { font-size: 0.8rem; font-weight: 700; color: #0F1629; margin: 0; }
.eb-info-sub { font-size: 0.7rem; color: #6B7899; margin: 0; }

/* Hide on non-frontpage */
.eb-frontpage-layout { display: none; }
#page-site-index .eb-frontpage-layout { display: block; margin: 0 auto; max-width: 1100px; padding: 1.5rem 1rem; }
</style>
CSSEOF;

// 3. HTML do layout via additionalhtmltopofbody
$frontpage_html = <<<'HTMLEOF'
<div class="eb-frontpage-layout">

    <div class="eb-hero">
        <div class="eb-hero-glow1"></div>
        <div class="eb-hero-glow2"></div>
        <div class="eb-hero-content">
            <p class="eb-hero-label">Programa de Pós-Graduação</p>
            <h1 class="eb-hero-title">Engenharia Biomédica</h1>
            <div class="eb-hero-bar"></div>
            <p class="eb-hero-desc">Formando pesquisadores e profissionais de excelência na interface entre engenharia, tecnologia e ciências da saúde.</p>
            <div class="eb-hero-stats">
                <div><p class="eb-stat-num">2</p><p class="eb-stat-label">Programas</p></div>
                <div><p class="eb-stat-num">4</p><p class="eb-stat-label">Disciplinas</p></div>
                <div><p class="eb-stat-num">60h</p><p class="eb-stat-label">Carga Média</p></div>
            </div>
        </div>
    </div>

    <div class="eb-programs">
        <div class="eb-program-card">
            <div class="eb-program-header-blue">
                <p class="eb-program-type eb-program-type-blue">Programa</p>
                <h2 class="eb-program-name">Mestrado</h2>
            </div>
            <div class="eb-program-body">
                <div class="eb-discipline">
                    <div class="eb-disc-icon-blue">📐</div>
                    <div>
                        <h3 class="eb-disc-title">Metodologia Científica e do Ensino Superior</h3>
                        <p class="eb-disc-desc">Pesquisa científica, redação acadêmica e práticas pedagógicas</p>
                        <div class="eb-disc-tags"><span class="eb-tag-blue">60h</span><span class="eb-tag-teal">4 créditos</span></div>
                    </div>
                </div>
                <div class="eb-discipline">
                    <div class="eb-disc-icon-blue">📊</div>
                    <div>
                        <h3 class="eb-disc-title">Métodos Matemáticos para Análise de Dados</h3>
                        <p class="eb-disc-desc">Estatística, álgebra linear e aprendizado de máquina aplicados</p>
                        <div class="eb-disc-tags"><span class="eb-tag-blue">60h</span><span class="eb-tag-teal">4 créditos</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="eb-program-card">
            <div class="eb-program-header-teal">
                <p class="eb-program-type eb-program-type-teal">Programa</p>
                <h2 class="eb-program-name">Doutorado</h2>
            </div>
            <div class="eb-program-body">
                <div class="eb-discipline">
                    <div class="eb-disc-icon-teal">🔬</div>
                    <div>
                        <h3 class="eb-disc-title">Tópicos Avançados em Engenharia Biomédica</h3>
                        <p class="eb-disc-desc">Bioinstrumentação, IA em saúde e nanotecnologia biomédica</p>
                        <div class="eb-disc-tags"><span class="eb-tag-blue">60h</span><span class="eb-tag-teal">4 créditos</span></div>
                    </div>
                </div>
                <div class="eb-discipline">
                    <div class="eb-disc-icon-teal">🧬</div>
                    <div>
                        <h3 class="eb-disc-title">Fundamentos de Citologia e Histologia</h3>
                        <p class="eb-disc-desc">Estrutura celular, microscopia e engenharia de tecidos</p>
                        <div class="eb-disc-tags"><span class="eb-tag-blue">45h</span><span class="eb-tag-teal">3 créditos</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="eb-infobar">
        <div class="eb-info-item">
            <div class="eb-info-icon-blue">🎓</div>
            <div><p class="eb-info-title">Inscrições Abertas</p><p class="eb-info-sub">Turma 2026.1</p></div>
        </div>
        <div class="eb-info-item">
            <div class="eb-info-icon-teal">📅</div>
            <div><p class="eb-info-title">Início das Aulas</p><p class="eb-info-sub">Março 2026</p></div>
        </div>
        <div class="eb-info-item">
            <div class="eb-info-icon-blue">💻</div>
            <div><p class="eb-info-title">Modalidade</p><p class="eb-info-sub">Presencial + EAD</p></div>
        </div>
    </div>

</div>
HTMLEOF;

// Aplicar
set_config('additionalhtmlhead', $existing_head . $frontpage_css);
set_config('additionalhtmltopofbody', $frontpage_html);

echo "Layout da frontpage aplicado!\n";

purge_all_caches();
echo "Caches limpos!\n";
echo "Acesse http://localhost:8080 (Ctrl+F5)\n";
