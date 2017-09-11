<?php

include_once __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App(new \Slim\Container(include __DIR__.'/../config/container.php'));

include_once __DIR__ . '/../config/routes.php';

$app->run();