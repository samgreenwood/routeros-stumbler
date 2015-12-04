<?php namespace RouterOsStumbler\Services;

use PEAR2\Net\RouterOS;
use RouterOsStumbler\Entity\Routerboard;
use RouterOsStumbler\Entity\ScanResult;

class RouterBoardScanResultReader
{
    /**
     * @param Routerboard $routerboard
     * @return \RouterOsStumbler\Entity\ScanResult[]
     */
    public function read(Routerboard $routerboard)
    {
        $scanResults = [];

        $client = new RouterOS\Client($routerboard->getHost(), $routerboard->getUsername(), $routerboard->getPassword());

        $scanRequest = new RouterOS\Request("/interface wireless scan");
        $scanRequest->setArgument("number", $this->routerboard->getScanInterface());
        $scanRequest->setArgument("duration", 2);

        $rawResults = $client->sendSync($scanRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

        foreach($rawResults as $rawResult)
        {
            $scanResult = new ScanResult(
                $rawResult->getProperty('ssid'),
                (int) $rawResult->getProperty('sig'),
                $rawResult->getProperty('address'),
                $rawResult->getProperty('freq'),
                $rawResult->getProperty('band'),
                (int) $rawResult->getProperty('channel-width'),
                (int) $rawResult->getProperty('nf'),
                (int) $rawResult->getProperty('snr')
            );

            $scanResults[] = $scanResult;
        }

        return $scanResults;
    }
}