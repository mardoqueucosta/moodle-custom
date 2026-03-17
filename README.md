# Moodle Custom - Engenharia Biomédica EAD

Plataforma EAD para o programa de Pós-Graduação em Engenharia Biomédica.
Moodle 5.1 dockerizado com customizações de interface, player de vídeo e viewer de PDF.

**Produção:** https://pos.engenhariabiomedica.com

## Stack

- Docker: Moodle (PHP 8.2-apache), MariaDB 10.11, Redis 7, Nginx (reverse proxy + SSL)
- SSL via Let's Encrypt/Certbot

## Estrutura do projeto

```
moodle-custom/
├── public/conteudo/                     ← conteúdo das disciplinas
│   ├── player.html                      ← player genérico (?curso=slug)
│   ├── viewer.html                      ← viewer PDF somente leitura (?file=slug/materiais/X.pdf)
│   └── <curso-slug>/
│       ├── videos/*.mp4                 ← videoaulas (gitignored)
│       └── materiais/*.pdf|*.docx       ← materiais complementares (gitignored)
├── public/                              ← PHP endpoints customizados
│   ├── enrol_programa.php               ← inscrição no programa (mestrado/doutorado)
│   ├── enrol_discipline.php             ← inscrição em disciplina
│   └── enrolled_check.php               ← AJAX: verifica inscrições do aluno
├── nginx/default.conf                   ← Nginx: SSL + proxy + static files
├── htaccess-root.conf                   ← Apache: rewrites (URLs amigáveis)
├── docker-compose.yml                   ← dev (localhost:8080)
├── docker-compose.prod.yml              ← prod (Nginx + Certbot)
├── config.local.php                     ← config Moodle dev (versionado)
├── config.prod.php                      ← config Moodle prod (NÃO versionado)
├── deploy.sh                            ← deploy automatizado (NÃO versionado)
└── .env                                 ← senhas DB prod (NÃO versionado)
```

## Desenvolvimento local

```bash
docker compose up -d
# Acesse http://localhost:8080
```

## Deploy para produção

```bash
bash deploy.sh            # git push + pull no servidor + recreate container
bash deploy.sh --full     # + envia vídeos e materiais via SCP
```

## Configuração inicial do servidor

O servidor precisa de dois arquivos que não estão no git:

1. **`.env`** — senhas do banco de dados
2. **`config.prod.php`** — configuração Moodle de produção
