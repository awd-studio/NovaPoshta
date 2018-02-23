<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode


namespace NP\Common\Task;

use NP\Common\Config;
use NP\Common\Util\Collection;
use NP\Exception\Error;
use NP\Http\Request;
use NP\Http\Response;
use NP\Model\ModelBuilderInterface;


/**
 * Class TaskManager
 * @package NP\Common\Task
 */
class TaskManager extends Collection
{

    /**
     * Add new item to collection.
     *
     * @param ModelBuilderInterface $modelBuilder
     * @param Config                $config
     * @param mixed                 $key
     */
    public function add(ModelBuilderInterface $modelBuilder, Config $config, $key = null)
    {
        $task = new Task($config);
        if ($modelBuilder->hasError()) {
            $error = new Error($modelBuilder->error);
            $task->setResponse(new Response($error->toJson()));
        } else {
            $task->setRequest(new Request($modelBuilder));
        }

        $this->addItem($task, $key ?? count($this->collection));
    }


    /**
     * Get item by ID.
     *
     * @param mixed $id
     *
     * @return Task Item from collection by ID. If ID is NULL - return last added item.
     */
    public function getItem($id = null)
    {
        return parent::getItem($id);
    }


    /**
     * Execute task.
     * If ID not set - will be executed all tasks.
     *
     * @param mixed|null $id
     *
     * @return TaskManager
     */
    public function execute($id = null): TaskManager
    {
        if ($id) {
            if (!$task = $this->getItem($id)) {
                $task = new Task();
                $error = new Error("There is no task with ID \"{$id}\"");
                $task->setResponse(new Response($error->toJson()));
                $this->addItem($task);
            }
            $task->getResponse();
        } else {
            array_map(function (Task $task) {
                $task->getResponse();
            }, $this->collection);
        }

        return $this;
    }


    /**
     * Get response by ID.
     * Return last response if ID not set.
     *
     * @param null $id
     *
     * @return Response|null
     */
    public function getResponse($id = null)
    {
        return $this->getItem($id)->getResponse();
    }
}
