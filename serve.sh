#!/bin/bash
# Servidor local para testar as paginas antes de enviar ao servidor
# Acesse: http://localhost:8888/videos/metodologia-cientifica/index.html
# Acesse: http://localhost:8888/materiais/viewer.html?file=/materiais/metodologia-cientifica/normas/ABNT-NBR-14724-2024.pdf

PORT=8888
DIR="$(dirname "$0")/public"

echo "Servidor local rodando em http://localhost:$PORT"
echo ""
echo "URLs para testar:"
echo "  Player:  http://localhost:$PORT/videos/metodologia-cientifica/index.html"
echo "  Viewer:  http://localhost:$PORT/materiais/viewer.html?file=/materiais/metodologia-cientifica/normas/ABNT-NBR-14724-2024.pdf"
echo ""
echo "Ctrl+C para parar"
echo ""

cd "$DIR" && python -m http.server $PORT
