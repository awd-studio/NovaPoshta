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


namespace NP\Mock\Model;

use NP\Model\ModelBuilderInterface;


/**
 * Class MockModelBuilder
 *
 * @property string apiKey
 * @property string modelName
 * @property string calledMethod
 * @property array  methodProperties
 * @property string error
 *
 * @package NP\Model
 */
class MockModelBuilder implements ModelBuilderInterface
{
    /**
     * MockModelBuilder constructor.
     */
    public function __construct(bool $hasError = true)
    {
        if ($hasError) {
            $this->error = 'Mock Model Builder Error';
        } else {
            $this->apiKey = '';
            $this->modelName = 'mockModelName';
            $this->calledMethod = 'mockCalledMethod';
            $this->methodProperties = [];
        }
    }


    /**
     * Has error.
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return isset($this->error);
    }


    /**
     * Get serialized object.
     *
     * @return object
     */
    public function getBody()
    {
        return get_object_vars($this);
    }
}
