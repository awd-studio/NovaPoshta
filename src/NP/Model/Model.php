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
     * @var array Method properties.
     */
    private $methodProperties;


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
     * Get method properties.
     *
     * @return array
     */
    public function getMethodProperties()
    {
        return $this->methodProperties;
    }


    /**
     * Set method properties.
     *
     * @param array $data
     * @return self
     */
    public function setMethodProperties(array $data)
    {
        $this->methodProperties = $data;

        return $this;
    }


    /**
     * Set method properties.
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function setMethodProperty($name, $value)
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
