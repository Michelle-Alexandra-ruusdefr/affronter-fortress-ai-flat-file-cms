# Affronter Fortress AI Flat-File CMS

[![PHP 8+](https://img.shields.io/badge/PHP-8+-green.svg)](https://www.php.net)
[![GPLv3](https://img.shields.io/badge/License-GPLv3-blue.svg)](LICENSE)
[![Flat-File](https://img.shields.io/badge/Storage-Flat%20File-orange.svg)](https://github.com/affronter/fortress-cms)

**Open Source core** flat-file CMS (no DB), highly extensible via plugins. Multilingual (EN/DE/RU). Core is free/open; AI features (newsletter, contact, etc.) as premium plugins for marketplaces like CodeCanyon.

## Features
- PHP 8.0+ native.
- Flat-file storage (JSON).
- Plugin system (hooks/events).
- Admin panel (file manager, plugin mgr).
- Responsive theme (Bootstrap 5).
- Security: CSRF, hashed auth, .htaccess.
- SEO ready.

## Installation
1. Clone: `git clone https://github.com/yourusername/affronter-fortress-ai-flat-file-cms`
2. `composer install` (dev only).
3. Local server: `php -S localhost:8000`
4. Visit http://localhost:8000/install.php → Create admin.
5. Delete install.php.

## Structure
```
/
├── index.php (router)
├── composer.json
├── config/config.json
├── data/ (pages.json, users.json)
├── src/Core/ (classes)
├── admin/
├── plugins/
├── themes/default/
└── lang/
```

## Plugins
Active via config. Example: `/plugins/example/manifest.json`, `example.php`.

## Development
See TODO.md. Run tests: `composer run test`.

## Business Model
- Free core.
- Sell AI plugins/themes on Envato.

**Roadmap**: Articles, Forum, Wiki, etc. as plugins.

Contribute: Fork/PR. Issues welcome.

