<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [__DIR__ . "/../src/RouterOsStumbler/Entity"];
$isDevMode = false;

$dbParams = [
    'driver'   => 'pdo_sqlite',
    'path'     => __DIR__ . '/../database.sqlite'
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);