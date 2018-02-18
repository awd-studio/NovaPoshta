<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Common\Task;

use NP\Common\Task\Task;
use NP\Http\Request;
use NP\Http\Response;
use NP\Mock\Http\MockRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class TaskTest
 * @package NP\Test\Common\Task
 */
class TaskTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Task
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $request = new MockRequest();

        $this->instance = new Task($request);
    }


    /**
     * @covers \NP\Common\Task\Task::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Task::class, $this->instance);
    }


    /**
     * @covers \NP\Common\Task\Task::getRequest()
     */
    public function testGetRequest()
    {
        $this->assertInstanceOf(Request::class, $this->instance->getRequest());
    }

    /**
     * @covers \NP\Common\Task\Task::setResponse
     * @covers \NP\Common\Task\Task::getResponse
     */
    public function testSetResponse()
    {
        $response = json_decode(realpath(dirname(__FILE__) . "/../../assets/json/response/success.json"));
        $this->instance->setResponse(new Response($response));

        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }

    /**
     * @covers \NP\Common\Task\Task::execute
     * @covers \NP\Common\Task\Task::getResponse
     */
    public function testExecute()
    {
        $response = $this->instance->execute();
        $this->assertEquals($response, $this->instance->getResponse());
    }
}
