<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Np;

use NP\Exception\NPException;
use NP\NP;
use NP\Http\DriverInterface;
use NP\Http\CurlDriver;


class NPTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Instance.
     *
     * @var NP
     */
    private $instance;

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
        $this->instance = NP::init($this->key, $this->driver);
    }


    /**
     * @covers \NP\NP::getInstance
     */
    public function testNPInstance()
    {
        $this->assertInstanceOf(NP::class, NP::getInstance());
    }


    // public function testNPgetDefaultDriverException()
    // {
    //     $this->expectException(NpException::class);
    //
    //     $NewAddress = new Address($this->settings);
    //     $NewAddress->searchSettlementStreets([]);
    // }


    /**
     * @covers \NP\NP::init
     * @covers \NP\NP::getDefaultDriver
     */
    public function testNPinit()
    {
        $this->assertInstanceOf(NP::class, NP::init($this->key, $this->driver));
    }


    /**
     * @covers \NP\NP::getKey
     */
    public function testNPgetKey()
    {
        $this->assertEquals($this->key, $this->instance::getKey());
    }


    /**
     * @covers \NP\NP::getDriver
     */
    public function testNPgetDriver()
    {
        $this->assertEquals($this->driver, $this->instance::getDriver());
    }


    /**
     * @covers \NP\NP::getModel
     */
    public function testNPgetModel()
    {
        $this->assertEquals(null, $this->instance->getModel());
    }


    /**
     * @covers \NP\NP::getRequest
     */
    public function testNPgetRequest()
    {
        $this->assertEquals(null, $this->instance->getRequest());
    }


    /**
     * @covers \NP\NP::getResponse
     */
    public function testNPgetResponse()
    {
        $this->assertEquals(null, $this->instance->getResponse());
    }

}
