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

namespace NP\Test\Entity;

use NP\Entity\Config;
use NP\Exception\Errors;
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
     * @var Errors
     */
    private $errors;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->errors = new Errors();
        $this->driver = new MockDriver();
        $this->instance = Config::setUp([
            'key' => $this->key,
        ], $this->errors);
    }


    /**
     * @covers \NP\Entity\Config::setUp
     * @covers \NP\Entity\Config::setProperty
     * @covers \NP\Entity\Config::setProperty
     * @covers \NP\Entity\Config::setDefaults
     * @covers \NP\Entity\Config::getDefaultDriver
     */
    public function testSetUp()
    {
        $this->assertInstanceOf(Config::class, $this->instance);

        $newConfig = Config::setUp($this->key, $this->errors);
        $this->assertInstanceOf(DriverInterface::class, $newConfig->getDriver());

        $superNewConfig = Config::setUp(new \stdClass(), $this->errors);
        $this->assertInstanceOf(DriverInterface::class, $superNewConfig->getDriver());

    }


    /**
     * @covers \NP\Entity\Config::getDriver
     */
    public function testGetDriver()
    {
        $this->assertInstanceOf(DriverInterface::class, $this->instance->getDriver());

        $newConfig = Config::setUp([
            'key'    => $this->key,
            'driver' => $this->driver,
        ], $this->errors);
        $this->assertInstanceOf(DriverInterface::class, $newConfig->getDriver());
    }


    /**
     * @covers \NP\Entity\Config::getLanguage
     */
    public function testGetLanguage()
    {
        $this->assertEquals('Uk', $this->instance::getLanguage());
    }
}
