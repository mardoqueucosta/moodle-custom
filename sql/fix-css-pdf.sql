SET NAMES utf8mb4;

UPDATE mdl_config SET value = CONCAT(value, '
<style>
/* === MATERIAL COMPLEMENTAR === */
.eb-materiais-section { margin: 0; }
.eb-materiais-header { display: flex; align-items: center; gap: 14px; margin-bottom: 20px; }
.eb-materiais-icon { font-size: 36px; }
.eb-materiais-title { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; }
.eb-materiais-desc { font-size: 14px; color: #64748b; margin: 0; }

.eb-pdf-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 14px; }
.eb-pdf-card { display: flex; align-items: center; gap: 14px; padding: 16px; border-radius: 12px; background: #fff; border: 1px solid #e5e7eb; text-decoration: none !important; color: inherit !important; transition: all 0.2s; }
.eb-pdf-card:hover { border-color: #dc2626; box-shadow: 0 4px 12px rgba(220,38,38,0.1); transform: translateY(-2px); }
.eb-pdf-icon { width: 48px; min-width: 48px; height: 48px; background: #fef2f2; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
.eb-pdf-info { flex: 1; min-width: 0; }
.eb-pdf-info strong { display: block; font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 2px; }
.eb-pdf-info p { font-size: 12px; color: #64748b; margin: 0 0 6px 0; }
.eb-pdf-badge { display: inline-block; font-size: 10px; background: #f1f5f9; color: #64748b; padding: 2px 8px; border-radius: 10px; font-weight: 600; }
</style>
') WHERE name='additionalhtmlhead';
