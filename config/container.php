<?php

use Slim\Views\Twig;
use Slimple\Controllers\StaticPageController;

return [
    'settings'=>['displayErrorDetails' => true],
    Twig::class => function (\Interop\Container\ContainerInterface $container)
    {
        $view = new Twig(__DIR__.'/../templates', [
            'cache' => false
        ]);

        // Instantiate and add Slim specific extension
        $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

        return $view;
    },
    StaticPageController::class => function (\Interop\Container\ContainerInterface $container)
    {
        return new StaticPageController($container->get(Twig::class));
    }
];