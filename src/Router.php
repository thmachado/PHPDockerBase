<?php

namespace Root\App;

class Router
{
    private array $routes;

    public function register(string $method, string $route, array|callable $action): self
    {
        $this->routes[$route][$method] = $action;
        return $this;
    }

    public function get(string $route, array|callable $action): self
    {
        return $this->register('GET', $route, $action);
    }

    public function post(string $route, array|callable $action): self
    {
        return $this->register('POST', $route, $action);
    }

    public function resolve(string $requestUri, string $requestMethod, \PDO $pdo)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route][$requestMethod] ?? null;

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
