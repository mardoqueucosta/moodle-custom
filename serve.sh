#!/bin/bash
# Servidor local para testar as paginas antes de enviar ao servidor
# Acesse: http://localhost:8888/conteudo/player.html?curso=metodologia-cientifica
# Acesse: http://localhost:8888/conteudo/viewer.html?file=metodologia-cientifica/materiais/ABNT-NBR-14724-2024.pdf

PORT=8888
DIR="$(dirname "$0")/public"

echo "Servidor local rodando em http://localhost:$PORT"
echo ""
echo "URLs para testar:"
echo "  Player:  http://localhost:$PORT/conteudo/player.html?curso=metodologia-cientifica"
echo "  Viewer:  http://localhost:$PORT/conteudo/viewer.html?file=metodologia-cientifica/materiais/ABNT-NBR-14724-2024.pdf"
echo ""
echo "Ctrl+C para parar"
echo ""

cd "$DIR" && python -m http.server $PORT
