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
    public function __construct(array $data = [], array $params = [])
    {
        // Set up model data
        $this->methodParams = $params;
        $this->methodProperties = $data;

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
            'callbackMethod' => 'setMethodProperty',
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
        try {
            foreach ($this->methodParams as $name => $prop) {
                $method = $prop['callbackMethod'];
                if ($method !== 'setMethodProperty') {
                    if (method_exists($this, $method)) {
                        $this->methodParams[$prop['name']] = $this->{$method}($this->getMethodProperties());
                    } else {
                        throw new ErrorException("Undefined callback method!");
                    }
                }
            }
        } catch (ErrorException $exception) {
            throw new ErrorException($exception->getMessage());
        }
    }


    /**
     * Set method properties.
     *
     * @param string $name
     * @param mixed  $data
     */
    public function setMethodProperty(string $name, $data)
    {
        $this->methodProperties[$name] = $data;
    }


    /**
     * Get method properties.
     *
     * @param string $name
     * @return mixed
     */
    public function getMethodProperty(string $name)
    {
        return isset($this->methodProperties[$name]) ? $this->methodProperties[$name] : null;
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
     */
    public function checkRequiredProperties()
    {
        $errors = [];
        if ($this->methodParams) {
            if ($required = array_filter($this->methodParams, function ($v) {
                return $v['required'];
            })) {
                foreach ($required as $property) {
                    $name = $property['name'];
                    if (empty($this->methodProperties[$name])) {
                        $errors[] = $name;
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
