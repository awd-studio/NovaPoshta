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

use NP\Http\Request;
use NP\Mock\Model\MockModelBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Http\Request
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $mb = new MockModelBuilder();
        $this->instance = new Request($mb);
    }


    /**
     * @covers \NP\Http\Request::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Request::class, $this->instance);
    }


    /**
     * @covers \NP\Http\Request::getBody
     */
    public function testGetBody()
    {
        $this->assertEquals((new MockModelBuilder())->getBody(), $this->instance->getBody());
        $this->assertJson($this->instance->getBody(true));
    }


    /**
     * @covers \NP\Http\Request::getBodyJson
     */
    public function testGetBodyJson()
    {
        $this->assertJson($this->instance->getBodyJson());
    }


    /**
     * @covers \NP\Http\Request::getUri
     */
    public function testGetUri()
    {
        $this->assertRegExp('/https?:\/\/(?:[\w\d]){2,3}/', $this->instance->getUri());
    }
}
