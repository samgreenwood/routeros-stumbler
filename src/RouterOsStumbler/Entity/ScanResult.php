<?php namespace RouterOsStumbler\Entity;

use Doctrine\ORM\Mapping;
use Stringy\StaticStringy as S;

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
     * @Column(type="string", nullable=true)
     */
    protected $macAddress;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $band;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $frequency;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $channelWidth;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $noiseFloor;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $snr;

    /**
     * @Column(type="datetime", nullable=true)
     */
    protected $seen;

    /**
     * @ManyToOne(targetEntity="RouterOsStumbler\Entity\Survey", inversedBy="survey")
     */
    protected $survey;

    /**
     * @param $ssid
     * @param $signalStrength
     * @param $macAddress
     * @param $frequency
     * @param $band
     * @param $channelWidth
     * @param $noiseFloor
     * @param $snr
     * @param $seen
     */
    public function __construct($ssid, $signalStrength, $macAddress = null, $frequency = null, $band = null, $channelWidth = null, $noiseFloor = null, $snr = null)
    {
        $this->ssid = $ssid;
        $this->signalStrength = $signalStrength;
        $this->macAddress = $macAddress;
        $this->frequency = $frequency;
        $this->band = $band;
        $this->channelWidth = $channelWidth;
        $this->noiseFloor = $noiseFloor;
        $this->snr = $snr;
        $this->seen = new \Datetime();
    }

    /**
     * @param $data
     * @return static
     */
    public static function fromArray($data)
    {
        extract($data);
        return new static($ssid, $signalStrength, $macAddress, $frequency, $band, $channelWidth, $noiseFloor, $snr);
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

    public function setSurvey(Survey $survey)
    {
        $this->survey = $survey;
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
           'ssidSlug' => S::slugify($this->ssid),
           'signalStrength' => $this->signalStrength,
           'macAddress' => $this->macAddress,
           'band' => $this->band,
           'channelWidth' => $this->channelWidth,
           'noiseFloor' => $this->noiseFloor,
           'snr' => $this->snr,
	   'seen' => \Carbon\Carbon::instance($this->seen)->diffInSeconds(\Carbon\Carbon::now()),
       ];
    }
}
