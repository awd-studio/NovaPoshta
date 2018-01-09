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
     * @param array  $action API Action properties.
     * @param array  $params API available properties.
     * @param Errors $errors NP Errors.
     */
    final public function __construct(array $data = [], array $action, array $params = [], Errors &$errors)
    {
        self::$errors = &$errors;
        $this->methodParams = $params;

        $this->setActionProperties($action);
        $this->setMethodProperties($data);
        $this->setMethodParams();
        $this->invokeMethod();
        $this->checkRequiredProperties();
    }


    /**
     * Set method parameters.
     */
    protected function setMethodParams()
    {
        $defaults = [
            'name'           => '',
            'required'       => false,
            'callbackClass'  => $this->getModelName() ?: __CLASS__,
            'callbackMethod' => 'setMethodProperties',
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
            $class = __NAMESPACE__ . "\\" . $prop['callbackClass'];
            $method = $prop['callbackMethod'];

            try {
                $reflectionMethod = new \ReflectionMethod($class, $method);
                $reflectionMethod->invoke($this);
            } catch (\ReflectionException $exception) {
                $message = "Undefined callbackClass or callbackMethod \"$class::$method\"!";
                $message .= ' Error: ';
                $message .= $exception->getMessage();

                self::$errors->addError($message, 3);
            }
        }
    }


    /**
     * Set API action properties.
     *
     * @param array $action
     */
    protected function setActionProperties($action)
    {
        if (count($action) == 1 && isset($action[0])) {
            $action = reset($action);
        }

        foreach ($action as $itemName => $itemValue) {
            if (isset($this->{$itemName}) || $this->{$itemName} === null) {
                $this->{$itemName} = $itemValue;
            }
        }
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
     * Set model name.
     *
     * @param string $modelName
     */
    public function setModelName(string $modelName)
    {
        $this->modelName = $modelName;
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
     * Set called method.
     *
     * @param string $calledMethod
     */
    public function setCalledMethod(string $calledMethod)
    {
        $this->calledMethod = $calledMethod;
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
     * Set method properties.
     *
     * @param array $data
     *
     * @return self
     */
    public function setMethodProperties(array $data): self
    {
        $this->methodProperties = $data;

        return $this;
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
