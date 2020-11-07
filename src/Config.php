<?php
$db = parse_url(getenv("DATABASE_URL"));

define('URL_BASE', '');
define("DATA_LAYER_CONFIG", [
    "driver" => "pgsql",
    "host" => $db['host'],
    "port" => $db['port'],
    "dbname" => ltrim($db['path'], "/"),
    "username" => $db['user'],
    "passwd" => $db['pass'],
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);