<?php

use RouterOsStumbler\Entity\Site;
use RouterOsStumbler\Entity\Survey;

$app->get('/surveys', function () use ($app, $entityManager) {

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

    return $app->redirectTo('/surveys/:surveyId', [$site->getId()]);

});

$app->get('/surveys/:surveyId', function($surveyId) use ($app, $entityManager)
{
    $survey = $entityManager->getRepository(Survey::class)->find($surveyId);

    return $app->render('surveys/scan.php', ['survey' => $survey]);
});

$app->get('/surveys/:surveyId/scan', function($surveyId) use ($app, $routerboardScanResultReader, $entityManager)
{
    $scanResults = $routerboardScanResultReader->read();

    $survey = $entityManager->getRepository(Survey::class)->find($surveyId);

    foreach($scanResults as $scanResult) $survey->addResult($scanResult);

    $entityManager->persist($survey);
    $entityManager->flush();

    $response = $app->response();
    $response->setBody(json_encode($scanResults));

    return $response;

});

$app->get('/surveys/:surveyId/results', function($surveyId) use ($app, $entityManager)
{
    $survey = $entityManager->getRepository(Survey::class)->find($surveyId);

    $_SESSION['surveyId'] = $survey->getId();

    return $app->render('results.php', ['survey' => $survey]);
});