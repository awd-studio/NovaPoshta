<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/NovaPoshta
 */

declare(strict_types=1); // strict mode

namespace AwdStudio\NovaPoshta;

use AwdStudio\NovaPoshta\Exception\NoApiKeyException;

/**
 * Class Config.
 * Realises the configuration for the library usage with API.
 * Uses to set up the API key.
 *
 * @package AwdStudio\NovaPoshta
 */
class Config implements ConfigInterface
{
    /** @var string API entry point */
    private $apiEntry = 'https://api.novaposhta.ua/v2.0/';

    /** @var string API key */
    private $apiKey;

    /**
     * Config constructor.
     *
     * @param string $apiKey The API key.
     *
     * @link https://my.novaposhta.ua/auth#apikeys
     * @throws NoApiKeyException
     */
    private function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->validateApiKey($this->apiKeyIsValid());
    }

    /**
     * Create the config instance.
     *
     * @param string $apiKey
     *
     * @return \AwdStudio\NovaPoshta\Config
     */
    public static function create(string $apiKey): self
    {
        return new self($apiKey);
    }

    /**
     * Validate the API key.
     *
     * @return bool
     */
    public function apiKeyIsValid(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Validate current API key.
     *
     * @param bool $apiKeyIsValid
     *
     * @return void
     * @throws \AwdStudio\NovaPoshta\Exception\NoApiKeyException
     */
    public function validateApiKey(bool $apiKeyIsValid): void
    {
        if (!$apiKeyIsValid) {
            throw new NoApiKeyException('API key must be valid!');
        }
    }

    /**
     * Get entry point.
     *
     * @return string
     */
    public function getApiEntry(): string
    {
        return $this->apiEntry;
    }

    /**
     * Get current config API key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
