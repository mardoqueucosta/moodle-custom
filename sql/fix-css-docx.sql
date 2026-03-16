SET NAMES utf8mb4;

UPDATE mdl_config SET value = CONCAT(value, '
<style>
.eb-docx-card:hover { border-color: #2563eb !important; box-shadow: 0 4px 12px rgba(37,99,235,0.1) !important; }
.eb-docx-icon { background: #eff6ff !important; }
.eb-docx-badge { background: #dbeafe !important; color: #2563eb !important; }
</style>
') WHERE name='additionalhtmlhead';
