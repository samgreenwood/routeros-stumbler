<?php namespace RouterOsStumbler\Services;

use Ssh;
use RouterOsStumbler\Entity\Ubiquiti;

class UbiquitiScanResultReader
{
    /**
     * @var UbiquitiScanResultParser
     */
    private $parser;

    /**
     * @var
     */
    private $sshSession;

    /**
     * UbiquitiScanResultReader constructor.
     * @param UbiquitiScanResultParser $parser
     */
    public function __construct(UbiquitiScanResultParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Read the results
     * @param Ubiquiti $device
     * @return ScanResult[]
     */
    public function read(Ubiquiti $device)
    {
        $session = $this->getSshSession($device->getHost(), $device->getUsername(), $device->getPassword());

        $data = $session->getExec()->run('iwlist ath0 scan');

        return $this->parser->parse($data);
    }

    /**
     * @param $host
     * @param $username
     * @param $password
     * @return Ssh\Session
     */
    private function getSshSession($host, $username, $password)
    {
        if(!$this->sshSession)
        {
            $configuration = new Ssh\Configuration($host);
            $authentication = new Ssh\Authentication\Password($username, $password);
            $this->sshSession = new Ssh\Session($configuration, $authentication);
        }

        return $this->sshSession;
    }


}