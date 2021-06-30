<?php

return [
    'displayErrorDetails' => ($_ENV['STAGE'] === 'dev' || $_ENV['STAGE'] === 'ci'),
    'doctrine.types' => require_once __DIR__ . '/../Doctrine/DoctrineTypes.php',
];