<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test;

use NP\Common\Task\TaskManager;
use NP\Http\Response;
use NP\NP;
use PHPUnit\Framework\TestCase;

class NPTest extends TestCase
{

    /**
     * Instance.
     *
     * @var NP
     */
    private $instance;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string Test model name
     */
    private $modelName;

    /**
     * @var string Test called method
     */
    private $calledMethod;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->modelName = 'testModelName';
        $this->calledMethod = 'testCalledMethod';
        $this->apiKey = '';
        $this->instance = NP::init($this->apiKey);
    }


    /**
     * @covers \NP\NP::init
     */
    public function testInit()
    {
        $np = NP::init($this->apiKey);

        $this->assertInstanceOf(NP::class, $np);
    }


    /**
     * @covers \NP\NP::with
     * @covers \NP\NP::execute
     */
    public function testWith()
    {
        $this->instance->with($this->modelName, $this->calledMethod);
        $tm = $this->instance->execute();

        $this->assertInstanceOf(TaskManager::class, $tm);
    }


    /**
     * @covers \NP\NP::send
     */
    public function testSend()
    {
        $this->instance->with($this->modelName, $this->calledMethod);
        $response = $this->instance->send();

        $this->assertInstanceOf(Response::class, $response);
    }


    /**
     * @covers \NP\NP::sendWith
     */
    public function testSendWith()
    {
        $response = $this->instance->sendWith($this->modelName, $this->calledMethod);

        $this->assertInstanceOf(Response::class, $response);
    }
}
