<?php

/**
 * ResponseTest
 *
 * @package    Congow\Orient
 * @subpackage Test
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 * @version
 */
use Congow\Orient\Http;

class ResponseTest extends PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $response = new Http\Response("A\r\n\r\nB");

        $this->assertEquals("A\r\n\r\nB", (string) $response);
    }

    public function testRetrieveTheWholeResponse()
    {
        $response = new Http\Response("A\r\n\r\nB");

        $this->assertEquals("A\r\n\r\nB", $response->getResponse());
    }

    public function testExtractBodyCorrectlyFromResponse()
    {
        $response = new Http\Response("A\r\n\r\nB\r\n\r\nC");

        $this->assertEquals("B\r\n\r\nC", $response->getBody());
    }

    public function testSameHeaderInDifferentLinesAreMergedTogether()
    {
        $response = new Http\Response("HTTP/1.1 200 OK\r\nCache-Control: max-age=30\r\nCache-Control: s-maxage=50\r\n\r\n");

        $this->assertEquals("max-age=30, s-maxage=50", $response->getHeader('Cache-Control'));
    }

    public function testRetrievingTheProtocol()
    {
        $response = new Http\Response("HTTP/1.1 200 OK\r\nCache-Control: max-age=30\r\nCache-Control: s-maxage=50\r\n\r\n");

        $this->assertEquals("HTTP/1.1", $response->getProtocol());
    }

    public function testGettingTheStatusCode()
    {
        $response = new Http\Response("HTTP/1.1 200 OK\r\nCache-Control: max-age=30\r\nCache-Control: s-maxage=50\r\n\r\n");

        $this->assertEquals("200", $response->getStatusCode());
    }

    public function testnullIsReturnedWhenRequestingANonExistingHeader()
    {
        $response = new Http\Response("HTTP/1.1 200 OK\r\nCache-Control: max-age=30\r\nCache-Control: s-maxage=50\r\n\r\n");

        $this->assertEquals(null, $response->getHeader('Host'));
    }
}
