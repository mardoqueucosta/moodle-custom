<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

$css = <<<'CSSEOF'
/* ============================================
   TEMA ENGENHARIA BIOMEDICA
   Cores baseadas em engenhariabiomedica.com
   ============================================ */

@import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap");

:root {
    --eb-primary-50: #EDF6FD;
    --eb-primary-100: #D6ECFA;
    --eb-primary-200: #A4D2F0;
    --eb-primary-400: #3A93D5;
    --eb-primary-500: #1678C2;
    --eb-primary-600: #1264A5;
    --eb-primary-700: #0E5089;
    --eb-primary-900: #062A4A;
    --eb-teal-400: #2ECDB8;
    --eb-teal-500: #00B49E;
    --eb-teal-600: #009985;
    --eb-teal-700: #007A6A;
    --eb-slate-50: #F2F4F8;
    --eb-slate-100: #E0E4ED;
    --eb-slate-700: #283352;
    --eb-slate-900: #0F1629;
}

body {
    font-family: "DM Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    color: var(--eb-slate-900) !important;
    background-color: var(--eb-slate-50) !important;
}

.navbar {
    background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%) !important;
    border-bottom: 3px solid var(--eb-teal-500) !important;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15) !important;
}

.navbar .navbar-brand,
.navbar .nav-link,
.navbar .dropdown-toggle {
    color: #fff !important;
}

.navbar .nav-link:hover,
.navbar .dropdown-toggle:hover {
    color: var(--eb-teal-400) !important;
}

a { color: var(--eb-primary-600) !important; }
a:hover { color: var(--eb-teal-700) !important; }

.btn-primary {
    background: var(--eb-primary-600) !important;
    border-color: var(--eb-primary-700) !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
}
.btn-primary:hover {
    background: var(--eb-primary-700) !important;
    border-color: var(--eb-primary-900) !important;
}

.btn-secondary {
    background: var(--eb-teal-500) !important;
    border-color: var(--eb-teal-600) !important;
    color: #fff !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
}
.btn-secondary:hover {
    background: var(--eb-teal-600) !important;
}

.card {
    border-radius: 14px !important;
    border: 1px solid var(--eb-slate-100) !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 20px rgba(0, 0, 0, 0.02) !important;
    transition: box-shadow 0.3s ease, transform 0.2s ease !important;
}
.card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.04) !important;
    transform: translateY(-2px) !important;
}

.coursebox {
    border-radius: 14px !important;
    border: 1px solid var(--eb-slate-100) !important;
    background: #fff !important;
    padding: 1.5rem !important;
    margin-bottom: 1rem !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
    transition: all 0.3s ease !important;
}
.coursebox:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08) !important;
    border-color: var(--eb-primary-200) !important;
}

.coursebox .coursename a {
    color: var(--eb-primary-700) !important;
    font-weight: 700 !important;
    font-size: 1.25rem !important;
}
.coursebox .coursename a:hover {
    color: var(--eb-teal-600) !important;
}

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "DM Sans", sans-serif !important;
    color: var(--eb-slate-900) !important;
    font-weight: 700 !important;
}

h1, .h1 { letter-spacing: -0.02em !important; }
h2, .h2 { letter-spacing: -0.01em !important; }

.breadcrumb {
    background: transparent !important;
    padding: 0.5rem 0 !important;
}
.breadcrumb-item a { color: var(--eb-primary-600) !important; }
.breadcrumb-item.active { color: var(--eb-slate-700) !important; }

[data-region="drawer"] {
    background: #fff !important;
    border-right: 1px solid var(--eb-slate-100) !important;
}

#page-footer {
    background: var(--eb-primary-900) !important;
    color: #fff !important;
    border-top: 3px solid var(--eb-teal-500) !important;
}
#page-footer a { color: var(--eb-teal-400) !important; }

.progress-bar {
    background: linear-gradient(90deg, var(--eb-primary-600), var(--eb-teal-500)) !important;
}

.activity-item {
    border-radius: 10px !important;
    transition: background 0.2s !important;
}
.activity-item:hover {
    background: var(--eb-primary-50) !important;
}

.login-container .card,
#page-login-index .card {
    border-radius: 14px !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08) !important;
}

.badge-primary, .tag {
    background: var(--eb-primary-600) !important;
    border-radius: 6px !important;
}

::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: var(--eb-slate-50); }
::-webkit-scrollbar-thumb { background: var(--eb-primary-200); border-radius: 4px; }
::-webkit-scrollbar-thumb:hover { background: var(--eb-primary-400); }
CSSEOF;

set_config('scss', $css, 'theme_boost');
echo "CSS customizado aplicado!\n";

theme_reset_all_caches();
echo "Cache do tema resetado!\n";

echo "Pronto! Recarregue o Moodle no navegador.\n";
