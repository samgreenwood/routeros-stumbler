<?php

class SignalStrengthTest extends PHPUnit_Framework_TestCase
{
    public function test_highest_signal_for_ssid_is_returned()
    {
        $site = new \RouterOsStumbler\Site("Goonwood");
        $survey = new \RouterOsStumbler\Survey($site);

        $scanResults[] = new \RouterOsStumbler\ScanResult("Air-Stream-Seaton-2", -60);
        $scanResults[] = new \RouterOsStumbler\ScanResult("Air-Stream-Seaton-2", -77);
        $scanResults[] = new \RouterOsStumbler\ScanResult("Air-Stream-Seaton-2", -64);
        $scanResults[] = new \RouterOsStumbler\ScanResult("Air-Stream-Seaton-2", -52);
        $scanResults[] = new \RouterOsStumbler\ScanResult("Air-Stream-Seaton-2", -48);

        foreach($scanResults as $scanResult)
        {
            $survey->addResult($scanResult);
        }

        $bestScan = $survey->getBestScanResultForSsid("Air-Stream-Seaton-2");

        $this->assertEquals(-48, $bestScan->getSignalStrength());
    }
}