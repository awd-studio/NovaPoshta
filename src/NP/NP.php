<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author   Anton Karpov <awd.com.ua@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/awd-studio/novaposhta
 */

namespace NP;

use NP\Exception\BadFunctionCallException;
use NP\Exception\ErrorException;
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
    const NP_API_HOST = 'https://api.novaposhta.ua/v2.0/json/';

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
     * Initialize NovaPoshta instance.
     *
     * @param string               $key    API key.
     * @param DriverInterface|null $driver HTTP driver.
     *
     * @return NP
     * @throws ErrorException
     */
    public static function init($key, DriverInterface $driver = null)
    {
        self::$key = $key;
        self::$driver = isset($driver) ? $driver : self::getDefaultDriver();

        return self::getInstance();
    }


    /**
     * Get default HTTP driver.
     *
     * @return DriverInterface
     * @throws ErrorException
     */
    private static function getDefaultDriver()
    {
        try {
            $driver = new GuzzleDriver;
        } catch (\Exception $exception) {
            try {
                $driver = new CurlDriver;
            } catch (\Exception $exception) {
                throw new ErrorException(
                    'You need to install "Guzzle" library or "php_curl" extension in your project!'
                );
            }
        }

        return $driver;
    }


    /**
     * Get API key.
     *
     * @return string
     */
    public static function getKey()
    {
        return self::$key;
    }


    /**
     * Get HTTP driver.
     *
     * @return DriverInterface
     */
    public static function getDriver()
    {
        return self::$driver;
    }


    /**
     * Get model.
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }


    /**
     * Get HTTP request.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }


    /**
     * Get server response.
     *
     * @return Response
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
     * @throws BadFunctionCallException
     */
    public function with($modelName, $calledMethod, array $data = [])
    {
        $model = __NAMESPACE__ . "\\Model\\$modelName";

        try {
            $reflectionMethod = new \ReflectionMethod($model, $calledMethod);
        } catch (\ReflectionException $exception) {
            $message = "Undefined model or method \"$model::$calledMethod\"!";
            $message .= ' Error: ';
            $message .= $exception->getMessage();

            throw new BadFunctionCallException($message);
        }

        // Invoking model method.
        $this->model = $reflectionMethod->invoke(new $model($data));
        $this->request = new Request($this, $modelName, $calledMethod);

        return $this;
    }


    /**
     * Execute request.
     *
     * @return Response
     */
    public function send()
    {
        return $this->response = self::$driver->send($this->request);
    }
}
