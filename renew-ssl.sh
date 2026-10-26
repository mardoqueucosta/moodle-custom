#!/bin/bash
# Renova os certificados do Let's Encrypt do volume certbot-etc (pos., cursos.cultivee e os outros).
# Roda todo dia pelo crontab do root; o certbot só renova o que vence em menos de 30 dias.
# Até 26/10/2026 o cron era de 2 em 2 meses, este arquivo não tinha permissão de execução e o
# compose usado não era o do servidor: o certificado da pós venceu em 15/06/2026 sem aviso.
cd /opt/moodle
echo "$(date -Is) renovando"
docker compose -f docker-compose.prod.yml run --rm certbot renew --quiet
docker exec moodle_nginx nginx -s reload
for d in pos.engenhariabiomedica.com cursos.cultivee.com.br; do
  fim=$(echo | timeout 10 openssl s_client -servername $d -connect 127.0.0.1:443 2>/dev/null | openssl x509 -noout -enddate | cut -d= -f2)
  dias=$(( ($(date -d "$fim" +%s) - $(date +%s)) / 86400 ))
  [ "$dias" -lt 20 ] && echo "$(date -Is) ATENÇÃO: o certificado de $d vence em $dias dias" || echo "$(date -Is) $d ok, vence em $dias dias"
done
