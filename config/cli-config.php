<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/../bootstrap/database.php';

return ConsoleRunner::createHelperSet($entityManager);