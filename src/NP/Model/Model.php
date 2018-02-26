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

use NP\Exception\ErrorException;
use NP\Common\Util\Helper;
use NP\Common\Util\NPReflectionMethod;
use ReflectionException;


/**
 * Main Model class.
 * @package NP\Model
 */
class Model
{

    use Helper;

    /**
     * @var array Method properties.
     */
    private $methodProperties = [];

    /**
     * @var array Method parameters.
     */
    private $methodParams = [];


    /**
     * Model constructor.
     *
     * @param array $data   Data for send.
     * @param array $params API available properties.
     *
     * @throws ErrorException
     */
    final public function __construct(array $data = [], array $params = [])
    {
        $this->methodParams = $params;

        // Set up model data
        $this->setMethodProperties($data);
        $this->setMethodParams();

        // Process model
        $this->processModel();
    }


    /**
     * Processing model by method date.
     *
     * @throws ErrorException
     */
    private function processModel()
    {
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
     *
     * @throws ErrorException
     */
    protected function invokeMethod()
    {
        foreach ($this->methodParams as $name => $prop) {
            $class = $prop['callbackClass'];
            $method = $prop['callbackMethod'];
            $callbackData = $prop['callbackData'];

            try {
                $data = NPReflectionMethod::build($class, $callbackData, [$class]);
                NPReflectionMethod::build($class, $method, [$class, $data]);
            } catch (ReflectionException $exception) {
                $message = "Undefined callbackClass or callbackMethod!";
                $message .= ' Error: ';
                $message .= $exception->getMessage();

                throw new ErrorException($message);
            }
        }
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
     *
     * @throws ErrorException
     *
     * ToDo: Refactor;
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
            throw new ErrorException("Required properties: {$values} - not allowed!");
        }
    }
}
