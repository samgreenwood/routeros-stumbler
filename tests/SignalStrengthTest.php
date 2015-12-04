<?php

use RouterOsStumbler\Entity\ScanResult;
use RouterOsStumbler\Entity\Survey;

class SignalStrengthTest extends PHPUnit_Framework_TestCase
{
    public function test_highest_signal_for_ssid_is_returned()
    {
        $survey = new Survey("Goonwood");

        $scanResults[] = new ScanResult("Air-Stream-Seaton-2", -60);
        $scanResults[] = new ScanResult("Air-Stream-Seaton-2", -77);
        $scanResults[] = new ScanResult("Air-Stream-Seaton-2", -64);
        $scanResults[] = new ScanResult("Air-Stream-Seaton-2", -52);
        $scanResults[] = new ScanResult("Air-Stream-Seaton-2", -48);

        foreach($scanResults as $scanResult)
        {
            $survey->addResult($scanResult);
        }

        $bestScan = $survey->getBestScanResultForSsid("Air-Stream-Seaton-2");

        $this->assertEquals(-48, $bestScan->getSignalStrength());
    }
}