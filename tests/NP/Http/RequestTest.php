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

namespace NP\Test\Http;

use NP\Exception\Errors;
use NP\Http\Response;
use NP\Mock\Http\MockDriver;
use PHPUnit\Framework\TestCase;
use NP\Http\Request;
use NP\NP;
use NP\Http\DriverInterface;


/**
 * Class RequestTest
 * @package NP\Test\Http
 */
class RequestTest extends TestCase
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

        $this->driver = new MockDriver();
        $this->np = NP::init(['key' => $this->key, 'driver' => $this->driver]);
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
     * @covers \NP\Http\Request::execute
     * @covers \NP\Http\Response::getRaw
     */
    public function testExecute()
    {
        $r = $this->instance->execute();

        $this->assertInstanceOf(Response::class, $r);
        $this->assertJson($r->getRaw());
    }


    /**
     * @covers \NP\Http\Request::errors
     */
    public function testErrors()
    {
        $this->assertInstanceOf(Errors::class, $this->instance::errors());
    }
}
