<?php

require 'vendor/autoload.php';

use RouterOsStumbler\Site;
use Slim\Slim;
use Symfony\Component\Yaml\Yaml;

$rbConfig = Yaml::parse(file_get_contents(__DIR__ . '/config/routerboard.yml'));

$rbHost = $rbConfig['config']['host'];
$rbUser = $rbConfig['config']['username'];
$rbPassword = $rbConfig['config']['password'];

require __DIR__ . '/bootstrap/database.php';

$routerboard = new \RouterOsStumbler\Routerboard($rbHost, $rbUser, $rbPassword);
$routerboardScanResultReader = new RouterOsStumbler\Services\RouterBoardScanResultReader($routerboard);

$siteRepository = new \RouterOsStumbler\SiteRepository($pdo, $marshal);

$site = new Site('Test');
$siteRepository->save($site);
var_dump($siteRepository->getAll());

$app = new Slim(['templates.path' => '../templates']);

require 'routes.php';

$app->run();