<?php

namespace core\library;

class Router
{
    protected $routes = [];

    public function add(
        string $method,
        string $uri,
        array $route
    ) {
        $this->routes[$method][$uri] = $route;
    }

    public function execute()
    {
        foreach ($this->routes as $request => $routes) {
            if ($request === $_SERVER['REQUEST_METHOD']) {
                return $this->handleUrl($routes);
            }
        }
    }

    private function handleUrl(array $routes)
    {

        foreach ($routes as $uri => $route) {
            [$controller, $action] = $route;
            if ($uri === $_SERVER['REQUEST_URI']) {
                break;
            }

            $pattern = str_replace('/', '\/', $uri);
            if ($uri !== '/' && preg_match("/^$pattern$/", $_SERVER['REQUEST_URI'], $matches)) {
                dump($matches);
            }
        }

        return $this->handleController();
    }

    private function handleController() {}
}
