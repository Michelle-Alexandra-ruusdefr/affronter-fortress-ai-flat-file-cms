<?php
/**
 * Plugin Loader Stub
 */

declare(strict_types=1);

namespace Affronter\Core;

class PluginLoader
{
    private Config $config;
    private array $plugins = [];

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function load(): void
    {
        $active = $this->config->get('plugins.active', []);
        foreach ($active as $plugin) {
            $manifestPath = __DIR__ . '/../../plugins/' . $plugin . '/manifest.json';
            if (file_exists($manifestPath)) {
                // Load plugin class later
            }
        }
    }

    public function trigger(string $hook, array $args = []): mixed
    {
        // Call plugin hooks
        return null;
    }
}

