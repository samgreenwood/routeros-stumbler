<?php

use RouterOsStumbler\Entity\Site;
use RouterOsStumbler\Entity\Survey;

$app->get('/surveys', function () use ($app, $entityManager, $devices) {

    $surveys = $entityManager->getRepository(Survey::class)->findAll();

    $app->render('surveys/index.html.twig', ['surveys' => $surveys, 'devices' => array_keys($devices)]);

});

$app->get('/surveys/create', function () use ($app) {
    $app->render('surveys/create.html.twig');
});

$app->post('/surveys', function () use ($app, $entityManager) {
    $request = $app->request();
    $surveyName = $request->post('survey_name');

    $survey = new Survey($surveyName);
    $entityManager->persist($survey);
    $entityManager->flush();

    return $app->redirect('/surveys/' . $survey->getId());
});

$app->get('/surveys/:surveyId', function ($surveyId) use ($app, $entityManager) {
    $survey = $entityManager->getRepository(Survey::class)->find($surveyId);

    $devices = $app->request()->get('devices');

    return $app->render('surveys/scan.html.twig', ['survey' => $survey, 'devices' => $devices]);
});

$app->get('/surveys/:surveyId/scan/:deviceName', function ($surveyId, $deviceName) use ($app, $entityManager, $devices) {

    $device = $devices[$deviceName];

    if ( ! $device) {
        throw new Exception('Device not found');
    } else {
        if ($device instanceof \RouterOsStumbler\Entity\Routerboard) {
            $reader = new \RouterOsStumbler\Services\RouterBoardScanResultReader($device);
            $scanResults = $reader->read();
        }

        $survey = $entityManager->getRepository(Survey::class)->find($surveyId);

        foreach ($scanResults as $scanResult) $survey->addResult($scanResult);

        $entityManager->persist($survey);
        $entityManager->flush();

        $response = $app->response();
        $response->setBody(json_encode($scanResults));

        return $response;
    }
});

$app->get('/surveys/:surveyId/results', function ($surveyId) use ($app, $entityManager) {
    $survey = $entityManager->getRepository(Survey::class)->find($surveyId);
    $ssids = $survey->getSsidsScanned();

    $bestSignals = [];

    foreach ($ssids as $ssid) {
        $bestSignals[$ssid] = $survey->getBestScanResultForSsid($ssid)->getSignalStrength();
    }

    asort($bestSignals);
    $bestSignals = array_reverse($bestSignals);

    return $app->render('surveys/results.html.twig', ['survey' => $survey, 'bestSignals' => $bestSignals]);
});