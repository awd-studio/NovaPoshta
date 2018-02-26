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


/**
 * ModelBuilder Interface
 *
 * @property string apiKey
 * @property string modelName
 * @property string calledMethod
 * @property array  methodProperties
 * @property string error
 *
 * @package NP\Model
 */
interface ModelBuilderInterface
{

    /**
     * Has error.
     *
     * @return bool
     */
    public function hasError(): bool;

    /**
     * Get serialized object.
     *
     * @return array
     */
    public function getBody();
}
