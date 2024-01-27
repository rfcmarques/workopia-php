<?php

class Router
{
    protected $routes = [];

    /**
     * Add a new route
     * 
     * @param string $uri
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }


    /**
     * Add a GET route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function get(string $uri, string $controller): void
    {
        $this->add('GET', $uri, $controller);
    }

    /**
     * Add a POST route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function post(string $uri, string $controller): void
    {
        $this->add('POST', $uri, $controller);
    }

    /**
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function put(string $uri, string $controller): void
    {
        $this->add('PUT', $uri, $controller);
    }

    /**
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function delete(string $uri, string $controller): void
    {
        $this->add('DELETE', $uri, $controller);
    }

    /**
     * Load error page
     * 
     * @param int $httpCode
     * @return void
     */
    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }


    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri, $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require basePath('App/' . $route['controller']);
                return;
            }
        }

        $this->error();
    }
}
