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

namespace AwdStudio\NovaPoshta\Entity;

use AwdStudio\NovaPoshta\ConfigInterface;
use AwdStudio\NovaPoshta\Exception\RequestException;
use AwdStudio\NovaPoshta\Method\MethodPostInterface;

/**
 * Factory to build PostData instances.
 *
 * @package AwdStudio\NovaPoshta\Entity
 */
final class PostDataFactory
{
    /** @var \AwdStudio\NovaPoshta\ConfigInterface */
    private $config;

    /** @var \AwdStudio\NovaPoshta\Method\MethodPostInterface */
    private $method;

    /**
     * Set the configuration.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface $config
     *
     * @return PostDataFactory
     */
    public function setConfig(ConfigInterface $config): PostDataFactory
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Set the method.
     *
     * @param \AwdStudio\NovaPoshta\Method\MethodPostInterface $method
     *
     * @return PostDataFactory
     */
    public function setMethod(MethodPostInterface $method): PostDataFactory
    {
        $this->method = $method;

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
     * Validate the data.
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    private function validate(): void
    {
        $this->throwRequestException($this->config === null, 'No configuration defined!');
        $this->throwRequestException($this->method === null, 'No API method defined!');
    }

    /**
     * Build a Post data instance.
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostData
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function build(): PostData
    {
        $this->validate();

        $postData = new PostData();
        $postData->setModelName($this->method->getModelName());
        $postData->setCalledMethod($this->method->getCalledMethod());
        $postData->setMethodProperties($this->method->getMethodProperties());
        $postData->setApiKey($this->config->getApiKey());

        return $postData;
    }

    /**
     * Create the POST data instance.
     *
     * @param \AwdStudio\NovaPoshta\ConfigInterface $config
     * @param \AwdStudio\NovaPoshta\Method\MethodPostInterface $method
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostData
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public static function create(ConfigInterface $config, MethodPostInterface $method): PostData
    {
        $postData = new self();
        $postData
            ->setConfig($config)
            ->setMethod($method);

        return $postData->build();
    }
}
