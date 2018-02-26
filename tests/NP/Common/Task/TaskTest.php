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

use NP\Common\Config;
use NP\Common\Task\Task;
use NP\Http\Request;
use NP\Http\Response;
use NP\Mock\AssetsResponse;
use NP\Mock\Http\MockDriver;
use NP\Mock\Http\MockRequest;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Common\Task\Task
     */
    private $instance;

    /**
     * @var array
     */
    private $configData;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
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

        $this->request = new MockRequest();
        $this->response = new MockRequest();
        $this->configData = ['key' => 'testKey', 'driver' => new MockDriver()];
        $this->config = Config::setUp($this->configData);
        $this->instance = new Task($this->config);
    }


    /**
     * @covers \NP\Common\Task\Task::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Task::class, $this->instance);
    }


    /**
     * @covers \NP\Common\Task\Task::setRequest
     * @covers \NP\Common\Task\Task::getRequest
     */
    public function testSetGetRequest()
    {
        $this->instance->setRequest($this->request);

        $this->assertInstanceOf(Request::class, $this->instance->getRequest());
    }


    /**
     * @covers \NP\Common\Task\Task::setResponse
     * @covers \NP\Common\Task\Task::getResponse
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testSetGetResponse()
    {
        $this->instance->setResponse(new Response(AssetsResponse::json()));

        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }


    /**
     * @covers \NP\Common\Task\Task::getResponse
     * @covers \NP\Common\Task\Task::execute
     */
    public function testGetResponse()
    {
        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }


    /**
     * @covers \NP\Common\Task\Task::execute
     */
    public function testExecute()
    {
        $this->instance->setRequest($this->request);
        $this->instance->execute();

        $this->assertInstanceOf(Response::class, $this->instance->getResponse());
    }
}
