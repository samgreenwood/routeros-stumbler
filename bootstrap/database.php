<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [__DIR__ . "/../src/RouterOsStumbler/Entity"];
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_sqlite',
    'path'     => 'stumbler.sqlite'
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);