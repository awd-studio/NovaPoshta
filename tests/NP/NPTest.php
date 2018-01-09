<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode

namespace NP\Test\Np;

use NP\Entity\Config;
use NP\Exception\Errors;
use NP\Http\Request;
use NP\Http\Response;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;
use NP\NP;
use NP\Http\DriverInterface;
use NP\Mock\Http\MockDriver;


/**
 * Class NPTest
 * @package NP\Test\Np
 */
class NPTest extends TestCase
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

        $this->driver = new MockDriver('success');
        $this->instance = NP::init(['key' => $this->key, 'driver' => $this->driver]);
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
     * @covers \NP\Entity\Config::getDefaultDriver
     */
    public function testInit()
    {
        $this->assertInstanceOf(NP::class, NP::init(['key' => $this->key, 'driver' => $this->driver]));
        $this->assertInstanceOf(NP::class, NP::init($this->key));
    }


    /**
     * @covers \NP\Entity\Config::getKey
     */
    public function testGetKey()
    {
        $this->assertEquals($this->key, $this->instance::config()->getKey());
    }


    /**
     * @covers \NP\Entity\Config::getDriver
     */
    public function testGetDriver()
    {
        $this->assertEquals($this->driver, $this->instance::config()->getDriver());
    }


    /**
     * @covers \NP\NP::getModel
     */
    public function testGetModel()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getModel());
    }


    /**
     * @covers \NP\NP::getRequest
     */
    public function testGetRequest()
    {
        $this->assertInstanceOf(Request::class, $this->instance->getRequest());
    }


    /**
     * @covers \NP\NP::getResponse
     */
    public function testGetResponse()
    {
        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }


    /**
     * @covers \NP\NP::checkErrors
     * @covers \NP\NP::reset
     */
    public function testCheckErrors()
    {
        $this->assertFalse($this->instance->checkErrors());

        $this->instance->reset();
        $this->assertTrue($this->instance->checkErrors());
    }


    /**
     * @covers \NP\NP::config
     */
    public function testConfig()
    {
        $this->assertInstanceOf(Config::class, $this->instance::config());
    }


    /**
     * @covers \NP\NP::getErrors
     */
    public function testGetErrors()
    {
        $this->assertInstanceOf(Errors::class, $this->instance->getErrors());
    }
}
