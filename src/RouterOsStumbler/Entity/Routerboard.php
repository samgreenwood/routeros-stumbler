<?php namespace RouterOsStumbler\Entity;

class Routerboard {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $scanInterface;

    /**
     * @param string $name
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $scanInterface
     */
    public function __construct($name, $host, $username, $password, $scanInterface = "wlan0")
    {
        $this->name = $name;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->scanInterface = $scanInterface;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
        public function getScanInterface()
    {
        return $this->scanInterface;
    }

} 