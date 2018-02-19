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
use NP\Common\Util\Singleton;
use NP\Exception\Errors;
use NP\Http\Request;
use NP\Http\Response;


/**
 * Class TaskManager
 * @package NP\Common\Task
 */
class TaskManager extends Collection
{

    // ToDo: Remove singleton pattern;
    use Singleton;

    /**
     * @var Config NP instance config.
     */
    private static $config;


    /**
     * Initialize TaskManager.
     *
     * @param Config $config
     */
    public static function init($config)
    {
        self::$config = Config::getInstance()::setUp($config);
    }


    /**
     * Add new item to collection.
     *
     * @param Request $request
     * @param null    $key
     */
    public function new(Request $request, $key = null)
    {
        $this->add(new Task($request), $key ?? count($this->collection));
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
            if ($task = $this->getItem($id)) {
                $task->execute();
            } else {
                Errors::getInstance()->addError("There is no task with UD \"{$id}\"");
            }
        } else {
            array_map(function (Task $task) {
                $task->execute();
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
