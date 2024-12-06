<?php
namespace App\Routes;

class Routes {
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = compact('method', 'path', 'callback');
    }

    public function dispatch($method, $path) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                call_user_func($route['callback']);
                return;
            }
        }
        echo "404 Not Found";
    }
}
?>
