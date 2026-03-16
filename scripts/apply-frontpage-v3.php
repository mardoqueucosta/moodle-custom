<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

// Limpar summary
$DB->update_record('course', (object)['id' => 1, 'summary' => '', 'summaryformat' => 1]);

// CSS completo (tema + frontpage)
$css = <<<'CSSEOF'
<style id="eb-theme">
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap");

:root {
    --eb-primary-50: #EDF6FD; --eb-primary-100: #D6ECFA; --eb-primary-200: #A4D2F0;
    --eb-primary-400: #3A93D5; --eb-primary-500: #1678C2; --eb-primary-600: #1264A5;
    --eb-primary-700: #0E5089; --eb-primary-900: #062A4A;
    --eb-teal-400: #2ECDB8; --eb-teal-500: #00B49E; --eb-teal-600: #009985; --eb-teal-700: #007A6A;
    --eb-slate-50: #F2F4F8; --eb-slate-100: #E0E4ED; --eb-slate-700: #283352; --eb-slate-900: #0F1629;
}
body { font-family: "DM Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important; background-color: var(--eb-slate-50) !important; }

/* NAVBAR */
.navbar { background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%) !important; border-bottom: 3px solid #00B49E !important; box-shadow: 0 2px 12px rgba(0,0,0,0.15) !important; }
.navbar .navbar-brand, .navbar .nav-link, .navbar .dropdown-toggle, .navbar .btn-outline-secondary { color: #fff !important; }
.navbar .nav-link:hover, .navbar .dropdown-toggle:hover { color: #2ECDB8 !important; }
.navbar .moremenu .nav-link.active { border-bottom-color: #00B49E !important; }

a:not(.btn):not(.eb-disc-link) { color: #1264A5; } a:not(.btn):not(.eb-disc-link):hover { color: #007A6A; }

.btn-primary { background: #1264A5 !important; border-color: #0E5089 !important; border-radius: 8px !important; font-weight: 600 !important; }
.btn-primary:hover { background: #0E5089 !important; }
.btn-secondary { background: #00B49E !important; border-color: #009985 !important; color: #fff !important; border-radius: 8px !important; }
.btn-secondary:hover { background: #009985 !important; }

.card { border-radius: 14px !important; border-color: #E0E4ED !important; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.02) !important; }

h1, h2, h3, h4, h5, h6 { font-family: "DM Sans", sans-serif !important; font-weight: 700 !important; color: #0F1629 !important; }

.breadcrumb { background: transparent !important; }
.breadcrumb-item a { color: #1264A5 !important; }

[data-region="drawer"] { background: #fff !important; border-color: #E0E4ED !important; }

#page-footer { background: #062A4A !important; color: #A4D2F0 !important; border-top: 3px solid #00B49E !important; }
#page-footer a { color: #2ECDB8 !important; }

.nav-tabs .nav-link.active { border-bottom: 3px solid #00B49E !important; color: #0E5089 !important; font-weight: 600 !important; }

.coursebox, .course-info-container { border-radius: 14px !important; border: 1px solid #E0E4ED !important; background: #fff !important; padding: 1.5rem !important; margin-bottom: 1rem !important; box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important; }
.coursebox:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important; border-color: #A4D2F0 !important; }
.coursebox .coursename a { color: #0E5089 !important; font-weight: 700 !important; font-size: 1.2rem !important; }
.category-content .coursebox { border-left: 4px solid #00B49E !important; }

.activity-item { border-radius: 10px !important; transition: background 0.2s !important; }
.activity-item:hover { background: #EDF6FD !important; }
.progress-bar { background: linear-gradient(90deg, #1264A5, #00B49E) !important; }
.dropdown-menu { border-radius: 10px !important; border-color: #E0E4ED !important; box-shadow: 0 8px 32px rgba(0,0,0,0.08) !important; }

::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: #F2F4F8; }
::-webkit-scrollbar-thumb { background: #A4D2F0; border-radius: 4px; }
::-webkit-scrollbar-thumb:hover { background: #3A93D5; }

/* === FRONTPAGE LAYOUT === */
.eb-hero { background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%); border-radius: 18px; padding: 3rem 2.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; }
.eb-hero-glow1 { position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(0,180,158,0.15) 0%, transparent 70%); border-radius: 50%; }
.eb-hero-glow2 { position: absolute; bottom: -30px; left: 20%; width: 150px; height: 150px; background: radial-gradient(circle, rgba(22,120,194,0.12) 0%, transparent 70%); border-radius: 50%; }
.eb-hero-content { position: relative; z-index: 1; }
.eb-hero-label { color: #00B49E; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 0.75rem; }
.eb-hero-title { color: #fff !important; font-size: 2.2rem; font-weight: 700 !important; margin-bottom: 0.5rem; letter-spacing: -0.02em; line-height: 1.15; }
.eb-hero-bar { width: 60px; height: 3px; background: linear-gradient(90deg, #00B49E, #1678C2); border-radius: 2px; margin-bottom: 1rem; }
.eb-hero-desc { color: #A4D2F0 !important; font-size: 1rem; line-height: 1.7; max-width: 600px; margin-bottom: 1.5rem; }
.eb-hero-stats { display: flex; gap: 2rem; flex-wrap: wrap; }
.eb-stat-num { color: #00B49E !important; font-size: 1.75rem; font-weight: 700; margin: 0; }
.eb-stat-label { color: #A4D2F0 !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; margin: 0; }

.eb-programs { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }
@media (max-width: 768px) { .eb-programs { grid-template-columns: 1fr; } }
.eb-program-card { background: #fff; border-radius: 14px; border: 1px solid #E0E4ED; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.02); }
.eb-program-header-blue { background: linear-gradient(135deg, #0E5089, #1678C2); padding: 1.25rem 1.5rem; }
.eb-program-header-teal { background: linear-gradient(135deg, #003D36, #007A6A); padding: 1.25rem 1.5rem; }
.eb-program-type { font-size: 0.65rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; margin: 0 0 0.25rem 0; }
.eb-program-type-blue { color: #00B49E; }
.eb-program-type-teal { color: #2ECDB8; }
.eb-program-name { color: #fff !important; font-size: 1.35rem; font-weight: 700 !important; margin: 0; }
.eb-program-body { padding: 1.5rem; }

.eb-discipline { display: flex; align-items: flex-start; gap: 0.75rem; }
.eb-discipline + .eb-discipline { margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #F2F4F8; }
.eb-disc-icon-blue { min-width: 40px; height: 40px; background: linear-gradient(135deg, #EDF6FD, #D6ECFA); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
.eb-disc-icon-teal { min-width: 40px; height: 40px; background: linear-gradient(135deg, #E8FBF8, #CCF6F0); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
.eb-disc-title { font-size: 0.95rem; font-weight: 700 !important; color: #0F1629 !important; margin: 0 0 0.25rem 0; }
.eb-disc-desc { font-size: 0.8rem; color: #6B7899; line-height: 1.5; margin: 0; }
.eb-disc-tags { margin-top: 0.5rem; }
.eb-tag-blue { display: inline-block; background: #EDF6FD; color: #1264A5; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px; margin-right: 0.25rem; }
.eb-tag-teal { display: inline-block; background: #E8FBF8; color: #009985; font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 4px; }

/* Link da disciplina - clicável */
.eb-disc-link { text-decoration: none !important; color: inherit !important; display: flex; align-items: flex-start; gap: 0.75rem; flex: 1; border-radius: 10px; padding: 0.5rem; margin: -0.5rem; transition: background 0.2s; }
.eb-disc-link:hover { background: #F2F4F8; }
.eb-disc-link:hover .eb-disc-title { color: #1264A5 !important; }

.eb-infobar { background: #fff; border-radius: 14px; border: 1px solid #E0E4ED; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); margin-bottom: 1.5rem; }
.eb-info-item { display: flex; align-items: center; gap: 0.75rem; }
.eb-info-icon-blue { width: 36px; height: 36px; background: #EDF6FD; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
.eb-info-icon-teal { width: 36px; height: 36px; background: #E8FBF8; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
.eb-info-title { font-size: 0.8rem; font-weight: 700; color: #0F1629; margin: 0; }
.eb-info-sub { font-size: 0.7rem; color: #6B7899; margin: 0; }

/* Botão "Ver disciplinas" */
.eb-program-footer { padding: 0 1.5rem 1.25rem; }
.eb-btn-outline {
    display: inline-flex; align-items: center; gap: 0.4rem;
    padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600;
    text-decoration: none !important; transition: all 0.2s; cursor: pointer;
}
.eb-btn-outline-blue {
    color: #1264A5 !important; border: 1.5px solid #A4D2F0; background: transparent;
}
.eb-btn-outline-blue:hover { background: #EDF6FD; border-color: #1264A5; }
.eb-btn-outline-teal {
    color: #009985 !important; border: 1.5px solid #CCF6F0; background: transparent;
}
.eb-btn-outline-teal:hover { background: #E8FBF8; border-color: #009985; }

/* Admin quick-access - só aparece para admin */
.eb-admin-bar {
    background: #fff; border-radius: 14px; border: 1px solid #E0E4ED;
    padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04); margin-bottom: 1.5rem;
    flex-wrap: wrap;
}
.eb-admin-label { font-size: 0.75rem; font-weight: 600; color: #6B7899; text-transform: uppercase; letter-spacing: 0.08em; }
.eb-admin-link {
    display: inline-flex; align-items: center; gap: 0.35rem;
    padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 500;
    text-decoration: none !important; color: #1264A5 !important; background: #EDF6FD; transition: all 0.2s;
}
.eb-admin-link:hover { background: #D6ECFA; }

/* Header clicável do programa */
.eb-program-header-link { text-decoration: none !important; display: block; }
.eb-program-header-link:hover .eb-program-header-blue,
.eb-program-header-link:hover .eb-program-header-teal { filter: brightness(1.1); }
.eb-header-arrow { opacity: 0.5; transition: all 0.2s; font-size: 1rem; }
.eb-program-header-link:hover .eb-header-arrow { opacity: 1; margin-left: 0.25rem; }

/* === PÁGINA DE CATEGORIA (Mestrado/Doutorado) === */
.subcategories .card,
.course-listing .card { border-radius: 14px !important; }

/* Hero da categoria */
.eb-cat-hero {
    background: linear-gradient(135deg, #062A4A 0%, #0E5089 100%);
    border-radius: 18px; padding: 2rem 2.5rem; margin-bottom: 2rem;
    position: relative; overflow: hidden;
}
.eb-cat-hero-teal {
    background: linear-gradient(135deg, #003D36 0%, #007A6A 100%);
}
.eb-cat-hero .eb-hero-label { color: #00B49E; }
.eb-cat-hero h1 { color: #fff !important; font-size: 1.75rem; margin: 0 0 0.5rem 0; }
.eb-cat-hero p { color: #A4D2F0; font-size: 0.9rem; margin: 0; max-width: 500px; line-height: 1.6; }

.eb-frontpage-layout { display: none; }
#page-site-index .eb-frontpage-layout { display: block; margin: 0 auto; max-width: 1400px; padding: 1.5rem 2rem 0; }

/* Alargar o conteúdo do Moodle em todas as páginas */
#page.drawers .main-inner { max-width: 1400px !important; margin: 0 auto; }
#page.drawers #region-main-box { max-width: 100% !important; }
.pagelayout-coursecategory #region-main { max-width: 1200px; margin: 0 auto; }
.pagelayout-coursecategory .course-listing { max-width: 100%; }
#page-wrapper #page { max-width: 100%; }
#page-wrapper #page.drawers .main-inner { max-width: 1400px !important; }

/* Esconder TUDO do Moodle padrão na frontpage — nosso layout é suficiente */
#page-site-index #region-main-box { display: none !important; }
#page-site-index .secondary-navigation { display: none !important; }
#page-site-index #region-main { display: none !important; }
#page-site-index #page-content { display: none !important; }
#page-site-index .drawers { padding-bottom: 0 !important; }
#page-site-index #topofscroll { display: none !important; }
#page-site-index .main-inner { display: none !important; }

/* Esconder footer padrão do Moodle na frontpage */
#page-site-index #page-footer { display: none !important; }

/* FOOTER CUSTOM */
.eb-footer {
    background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%);
    border-radius: 18px 18px 0 0;
    padding: 2.5rem 2.5rem 1.5rem;
    margin-top: 1rem;
    color: #A4D2F0;
}
.eb-footer-grid {
    display: grid; grid-template-columns: 2fr 1fr 1fr;
    gap: 2rem; margin-bottom: 2rem;
}
@media (max-width: 768px) { .eb-footer-grid { grid-template-columns: 1fr; } }

.eb-footer-brand h3 {
    color: #fff !important; font-size: 1.25rem; font-weight: 700 !important; margin: 0 0 0.25rem 0;
}
.eb-footer-brand .eb-footer-accent {
    color: #00B49E !important;
}
.eb-footer-brand p {
    font-size: 0.85rem; line-height: 1.6; color: #A4D2F0; margin: 0.75rem 0 0 0; max-width: 350px;
}
.eb-footer-bar-small {
    width: 40px; height: 2px; background: linear-gradient(90deg, #00B49E, #1678C2);
    border-radius: 2px; margin: 0.75rem 0;
}

.eb-footer-col h4 {
    color: #fff !important; font-size: 0.8rem; font-weight: 600 !important;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 1rem 0;
}
.eb-footer-col a {
    display: block; color: #A4D2F0 !important; text-decoration: none !important;
    font-size: 0.85rem; padding: 0.3rem 0; transition: color 0.2s;
}
.eb-footer-col a:hover { color: #2ECDB8 !important; }

.eb-footer-divider {
    border: none; border-top: 1px solid rgba(164, 210, 240, 0.15); margin: 0 0 1rem 0;
}
.eb-footer-bottom {
    display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;
}
.eb-footer-copy { font-size: 0.75rem; color: rgba(164, 210, 240, 0.6); margin: 0; }
.eb-footer-links { display: flex; gap: 1.5rem; }
.eb-footer-links a {
    font-size: 0.75rem; color: rgba(164, 210, 240, 0.6) !important;
    text-decoration: none !important; transition: color 0.2s;
}
.eb-footer-links a:hover { color: #2ECDB8 !important; }
</style>
CSSEOF;

// HTML do layout com links clicáveis para os cursos
$html = <<<'HTMLEOF'
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
            <a href="/course/index.php?categoryid=3" class="eb-program-header-link">
                <div class="eb-program-header-blue">
                    <p class="eb-program-type eb-program-type-blue">Programa</p>
                    <h2 class="eb-program-name">Mestrado <span class="eb-header-arrow">→</span></h2>
                </div>
            </a>
            <div class="eb-program-body">
                <div class="eb-discipline">
                    <a href="/course/view.php?id=2" class="eb-disc-link">
                        <div class="eb-disc-icon-blue">📐</div>
                        <div>
                            <h3 class="eb-disc-title">Metodologia Científica e do Ensino Superior</h3>
                            <p class="eb-disc-desc">Pesquisa científica, redação acadêmica e práticas pedagógicas</p>
                            <div class="eb-disc-tags"><span class="eb-tag-blue">60h</span><span class="eb-tag-teal">4 créditos</span></div>
                        </div>
                    </a>
                </div>
                <div class="eb-discipline">
                    <a href="/course/view.php?id=3" class="eb-disc-link">
                        <div class="eb-disc-icon-blue">📊</div>
                        <div>
                            <h3 class="eb-disc-title">Métodos Matemáticos para Análise de Dados</h3>
                            <p class="eb-disc-desc">Estatística, álgebra linear e aprendizado de máquina aplicados</p>
                            <div class="eb-disc-tags"><span class="eb-tag-blue">60h</span><span class="eb-tag-teal">4 créditos</span></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="eb-program-footer">
                <a href="/course/index.php?categoryid=3" class="eb-btn-outline eb-btn-outline-blue">Ver todas as disciplinas →</a>
            </div>
        </div>

        <div class="eb-program-card">
            <a href="/course/index.php?categoryid=4" class="eb-program-header-link">
                <div class="eb-program-header-teal">
                    <p class="eb-program-type eb-program-type-teal">Programa</p>
                    <h2 class="eb-program-name">Doutorado <span class="eb-header-arrow">→</span></h2>
                </div>
            </a>
            <div class="eb-program-body">
                <div class="eb-discipline">
                    <a href="/course/view.php?id=4" class="eb-disc-link">
                        <div class="eb-disc-icon-teal">🔬</div>
                        <div>
                            <h3 class="eb-disc-title">Tópicos Avançados em Engenharia Biomédica</h3>
                            <p class="eb-disc-desc">Bioinstrumentação, IA em saúde e nanotecnologia biomédica</p>
                            <div class="eb-disc-tags"><span class="eb-tag-blue">60h</span><span class="eb-tag-teal">4 créditos</span></div>
                        </div>
                    </a>
                </div>
                <div class="eb-discipline">
                    <a href="/course/view.php?id=5" class="eb-disc-link">
                        <div class="eb-disc-icon-teal">🧬</div>
                        <div>
                            <h3 class="eb-disc-title">Fundamentos de Citologia e Histologia</h3>
                            <p class="eb-disc-desc">Estrutura celular, microscopia e engenharia de tecidos</p>
                            <div class="eb-disc-tags"><span class="eb-tag-blue">45h</span><span class="eb-tag-teal">3 créditos</span></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="eb-program-footer">
                <a href="/course/index.php?categoryid=4" class="eb-btn-outline eb-btn-outline-teal">Ver todas as disciplinas →</a>
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

    <!-- Barra admin - links rápidos para administração -->
    <div class="eb-admin-bar">
        <span class="eb-admin-label">⚙️ Admin:</span>
        <a href="/admin/search.php" class="eb-admin-link">Administração do Site</a>
        <a href="/admin/settings.php?section=frontpagesettings" class="eb-admin-link">Config. Página Inicial</a>
        <a href="/course/management.php" class="eb-admin-link">Gerenciar Cursos</a>
        <a href="/admin/user.php" class="eb-admin-link">Usuários</a>
        <a href="/report/log/index.php" class="eb-admin-link">Relatórios</a>
    </div>

    <!-- FOOTER -->
    <div class="eb-footer">
        <div class="eb-footer-grid">
            <div class="eb-footer-brand">
                <h3>Engenharia <span class="eb-footer-accent">Biomédica</span></h3>
                <div class="eb-footer-bar-small"></div>
                <p>Programa de Pós-Graduação dedicado à formação de pesquisadores e profissionais na interface entre engenharia e ciências da saúde.</p>
            </div>
            <div class="eb-footer-col">
                <h4>Programas</h4>
                <a href="/course/index.php?categoryid=3">Mestrado</a>
                <a href="/course/index.php?categoryid=4">Doutorado</a>
                <a href="/course/index.php?categoryid=2">Todos os Cursos</a>
            </div>
            <div class="eb-footer-col">
                <h4>Acesso Rápido</h4>
                <a href="/login/index.php">Entrar</a>
                <a href="/my/">Meu Painel</a>
                <a href="/calendar/view.php">Calendário</a>
                <a href="/admin/search.php">Administração</a>
            </div>
        </div>
        <hr class="eb-footer-divider">
        <div class="eb-footer-bottom">
            <p class="eb-footer-copy">© 2026 Engenharia Biomédica — Programa de Pós-Graduação. Todos os direitos reservados.</p>
            <div class="eb-footer-links">
                <a href="#">Termos de Uso</a>
                <a href="#">Privacidade</a>
                <a href="#">Contato</a>
            </div>
        </div>
    </div>

</div>
HTMLEOF;

set_config('additionalhtmlhead', $css);
set_config('additionalhtmltopofbody', $html);

// Frontpage mostra categorias abaixo do layout custom
set_config('frontpage', '3');
set_config('frontpageloggedin', '3');
set_config('defaulthomepage', 0);

// Atualizar descrições das categorias com conteúdo rico
$mestrado_desc = '<div class="eb-cat-hero"><p class="eb-hero-label">Programa de Mestrado</p><h1>Mestrado em Engenharia Biomédica</h1><div class="eb-hero-bar"></div><p>Formação de pesquisadores com domínio de métodos científicos e tecnologias aplicadas à saúde. Duração: 24 meses. Dissertação obrigatória.</p></div>';

$doutorado_desc = '<div class="eb-cat-hero eb-cat-hero-teal"><p class="eb-hero-label">Programa de Doutorado</p><h1>Doutorado em Engenharia Biomédica</h1><div class="eb-hero-bar"></div><p>Formação de pesquisadores autônomos com capacidade de gerar conhecimento original na fronteira da engenharia biomédica. Duração: 48 meses.</p></div>';

$DB->update_record('course_categories', (object)['id' => 3, 'description' => $mestrado_desc, 'descriptionformat' => 1]);
$DB->update_record('course_categories', (object)['id' => 4, 'description' => $doutorado_desc, 'descriptionformat' => 1]);

echo "Categorias atualizadas com descrições ricas.\n";

purge_all_caches();
echo "Pronto! Layout v3 aplicado com links clicáveis.\n";
