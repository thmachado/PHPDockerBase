<?php

namespace Root\App;

class Router
{
    private array $routes;

    public function register(string $route, array | callable $action): void
    {
        $this->routes[$route] = $action;
    }

    public function resolve(string $requestUri, \PDO $pdo)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route] ?? null;

        if (!$action) {
            http_response_code(404);
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;
        if (class_exists($class)) {
            $class = new $class($pdo);
            if (method_exists($class, $method)) {
                return call_user_func_array([$class, $method], []);
            }
        }
    }
}
