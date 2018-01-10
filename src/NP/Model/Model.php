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

namespace NP\Model;

use NP\Exception\Errors;
use NP\Util\Helper;
use NP\Util\NPReflectionMethod;
use ReflectionException;


/**
 * Main Model class.
 * @package NP\Model
 */
class Model
{

    use Helper;

    /**
     * @var string
     */
    private $modelName;

    /**
     * @var string
     */
    private $calledMethod;


    /**
     * @var array Method properties.
     */
    private $methodProperties = [];


    /**
     * @var array Method parameters.
     */
    private $methodParams = [];


    /**
     * @var Errors NP Errors.
     */
    public static $errors;


    /**
     * Model constructor.
     *
     * @param array  $data   Data for send.
     * @param array  $params API available properties.
     * @param Errors $errors NP Errors.
     */
    final public function __construct(array $data = [], array $params = [], Errors &$errors)
    {
        self::$errors = &$errors;
        $this->methodParams = $params;

        // Set up model data
        $this->setMethodProperties($data);
        $this->setMethodParams();

        // Process model
        $this->processModel();
    }


    /**
     * Processing model by method date.
     */
    private function processModel()
    {
        if (!self::$errors->getStatus()) {
            $this->invokeMethod();
            $this->checkRequiredProperties();
        }
    }


    /**
     * Set method parameters.
     */
    protected function setMethodParams()
    {
        $defaults = [
            'name'           => '',
            'required'       => false,
            'callbackClass'  => $this,
            'callbackMethod' => 'setMethodProperties',
            'callbackData'   => 'getMethodProperties',
        ];

        foreach ($this->methodParams as $name => $prop) {
            $this->methodParams[$name] = array_merge($defaults, $prop);
        }
    }


    /**
     * Fill method parameters with defined methods.
     */
    protected function invokeMethod()
    {
        foreach ($this->methodParams as $name => $prop) {
            $class = $prop['callbackClass'];
            $method = $prop['callbackMethod'];
            $dataCallback = $prop['callbackData'];

            try {
                $data = null;
                try {
                    $data = NPReflectionMethod::build($class, $dataCallback, [$class]);
                } catch (ReflectionException $exception) {
                    $className = is_string($class) ? $class : get_class($class);
                    $message = "Data callback \"$className::$dataCallback\" - undefined!";
                    $message .= ' Error: ';
                    $message .= $exception->getMessage();

                    self::$errors->addError($message, 3);
                }

                NPReflectionMethod::build($class, $method, [$class, $data]);
            } catch (ReflectionException $exception) {
                $message = "Undefined callbackClass or callbackMethod \"$class::$method\"!";
                $message .= ' Error: ';
                $message .= $exception->getMessage();

                self::$errors->addError($message, 3);
            }
        }
    }


    /**
     * Set model name.
     *
     * @param string $modelName
     */
    public function setModelName(string $modelName)
    {
        $this->modelName = $modelName;
    }


    /**
     * Get model name.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return $this->modelName;
    }


    /**
     * Set called method.
     *
     * @param string $calledMethod
     */
    public function setCalledMethod(string $calledMethod)
    {
        $this->calledMethod = $calledMethod;
    }


    /**
     * Get called method.
     *
     * @return string
     */
    public function getCalledMethod(): string
    {
        return $this->calledMethod;
    }


    /**
     * Set method property.
     *
     * @param string $name
     * @param string $value
     */
    public function setMethodProperty(string $name, string $value)
    {
        $this->methodProperties[$name] = $value;
    }


    /**
     * Set method properties.
     *
     * @param array $data
     */
    public function setMethodProperties(array $data)
    {
        $this->methodProperties = $data;
    }


    /**
     * Get method properties.
     *
     * @return array
     */
    public function getMethodProperties(): array
    {
        return $this->methodProperties;
    }


    /**
     * Check required method properties.
     */
    public function checkRequiredProperties()
    {
        $errors = [];
        if ($this->methodParams) {
            $required = array_filter($this->methodParams, function ($v) {
                return (bool) $v['required'];
            });

            if ($required) {
                $params = array_map(function ($i) {
                    return $this->toActionCase($i);
                }, array_keys($this->methodParams));

                foreach ($params as $property) {
                    if (empty($this->methodParams[$property])) {
                        $errors[] = $property;
                    }
                }
            }
        }

        if ($errors) {
            $values = implode(', ', $errors);
            self::$errors->addError("Required properties: {$values} - not allowed!");
        }
    }


    /**
     * Get errors.
     *
     * @return Errors
     */
    public function getError(): Errors
    {
        return self::$errors;
    }
}
