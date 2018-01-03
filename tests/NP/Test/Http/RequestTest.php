<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Http;

use NP\Http\Request;
use NP\NP;
use NP\Http\CurlDriver;
use NP\Http\DriverInterface;


/**
 * Class RequestTest
 * @package NP\Test\Http
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Instance.
     *
     * @var Request
     */
    private $instance;

    /**
     * NP instance.
     *
     * @var NP
     */
    private $np;

    /**
     * API key.
     *
     * @var string
     */
    private $key = 'myAPIkey';

    /**
     * Driver.
     *
     * @var DriverInterface
     */
    private $driver;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->driver = new CurlDriver();
        $this->np = NP::init($this->key, $this->driver);
        $this->instance = new Request($this->np);
    }


    /**
     * @covers \NP\Http\Request::__construct
     * @covers \NP\Http\Request::buildData
     */
    public function testRequest()
    {
        $this->assertInstanceOf(Request::class, $this->instance);
    }


    /**
     * @covers \NP\Http\Request::getBody
     * @covers \NP\Http\Request::getBodyJson
     */
    public function testGetBody()
    {
        $this->assertEquals(new \stdClass(), $this->instance->getBody());
        $this->assertEquals(json_encode(new \stdClass()), $this->instance->getBody(true));
    }


    /**
     * @covers \NP\Http\Request::getUri
     */
    public function testGetUri()
    {
        $patternJson = '/(https:\/\/(?:api)?\.?novaposhta\.ua\/(?:v\d+\.\d+)\/json\/)/i';
        $this->assertRegExp($patternJson, $this->instance->getUri());
    }


    /**
     * ToDo: Implement test;
     */
    // public function testExecute()
    // {
    //
    // }
}
