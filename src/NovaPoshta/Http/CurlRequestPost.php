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

/**
 * Class CurlRequestPost
 *
 * @package AwdStudio\NovaPoshta\Http
 */
class CurlRequestPost extends CurlRequestGet implements RequestPostInterface
{
    /** @var string */
    protected $body;

    /** @var string */
    protected $method = 'POST';

    /**
     * Set requested body data.
     *
     * @param string $body
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestPostInterface
     */
    public function setBody(string $body): RequestPostInterface
    {
        $this->body = $body;

        return $this;
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
        parent::validateRequest();

        $headersNotDefinedMessage = 'Headers are not defined';
        $this->throwRequestException(empty($this->headers), $headersNotDefinedMessage);

        $bodyNotDefinedMessage = 'Body is not defined';
        $this->throwRequestException(empty($this->body), $bodyNotDefinedMessage);
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
        curl_setopt($chanel, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($chanel, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($chanel, CURLOPT_URL, $this->url);
        curl_setopt($chanel, CURLOPT_POST, true);
        curl_setopt($chanel, CURLOPT_POSTFIELDS, $this->body);

        return $chanel;
    }
}
