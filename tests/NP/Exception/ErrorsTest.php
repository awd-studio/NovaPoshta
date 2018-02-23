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

use PHPUnit\Framework\TestCase;
use JsonSerializable;
use NP\Exception\Error;
use NP\Http\Response;

class ErrorsTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Error
     */
    private $instance;

    /**
     * @var string
     */
    private $error;

    /**
     * @var int
     */
    private $code;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->error = 'Test message';
        $this->code = 1;
        $this->instance = Error::getInstance();
    }


    /**
     * @coversNothing
     */
    public function testError()
    {
        $this->instance->addError($this->error);
        $this->assertInstanceOf(Error::class, $this->instance);
        $this->assertInstanceOf(JsonSerializable::class, $this->instance);
    }


    /**
     * @covers \NP\Exception\Error::addError
     * @covers \NP\Exception\Error::getError
     */
    public function testAddGetError()
    {
        $error = 'My test message';
        $this->instance->addError($error);

        $this->assertEquals($error, $this->instance->getError(
            (count($this->instance->getError()) - 1)
        ));
    }


    /**
     * @covers \NP\Exception\Error::getStatus()
     */
    public function testGetStatus()
    {
        $this->assertTrue($this->instance->getStatus());

        $this->instance->addError('New error');
        $this->assertTrue($this->instance->getStatus());
    }


    /**
     * @covers \NP\Exception\Error::getResponse
     */
    public function testGetResponse()
    {
        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }


    /**
     * @covers \NP\Exception\Error::toJson
     */
    public function testToJson()
    {
        $this->assertJson($this->instance->toJson());
    }


    /**
     * @covers \NP\Exception\Error::getError
     * @covers \NP\Exception\Error::__toString
     */
    public function test__toString()
    {
        $this->instance->addError('Test');

        $this->assertEquals('Errors: ' . implode(
                '; ', array_map(function ($error) {
                return "Error: {$error}";
            }, $this->instance->getError())), $this->instance->__toString());
    }


    /**
     * @covers \NP\Exception\Error::jsonSerialize
     */
    public function testJsonSerialize()
    {
        $expected = [
            'success'    => false,
            'errors'     => $this->instance->getError(),
        ];

        $this->assertEquals($expected, $this->instance->jsonSerialize());
    }
}
