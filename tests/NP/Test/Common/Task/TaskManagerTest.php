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
use NP\Common\Task\TaskManager;
use NP\Mock\Http\MockRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class TaskManagerTest
 * @package NP\Test\Common\Task
 */
class TaskManagerTest extends TestCase
{

    /**
     * Instance.
     *
     * @var TaskManager
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = TaskManager::getInstance();
    }


    /**
     * @covers \NP\Common\Task\TaskManager::add
     * @covers \NP\Common\Task\TaskManager::getItem
     */
    public function testNew()
    {
        $request = new MockRequest();
        $key = 'test';
        $this->instance->add($request, $key);

        $this->assertEquals(new Task($request), $this->instance->getItem());
    }


    /**
     * @covers \NP\Common\Task\TaskManager::execute
     */
    public function testExecute()
    {
        $this->assertInstanceOf(TaskManager::class, $this->instance->execute(1));
    }
}
