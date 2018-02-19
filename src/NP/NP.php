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

use NP\Common\Task\TaskManager;
use NP\Http\Request;
use NP\Http\Response;
use NP\Common\Util\Singleton;
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

    use Singleton;

    /**
     * @var TaskManager
     */
    public static $taskManager;


    /**
     * Initialize NovaPoshta instance.
     *
     * @param mixed $config
     *
     * @return NP
     */
    public static function init($config): NP
    {
        self::$taskManager = TaskManager::getInstance();
        self::$taskManager::init($config);

        return self::getInstance();
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
        if ($model = ModelBuilder::build($modelName, $calledMethod, $data)) {
            self::$taskManager->new(new Request($model), $key);
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
        return self::$taskManager->execute($id);
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
        return self::$taskManager->execute($id)->getResponse($id);
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
