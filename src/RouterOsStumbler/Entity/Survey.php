<?php namespace RouterOsStumbler\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="surveys")
 */
class Survey
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @Column(type="string")
     */
    protected $name;

    /**
     * @Column(type="datetime")
     */
    protected $surveyDate;

    /**
     * @OneToMany(targetEntity="RouterOsStumbler\Entity\ScanResult", mappedBy="survey", cascade={"persist"})
     */
    protected $scanResults = [];

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->surveyDate = new \Datetime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return \Datetime
     */
    public function getSurveyDate()
    {
        return $this->surveyDate;
    }

}