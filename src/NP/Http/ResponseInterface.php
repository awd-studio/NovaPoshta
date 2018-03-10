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


namespace NP\Http;


/**
 * Interface ResponseInterface
 * @package NP\Http
 */
interface ResponseInterface
{

    /**
     * Get current server response.
     *
     * @return string
     */
    public function getRaw(): string;


    /**
     * Get processed (decoded) response data.
     *
     * @return object
     */
    public function getData();


    /**
     * Get response status.
     *
     * @return bool
     */
    public function isSuccess(): bool;


    /**
     * Get response property.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name);
}