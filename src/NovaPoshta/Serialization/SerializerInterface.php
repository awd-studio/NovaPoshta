<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/NovaPoshta
 */

declare(strict_types=1); // strict mode

namespace AwdStudio\NovaPoshta\Serialization;

interface SerializerInterface
{
    /**
     * Return the type of format from supported by API.
     * Uses to build the path for request.
     * @example:
     *   - 'xml' for XML format,
     *   - 'json' for JSON format,
     *
     * Read about supported formats in developer documentation:
     * @link https://devcenter.novaposhta.ua/
     *
     * @return string
     */
    public static function format(): string;

    /**
     * Return a pack of headers needed for request.
     * Uses for Content-Type headers and so one.
     * @example:
     *   - ['Content-Type' => 'text/xml'] for XML format,
     *   - ['Content-Type' => 'application/json'] for JSON format,
     *
     * Read about supported formats in developer documentation:
     * @link https://devcenter.novaposhta.ua/
     *
     * @return array
     */
    public static function headers(): array;

    /**
     * Serialize data.
     *
     * @param mixed $data Data to serialize
     *
     * @return string
     */
    public function serialize($data): string;

    /**
     * Deserialize data.
     *
     * @param string $data Data to deserialize
     *
     * @return object
     */
    public function deserialize(string $data): object;
}
