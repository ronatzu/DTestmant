# Mantsoft

Mantsoft is a polished Laravel demo for a modern CMMS product. It is intended for customer presentations and local MVP validation, not as a production CMMS.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```

Demo credentials after seeding:

- Email: `admin@mantsoft.test`
- Password: `password`

## If you see a 403 error

### Composer / Packagist 403

If the 403 happens during `composer install`, the application code is not rejecting the request. Composer is being blocked before dependencies download, usually by a proxy, VPN, firewall, or restricted CI network.

Try one of these options:

```bash
composer clear-cache
composer install --prefer-dist --no-interaction
```

If your network blocks `repo.packagist.org`, configure Composer to use an approved mirror or run the install from a network that allows Packagist. For corporate networks, ask the network administrator to allow HTTPS access to:

- `repo.packagist.org`
- `packagist.org`
- `github.com`
- `api.github.com`
- `codeload.github.com`

### Browser / Vite 403

If the Laravel page loads but frontend assets fail with a 403 while using a forwarded port, Codespaces, Gitpod, Docker, or a LAN URL, run Vite with the provided config:

```bash
npm run dev
```

The Vite config allows external dev-server hosts for demo environments.

### Laravel authorization 403

The demo routes are intentionally open for presentation use. If you add auth middleware later, make sure the seeded admin user exists:

```bash
php artisan migrate:fresh --seed
```
