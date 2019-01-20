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

namespace AwdStudio\NovaPoshta\Entity;


use AwdStudio\NovaPoshta\Method\MethodGetInterface;

/**
 * Class GetQuery
 * Creates query for the GET request.
 *
 * @package AwdStudio\NovaPoshta\Entity
 */
class GetQuery implements GetQueryInterface
{

    /** @var MethodGetInterface */
    private $method;

    /**
     * GetQuery constructor.
     *
     * @param \AwdStudio\NovaPoshta\Method\MethodGetInterface $method
     */
    public function __construct(MethodGetInterface $method)
    {
        $this->method = $method;
    }

    /**
     * Build query array.
     *
     * @param array $params
     *s
     * @return \Generator
     */
    public function generateQuery(array $params): \Generator
    {
        foreach ($params as $k => $value) {
            if (is_array($value)) {
                foreach ($value as $subValue) {
                    yield "{$k}[]";
                    yield $subValue;
                }
            } else {
                yield $k;
                yield $value;
            }
        }
    }

    /**
     * Build query string.
     *
     * @return string
     */
    public function buildQuery(): string
    {
        $params = $this->method->getQueryParameters();
        $iterator = $this->generateQuery($params);
        $result = iterator_to_array($iterator);
        array_unshift($result, $this->method->getCalledMethod());
        array_unshift($result, $this->method->getModelName());

        return implode('/', $result);
    }
}
