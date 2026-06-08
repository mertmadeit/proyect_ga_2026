# Deploy En Railway (Laravel + Vite)

## 1) Preparar repositorio

Este proyecto ya incluye `railway.json` con `startCommand` para Laravel.

## 2) Crear proyecto en Railway

1. Entra a Railway y crea `New Project`.
2. Elige `Deploy from GitHub Repo`.
3. Selecciona este repositorio y rama principal.

## 3) Crear base de datos

Puedes usar MySQL de Railway o una base externa como DigitalOcean Managed MySQL.

Si usas DigitalOcean, no pegues credenciales en archivos del repo. Configuralas como variables del servicio web en Railway.

## 4) Variables de entorno (servicio web)

Configura estas variables en Railway (servicio de la app):

- `APP_NAME`
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://<tu-dominio-railway>`
- `APP_KEY` (genera una nueva para produccion)
- `LOG_CHANNEL=stack`
- `LOG_LEVEL=info`
- `DB_CONNECTION=mysql`
- `DB_HOST` (host de MySQL; por ejemplo el host externo de DigitalOcean)
- `DB_PORT` (puerto de MySQL; DigitalOcean suele usar `25060`)
- `DB_DATABASE` (nombre de base; por ejemplo `defaultdb`)
- `DB_USERNAME` (usuario de produccion)
- `DB_PASSWORD` (password de produccion)
- `MYSQL_ATTR_SSL_CA` (opcional/recomendado si usas el certificado CA de DigitalOcean)
- `SESSION_DRIVER=database`
- `CACHE_STORE=database`
- `QUEUE_CONNECTION=database`
- `MAIL_MAILER=resend`
- `RESEND_KEY`
- `MAIL_FROM_ADDRESS` (de dominio verificado en Resend)
- `MAIL_FROM_NAME=Virelle`

Nota Resend: `onboarding@resend.dev` solo sirve para pruebas y solo puede enviar al correo dueno de la cuenta Resend. Para enviar a clientes o usuarios reales, verifica tu dominio en Resend y usa un remitente de ese dominio, por ejemplo `noreply@tu-dominio.com`. En Railway escribe `MAIL_FROM_NAME=Virelle` directamente; no uses `"${APP_NAME}"`, porque Railway puede pasarlo como texto literal.

Puedes tomar `.env.production.example` como checklist, pero los valores reales deben vivir en Railway.

## 5) Build command (en Railway Dashboard)

En Settings del servicio web, define `Build Command`:

```bash
composer install --no-dev --optimize-autoloader --no-interaction && npm ci && npm run build
```

## 6) Post deploy / migraciones

El `startCommand` de `railway.json` ya ejecuta migraciones, crea el link de storage y cachea config/rutas/vistas en cada arranque:

```bash
php artisan optimize:clear
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Si quieres correrlo manualmente despues del primer deploy:

```bash
php artisan migrate --force
php artisan storage:link
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 7) Verificacion final

1. Abre la URL publica.
2. Prueba login.
3. Prueba `/forgot-password`.
4. Verifica envio de correo con Resend.
