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

use NP\Exception\Error;
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
     * API endpoint.
     */
    const NP_API_HOST_JSON = 'https://api.novaposhta.ua/v2.0/json/';

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
     * @var Error
     */
    private static $error;


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
                self::$error = new Error('', 2);
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
            $this->model = $reflectionMethod->invoke(new $model($data));
            $this->request = new Request($this, $modelName, $calledMethod);
        } catch (\ReflectionException $exception) {
            $message = "Undefined model or method \"$model::$calledMethod\"!";
            $message .= ' Error: ';
            $message .= $exception->getMessage();

            self::$error = new Error($message, 2);
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
        if (self::$error) {
            return $this->response = self::$error->getResponse();
        }

        return $this->response = $this->request->execute(self::$driver);
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
