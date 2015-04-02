<?php

use RouterOsStumbler\Entity\Site;
use RouterOsStumbler\Entity\Survey;

$app->get('/surveys', function () use ($app, $entityManager) {

    $survey = new Survey("Surveyname");
    $entityManager->persist($survey);
    $entityManager->flush();

    $surveys = $entityManager->getRepository(Survey::class)->findAll();

    $app->render('surveys/index.php', ['surveys' => $surveys]);

});

$app->post('/surveys', function() use($app, $entityManager)
{
    $request = $app->request();
    $surveyName = $request->get('name');

    $survey = new Survey($surveyName);
    $entityManager->persist($survey);
    $entityManager->flush();

    return $app->redirectTo('/survey/:surveyId', [$site->getId()]);

});

$app->get('/survey/:surveyId', function($siteId) use ($app, $entityManager)
{
    $site = $entityManager->getRepository(Site::class)->find($siteId);
    $survey = new Survey($site);

    $entityManager->persist($survey);
    $entityManager->flush();

    $_SESSION['surveyId'] = $survey->getId();

    return $app->render('scan.php', ['site' => $site, 'survey' => $survey]);
});

$app->get('/survey/:surveyId/scan', function($surveyId) use ($app, $routerboardScanResultReader, $entityManager)
{
    $scanResults = $routerboardScanResultReader->read();

    $survey = $entityManager->getRepository(Survey::class)->find($surveyId);

    foreach($scanResults as $scanResult) $survey->addScan($scanResult);

    $entityManager->persist($survey);
    $entityManager->flush();

    $response = $app->response();
    $response->setBody(json_encode($scanResults));

    return $response;

});