<?php
/**
 * Config Manager
 */

declare(strict_types=1);

namespace Affronter\Core;

class Config
{
    private array $data;

    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \RuntimeException('Config not found: ' . $path);
        }
        $this->data = json_decode(file_get_contents($path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON in config');
        }
    }

    public function get(string $key, $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
        $this->save();
    }

    private function save(): void
    {
        $path = dirname(debug_backtrace()[1]['file']) . '/../../config/config.json'; // Relative
        file_put_contents($path, json_encode($this->data, JSON_PRETTY_PRINT));
    }
}

