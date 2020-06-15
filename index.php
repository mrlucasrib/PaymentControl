<?php

require __DIR__.'/vendor/autoload.php';

use CoffeeCode\Router\Router;

$route = new Router(URL_BASE);
$route->namespace("Source\App");

$route->group(null);
$route->get("/inserir","Web:insert");
$route->get('/listar', "Web:listItems");


$route->dispatch();