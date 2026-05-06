<?php
/**
 * Simple Router
 */

declare(strict_types=1);

namespace Affronter\Core;

class Router
{
    private Config $config;
    private FlatFileStorage $storage;
    private Auth $auth;

    public function __construct(Config $config, FlatFileStorage $storage, Auth $auth)
    {
        $this->config = $config;
        $this->storage = $storage;
        $this->auth = $auth;
    }

    public function resolve(): array
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
        $path = trim($path, '/');

        // Admin check
        if (str_starts_with($path, 'admin/')) {
            if (!$this->auth->isLoggedIn()) {
                return ['template' => 'login', 'data' => []];
            }
            return ['template' => 'admin/' . substr($path, 6), 'data' => []];
        }

        // Plugin route: plugin/name
        if (preg_match('#^([^/]+)/(.+)$#', $path, $matches)) {
            return ['controller' => 'plugin', 'plugin' => $matches[1], 'action' => $matches[2], 'data' => []];
        }

        // Page from data
        $pageData = $this->storage->get('pages/' . $path) ?: $this->storage->get('pages/home');
        return ['template' => 'home', 'data' => $pageData];
    }
}

