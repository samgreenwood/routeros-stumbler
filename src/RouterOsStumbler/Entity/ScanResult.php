<?php namespace RouterOsStumbler\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="scanresults")
 */
class ScanResult implements \JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $ssid;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $signalStrength;

    /**
     * @OneToMany(targetEntity="RouterOsStumbler\Entity\Survey", mappedBy="survey")
     */
    protected $survey;

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