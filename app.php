<?php

require 'vendor/autoload.php';

use RouterOsStumbler\Entity\Routerboard;
use Slim\Slim;
use Symfony\Component\Yaml\Yaml;

require 'bootstrap/database.php';

$rbConfig = Yaml::parse(file_get_contents(__DIR__ . '/config/routerboard.yml'));

$rbHost = $rbConfig['config']['host'];
$rbUser = $rbConfig['config']['username'];
$rbPassword = $rbConfig['config']['password'];

$routerboard = new Routerboard($rbHost, $rbUser, $rbPassword);
$routerboardScanResultReader = new RouterOsStumbler\Services\RouterBoardScanResultReader($routerboard);

session_cache_limiter(false);
session_start();

$app = new Slim(['templates.path' => '../templates']);

require 'routes.php';

$app->run();