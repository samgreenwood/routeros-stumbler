<?php

require 'vendor/autoload.php';

use Slim\Slim;
use Symfony\Component\Yaml\Yaml;

$rbConfig = Yaml::parse(file_get_contents(__DIR__ . '/config/routerboard.yml'));

$rbHost = $rbConfig['config']['host'];
$rbUser = $rbConfig['config']['username'];
$rbPassword = $rbConfig['config']['password'];

$routerboard = new \RouterOsStumbler\Routerboard($rbHost, $rbUser, $rbPassword);
$routerboardScanResultReader = new RouterOsStumbler\Services\RouterBoardScanResultReader($routerboard);

$spotConfig = new \Spot\Config();
$spotConfig->addConnection('sqlite', 'sqlite://database.sqlite');
$spot = new \Spot\Locator($spotConfig);

$app = new Slim(['templates.path' => '../templates']);

require 'routes.php';

$app->run();