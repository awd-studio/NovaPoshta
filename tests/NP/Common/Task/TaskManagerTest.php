<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Common\Task;

use NP\Common\Config;
use NP\Http\Response;
use NP\Mock\Model\MockModelBuilder;
use NP\Model\ModelBuilderInterface;
use PHPUnit\Framework\TestCase;

class TaskManagerTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Common\Task\TaskManager
     */
    private $instance;

    /**
     * @var ModelBuilderInterface
     */
    private $modelBuilder;

    /**
     * @var Config
     */
    private $config;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->modelBuilder = new MockModelBuilder();
        $this->config = Config::setUp('testKey');
        $this->instance = new TaskManager();
    }


    /**
     * @covers \NP\Common\Task\TaskManager::add
     * @covers \NP\Common\Task\TaskManager::getItem
     */
    public function testAddGetItem()
    {
        $id = $this->instance->add(new MockModelBuilder(false), $this->config);
        $this->assertInstanceOf(Task::class, $this->instance->getItem($id));
    }


    /**
     * @covers \NP\Common\Task\TaskManager::execute
     */
    public function testExecute()
    {
        $id = $this->instance->add(new MockModelBuilder(false), $this->config);
        $this->assertInstanceOf(TaskManager::class, $this->instance->execute($id));
        $this->assertInstanceOf(TaskManager::class, $this->instance->execute('noExistsId'));
    }


    /**
     * @covers \NP\Common\Task\TaskManager::add
     * @covers \NP\Common\Task\TaskManager::getResponse
     */
    public function testGetResponse()
    {
        $id = $this->instance->add($this->modelBuilder, $this->config);
        $this->assertInstanceOf(Response::class, $this->instance->getResponse($id));
    }
}
