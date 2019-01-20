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
class CurlRequestFactory
{
    /** @var \AwdStudio\NovaPoshta\ConfigInterface */
    private $config;

    /** @var \AwdStudio\NovaPoshta\Method\MethodInterface */
    private $method;

    /** @var \AwdStudio\NovaPoshta\Serialization\SerializerInterface */
    private $serializer;

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
     * Build the request.
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function build(): RequestInterface
    {
        $this->throwRequestException(!$this->config instanceof ConfigInterface, 'No configuration defined!');
        $this->throwRequestException(!$this->method instanceof MethodInterface, 'No API method defined!');

        if ($this->method instanceof MethodGetInterface) {
            return $this->buildGetRequest($this->config, $this->method);
        }

        if ($this->method instanceof MethodPostInterface) {
            $this->throwRequestException(!$this->serializer instanceof SerializerInterface, 'No serializer defined!');
            return self::buildPostRequest($this->config, $this->method, $this->serializer);
        }

        throw new RequestException('Unknown method type');
    }

    /**
     * Build post request.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface $config
     * @param \AwdStudio\NovaPoshta\Method\MethodPostInterface $method
     * @param \AwdStudio\NovaPoshta\Serialization\SerializerInterface $serializer
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterfacePost
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public static function buildPostRequest(
        ConfigInterface $config,
        MethodPostInterface $method,
        SerializerInterface $serializer
    ): RequestInterfacePost {
        $url = $config->getApiEntry() . $serializer::format();

        $postData = new PostData();
        $postData->setModelName($method->getModelName());
        $postData->setCalledMethod($method->getCalledMethod());
        $postData->setMethodProperties($method->getMethodProperties());
        $postData->setApiKey($config->getApiKey());

        $body = $serializer->serialize($postData->getPostData());

        $request = new CurlRequestPost();
        $request->setBody($body);
        $request->setUrl($url);
        $request->setHeaders($serializer::headers());

        return $request;
    }

    /**
     * Build get request.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface $config
     * @param \AwdStudio\NovaPoshta\Method\MethodGetInterface $method
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterface
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public static function buildGetRequest(ConfigInterface $config, MethodGetInterface $method): RequestInterface
    {
        $query = new GetQuery($method);
        $url = $config->getApiEntry() . $query->buildQuery();

        $request = new CurlRequestGet();
        $request->setUrl($url);

        return $request;
    }
}
