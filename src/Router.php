<?php


namespace Source;

use Source\Exceptions\HttpException;

/**
 * Class Router
 * @package Source
 */
class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param string $pattern
     * @param $callback
     */
    public function add(string $method, string $pattern, $callback)
    {
        $method = strtolower($method);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        $this->routes[$method][$pattern] = $callback;
    }

    /**
     * @return string
     */
    public function run()
    {
        $url = $this->getCurrentUrl();
        $method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $method = strtolower($method);

        if (empty($method)) {
            throw new HttpException('Página não encontrada - 404', 404);
        }

        foreach ($this->routes[$method] as $route => $action) {
            if (preg_match($route, $url, $params)) {
                // return $action($params);
                return compact('action', 'params');
            }
        }

        throw new HttpException('Página não encontrada - 404', 404);
    }

    /**
     * @return mixed|string
     */
    public function getCurrentUrl()
    {
        $url = $_SERVER['PATH_INFO'] ?? '/';

        if (strlen($url) > 1) {
            $url = rtrim($url, '/');
        }

        return $url;
    }
}