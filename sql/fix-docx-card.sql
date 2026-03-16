SET NAMES utf8mb4;

UPDATE mdl_course_sections SET summary = REPLACE(summary, '</div>\n</div>', '
<a href="/materiais/metodologia-cientifica/normas/Modelo_TCC_Completo_ABNT.docx" target="_blank" class="eb-pdf-card eb-docx-card">
<div class="eb-pdf-icon eb-docx-icon">
<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
</div>
<div class="eb-pdf-info">
<strong>Modelo TCC Completo ABNT</strong>
<p>Template Word pronto para uso — capa, sumário, referências</p>
<span class="eb-pdf-badge eb-docx-badge">DOCX — Template</span>
</div>
</a>
</div>
</div>') WHERE id IN (SELECT id FROM (SELECT id FROM mdl_course_sections WHERE course=2 AND section=2) t);
