<?php

require __DIR__.'/vendor/autoload.php';

use CoffeeCode\Router\Router;

$route = new Router(URL_BASE);
$route->namespace("Source\Controller");

$route->group(null);
$route->get("/inserir","Web:insert");
$route->post("/inserir","Web:insert");
$route->get('/listar',"Web:listItems");
$route->get('/excluir/{id}',"Web:deleteItem");

$route->dispatch();