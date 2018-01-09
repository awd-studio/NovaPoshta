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

namespace NP\Exception;

use JsonSerializable;
use NP\Http\Response;


/**
 * Class Error
 * @package NP\Exception
 */
class Errors implements JsonSerializable
{

    /**
     * Current error codes with description.
     */
    const ERRORS = [
        1 => 'Unknown error. Please, contact your system administrator.',
        2 => 'No installed "Guzzle" library or "php_curl" extension!',
        3 => 'Undefined API model or method.',
        4 => 'HTTP Driver Error.',
        5 => 'Model not defined.',
        6 => 'Request not defined.',
        7 => 'Required value not allowed.',
    ];

    /**
     * @var string Error message.
     */
    private $success = true;

    /**
     * @var array Current error.
     */
    private $errors = [];

    /**
     * @var array Error codes
     */
    private $errorCodes = [];


    /**
     * Add error.
     *
     * @param string $message Error message.
     * @param int    $code    Error code.
     *
     * @return int Added error key.
     */
    public function addError($message = '', $code = 1): int
    {
        $count = count($this->errors);
        $this->success = false;
        $this->errors[] = !empty($message) ? $message : $this->getErrorDescription($code);
        $this->errorCodes[] = $code;

        return $count;
    }


    /**
     * Get error from container by key.
     *
     * @param $key
     *
     * @return string
     */
    public function getError($key): string
    {
        return $this->errors[$key] ?: '';
    }


    /**
     * Get current Error description.
     * @param int $code
     *
     * @return string
     */
    public function getErrorDescription($code): string
    {
        return self::ERRORS[$code] ?? self::ERRORS[1];
    }


    /**
     * Get error status.
     *
     * @return bool
     */
    public function getStatus(): bool
    {
        return !$this->success;
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
        $errors = [];
        for ($i = 0, $l = count($this->errors); $i < $l; $i++) {
            $errors[] = "Error {$this->errors[$i]}, with code #{$this->errorCodes[$i]}";
        }

        $messages = implode('; ', $errors);

        return "Errors: {$messages}";
    }


    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
