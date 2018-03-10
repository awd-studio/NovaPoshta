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
 * Class Response.
 *
 * Processed server response.
 *
 * @package NP\Http
 */
class Response implements ResponseInterface
{

    /**
     * @var string Raw server data.
     */
    private $response;

    /**
     * @var object Decoded data.
     */
    private $data;


    /**
     * Response constructor.
     *
     * @param string $response - Server JSON response.
     */
    public function __construct(string $response)
    {
        $this->response = $response;
        $this->data = $this->getData();
    }


    /**
     * Get current server response.
     *
     * @return string
     */
    public function getRaw(): string
    {
        return $this->response;
    }


    /**
     * Get processed (decoded) response data.
     *
     * @return object
     */
    public function getData()
    {
        return json_decode($this->response);
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getRaw();
    }


    /**
     * Get response status.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return (isset($this->data->success) && $this->data->success);
    }


    /**
     * Get response property.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return isset($this->data->{$name}) ? $this->data->{$name} : null;
    }
}
