<?php

declare(strict_types=1);

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Helper\HelperSet as SymfonyHelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create App
$app = new \Trantor\MyApp();
$entityManager = $app->getContainer()->get(EntityManager::class);
$connection = $entityManager->getConnection();

// Configure Doctrine
$configuration = new Configuration();
$configuration->setAllOrNothing(true);
$configuration->addMigrationsDirectory(
    'Trantor\Infrastructure\Migrations',
    __DIR__ . '/migrations',
);

// DependencyFactory
$dependencyFactory = DependencyFactory::fromConnection(
    new ExistingConfiguration($configuration),
    new ExistingConnection($connection)
);

// Helper Set
$helperSet = new SymfonyHelperSet();
$helperSet->set(new ConnectionHelper($connection), 'db');
$helperSet->set(new EntityManagerHelper($entityManager), 'em');
$helperSet->set(new QuestionHelper(), 'dialog');

// Create Application
$cli = ConsoleRunner::createApplication($helperSet, [
    new DiffCommand($dependencyFactory),
    new DumpSchemaCommand($dependencyFactory),
    new ExecuteCommand($dependencyFactory),
    new GenerateCommand($dependencyFactory),
    new MigrateCommand($dependencyFactory),
    new StatusCommand($dependencyFactory),
    new VersionCommand($dependencyFactory),
]);

$cli->setCatchExceptions(true);

$cli->run();
