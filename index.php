<?php

require __DIR__ . '/vendor/autoload.php';

use CoffeeCode\Router\Router;

$route = new Router(URL_BASE);
$route->namespace("Source\Controller");

$route->group(null);
$route->get("/inserir", "Web:insert");
$route->post("/inserir", "Web:insert");
$route->get('/listar', "Web:listItems");
$route->get('/excluir/{id}', "Web:deleteItem");
$route->get('/editar/{index}', "Web:editItem");
$route->post('/editar/{index}', "Web:editItem");
$route->get('/importxlsx', "Web:importXlsx");
$route->post('/importxlsx', "Web:importXlsx");

$route->dispatch();