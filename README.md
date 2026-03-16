# Moodle Custom - Engenharia Biomédica Pós-Graduação

## Objetivo
Customizações do Moodle 5.1 LMS para o curso de Engenharia Biomédica.
Este é o projeto fonte — todas as alterações são feitas aqui e enviadas ao servidor via `deploy.sh`.

## Servidor VPS HostGator
- **URL:** http://129.121.51.237
- **Admin:** admin
- **Senha:** Admin1234!
- **SSH:** ver `../servidor-hostgator.md`

## Stack no servidor
- **SO:** Ubuntu 24.04.4 LTS (Kernel 6.8.0-106)
- **Web Server:** Apache 2.4.58
- **PHP:** 8.3.6
- **Banco de dados:** MariaDB 10.11.14
- **Moodle:** 5.1

## Banco de dados
- **Host:** localhost
- **Database:** moodle
- **Usuário:** moodleuser
- **Senha:** M00dle@DB2024!

## Estrutura do projeto
```
moodle-custom/
├── public/                              ← espelho de /var/www/html/public/ no servidor
│   ├── videos/metodologia-cientifica/
│   │   ├── index.html                   ← player estilo Hotmart
│   │   └── *.mp4                        ← 8 videoaulas (1.1GB)
│   └── materiais/
│       ├── viewer.html                  ← viewer PDF (somente leitura)
│       └── metodologia-cientifica/normas/
│           ├── ABNT-NBR-*.pdf           ← normas ABNT
│           └── Modelo_TCC_Completo_ABNT.docx
├── scripts/                             ← PHP de customização do Moodle
├── sql/                                 ← SQL de customização + backup
├── deploy.sh                            ← envia arquivos para o servidor
├── serve.sh                             ← servidor local para testes
└── docker-compose.yml                   ← referência do Docker original
```

## Como usar

### Testar localmente
```bash
bash serve.sh
# Acesse http://localhost:8888/videos/metodologia-cientifica/index.html
```

### Deploy para o servidor
```bash
bash deploy.sh --html       # envia HTMLs (player + viewer)
bash deploy.sh --materiais  # envia PDFs e DOCX
bash deploy.sh --videos     # envia vídeos (1.1GB)
bash deploy.sh --all        # envia tudo + limpa cache
```

## Estrutura no servidor
```
/var/www/html/               → código fonte do Moodle 5.1
/var/www/html/public/        → DocumentRoot (Apache)
/var/www/moodledata/         → dados do Moodle (uploads, cache, sessões)
/etc/apache2/                → configuração Apache
/etc/php/8.3/                → configuração PHP
/etc/cron.d/moodle           → cron job (executa a cada minuto)
```

## Configurações PHP (99-moodle.ini)
```ini
max_input_vars = 5000
memory_limit = 256M
post_max_size = 100M
upload_max_filesize = 100M
max_execution_time = 300
opcache.enable = 1
```

## Status
- [x] Servidor VPS configurado (Ubuntu 24.04 + LAMP)
- [x] Moodle 5.1 instalado e configurado
- [x] Banco de dados migrado do Docker
- [x] Moodledata migrado do Docker
- [x] Player de videoaulas (estilo Hotmart)
- [x] Viewer de PDF (somente leitura)
- [x] Materiais complementares (normas ABNT + template)
- [x] Estrutura local centralizada com deploy automatizado
- [ ] Configurar domínio + HTTPS (Let's Encrypt)
- [ ] Repositório GitHub
