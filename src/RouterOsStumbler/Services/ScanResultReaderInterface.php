<?php namespace RouterOsStumbler\Services;

interface ScanResultReaderInterface
{
    /**
     * Read the results from a data source.
     *
     * @return ScanResult[]
     */
    public function read();
}