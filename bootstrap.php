<?php

require __DIR__ . "/vendor/autoload.php";

require __DIR__ . "/config/containers.php";

$app = new \Source\App($container);
$app->getConnection();

$router = $app->getRouter();
require __DIR__ . "/config/routes.php";

$app->run();
