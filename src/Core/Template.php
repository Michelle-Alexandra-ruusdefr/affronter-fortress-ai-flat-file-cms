<?php
/**
 * Template Engine Stub (simple PHP templates)
 */

declare(strict_types=1);

namespace Affronter\Core;

class Template
{
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function render(string $template, array $data): string
    {
        $theme = $this->config->get('site.theme', 'default');
        $templatePath = __DIR__ . '/../../themes/' . $theme . '/templates/' . $template . '.php';

        if (!file_exists($templatePath)) {
            $templatePath = __DIR__ . '/../../themes/default/templates/home.php'; // Fallback
        }

        extract($data, EXTR_SKIP);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }
}

