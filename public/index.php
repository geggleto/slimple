<?php

use App\Infrastructure\Cors\CorsAction;
use App\Infrastructure\Cors\CorsMiddleware;
use App\MyApp;

include_once __DIR__ . '/../vendor/autoload.php';

session_name('app');
session_start();

$app = new MyApp(); //env is loaded here

$app->options('/{name:.+}', CorsAction::class);

$app->add(CorsMiddleware::class);

$app->run();
