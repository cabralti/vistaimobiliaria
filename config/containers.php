<?php

use Pimple\Container;

$container = new Container();

/**
 * @return \App\Models\Database
 */
$container['database'] = function () {
    return new \App\Models\Database();
};

/**
 * @return \League\Plates\Engine
 */
$container['view'] = function () {
    return \League\Plates\Engine::create(__DIR__ . "/../templates/" . APP_THEME, "php");
};

