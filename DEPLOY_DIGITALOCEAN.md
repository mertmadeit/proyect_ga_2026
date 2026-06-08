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
- `LOG_CHANNEL=stderr`
- `LOG_LEVEL=info`
- `DB_CONNECTION=mysql`
- `DB_HOST`
- `DB_PORT=25060`
- `DB_DATABASE=defaultdb`
- `DB_USERNAME`
- `DB_PASSWORD`
- `DB_SSL_MODE=required`
- `DB_SSL_VERIFY_SERVER_CERT=false`
- `SESSION_DRIVER=cookie`
- `CACHE_STORE=file`
- `QUEUE_CONNECTION=database`
- `MAIL_MAILER=resend`
- `RESEND_KEY`
- `MAIL_FROM_ADDRESS`
- `MAIL_FROM_NAME=Virelle`

No subas credenciales reales al repositorio. Usa `.env.production.example` solo como checklist.

## Migraciones

El `Procfile` ejecuta `scripts/start-web.sh`, que valida variables requeridas, corre migraciones y cachea Laravel antes de levantar Apache:

```bash
php artisan optimize:clear
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Si el deploy queda en 500, revisa primero los Runtime Logs de DigitalOcean. Con `LOG_CHANNEL=stderr`, Laravel debe mostrar ahi la excepcion real.

Para el primer deploy usa `SESSION_DRIVER=cookie` y `CACHE_STORE=file`; asi la pagina publica no depende de la tabla `sessions` ni de la tabla `cache` para renderizar. Cuando la base ya este estable, puedes volver a `SESSION_DRIVER=database` si lo necesitas.
