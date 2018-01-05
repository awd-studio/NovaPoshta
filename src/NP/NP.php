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

use NP\Exception\Errors;
use NP\Http\CurlDriver;
use NP\Http\DriverInterface;
use NP\Http\GuzzleDriver;
use NP\Http\Request;
use NP\Http\Response;
use NP\Model\Model;


/**
 * Class NP
 *
 * Main class.
 *
 * @package NP
 */
final class NP
{

    use Util\Singleton;

    /**
     * @var string API key.
     */
    private static $key;

    /**
     * @var DriverInterface HTTP driver.
     */
    private static $driver;

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
     * @var Errors
     */
    private static $errors;


    /**
     * Initialize NovaPoshta instance.
     *
     * @param string          $key    API key.
     * @param DriverInterface $driver HTTP driver.
     *
     * @return NP
     */
    public static function init(string $key, DriverInterface $driver = null): NP
    {
        self::$errors = new Errors();
        self::$key = $key;
        self::$driver = $driver ?: self::getDefaultDriver();

        return self::getInstance();
    }


    /**
     * Get default HTTP driver.
     *
     * @return DriverInterface
     */
    private static function getDefaultDriver(): DriverInterface
    {
        try {
            $driver = new GuzzleDriver;
        } catch (\Exception $exception) {
            try {
                $driver = new CurlDriver;
            } catch (\Exception $exception) {
                $driver = null;
                self::$errors->addError('', 2);
            }
        }

        return $driver;
    }


    /**
     * Get API key.
     *
     * @return string
     */
    public static function getKey(): string
    {
        return self::$key;
    }


    /**
     * Get HTTP driver.
     *
     * @return DriverInterface
     */
    public static function getDriver(): DriverInterface
    {
        return self::$driver;
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
     * Checking errors.
     *
     * @return bool
     */
    public function getErrors()
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

            // Make model
            $this->model = $reflectionMethod->invoke(new $model($data));
            $this->model->setModelName($modelName);
            $this->model->setCalledMethod($calledMethod);

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
        $this->response = $this->getErrors() ? self::$errors->getResponse() : $this->request->execute(self::$driver);

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
