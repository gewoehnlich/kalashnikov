<?php

namespace Gewoehnlich\Kalashnikov\Core;

class Router
{
    private array $routes = [];

    public function __construct()
    {
    }

    public function add(
        string $method,
        string $path,
        string $handler,
        array $middleware = []
    ) {
        $this->routes[] = [
            'method'     => strtoupper($method),
            'path'       => rtrim($path, '/'),
            'handler'    => $handler,
            'middleware' => $middleware
        ];
    }

    public function dispatch(): void
    {
        /*header('Content-Type: application/json');*/

        $requestUri = rtrim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($this->match($route, $requestMethod, $requestUri)) {
                try {
                    foreach ($route['middleware'] as $middleware) {
                        if (!class_exists($middleware)) {
                            throw new \Exception("Middleware {$middleware} not found.");
                        }

                        (new $middleware())->handle();
                    }

                    list($controller, $method) = explode('@', $route['handler']);
                    $controllerClass = 'Gewoehnlich\\Kalashnikov\\Controllers\\' . $controller;

                    if (!class_exists($controllerClass)) {
                        http_response_code(500);
                        echo json_encode(['error' => "Controller {$controllerClass} not found"]);
                        return;
                    }

                    $controllerInstance = new ($controllerClass);

                    if (!method_exists($controllerInstance, $method)) {
                        http_response_code(500);
                        echo json_encode(['error' => "Method {$method} not found in {$controllerClass}"]);
                        return;
                    }

                    call_user_func([$controllerInstance, $method]);
                    return;
                } catch (\Exception $e) {
                    http_response_code(500);
                    echo json_encode(['error' => $e->getMessage()]);
                    return;
                }
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function match(
        array $route,
        string $method,
        string $uri
    ): bool {
        return (
            $route['method'] === strtoupper($method) &&
            $route['path'] === $uri
        );
    }
}
