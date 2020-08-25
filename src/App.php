<?php

namespace Source;

use App\Models\Database;
use Pimple\Container;
use Source\Response;
use Source\Router;
use Source\Exceptions\HttpException;

class App
{
    private $container;

    public function __construct(Container $container = null)
    {
        $this->container = $container;
        if($this->container === null){
            $this->container = new Container();
        }
    }

    public function getRouter()
    {
        if (!$this->container->offsetExists('router')) {
            $this->container['router'] = function () {
                return new Router();
            };
        }
        return $this->container['router'];
    }

    public function getResponder()
    {
        if (!$this->container->offsetExists('responder')) {
            $this->container['responder'] = function () {
                return new Response();
            };
        }
        return $this->container['responder'];
    }

    public function getConnection()
    {
        if (!$this->container->offsetExists('database')) {
            $this->container['database'] = function () {
                return new Database();
            };
        }
        return $this->container['database'];
    }

    public function run()
    {
        try {
            $result = $this->getRouter()->run();

            $response = $this->getResponder();
            $params = [
                'container' => $this->container,
                'params' => $result['params']
            ];

            $response($result['action'], $params);

            //echo $route->run();
        } catch (HttpException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}