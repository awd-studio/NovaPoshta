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
use AwdStudio\NovaPoshta\Entity\GetQuery;
use AwdStudio\NovaPoshta\Entity\PostData;
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
class RequestFactory
{
    /** @var \AwdStudio\NovaPoshta\ConfigInterface */
    private $config;

    /** @var \AwdStudio\NovaPoshta\Method\MethodInterface */
    private $method;

    /** @var \AwdStudio\NovaPoshta\Serialization\SerializerInterface */
    private $serializer;

    /**
     * Class that implements the \AwdStudio\NovaPoshta\Http\RequestGetInterface
     *
     * @var string
     */
    private $getHttpDriver;

    /**
     * Class that implements the \AwdStudio\NovaPoshta\Http\RequestPostInterface
     *
     * @var string
     */
    private $postHttpDriver;

    /**
     * RequestFactory constructor.
     *
     * @param string $getHttpDriver Class that implements the \AwdStudio\NovaPoshta\Http\RequestGetInterface
     * @param string $postHttpDriver Class that implements the \AwdStudio\NovaPoshta\Http\RequestPostInterface
     */
    public function __construct(?string $getHttpDriver = null, ?string $postHttpDriver = null)
    {
        $this->setGetHttpDriver($getHttpDriver);
        $this->setPostHttpDriver($postHttpDriver);
    }

    /**
     * Set the config.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface|null $config
     *
     * @return RequestFactory
     */
    public function setConfig(?ConfigInterface $config): RequestFactory
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Set the method.
     *
     * @param \AwdStudio\NovaPoshta\Method\MethodInterface|null $method
     *
     * @return RequestFactory
     */
    public function setMethod(?MethodInterface $method): RequestFactory
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set a serializer.
     *
     * @param \AwdStudio\NovaPoshta\Serialization\SerializerInterface|null $serializer
     *
     * @return RequestFactory
     */
    public function setSerializer(?SerializerInterface $serializer): RequestFactory
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * Set a GET http driver.
     *
     * @param string|null $httpDriver
     *
     * @return RequestFactory
     */
    public function setGetHttpDriver(?string $httpDriver = null): RequestFactory
    {
        $this->getHttpDriver = $httpDriver ?? CurlRequestGet::class;

        return $this;
    }

    /**
     * Set a POST http driver.
     *
     * @param string|null $httpDriver
     *
     * @return RequestFactory
     */
    public function setPostHttpDriver(?string $httpDriver = null): RequestFactory
    {
        $this->postHttpDriver = $httpDriver ?? CurlRequestPost::class;

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
     * Build the request.
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function build(): RequestGetInterface
    {
        if ($this->method instanceof MethodGetInterface) {
            return $this->buildGetRequest();
        }

        if ($this->method instanceof MethodPostInterface) {
            return $this->buildPostRequest();
        }

        throw new RequestException('Unknown method type');
    }

    /**
     * Build get request.
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    protected function buildGetRequest(): RequestGetInterface
    {
        $this->throwRequestException(!$this->config instanceof ConfigInterface, 'No configuration defined!');
        $this->throwRequestException(!$this->method instanceof MethodGetInterface, 'No API method defined!');

        $query = new GetQuery($this->method);
        $url = $this->config->getApiEntry() . $query->buildQuery();

        /** @var \AwdStudio\NovaPoshta\Http\RequestGetInterface $request */
        $request = new $this->getHttpDriver();
        $request->setUrl($url);

        return $request;
    }

    /**
     * Build post request.
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestPostInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    protected function buildPostRequest(): RequestPostInterface
    {
        $this->throwRequestException(!$this->config instanceof ConfigInterface, 'No configuration defined!');
        $this->throwRequestException(!$this->method instanceof MethodPostInterface, 'No API method defined!');
        $this->throwRequestException(!$this->serializer instanceof SerializerInterface, 'No serializer defined!');

        $url = $this->config->getApiEntry() . $this->serializer::format() . '/';

        $postData = new PostData();
        $postData->setModelName($this->method->getModelName());
        $postData->setCalledMethod($this->method->getCalledMethod());
        $postData->setMethodProperties($this->method->getMethodProperties());
        $postData->setApiKey($this->config->getApiKey());

        $body = $this->serializer->serialize($postData->getPostData());

        /** @var \AwdStudio\NovaPoshta\Http\RequestPostInterface $request */
        $request = new $this->postHttpDriver();
        $request->setBody($body);
        $request->setUrl($url);
        $request->setHeaders($this->serializer::headers());

        return $request;
    }

    /**
     * Get request factory.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface $config
     * @param \AwdStudio\NovaPoshta\Method\MethodGetInterface $method
     * @param \AwdStudio\NovaPoshta\Http\RequestGetInterface $httpDriver
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public static function createGetRequest(
        ConfigInterface $config,
        MethodGetInterface $method,
        ?RequestGetInterface $httpDriver = null
    ): RequestGetInterface {
        $factory = new self();
        $factory
            ->setConfig($config)
            ->setMethod($method)
            ->setGetHttpDriver($httpDriver);

        return $factory->buildGetRequest();
    }

    /**
     * POST request factory.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface $config
     * @param \AwdStudio\NovaPoshta\Method\MethodPostInterface $method
     * @param \AwdStudio\NovaPoshta\Serialization\SerializerInterface $serializer
     * @param \AwdStudio\NovaPoshta\Http\RequestPostInterface $httpDriver
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestPostInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public static function createPostRequest(
        ConfigInterface $config,
        MethodPostInterface $method,
        SerializerInterface $serializer,
        ?RequestPostInterface $httpDriver = null
    ): RequestPostInterface {
        $factory = new self();
        $factory
            ->setConfig($config)
            ->setMethod($method)
            ->setSerializer($serializer)
            ->setPostHttpDriver($httpDriver);

        return $factory->buildPostRequest();
    }
}
