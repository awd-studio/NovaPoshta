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

use NP\Common\Task\TaskManager;
use NP\Exception\ErrorException;
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
     * @throws ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->driver = new MockDriver('success');
        $this->instance = NP::init(['key' => $this->key, 'driver' => $this->driver]);
    }


    /**
     * @covers \NP\NP::getInstance
     * @covers \NP\Common\Util\Singleton::getInstance
     */
    public function testNP()
    {
        $this->assertInstanceOf(NP::class, NP::getInstance());
    }


    /**
     * @covers \NP\NP::execute
     * @covers \NP\Common\Task\TaskManager::init
     * @covers \NP\Common\Task\TaskManager::execute
     */
    public function testExecute()
    {
        $this->assertInstanceOf(TaskManager::class, $this->instance->execute());
    }


    /**
     * @covers \NP\NP::init
     * @covers \NP\Common\Config::setDefaultDriver
     */
    public function testInit()
    {
        $this->assertInstanceOf(NP::class, NP::init(['key' => $this->key, 'driver' => $this->driver]));
        $this->assertInstanceOf(NP::class, NP::init($this->key));
    }
}
