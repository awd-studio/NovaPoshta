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
class CurlRequestGet implements RequestGetInterface
{
    /** @var string */
    protected $url;

    /** @var array */
    protected $headers = [];

    /** @var string */
    protected $method = 'GET';

    /**
     * CurlHttpDriver constructor.
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function __construct()
    {
        $this->tryCurl();
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
     * Set up request with headers.
     *
     * @param array|null $headers
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     */
    public function setHeaders(?array $headers = null): RequestGetInterface
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Set the URL address.
     *
     * @param string $url
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     */
    public function setUrl(string $url): RequestGetInterface
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Initialize cURL with default properties.
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function curlInit()
    {
        $this->validateRequest();

        $chanel = curl_init();
        curl_setopt($chanel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chanel, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($chanel, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($chanel, CURLOPT_URL, $this->url);
        curl_setopt($chanel, CURLOPT_HTTPHEADER, $this->headers);

        return $chanel;
    }

    /**
     * Check request errors.
     *
     * @param int $errorCode
     * @param string $errorMessage
     *
     * @return void
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function checkErrors(int $errorCode, string $errorMessage): void
    {
        if ($errorCode !== 0) {
            $message = sprintf("cURL Error #%d: %s", $errorCode, $errorMessage);
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
        $urlNotDefinedMessage = 'URL is not defined';
        $this->throwRequestException(empty($this->url), $urlNotDefinedMessage);

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
        $chanel = $this->curlInit();
        $response = curl_exec($chanel);
        $this->checkErrors(curl_errno($chanel), curl_error($chanel));
        curl_close($chanel);

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
        return $this->handleRequest();
    }
}
