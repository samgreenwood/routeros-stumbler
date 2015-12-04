<?php

require 'vendor/autoload.php';

use Slim\Slim;
use Symfony\Component\Yaml\Yaml;
use RouterOsStumbler\Entity\Ubiquiti;
use RouterOsStumbler\Entity\Routerboard;

require 'bootstrap/database.php';

$deviceConfig = Yaml::parse(file_get_contents(__DIR__ . '/config/devices.yml'));

$devices = [];

foreach ($deviceConfig['devices'] as $device) {
    switch ($device['type']) {
        case 'routerboard':
            $devices[$device['name']] = new Routerboard($device['name'], $device['host'], $device['username'], $device['password']);
            break;
        case 'ubiquiti':
            $devices[$device['name']] = new Ubiquiti($device['name'], $device['host'], $device['username'], $device['password']);
            break;
    }
}

session_cache_limiter(false);
session_start();

$app = new Slim([
    'templates.path' => '../templates',
    'view' => new \Slim\Views\Twig(),
]);

require 'routes.php';

$app->run();