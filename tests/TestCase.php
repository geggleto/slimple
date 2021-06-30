<?php
declare(strict_types=1);


namespace Tests;


use Doctrine\ORM\EntityManager;

use Faker\Factory;
use Faker\Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Psr\Container\ContainerInterface;
use Slim\App;
use Trantor\MyApp;

abstract class TestCase extends PHPUnit_TestCase
{
    use MockeryPHPUnitIntegration;

    protected EntityManager $entityManager;
    protected static ?App $app = null;
    protected static ?ContainerInterface $container = null;
    protected Generator $faker;

    public function setUp(): void
    {
        /** @var EntityManager $entityManager */
        $this->entityManager = $this->getDependency(EntityManager::class);

        $this->entityManager->getConnection()
            ->beginTransaction();

        $this->faker = Factory::create();
    }

    public function tearDown(): void
    {
        $this->entityManager->rollback();
    }

    public static function setUpBeforeClass(): void
    {
        if (self::$app !== null) {
            return;
        }

        self::$app = new MyApp();
        self::$container = self::$app->getContainer();
    }

    protected function getDependency(string $key)
    {
        return self::$container->get($key);
    }
}