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
use NP\Exception\Errors;
use NP\Http\Response;

class ErrorsTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Errors
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
        $this->instance = new Errors();
    }


    /**
     * @coversNothing
     */
    public function testError()
    {
        $this->instance->addError($this->error, $this->code);
        $this->assertInstanceOf(Errors::class, $this->instance);
        $this->assertInstanceOf(JsonSerializable::class, $this->instance);
    }


    /**
     * @covers \NP\Exception\Errors::addError
     * @covers \NP\Exception\Errors::getError
     */
    public function testAddGetError()
    {
        $error = 'My test message';
        $key = $this->instance->addError($error, 999);

        $this->assertEquals($error, $this->instance->getError($key));
    }


    /**
     * @covers \NP\Exception\Errors::getErrorDescription
     */
    public function testGetErrorDescription()
    {
        $error = 'Unknown error. Please, contact your system administrator.';

        $this->assertEquals($error, $this->instance->getErrorDescription(1));
        $this->assertEquals($error, $this->instance->getErrorDescription(10000));
    }


    /**
     * @covers \NP\Exception\Errors::getStatus()
     */
    public function testGetStatus()
    {
        $this->assertFalse($this->instance->getStatus());

        $this->instance->addError('New error');
        $this->assertTrue($this->instance->getStatus());
    }


    /**
     * @covers \NP\Exception\Errors::getResponse
     */
    public function testGetResponse()
    {
        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }


    /**
     * @covers \NP\Exception\Errors::toJson
     */
    public function testToJson()
    {
        $this->assertJson($this->instance->toJson());
    }


    /**
     * @covers \NP\Exception\Errors::__toString
     */
    public function test__toString()
    {
        $error = 'Errors: Error Test, with code #1';
        $this->instance->addError('Test');

        $this->assertEquals($error, $this->instance->__toString());
    }


    /**
     * @covers \NP\Exception\Errors::jsonSerialize
     */
    public function testJsonSerialize()
    {
        $expected = [
            'success'    => true,
            'errors'     => [],
            'errorCodes' => [],
        ];

        $this->assertEquals($expected, $this->instance->jsonSerialize());
    }
}
