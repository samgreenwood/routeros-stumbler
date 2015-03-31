<?php namespace RouterOsStumbler;

class ScanResult implements \JsonSerializable
{
    protected $ssid;

    protected $signalStrength;

    public function __construct($ssid, $signalStrength)
    {
        $this->ssid = $ssid;
        $this->signalStrength = $signalStrength;
    }

    public function getSsid()
    {
        return $this->ssid;
    }

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