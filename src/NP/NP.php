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

namespace NP;

use NP\Common\Config;
use NP\Common\Task\TaskManager;
use NP\Http\Response;
use NP\Model\Model;
use NP\Model\ModelBuilder;


/**
 * Class NP
 *
 * Main class.
 *
 * @package NP
 */
final class NP
{

    /**
     * @var Config NP instance config.
     */
    private $config;

    /**
     * @var TaskManager
     */
    public $taskManager;


    /**
     * Initialize NovaPoshta instance.
     *
     * @param mixed $config
     *
     * @return NP
     */
    public static function init($config): NP
    {
        $np = new static();
        $np->config = Config::setUp($config);
        $np->taskManager = new TaskManager();

        return $np;
    }


    /**
     * Model switcher.
     *
     * @param string|Model $model        API model name.
     * @param string       $calledMethod Model method.
     * @param array        $data         Data to send.
     * @param mixed        $key          Key to set item to task manager.
     */
    public function with($model, string $calledMethod, array $data = [], $key = null)
    {
        $modelBuilder = ModelBuilder::build($this->config, $model, $calledMethod, $data);
        $this->taskManager->add($modelBuilder, $this->config, $key);
    }


    /**
     * Execute request.
     *
     * @param mixed $id Task Id.
     *
     * @return TaskManager
     */
    public function execute($id = null): TaskManager
    {
        return $this->taskManager->execute($id);
    }


    /**
     * Execute request.
     *
     * @param mixed $id Task Id.
     *
     * @return Response
     */
    public function send($id = null): Response
    {
        return $this->execute($id)->getResponse($id);
    }


    /**
     * Send data with model and method.
     *
     * @param string $modelName    API model name.
     * @param string $calledMethod Model method.
     * @param array  $data         Data to send.
     *
     * @return Response
     */
    public function sendWith(string $modelName, string $calledMethod, array $data = []): Response
    {
        $this->with($modelName, $calledMethod, $data);

        return $this->send();
    }
}
