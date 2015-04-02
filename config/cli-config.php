<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once __DIR__ . '/../bootstrap/database.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $entityManager;

return ConsoleRunner::createHelperSet($entityManager);