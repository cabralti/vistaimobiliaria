<?php

/**
 * HOME
 */
$router->add('GET', '/', function () use ($container) {
    return $container['view']->render('index.php', [
        'title' => 'Home '
    ]);
});

/**
 * CLIENTES
 */
$router->add('GET', '/clientes', 'App\Controllers\ClienteController@index');
$router->add('GET', '/clientes/criar', 'App\Controllers\ClienteController@create');
$router->add('POST', '/clientes', 'App\Controllers\ClienteController@store');
$router->add('GET', '/clientes/(\d+)/editar', 'App\Controllers\ClienteController@edit');
$router->add('PUT', '/clientes/(\d+)/editar', 'App\Controllers\ClienteController@update');
$router->add('DELETE', '/clientes/(\d+)/excluir', 'App\Controllers\ClienteController@destroy');

/**
 * PROPRIETÁRIOS
 */
$router->add('GET', '/proprietarios', 'App\Controllers\ProprietarioController@index');
$router->add('GET', '/proprietarios/criar', 'App\Controllers\ProprietarioController@create');
$router->add('POST', '/proprietarios', 'App\Controllers\ProprietarioController@store');
$router->add('GET', '/proprietarios/(\d+)/editar', 'App\Controllers\ProprietarioController@edit');
$router->add('PUT', '/proprietarios/(\d+)/editar', 'App\Controllers\ProprietarioController@update');
$router->add('DELETE', '/proprietarios/(\d+)/excluir', 'App\Controllers\ProprietarioController@destroy');

/**
 * IMÓVEIS
 */
$router->add('GET', '/imoveis', 'App\Controllers\ImovelController@index');
$router->add('GET', '/imoveis/criar', 'App\Controllers\ImovelController@create');
$router->add('POST', '/imoveis', 'App\Controllers\ImovelController@store');
$router->add('GET', '/imoveis/(\d+)/editar', 'App\Controllers\ImovelController@edit');
$router->add('PUT', '/imoveis/(\d+)/editar', 'App\Controllers\ImovelController@update');
$router->add('DELETE', '/imoveis/(\d+)/excluir', 'App\Controllers\ImovelController@destroy');