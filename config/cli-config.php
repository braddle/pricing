<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once 'vendor/autoload.php';

$paths     = ["config"];
$isDevMode = false;

$dbParams = [
    'driver' => 'pdo_sqlite',
    'path'     => 'pricing.db',
];

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);