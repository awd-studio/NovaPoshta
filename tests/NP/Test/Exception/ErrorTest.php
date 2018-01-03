<?php
/**
 * Created by PhpStorm.
 * User: awd
 * Date: 03.01.18
 * Time: 23:55
 */

namespace NP\Test\Exception;

use JsonSerializable;
use NP\Exception\Error;
use NP\Http\Response;

class ErrorTest extends \PHPUnit_Framework_TestCase
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
        $this->instance = new Error($this->error, $this->code);
    }


    /**
     * @covers \NP\Exception\Error::__construct
     * @covers \NP\Exception\Error::getError
     */
    public function testError()
    {
        $this->assertInstanceOf(Error::class, $this->instance);
        $this->assertInstanceOf(JsonSerializable::class, $this->instance);
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
     * @covers \NP\Exception\Error::__toString
     */
    public function test__toString()
    {
        $error = "Error: {$this->error} With code: {$this->code}";
        $this->assertEquals($error, $this->instance->__toString());
    }


    /**
     * @covers \NP\Exception\Error::jsonSerialize
     */
    public function testJsonSerialize()
    {
        $expected = [
            'success' => false,
            'error'   => $this->error,
            'code'    => $this->code,
            'errors'  => ['Unknown error. Please, contact your system administrator.'],
        ];

        $this->assertEquals($expected, $this->instance->jsonSerialize());
    }
}
