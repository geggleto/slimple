<?php


namespace Slimple\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class StaticPageController
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * StaticPageController constructor.
     *
     * @param Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function home(Request $request, Response $response, array $args = [])
    {
        return $this->twig->render($response, 'home.twig');
    }
}