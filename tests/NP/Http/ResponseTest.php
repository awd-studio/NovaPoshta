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

use PHPUnit\Framework\TestCase;
use NP\Http\Response;

/**
 * Class ResponseTest
 * @package NP\Test\Http
 */
class ResponseTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Response
     */
    private $instance;

    /**
     * @var string JSON
     */
    private $response = '{"success":false,"error":"Error","code":2,"errors":["Error"]}';


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Response($this->response);
    }


    /**
     * @covers \NP\Http\Response::__construct
     */
    public function testResponse()
    {
        $this->assertInstanceOf(Response::class, $this->instance);
    }


    /**
     * @covers \NP\Http\Response::getRaw
     */
    public function testGetRaw()
    {
        $this->assertEquals($this->response, $this->instance->getRaw());
    }


    /**
     * @covers \NP\Http\Response::getData
     */
    public function testGetData()
    {
        $this->assertEquals(json_decode($this->response), $this->instance->getData());
    }


    /**
     * @covers \NP\Http\Response::__toString
     */
    public function test__toString()
    {
        $this->assertEquals($this->instance->getRaw(), $this->instance->__toString());
    }
}
