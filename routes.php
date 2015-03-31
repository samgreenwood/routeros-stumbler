<?php

$app->get('/', function () use ($app) {

    $sites = [];

    $app->render('index.php', ['sites' => $sites]);

});

$app->get('/scan', function() use ($app)
{
    return $app->render('scan.php');
});

$app->get('/api/scan', function() use ($app, $routerboardScanResultReader)
{
    $scans = $routerboardScanResultReader->read();

    $response = $app->response();
    $response->setBody(json_encode($scans));

    return $response;

});