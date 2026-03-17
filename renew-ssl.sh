#!/bin/bash
cd /opt/moodle
docker compose run --rm certbot renew --quiet
docker compose restart nginx
