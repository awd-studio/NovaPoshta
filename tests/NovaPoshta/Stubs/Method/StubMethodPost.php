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

namespace AwdStudio\NovaPoshta\Test\Stubs\Method;

use AwdStudio\NovaPoshta\Method\MethodPostInterface;

/**
 * Stub MethodPost
 *
 * @package AwdStudio\NovaPoshta\Test\Stubs\Method
 */
class StubMethodPost implements MethodPostInterface
{

    /** @var string */
    const CALLED_METHOD = 'stubMethodPost';

    /** @var string */
    const MODEL_NAME = 'stubModelPost';

    /** @var array */
    const PROPERTIES = [];

    /**
     * Get the name of method.
     *
     * @return string
     */
    public function getCalledMethod(): string
    {
        return self::CALLED_METHOD;
    }

    /**
     * Get the method properties array.
     *
     * @return array|null
     */
    public function getMethodProperties(): ?array
    {
        return self::PROPERTIES;
    }

    /**
     * Get the model name.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return self::MODEL_NAME;
    }
}
