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


/**
 * Class Error
 * @package NP\Exception
 */
class Error implements JsonSerializable
{

    /**
     * @var bool Success status.
     */
    private $success = false;

    /**
     * @var string Error message.
     */
    private $error;

    /**
     * @var int Error code.
     */
    private $code;


    /**
     * Errors constructor.
     * @param string $message Error message.
     * @param int    $code    Error code.
     */
    public function __construct(string $message, int $code = 0)
    {
        $this->error = $message;
        $this->code = $code;
    }


    /**
     * Get error message.
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }


    /**
     * Get error code.
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
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
        return "Error: {$this->error}";
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
