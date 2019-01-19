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

namespace AwdStudio\NovaPoshta\Http;

use AwdStudio\NovaPoshta\Exception\RequestException;

/**
 * Base Request
 * @package AwdStudio\NovaPoshta\Http
 */
class CurlRequestGet implements RequestInterface
{
    /** @var string */
    protected $url;

    /** @var array */
    protected $headers = [];

    /** @var resource|false */
    protected $chanel;

    /** @var string */
    protected $method = 'GET';

    /**
     * CurlHttpDriver constructor.
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function __construct()
    {
        $this->tryCurl();
        $this->curlInit();
    }

    /**
     * React on wrong settings.
     *
     * @param bool $throw
     * @param string $message
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function throwRequestException(bool $throw, string $message)
    {
        if ($throw) {
            throw new RequestException($message);
        }
    }

    /**
     * Check if the cURL library doesn't exist on server
     *
     * @return void
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function tryCurl(): void
    {
        $message = 'There no cURL extension on server! See: http://php.net/manual/en/book.curl.php';
        $this->throwRequestException(!function_exists('curl_version'), $message);
    }

    /**
     * Initialize cURL with default properties.
     */
    public function curlInit()
    {
        $this->chanel = curl_init();
        curl_setopt($this->chanel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->chanel, CURLOPT_HTTP_VERSION, $this->method);
        curl_setopt($this->chanel, CURLOPT_CUSTOMREQUEST, CURL_HTTP_VERSION_1_1);
    }

    /**
     * Set up request with headers.
     *
     * @param array|null $headers
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterface
     */
    public function setHeaders(?array $headers = null): RequestInterface
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Set the URL address.
     *
     * @param string $url
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterface
     */
    public function setUrl(string $url): RequestInterface
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Check request errors.
     *
     * @param int $errorCode
     *
     * @return void
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function checkErrors(int $errorCode): void
    {
        if ($errorCode !== 0) {
            $message = sprintf("cURL Error #%d: %s", $errorCode, curl_error($this->chanel));
            $this->throwRequestException(true, $message);
        }
    }

    /**
     * Checks if the request is valid.
     *
     * @return void
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function validateRequest()
    {
        $urlNodDefinedMessage = 'URL is not defined';
        $this->throwRequestException(empty($this->url), $urlNodDefinedMessage);

        $notValidUrlMessage = sprintf('URL "%s" is not valid', $this->url);
        $this->throwRequestException(filter_var($this->url, FILTER_VALIDATE_URL) === false, $notValidUrlMessage);
    }

    /**
     * Execute request to API and return the request.
     *
     * @return string API response
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function handleRequest(): string
    {
        curl_setopt($this->chanel, CURLOPT_URL, $this->url);
        curl_setopt($this->chanel, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($this->chanel);
        $this->checkErrors(curl_errno($this->chanel));
        curl_close($this->chanel);

        return (string)$response;
    }

    /**
     * Execute the request.
     *
     * @return string
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function execute(): string
    {
        $this->validateRequest();

        return $this->handleRequest();
    }
}
