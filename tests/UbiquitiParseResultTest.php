<?php

class UbiquitiParseResultTest extends PHPUnit_Framework_TestCase
{

    public function test_data_can_be_parsed_from_a_ubiquiti_radio()
    {
        $data = file_get_contents(__DIR__ . '/ubiquiti_results.txt');

        $parser = new \RouterOsStumbler\Services\UbiquitiScanResultParser();

        $results = $parser->parse($data);

        $this->assertCount(2, $results);

        $result = array_pop($results);

        $this->assertEquals('Testwood', $result->getSsid());
        $this->assertEquals(-96, $result->getSignalStrength());
    }
}