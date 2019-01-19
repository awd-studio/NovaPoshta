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

use AwdStudio\NovaPoshta\ConfigInterface;
use AwdStudio\NovaPoshta\Exception\RequestException;
use AwdStudio\NovaPoshta\Method\MethodGetInterface;
use AwdStudio\NovaPoshta\Method\MethodInterface;
use AwdStudio\NovaPoshta\Method\MethodPostInterface;
use AwdStudio\NovaPoshta\Serialization\SerializerInterface;

/**
 * Class to build Requests depended on their data.
 *
 * @package AwdStudio\NovaPoshta\Http
 */
class CurlRequestFactory
{
    /** @var \AwdStudio\NovaPoshta\ConfigInterface */
    private $config;

    /** @var \AwdStudio\NovaPoshta\Method\MethodInterface */
    private $method;

    /** @var \AwdStudio\NovaPoshta\Serialization\SerializerInterface */
    private $serializer;

    /** @var \AwdStudio\NovaPoshta\Http\RequestInterface */
    private $request;

    /** @var string */
    private $url;

    /** @var array */
    private $headers;

    /**
     * Set the config.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface|null $config
     *
     * @return CurlRequestFactory
     */
    public function setConfig(?ConfigInterface $config): CurlRequestFactory
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Set the method.
     *
     * @param \AwdStudio\NovaPoshta\Method\MethodInterface|null $method
     *
     * @return CurlRequestFactory
     */
    public function setMethod(?MethodInterface $method): CurlRequestFactory
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set a serializer.
     *
     * @param \AwdStudio\NovaPoshta\Serialization\SerializerInterface|null $serializer
     *
     * @return CurlRequestFactory
     */
    public function setSerializer(?SerializerInterface $serializer): CurlRequestFactory
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * Throw an exception.
     *
     * @param bool $throw
     * @param string|null $message
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function throwRequestException(bool $throw, ?string $message = null)
    {
        if ($throw) {
            throw new RequestException($message);
        }
    }

    /**
     * Build query array.
     *
     * @param array $params
     *s
     * @return \Generator
     */
    public function generateQuery(array $params): \Generator
    {
        foreach ($params as $k => $value) {
            if (is_array($value)) {
                foreach ($value as $subValue) {
                    yield "{$k}[]";
                    yield $subValue;
                }
            } else {
                yield $k;
                yield $value;
            }
        }
    }

    /**
     * Build the query path for the request.
     *
     * @param \AwdStudio\NovaPoshta\Method\MethodGetInterface $method
     *
     * @return string
     */
    public function buildGetQuery(MethodGetInterface $method): string
    {
        $params = $method->getQueryParameters();
        $iterator = $this->generateQuery($params);
        $result = iterator_to_array($iterator);
        array_unshift($result, $this->method->getCalledMethod());
        array_unshift($result, $this->method->getModelName());

        return implode('/', $result);
    }

    /**
     * Build the POST body for request.
     *
     * @param \AwdStudio\NovaPoshta\Method\MethodPostInterface $method
     *
     * @return object
     */
    public function buildPostData(MethodPostInterface $method): object
    {
        $data = new \stdClass();
        $data->modelName = $method->getModelName();
        $data->calledMethod = $method->getCalledMethod();
        $data->methodProperties = $method->getMethodProperties();
        $data->apiKey = $this->config->getApiKey();

        return $data;
    }

    /**
     * Build the request.
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function build(): RequestInterface
    {
        $this->throwRequestException(!$this->config instanceof ConfigInterface, 'No configuration defined!');
        $this->throwRequestException(!$this->method instanceof MethodInterface, 'No API method defined!');

        $this->url = $this->config->getApiEntry();

        if ($this->method instanceof MethodGetInterface) {
            $this->url .= $this->buildGetQuery($this->method);
            $this->request = new CurlRequestGet();
        }

        if ($this->method instanceof MethodPostInterface) {
            $this->throwRequestException(!$this->serializer instanceof SerializerInterface, 'No serializer defined!');
            $this->url .= $this->serializer::format();
            $postData = $this->buildPostData($this->method);
            $body = $this->serializer->serialize($postData);
            $this->request = new CurlRequestPost();
            $this->request->setBody($body);
        }

        $this->request->setUrl($this->url);
        $this->request->setHeaders($this->headers);

        return $this->request;
    }
}
