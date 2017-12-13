<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author   Anton Karpov <awd.com.ua@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/awd-studio/novaposhta
 */

namespace NP\Http;


/**
 * Class Response.
 *
 * Processed server response.
 *
 * @package NP\Http
 */
class Response
{
    /**
     * @var string - Raw server data.
     */
    private $response;


    /**
     * Response constructor.
     *
     * @param string $response - Server JSON response.
     */
    public function __construct($response)
    {
        $this->response = $response;
    }


    /**
     * Get current server response.
     *
     * @return string
     */
    public function getRaw()
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
}
