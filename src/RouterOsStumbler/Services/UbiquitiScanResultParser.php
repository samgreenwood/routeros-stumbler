<?php namespace RouterOsStumbler\Services;

use RouterOsStumbler\Entity\ScanResult;

class UbiquitiScanResultParser
{
    /**
     * Parse the output from a Ubiquiti Device scan into ScanResult
     * @param $data
     * @return ScanResult[]
     */
    public function parse($data)
    {
        $results = [];

        $patterns = [
            'ssid' => '/ESSID:"\s*([^\n\r]*)"/',
            'signalStrength' => '/Signal level=\s*([^\s]*)/',
            'frequency' => '/Frequency:\s*([^\s]*)/',
            'band' => '/Frequency:\s*([^\s]*)/',
            'macAddress' => '/Address:\s*([^\s]*)/',
            'channelWidth' => '/chanbw=\s*([^\n\r]*)/',
            'noiseFloor' => '/Noise level=\s*([^\s]*)/',
        ];


        foreach($patterns as $k => $pattern)
        {
            preg_match_all($pattern, $data, $matches);

            $matches = array_filter($matches);

            $matches = $matches[1];

            foreach($matches as $count => $match)
            {
                $results[$count][$k] = $match;
            }

        }

        return array_map(function($result)
        {
            $result['snr'] = $result['noiseFloor'] / $result['signalStrength'];
            $result['frequency'] = $result['frequency'] * 1000;
            return ScanResult::fromArray($result);
        }, $results);
    }
}