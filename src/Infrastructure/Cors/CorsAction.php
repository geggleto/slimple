<?php
declare(strict_types=1);


namespace App\Infrastructure\Cors;


class CorsAction
{
    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response) {
        return $response->withHeader('Access-Control-Allow-Origin', $request->getHeaderLine('Origin'))
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    }
}