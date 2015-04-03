<?php namespace RouterOsStumbler\Services;

interface ScanResultReaderInterface
{
    /**
     * Read the results from the device.
     * Return an array of ScanResults with the data.
     *
     * @return ScanResult[]
     */
    public function read();
}