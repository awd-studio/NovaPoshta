<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Http;

use NP\Http\Response;
use NP\Mock\AssetsResponse;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Http\Response
     */
    private $instance;

    /**
     * @var string
     */
    private $response;


    /**
     * Settings up.
     *
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->response = AssetsResponse::json();
        $this->instance = new Response($this->response);
    }


    /**
     * @covers \NP\Http\Response::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Response::class, $this->instance);
    }


    /**
     * @covers \NP\Http\Response::getRaw
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testGetRaw()
    {
        $this->assertJson($this->instance->getRaw());
        $this->assertEquals(AssetsResponse::json(), $this->instance->getRaw());
    }


    /**
     * @covers \NP\Http\Response::getData
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testGetData()
    {
        $this->assertEquals(json_decode(AssetsResponse::json()), $this->instance->getData());
    }


    /**
     * @covers \NP\Http\Response::__toString
     *
     * @throws \NP\Exception\ErrorException
     */
    public function test__toString()
    {
        $this->assertEquals(AssetsResponse::json(), $this->instance->__toString());
    }


    /**
     * @covers \NP\Http\Response::isSuccess
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testIsSuccess()
    {
        $this->assertTrue($this->instance->isSuccess());

        $failedResponse = new Response(AssetsResponse::json('failed'));
        $this->assertFalse($failedResponse->isSuccess());
    }


    /**
     * @covers \NP\Http\Response::get
     */
    public function testGet()
    {
        foreach ((array) $this->instance->getData() as $k => $value) {
            $this->assertEquals($value, $this->instance->get($k));
        }
    }
}
