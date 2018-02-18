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
use NP\Common\Util\Singleton;
use NP\Http\Response;


/**
 * Class Error
 * @package NP\Exception
 */
class Errors implements JsonSerializable
{

    use Singleton;

    /**
     * @var string Error message.
     */
    private $success = true;

    /**
     * @var array Current error.
     */
    private $errors = [];


    /**
     * Add error.
     *
     * @param string $message Error message.
     *
     * @return self.
     */
    public function addError(string $message): self
    {
        $this->success = false;
        $this->errors[] = $message;

        return $this;
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
        return $this->errors[$key] ?? '';
    }


    /**
     * Get all errors.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
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
        $messages = implode('; ', array_map(function ($error) {
            return "Error: {$error}";
        }, $this->errors));

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
