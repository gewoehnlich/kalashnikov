<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use Gewoehnlich\Kalashnikov\Core\Router;

$router = new Router();

$router->add('GET', '/', 'WordController@index');

$router->dispatch();
