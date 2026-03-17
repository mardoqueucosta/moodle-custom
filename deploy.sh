#!/bin/bash
# Deploy moodle-custom para o servidor de produção
# Uso: bash deploy.sh [--full]
#
# Fluxo: git push → SSH no servidor → git pull → docker compose -f docker-compose.prod.yml up -d
#
# --full  Também envia vídeos e materiais (arquivos grandes, ~1.1GB)
#         Sem essa flag, só atualiza configs, PHP e htaccess
#
# NOTA: config.prod.php não está no git (contém senha).
#       Se configurar servidor novo, copie manualmente antes do primeiro deploy.

set -e

SSH_KEY="$HOME/.ssh/id_rsa"
SERVER="root@129.121.51.237"
PORT="22022"
REMOTE_DIR="/opt/moodle"
COMPOSE_FILE="docker-compose.prod.yml"

SSH_CMD="ssh -i $SSH_KEY -p $PORT $SERVER"

echo "=========================================="
echo "  Deploy: moodle-custom → produção"
echo "=========================================="
echo ""

# 1. Verifica se há alterações não commitadas
if [ -n "$(git status --porcelain)" ]; then
    echo "⚠  Há alterações não commitadas:"
    git status --short
    echo ""
    read -p "Deseja continuar mesmo assim? (s/N) " -n 1 -r
    echo ""
    if [[ ! $REPLY =~ ^[Ss]$ ]]; then
        echo "Deploy cancelado."
        exit 1
    fi
fi

# 2. Push para GitHub
echo "→ Enviando para GitHub..."
git push origin master
echo "  ✓ Push concluído"
echo ""

# 3. Pull no servidor
echo "→ Atualizando servidor (git pull)..."
$SSH_CMD "cd $REMOTE_DIR && git pull origin master"
echo "  ✓ Pull concluído"
echo ""

# 4. Recria container se necessário (usa docker-compose.prod.yml)
echo "→ Atualizando containers..."
$SSH_CMD "cd $REMOTE_DIR && docker compose -f $COMPOSE_FILE up -d --no-deps moodle"
echo "  ✓ Container atualizado"
echo ""

# 5. Envia arquivos grandes se --full
if [ "$1" = "--full" ]; then
    echo "→ Enviando conteúdo (vídeos e materiais, ~1.1GB)..."
    SCP_CMD="scp -i $SSH_KEY -P $PORT"

    # Conteudo (videos + materiais)
    $SCP_CMD -r public/conteudo/ "$SERVER:$REMOTE_DIR/public/conteudo/"
    echo "  ✓ Conteúdo enviado"

    # Recria container para montar os novos arquivos
    $SSH_CMD "cd $REMOTE_DIR && docker compose -f $COMPOSE_FILE up -d --no-deps moodle"
    echo ""
fi

# 6. Purga cache do Moodle
echo "→ Limpando cache do Moodle..."
$SSH_CMD "docker exec moodle_app php /var/www/html/admin/cli/purge_caches.php 2>/dev/null || true"
echo "  ✓ Cache limpo"
echo ""

# 7. Verificação final
echo "→ Verificando servidor..."
STATUS=$($SSH_CMD "curl -s -o /dev/null -w '%{http_code}' https://ead.engenhariabiomedica.com/login/index.php")
if [ "$STATUS" = "200" ]; then
    echo "  ✓ Servidor respondendo (HTTP $STATUS)"
else
    echo "  ⚠ Servidor retornou HTTP $STATUS — verifique!"
fi

echo ""
echo "=========================================="
echo "  ✓ Deploy concluído!"
echo "  🌐 https://ead.engenhariabiomedica.com"
echo "=========================================="
