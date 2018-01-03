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


/**
 * Main Model class.
 * @package NP\Model
 */
class Model
{

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
     * Model constructor.
     *
     * @param array $data Data for send.
     */
    final public function __construct(array $data = [])
    {
        $this->setMethodProperties($data);
    }


    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->modelName;
    }


    /**
     * @param string $modelName
     */
    public function setModelName(string $modelName)
    {
        $this->modelName = $modelName;
    }


    /**
     * @return string
     */
    public function getCalledMethod(): string
    {
        return $this->calledMethod;
    }


    /**
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
     *
     * @return self
     */
    public function setMethodProperty(string $name, string $value): self
    {
        $this->methodProperties[$name] = $value;

        return $this;
    }


    /**
     * Check required method properties.
     *
     * @param array $properties
     *
     * @throws \NP\Exception\ErrorException
     */
    public function getRequiredProperties(array $properties)
    {
        $methodProperties = $this->getMethodProperties();

        foreach ($properties as $value) {
            if (empty($methodProperties[$value])) {
                throw new ErrorException("Property \"$value\" is required!");
            }
        }
    }
}
