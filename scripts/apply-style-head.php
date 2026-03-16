<?php
define('CLI_SCRIPT', true);
require('/var/www/html/public/config.php');

$style = <<<'CSSEOF'
<style>
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
    background-color: var(--eb-slate-50) !important;
}

/* NAVBAR - gradiente azul/teal */
.navbar {
    background: linear-gradient(135deg, #062A4A 0%, #0E5089 55%, #003D36 100%) !important;
    border-bottom: 3px solid #00B49E !important;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15) !important;
}
.navbar .navbar-brand,
.navbar .nav-link,
.navbar .dropdown-toggle,
.navbar .btn-outline-secondary { color: #fff !important; }
.navbar .nav-link:hover,
.navbar .dropdown-toggle:hover { color: #2ECDB8 !important; }
.navbar .moremenu .nav-link.active { border-bottom-color: #00B49E !important; }

/* LINKS */
a:not(.btn) { color: #1264A5; }
a:not(.btn):hover { color: #007A6A; }

/* BOTÕES */
.btn-primary, .btn-primary:visited {
    background: #1264A5 !important;
    border-color: #0E5089 !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
}
.btn-primary:hover, .btn-primary:focus {
    background: #0E5089 !important;
}
.btn-secondary, .btn-secondary:visited {
    background: #00B49E !important;
    border-color: #009985 !important;
    color: #fff !important;
    border-radius: 8px !important;
}
.btn-secondary:hover { background: #009985 !important; }
.btn-outline-secondary {
    border-color: #E0E4ED !important;
    border-radius: 8px !important;
}

/* CARDS */
.card {
    border-radius: 14px !important;
    border-color: #E0E4ED !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.02) !important;
}

/* COURSEBOX */
.coursebox, .course-info-container {
    border-radius: 14px !important;
    border: 1px solid #E0E4ED !important;
    background: #fff !important;
    padding: 1.5rem !important;
    margin-bottom: 1rem !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
    transition: all 0.25s ease !important;
}
.coursebox:hover, .course-info-container:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important;
    border-color: #A4D2F0 !important;
    transform: translateY(-2px);
}

.coursebox .coursename a,
.course-info-container .coursename a {
    color: #0E5089 !important;
    font-weight: 700 !important;
    font-size: 1.2rem !important;
    text-decoration: none !important;
}
.coursebox .coursename a:hover { color: #009985 !important; }

/* HEADINGS */
h1, h2, h3, h4, h5, h6 {
    font-family: "DM Sans", sans-serif !important;
    font-weight: 700 !important;
    color: #0F1629 !important;
}
h1 { letter-spacing: -0.02em; }
h2 { letter-spacing: -0.01em; }

/* CATEGORY PAGE */
.category-content .coursebox {
    border-left: 4px solid #00B49E !important;
}

/* BREADCRUMB */
.breadcrumb { background: transparent !important; }
.breadcrumb-item a { color: #1264A5 !important; }

/* DRAWER / SIDEBAR */
[data-region="drawer"] {
    background: #fff !important;
    border-color: #E0E4ED !important;
}

/* FOOTER */
#page-footer {
    background: #062A4A !important;
    color: #A4D2F0 !important;
    border-top: 3px solid #00B49E !important;
}
#page-footer a { color: #2ECDB8 !important; }

/* PAGE CONTENT AREA */
#page.drawers {
    background: var(--eb-slate-50) !important;
}
#page-content {
    background: transparent !important;
}
.pagelayout-frontpage #region-main {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}
#region-main-box {
    background: transparent !important;
}

/* ACTIVITY ITEMS (dentro do curso) */
.activity-item {
    border-radius: 10px !important;
    transition: background 0.2s !important;
}
.activity-item:hover {
    background: #EDF6FD !important;
}

/* PROGRESS */
.progress-bar {
    background: linear-gradient(90deg, #1264A5, #00B49E) !important;
}

/* BADGES */
.badge-primary, .badge.bg-primary {
    background: #1264A5 !important;
}

/* TAB NAVIGATION */
.nav-tabs .nav-link.active {
    border-bottom: 3px solid #00B49E !important;
    color: #0E5089 !important;
    font-weight: 600 !important;
}

/* LOGIN */
#page-login-index .card {
    border-radius: 14px !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08) !important;
}

/* DROPDOWN */
.dropdown-menu {
    border-radius: 10px !important;
    border-color: #E0E4ED !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08) !important;
}

/* SEARCH */
.input-group .form-control {
    border-radius: 8px 0 0 8px !important;
}
.input-group .btn {
    border-radius: 0 8px 8px 0 !important;
}

/* SCROLLBAR */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: #F2F4F8; }
::-webkit-scrollbar-thumb { background: #A4D2F0; border-radius: 4px; }
::-webkit-scrollbar-thumb:hover { background: #3A93D5; }
</style>
CSSEOF;

set_config('additionalhtmlhead', $style);
echo "CSS injetado via additionalhtmlhead!\n";

purge_all_caches();
echo "Caches limpos!\n";
echo "Acesse http://localhost:8080 (Ctrl+F5)\n";
