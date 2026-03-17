#!/bin/bash
set -e

echo "=== Deploy Moodle Infrastructure to VPS ==="

SSH_KEY="D:/Google-Drive/01-projetos-claude/id_rsa"
SERVER="root@129.121.51.237"
PORT="22022"
SSH_CMD="ssh -i $SSH_KEY -p $PORT"
SCP_CMD="scp -i $SSH_KEY -P $PORT"
REMOTE_DIR="/opt/moodle"
LOCAL_DIR="$(dirname "$0")"

echo "[1/7] Creating remote directory structure..."
$SSH_CMD $SERVER "mkdir -p $REMOTE_DIR/{nginx,sql,public,scripts}"

echo "[2/7] Copying files to VPS..."
$SCP_CMD "$LOCAL_DIR/Dockerfile" "$SERVER:$REMOTE_DIR/"
$SCP_CMD "$LOCAL_DIR/docker-compose.prod.yml" "$SERVER:$REMOTE_DIR/docker-compose.yml"
$SCP_CMD "$LOCAL_DIR/nginx/default.conf" "$SERVER:$REMOTE_DIR/nginx/"
$SCP_CMD "$LOCAL_DIR/sql/moodle_dump.sql" "$SERVER:$REMOTE_DIR/sql/"
$SCP_CMD "$LOCAL_DIR/public/enrol_programa.php" "$SERVER:$REMOTE_DIR/public/"
$SCP_CMD "$LOCAL_DIR/public/enrol_discipline.php" "$SERVER:$REMOTE_DIR/public/"
$SCP_CMD "$LOCAL_DIR/public/enrolled_check.php" "$SERVER:$REMOTE_DIR/public/"
$SCP_CMD "$LOCAL_DIR/public/.htaccess" "$SERVER:$REMOTE_DIR/public/"
$SCP_CMD "$LOCAL_DIR/htaccess-root.conf" "$SERVER:$REMOTE_DIR/"
$SCP_CMD "$LOCAL_DIR/renew-ssl.sh" "$SERVER:$REMOTE_DIR/"
$SCP_CMD "$LOCAL_DIR/scripts/configure-moodle.php" "$SERVER:$REMOTE_DIR/scripts/"

echo "[3/7] Building and starting containers..."
$SSH_CMD $SERVER "cd $REMOTE_DIR && docker compose up -d --build mariadb redis moodle"

echo "[4/7] Waiting for MariaDB (30s)..."
sleep 30

echo "[5/7] Importing database..."
$SSH_CMD $SERVER "docker exec -i moodle_db mariadb -u moodleuser -pM00dleDB2024Secure moodle < $REMOTE_DIR/sql/moodle_dump.sql"

echo "[6/7] Configuring Moodle for production..."
$SSH_CMD $SERVER 'docker exec moodle_app bash -c "cat > /var/www/html/config.php << '\''PHPEOF'\''
<?php
unset(\$CFG);
global \$CFG;
\$CFG = new stdClass();
\$CFG->dbtype    = '\''mariadb'\'';
\$CFG->dblibrary = '\''native'\'';
\$CFG->dbhost    = '\''mariadb'\'';
\$CFG->dbname    = '\''moodle'\'';
\$CFG->dbuser    = '\''moodleuser'\'';
\$CFG->dbpass    = '\''M00dleDB2024Secure'\'';
\$CFG->prefix    = '\''mdl_'\'';
\$CFG->dboptions = array(
    '\''dbpersist'\'' => 0,
    '\''dbport'\'' => '\'''\'',
    '\''dbsocket'\'' => '\'''\'',
    '\''dbcollation'\'' => '\''utf8mb4_unicode_ci'\'',
);
\$CFG->wwwroot   = '\''https://ead.engenhariabiomedica.com'\'';
\$CFG->dataroot  = '\''/var/www/moodledata'\'';
\$CFG->admin     = '\''admin'\'';
\$CFG->directorypermissions = 0777;
\$CFG->session_handler_class = '\''\core\session\redis'\'';
\$CFG->session_redis_host = '\''redis'\'';
\$CFG->session_redis_port = 6379;
\$CFG->session_redis_database = 0;
\$CFG->session_redis_prefix = '\''moodle_sess_'\'';
\$CFG->sslproxy = true;
require_once(__DIR__ . '\''/lib/setup.php'\'');
PHPEOF"'

echo "[7/7] Installing root .htaccess and applying Moodle settings..."
$SSH_CMD $SERVER "docker cp $REMOTE_DIR/htaccess-root.conf moodle_app:/var/www/html/.htaccess"
$SSH_CMD $SERVER "docker cp $REMOTE_DIR/scripts/configure-moodle.php moodle_app:/tmp/"
$SSH_CMD $SERVER "docker exec moodle_app php /tmp/configure-moodle.php"

# SSL renewal cron
$SSH_CMD $SERVER "chmod +x $REMOTE_DIR/renew-ssl.sh"
$SSH_CMD $SERVER "(crontab -l 2>/dev/null | grep -v renew-ssl; echo '0 3 1 */2 * $REMOTE_DIR/renew-ssl.sh >> /var/log/certbot-renew.log 2>&1') | crontab -"

echo ""
echo "=== Infrastructure deployed! ==="
echo "Next steps:"
echo "  1. Configure DNS: ead.engenhariabiomedica.com -> 129.121.51.237"
echo "  2. Start nginx: ssh ... 'cd /opt/moodle && docker compose up -d nginx'"
echo "  3. Get SSL cert: ssh ... 'cd /opt/moodle && docker compose run --rm certbot certonly --webroot -w /var/www/certbot -d ead.engenhariabiomedica.com --email mardo.abc@gmail.com --agree-tos'"
echo "  4. Restart nginx: ssh ... 'cd /opt/moodle && docker compose restart nginx'"
echo "  5. Test: https://ead.engenhariabiomedica.com"
