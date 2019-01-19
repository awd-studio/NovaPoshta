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
class CurlRequestPost extends CurlRequestGet implements RequestInterfacePost
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
     * @return \AwdStudio\NovaPoshta\Http\RequestInterfacePost
     */
    public function setBody(string $body): RequestInterfacePost
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

        $bodyNodDefinedMessage = 'Body is not defined';
        $this->throwRequestException(empty($this->body), $bodyNodDefinedMessage);
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
        curl_setopt($this->chanel, CURLOPT_POSTFIELDS, $this->body);

        return parent::handleRequest();
    }
}
