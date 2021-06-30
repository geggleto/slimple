<?php
declare(strict_types=1);


namespace App;


use DI\Bridge\Slim\App;
use DI\ContainerBuilder;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Container\ContainerInterface;
use Psr\Container\ContainerInterface as Container;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Trantor\Domain\Accounts\Repositories\AccountRepository;
use Trantor\Domain\Accounts\Services\EmailService;
use Trantor\Domain\Accounts\Services\GetAllBalancesForAccount;
use Trantor\Http\MakePayment;
use Trantor\Util\Session\SessionProxy;

class MyApp extends App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $builder->addDefinitions();
    }
}