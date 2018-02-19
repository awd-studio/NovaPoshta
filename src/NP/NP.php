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
use NP\Http\Request;
use NP\Http\Response;
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
     * NP constructor.
     *
     * @param mixed $config
     */
    private function __construct($config)
    {
        $this->config = Config::setUp($config);
        $this->taskManager = TaskManager::init();
    }


    /**
     * Initialize NovaPoshta instance.
     *
     * @param mixed $config
     *
     * @return NP
     */
    public static function init($config): NP
    {
        return new static($config);
    }


    /**
     * Model switcher.
     *
     * @param string $modelName    API model name.
     * @param string $calledMethod Model method.
     * @param array  $data         Data to send.
     * @param mixed  $key          Key to set item to task manager.
     */
    public function with(string $modelName, string $calledMethod, array $data = [], $key = null)
    {
        if ($modelBuilder = ModelBuilder::build($this->config, $modelName, $calledMethod, $data)) {
            $this->taskManager->new(new Request($modelBuilder, $this->config), $key);
        }
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
        return $this->taskManager->execute($id)->getResponse($id);
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
