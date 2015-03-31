<?php namespace RouterOsStumbler;

class Survey
{
    protected $site;

    protected $date;

    protected $scanResults = [];

    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->date = new \Datetime();
    }

    public function addResult(ScanResult $scanResult)
    {
        $this->scanResults[] = $scanResult;
    }

    public function getBestScanResultForSsid($ssid)
    {
        $scansForSsid = array_filter($this->scanResults, function(ScanResult $scanResult) use ($ssid) {
            return $ssid == $scanResult->getSsid();
        });

        usort($scansForSsid, function(ScanResult $a, ScanResult $b) {
            if ($a->getSignalStrength() == $b->getSignalStrength()) {
                return 0;
            }

            return ($a->getSignalStrength() < $b->getSignalStrength()) ? -1 : 1;
        });

        return array_pop($scansForSsid);
    }

    public function getSite()
    {
        return $this->site;
    }

    public function getSurveyDate()
    {
        return $this->date;
    }

}