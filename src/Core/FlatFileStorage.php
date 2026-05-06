<?php
/**
 * Flat File Storage (JSON)
 */

declare(strict_types=1);

namespace Affronter\Core;

class FlatFileStorage
{
    private string $dataPath;

    public function __construct(string $dataPath)
    {
        $this->dataPath = rtrim($dataPath, '/') . '/';
    }

    public function get(string $key): ?array
    {
        $file = $this->dataPath . str_replace('/', '_', $key) . '.json';
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true);
            return (json_last_error() === JSON_ERROR_NONE) ? $data : null;
        }
        return null;
    }

    public function set(string $key, array $data): bool
    {
        $file = $this->dataPath . str_replace('/', '_', $key) . '.json';
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) !== false;
    }

    public function listDir(string $dir): array
    {
        $path = $this->dataPath . str_replace('/', '_', $dir) . '_*.json';
        $files = glob($path);
        return array_map(fn($f) => str_replace($this->dataPath, '', basename($f, '.json')), $files);
    }
}

