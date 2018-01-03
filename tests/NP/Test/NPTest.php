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


/**
 * Class NPTest
 * @package NP\Test\Np
 */
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
     * @covers \NP\Util\Singleton::getInstance
     */
    public function testNP()
    {
        $this->assertInstanceOf(NP::class, NP::getInstance());
    }


    /**
     * @covers \NP\NP::init
     * @covers \NP\NP::getDefaultDriver
     */
    public function testInit()
    {
        $this->assertInstanceOf(NP::class, NP::init($this->key, $this->driver));
    }


    /**
     * @covers \NP\NP::getKey
     */
    public function testGetKey()
    {
        $this->assertEquals($this->key, $this->instance::getKey());
    }


    /**
     * @covers \NP\NP::getDriver
     */
    public function testGetDriver()
    {
        $this->assertEquals($this->driver, $this->instance::getDriver());
    }


    /**
     * @covers \NP\NP::getModel
     */
    public function testGetModel()
    {
        $this->assertEquals(null, $this->instance->getModel());
    }


    /**
     * @covers \NP\NP::getRequest
     */
    public function testGetRequest()
    {
        $this->assertEquals(null, $this->instance->getRequest());
    }


    /**
     * @covers \NP\NP::getResponse
     */
    public function testGetResponse()
    {
        $this->assertEquals(null, $this->instance->getResponse());
    }

}
