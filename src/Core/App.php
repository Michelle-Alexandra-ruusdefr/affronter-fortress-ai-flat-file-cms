<?php
/**
 * Core App Class
 */

declare(strict_types=1);

namespace Affronter\Core;

class App
{
    private Config $config;
    private Router $router;
    private Template $template;
    private FlatFileStorage $storage;
    private Auth $auth;

    public function __construct(string $configPath)
    {
        $this->config = new Config($configPath);
        $this->storage = new FlatFileStorage($this->config->get('paths.data'));
        $this->auth = new Auth($this->storage);
        $this->router = new Router($this->config, $this->storage, $this->auth);
        $this->template = new Template($this->config);
    }

    public function run(): void
    {
        $route = $this->router->resolve();
        $data = $route['data'] ?? ['title' => 'Home', 'content' => 'Welcome'];

        // Load plugins hooks here later

        echo $this->template->render($route['template'] ?? 'home', $data);
    }
}

