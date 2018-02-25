<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Exception;

use NP\Exception\Error;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Exception\Error
     */
    private $instance;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @var int
     */
    private $errorCode;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->errorMessage = 'Test Error Message';
        $this->errorCode = 42;
        $this->instance = new Error($this->errorMessage, $this->errorCode);
    }


    /**
     * @covers \NP\Exception\Error::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Error::class, $this->instance);
    }


    /**
     * @covers \NP\Exception\Error::getError
     */
    public function testGetError()
    {
        $this->assertEquals($this->errorMessage, $this->instance->getError());
    }


    /**
     * @covers \NP\Exception\Error::getCode
     */
    public function testGetCode()
    {
        $this->assertEquals($this->errorCode, $this->instance->getCode());
    }


    /**
     * @covers \NP\Exception\Error::getStatus
     */
    public function testGetStatus()
    {
        $this->assertTrue($this->instance->getStatus());
    }


    /**
     * @covers \NP\Exception\Error::toJson
     */
    public function testToJson()
    {
        $this->assertJson($this->instance->toJson());
    }


    /**
     * @covers \NP\Exception\Error::__toString
     */
    public function test__toString()
    {
        $this->assertEquals("Error: {$this->errorMessage}", $this->instance->__toString());
    }


    /**
     * @covers \NP\Exception\Error::jsonSerialize
     */
    public function testJsonSerialize()
    {
        $array = $this->instance->jsonSerialize();

        $this->assertArrayHasKey('success', $array);
        $this->assertArrayHasKey('error', $array);
        $this->assertArrayHasKey('code', $array);
    }
}
