# Deploy En DigitalOcean App Platform (Laravel + Vite)

## Error del log

Si el build falla con:

```bash
Running custom build command: php artisan migrate --force ...
could not find driver (Connection: sqlite)
```

El problema es que App Platform esta ejecutando un comando de arranque como `Build Command`.

## Configuracion correcta

En DigitalOcean App Platform:

- `Build Command`: dejalo vacio.
- `Run Command`: dejalo vacio para usar el `Procfile`.
- `HTTP Port`: usa el valor automatico de App Platform.

El repo incluye:

- `Procfile` para servir Laravel desde `public/`.
- `heroku-postbuild` en `package.json` para compilar Vite.
- `ext-pdo_mysql` en `composer.json` para instalar el driver MySQL.

## Variables de entorno

Configura estas variables en el componente web:

- `APP_NAME=Virelle`
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://tu-dominio`
- `APP_KEY`
- `LOG_CHANNEL=stack`
- `LOG_LEVEL=info`
- `DB_CONNECTION=mysql`
- `DB_HOST`
- `DB_PORT=25060`
- `DB_DATABASE=defaultdb`
- `DB_USERNAME`
- `DB_PASSWORD`
- `SESSION_DRIVER=database`
- `CACHE_STORE=database`
- `QUEUE_CONNECTION=database`
- `MAIL_MAILER=resend`
- `RESEND_KEY`
- `MAIL_FROM_ADDRESS`
- `MAIL_FROM_NAME=Virelle`

No subas credenciales reales al repositorio. Usa `.env.production.example` solo como checklist.

## Migraciones

El `Procfile` incluye un proceso `release` para migraciones:

```bash
php artisan migrate --force
```

Si App Platform no ejecuta procesos `release` en tu configuracion, corre manualmente el mismo comando desde la consola/job de DigitalOcean despues del primer deploy.
