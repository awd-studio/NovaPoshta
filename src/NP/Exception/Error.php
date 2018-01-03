<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Exception;

use JsonSerializable;
use NP\Http\Response;


/**
 * Class Error
 * @package NP\Exception
 */
class Error implements JsonSerializable
{

    /**
     * Current error codes with description.
     */
    const ERRORS = [
        1 => 'Unknown error. Please, contact your system administrator.',
        2 => 'No installed "Guzzle" library or "php_curl" extension!',
        3 => 'Undefined API model or method.',
        4 => 'HTTP Driver Error.',
    ];

    /**
     * @var string Error message.
     */
    private $success;

    /**
     * @var string Error message.
     */
    private $error;

    /**
     * @var int Error code.
     */
    private $code;

    /**
     * @var array current error.
     */
    private $errors = [];


    /**
     * Error constructor.
     *
     * @param string $message Error message.
     * @param int    $code    Error code.
     */
    public function __construct($message = '', $code = 1)
    {
        $this->error = !empty($message) ? $message : $this->getError();
        $this->code = $code;
        $this->errors[] = $this->getError();
        $this->success = false;
    }


    /**
     * Get current Error description.
     */
    public function getError()
    {
        return self::ERRORS[$this->code];
    }


    /**
     * Get response with error.
     *
     * @return Response
     */
    public function getResponse()
    {
        return new Response($this->toJson());
    }


    /**
     * Return JSON-encoded error.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this);
    }


    /**
     * Return error message.
     *
     * @return string
     */
    public function __toString()
    {
        return "Error: {$this->error} With code: {$this->code}";
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
