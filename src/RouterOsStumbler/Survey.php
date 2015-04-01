<?php namespace RouterOsStumbler;

class Survey
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Site
     */
    protected $site;

    /**
     * @var \Datetime
     */
    protected $date;

    /**
     * @var ScanResult[]
     */
    protected $scanResults = [];

    /**
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->date = new \Datetime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param ScanResult $scanResult
     */
    public function addResult(ScanResult $scanResult)
    {
        $this->scanResults[] = $scanResult;
    }

    /**
     * @param $ssid
     * @return mixed
     */
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

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @return \Datetime
     */
    public function getSurveyDate()
    {
        return $this->date;
    }

}