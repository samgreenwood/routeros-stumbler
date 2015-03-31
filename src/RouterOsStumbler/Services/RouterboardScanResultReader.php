<?php namespace RouterOsStumbler\Services;

use PEAR2\Net\RouterOS;
use RouterOsStumbler\Routerboard;
use RouterOsStumbler\ScanResult;

class RouterBoardScanResultReader
{
    /**
     * @var Routerboard
     */
    protected $routerboard;

    /**
     * @param Routerboard $routerboard
     */
    public function __construct(Routerboard $routerboard)
    {
        $this->routerboard = $routerboard;
    }

    /**
     * @return ScanResult[]
     */
    public function read()
    {
        $scanResults = [];

        $client = new RouterOS\Client($this->routerboard->getHost(), $this->routerboard->getUsername(), $this->routerboard->getPassword());

        $scanRequest = new RouterOS\Request("/interface wireless scan");
        $scanRequest->setArgument("number", $this->routerboard->getScanInterface());
        $scanRequest->setArgument("duration", 2);

        $rawResults = $client->sendSync($scanRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

        foreach($rawResults as $rawResult)
        {
            $scanResult = new ScanResult($rawResult->getProperty('ssid'), $rawResult->getProperty('sig'));
            $scanResults[] = $scanResult;
        }

        return $scanResults;
    }
}