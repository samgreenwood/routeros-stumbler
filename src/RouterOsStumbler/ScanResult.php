<?php namespace RouterOsStumbler;

class ScanResult implements \JsonSerializable
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $ssid;

    /**
     * @var integer
     */
    protected $signalStrength;

    /**
     * @param $ssid
     * @param $signalStrength
     */
    public function __construct($ssid, $signalStrength)
    {
        $this->ssid = $ssid;
        $this->signalStrength = $signalStrength;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @return string
     */
    public function getSsid()
    {
        return $this->ssid;
    }

    /**
     * @return integer
     */
    public function getSignalStrength()
    {
        return $this->signalStrength;
    }

    /**
     * @return mixed|void
     */
    public function jsonSerialize()
    {
       return [
           'ssid' => $this->ssid,
           'signalStrength' => $this->signalStrength
       ];
    }
}