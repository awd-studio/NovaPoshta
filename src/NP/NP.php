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

use NP\Entity\Config;
use NP\Exception\Errors;
use NP\Http\Request;
use NP\Http\Response;
use NP\Model\Model;
use NP\Util\ActionDoc;
use NP\Util\Singleton;


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
     * @var Errors
     */
    public static $errors;

    /**
     * @var Model Current model.
     */
    private $model;

    /**
     * @var Request HTTP request.
     */
    private $request;

    /**
     * @var Response Server response.
     */
    private $response;


    /**
     * Initialize NovaPoshta instance.
     *
     * @param mixed $config
     *
     * @return NP
     */
    public static function init($config): NP
    {
        self::$errors = new Errors();
        self::$config = Config::setUp($config, self::$errors);

        return self::getInstance();
    }


    /**
     * Get Config.
     *
     * @return Config
     */
    public static function config(): Config
    {
        return self::$config;
    }


    /**
     * Get model.
     *
     * @return Model|null
     */
    public function getModel()
    {
        return $this->model;
    }


    /**
     * Get HTTP request.
     *
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }


    /**
     * Get server response.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * Get errors.
     *
     * @return Errors
     */
    public function getErrors(): Errors
    {
        return self::$errors;
    }


    /**
     * Checking errors.
     *
     * @return bool
     */
    public function checkErrors()
    {
        if (!isset($this->model)) {
            self::$errors->addError('', 5);
        }

        if (!isset($this->request)) {
            self::$errors->addError('', 6);
        }

        return self::$errors->getStatus();
    }


    /**
     * Model switcher.
     *
     * @param string $modelName    API model name.
     * @param string $calledMethod Model method.
     * @param array  $data         Data to send.
     *
     * @return self
     */
    public function with(string $modelName, string $calledMethod, array $data = []): self
    {
        $model = __NAMESPACE__ . "\\Model\\$modelName";

        // Getting reflection of model with called method.
        // Replacing called method name with [*Action] suffix.
        // Catching Reflection exception if model or method is unavailable.
        try {
            $reflectionMethod = new \ReflectionMethod($model, "{$calledMethod}Action");

            $action = (new ActionDoc($reflectionMethod))->getAnnotation('Action');
            $params = (new ActionDoc($reflectionMethod))->getAnnotation('ActionParam');

            // Create model
            $this->model = $reflectionMethod->invoke(new $model($data, $action, $params, self::$errors));

            // Create request
            $this->request = new Request($this);
        } catch (\ReflectionException $exception) {
            $message = "Undefined model or method \"$model::$calledMethod\"!";
            $message .= ' Error: ';
            $message .= $exception->getMessage();

            self::$errors->addError($message, 3);
        } finally {
            return $this;
        }
    }


    /**
     * Execute request.
     *
     * @return Response
     */
    public function send(): Response
    {
        if ($this->checkErrors()) {
            $this->response = self::$errors->getResponse();
        } else {
            $this->response = $this->request->execute();
        }

        return $this->response;
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


    /**
     * Reset NovaPoshta instance.
     *
     * Unset Model, Request and Response on instance.
     * Clear Errors.
     *
     * @return self
     */
    public function reset()
    {
        $this->model = null;
        $this->request = null;
        $this->response = null;
        self::$errors = new Errors();

        return $this;
    }
}
