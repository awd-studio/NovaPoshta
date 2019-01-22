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

use AwdStudio\NovaPoshta\Method\MethodGetInterface;

/**
 * Stub MethodGet
 *
 * @package AwdStudio\NovaPoshta\Test\Stubs\Method
 */
class StubMethodGet implements MethodGetInterface
{
    /** @var array */
    const QUERY_PARAMETERS = [
        'model' => 'method',
        'orders' => [
            '1234567891234',
            '1234567891235',
        ],
        'test' => 'data',
        'apiKey' => 'MY_KEY',
    ];

    /** @var string */
    const CALLED_METHOD = 'stubMethodGet';

    /** @var string */
    const MODEL_NAME = 'stubModelGet';

    /**
     * Get query parameters to use for request building.
     *
     * @return array
     */
    public function getQueryParameters(): array
    {
        return self::QUERY_PARAMETERS;
    }

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
     * Get the model name.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return self::MODEL_NAME;
    }
}
