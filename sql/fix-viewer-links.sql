SET NAMES utf8mb4;

UPDATE mdl_course_sections SET summary = REPLACE(summary,
    'href="/materiais/metodologia-cientifica/normas/ABNT-NBR-14724-2024.pdf" target="_blank"',
    'href="/materiais/viewer.html?file=/materiais/metodologia-cientifica/normas/ABNT-NBR-14724-2024.pdf&title=NBR 14724:2024" target="_blank"'
) WHERE course=2 AND section=2;

UPDATE mdl_course_sections SET summary = REPLACE(summary,
    'href="/materiais/metodologia-cientifica/normas/ABNT-NBR-6023-2025.pdf" target="_blank"',
    'href="/materiais/viewer.html?file=/materiais/metodologia-cientifica/normas/ABNT-NBR-6023-2025.pdf&title=NBR 6023:2025" target="_blank"'
) WHERE course=2 AND section=2;

UPDATE mdl_course_sections SET summary = REPLACE(summary,
    'href="/materiais/metodologia-cientifica/normas/ABNT-NBR-10520-2023.pdf" target="_blank"',
    'href="/materiais/viewer.html?file=/materiais/metodologia-cientifica/normas/ABNT-NBR-10520-2023.pdf&title=NBR 10520:2023" target="_blank"'
) WHERE course=2 AND section=2;

UPDATE mdl_course_sections SET summary = REPLACE(summary,
    'href="/materiais/metodologia-cientifica/normas/ABNT-NBR-6027-2012-sumario.pdf" target="_blank"',
    'href="/materiais/viewer.html?file=/materiais/metodologia-cientifica/normas/ABNT-NBR-6027-2012-sumario.pdf&title=NBR 6027:2012" target="_blank"'
) WHERE course=2 AND section=2;
