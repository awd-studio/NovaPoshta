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
use NP\Common\Config;
use NP\Exception\Errors;
use NP\Http\Request;
use NP\Http\Response;
use NP\Common\Util\ActionDoc;
use NP\Common\Util\NPReflectionMethod;
use NP\Common\Util\Singleton;
use ReflectionException;


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
     * @var Config NP instance config.
     */
    private static $config;

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
        self::$config = Config::setUp($config);

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
        $modelClass = __NAMESPACE__ . "\\Model\\$modelName"; // Build full model name

        // Try to model reflection with called method.
        // Catch Reflection exception if model or method is unavailable.
        try {
            // Replacing called method name with [*Action] suffix.
            $reflectionMethod = new NPReflectionMethod($modelClass, "{$calledMethod}Action");

            // Get method parameters from annotation
            $params = (new ActionDoc($reflectionMethod))->getAnnotation('ActionParam');

            // Create model
            $model = $reflectionMethod->invoke(new $modelClass($data, $params, Errors::getInstance()));
            $model->setModelName($modelName);
            $model->setCalledMethod($calledMethod);

            // Add task to manager
            self::$taskManager->new(new Request($model), $key);
        } catch (ReflectionException $exception) {
            $message = "Undefined model or method \"$modelClass::$calledMethod\"!";
            $message .= ' Error: ';
            $message .= $exception->getMessage();

            Errors::getInstance()->addError($message);
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
