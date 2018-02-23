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

namespace NP\Test\Common\Util;

use NP\Common\Config;
use NP\Exception\ErrorException;
use NP\Exception\Error;
use NP\Http\DriverInterface;
use NP\Mock\Http\MockDriver;
use PHPUnit\Framework\TestCase;


/**
 * Class ConfigTest
 * @package NP\Test\Entity
 */
class ConfigTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Config
     */
    private $instance;

    /**
     * @var string
     */
    private $key = 'TestModel';

    /**
     * @var DriverInterface
     */
    private $driver;


    /**
     * Settings up.
     * @throws ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->driver = new MockDriver();
        $this->instance = Config::setUp([
            'key' => $this->key,
        ]);
    }


    /**
     * @covers \NP\Common\Config::setUp
     * @covers \NP\Common\Config::setProperty
     * @covers \NP\Common\Config::setProperty
     * @covers \NP\Common\Config::setDefaults
     * @covers \NP\Common\Config::setDefaultDriver
     */
    public function testSetUp()
    {
        $this->assertInstanceOf(Config::class, $this->instance);

        $newConfig = Config::setUp($this->key);
        $this->assertInstanceOf(DriverInterface::class, $newConfig->getDriver());

        $superNewConfig = Config::setUp(new \stdClass());
        $this->assertInstanceOf(DriverInterface::class, $superNewConfig->getDriver());

    }


    /**
     * @covers \NP\Common\Config::getDriver
     */
    public function testGetDriver()
    {
        $this->assertInstanceOf(DriverInterface::class, $this->instance->getDriver());

        $newConfig = Config::setUp([
            'key'    => $this->key,
            'driver' => $this->driver,
        ]);
        $this->assertInstanceOf(DriverInterface::class, $newConfig->getDriver());
    }


    /**
     * @covers \NP\Common\Config::getLanguage
     */
    public function testGetLanguage()
    {
        $this->assertEquals('Uk', $this->instance::getLanguage());
    }
}
