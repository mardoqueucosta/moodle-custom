#!/bin/bash
# Deploy moodle-custom
# Uso: bash deploy.sh [local | server] [--all | --html | --materiais | --videos]

SSH_KEY="D:/Google-Drive/01-projetos-claude/id_rsa"
SERVER="root@129.121.51.237"
PORT="22022"
REMOTE_BASE="/var/www/html/public"
LOCAL_BASE="$(dirname "$0")/public"
DOCKER_BASE="C:/moodle-docker/moodle/public"

SSH_CMD="ssh -i $SSH_KEY -p $PORT"
SCP_CMD="scp -i $SSH_KEY -P $PORT"

# ===== LOCAL (Docker) =====
local_html() {
    echo "==> [LOCAL] Copiando HTMLs para Docker..."
    cp "$LOCAL_BASE/videos/metodologia-cientifica/index.html" "$DOCKER_BASE/videos/metodologia-cientifica/index.html"
    cp "$LOCAL_BASE/materiais/viewer.html" "$DOCKER_BASE/materiais/viewer.html"
    echo "    HTMLs copiados."
}

local_materiais() {
    echo "==> [LOCAL] Copiando materiais para Docker..."
    cp "$LOCAL_BASE/materiais/metodologia-cientifica/normas/"* "$DOCKER_BASE/materiais/metodologia-cientifica/normas/"
    echo "    Materiais copiados."
}

local_videos() {
    echo "==> [LOCAL] Copiando videos para Docker..."
    cp "$LOCAL_BASE/videos/metodologia-cientifica/"*.mp4 "$DOCKER_BASE/videos/metodologia-cientifica/"
    echo "    Videos copiados."
}

# ===== SERVER (VPS) =====
server_html() {
    echo "==> [SERVER] Enviando HTMLs..."
    $SCP_CMD "$LOCAL_BASE/videos/metodologia-cientifica/index.html" \
        "$SERVER:$REMOTE_BASE/videos/metodologia-cientifica/index.html"
    $SCP_CMD "$LOCAL_BASE/materiais/viewer.html" \
        "$SERVER:$REMOTE_BASE/materiais/viewer.html"
    echo "    HTMLs enviados."
}

server_materiais() {
    echo "==> [SERVER] Enviando materiais..."
    $SCP_CMD "$LOCAL_BASE/materiais/metodologia-cientifica/normas/"* \
        "$SERVER:$REMOTE_BASE/materiais/metodologia-cientifica/normas/"
    echo "    Materiais enviados."
}

server_videos() {
    echo "==> [SERVER] Enviando videos (1.1GB)..."
    $SCP_CMD "$LOCAL_BASE/videos/metodologia-cientifica/"*.mp4 \
        "$SERVER:$REMOTE_BASE/videos/metodologia-cientifica/"
    echo "    Videos enviados."
}

fix_permissions() {
    echo "==> [SERVER] Corrigindo permissoes..."
    $SSH_CMD "$SERVER" "chown -R www-data:www-data $REMOTE_BASE/videos $REMOTE_BASE/materiais"
    echo "    Permissoes corrigidas."
}

purge_cache() {
    echo "==> [SERVER] Limpando cache do Moodle..."
    $SSH_CMD "$SERVER" "php /var/www/html/admin/cli/purge_caches.php 2>&1"
    echo "    Cache limpo."
}

TARGET="${1:-}"
OPTION="${2:-}"

case "$TARGET" in
    local)
        case "$OPTION" in
            --html)      local_html ;;
            --materiais) local_materiais ;;
            --videos)    local_videos ;;
            --all)       local_html; local_materiais; local_videos ;;
            *)           local_html; echo "(use --all para incluir videos e materiais)" ;;
        esac
        echo ""
        echo "Teste em: http://localhost:8080"
        ;;
    server)
        case "$OPTION" in
            --html)      server_html; fix_permissions ;;
            --materiais) server_materiais; fix_permissions ;;
            --videos)    server_videos; fix_permissions ;;
            --all)       server_html; server_materiais; server_videos; fix_permissions; purge_cache ;;
            *)           server_html; fix_permissions ;;
        esac
        echo ""
        echo "Online em: http://129.121.51.237"
        ;;
    *)
        echo "Deploy Moodle Custom"
        echo ""
        echo "Uso: bash deploy.sh <destino> [opcao]"
        echo ""
        echo "Destinos:"
        echo "  local    Copia para Docker (teste em localhost:8080)"
        echo "  server   Envia para VPS HostGator (producao)"
        echo ""
        echo "Opcoes:"
        echo "  --html       Apenas HTMLs (player + viewer)"
        echo "  --materiais  PDFs e DOCX"
        echo "  --videos     Videos (1.1GB)"
        echo "  --all        Tudo"
        echo ""
        echo "Exemplos:"
        echo "  bash deploy.sh local --html      Testa HTML localmente"
        echo "  bash deploy.sh server --html     Envia HTML para producao"
        echo "  bash deploy.sh server --all      Envia tudo para producao"
        ;;
esac

echo ""
echo "Concluido!"
