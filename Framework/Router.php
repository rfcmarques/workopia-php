<?php

namespace Framework;

use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;

class Router
{
    protected $routes = [];

    /**
     * Add a new route
     * 
     * @param string $uri
     * @param string $uri
     * @param string $action
     * @param array $middleware
     * @return void
     */
    public function add($method, $uri, $action, $middleware = [])
    {
        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }


    /**
     * Add a GET route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function get(string $uri, string $controller, array $middleware = []): void
    {
        $this->add('GET', $uri, $controller, $middleware);
    }


    /**
     * Add a POST route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function post(string $uri, string $controller, array $middleware = []): void
    {
        $this->add('POST', $uri, $controller, $middleware);
    }


    /**
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function put(string $uri, string $controller, array $middleware = []): void
    {
        $this->add('PUT', $uri, $controller, $middleware);
    }


    /**
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function delete(string $uri, string $controller, array $middleware = []): void
    {
        $this->add('DELETE', $uri, $controller, $middleware);
    }


    /**
     * Route the request
     * 
     * @param string $uri
     * @return void
     */
    public function route($uri): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Check for _method input
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            // Split the current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));

            // Split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            $match = true;

            // Check if the number of segments matches
            if (
                count($uriSegments) === count($routeSegments)
                && strtoupper($route['method']) === $requestMethod
            ) {
                $params = [];

                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    // If the uri's do not match and there is no param
                    if (
                        $routeSegments[$i] !== $uriSegments[$i]
                        && !preg_match('/\{(.+?)\}/', $routeSegments[$i])
                    ) {
                        $match = false;
                        break;
                    }

                    // Check for the param and add to $params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }

                if ($match) {

                    foreach ($route['middleware'] as $middleware) {
                        (new Authorize())->handle($middleware);
                    }

                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }

        ErrorController::notFound();
    }
}
