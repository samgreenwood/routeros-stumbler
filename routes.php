<?php

use RouterOsStumbler\Site;

$app->get('/', function () use ($app) {

    $sites = [];

    $app->render('index.php', ['sites' => $sites]);

});

$app->get('/scan/:siteId', function($siteName) use ($app)
{
    $site = new Site($siteName);
    $survey = new Survey($site);

    return $app->render('scan.php', ['site' => $site, 'survey' => $survey]);
});

$app->get('/api/scan', function() use ($app, $routerboardScanResultReader)
{

    $scanResults = $routerboardScanResultReader->read();

    $response = $app->response();
    $response->setBody(json_encode($scanResults));

    return $response;

});