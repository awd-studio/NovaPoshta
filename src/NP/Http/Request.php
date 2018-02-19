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

namespace NP\Http;

use NP\Common\Config;
use NP\Model\ModelBuilderInterface;


/**
 * Class Request
 * @package NP\Http
 */
class Request
{
    /**
     * API endpoint.
     */
    const NP_API_HOST_JSON = 'https://api.novaposhta.ua/v2.0/json/';

    /**
     * @var ModelBuilderInterface
     */
    private $modelBuilder;

    /**
     * @var Config
     */
    private $config;


    /**
     * Request constructor.
     *
     * @param ModelBuilderInterface $modelBuilder
     * @param Config                $config
     */
    public function __construct(ModelBuilderInterface $modelBuilder, Config $config)
    {
        $this->modelBuilder = $modelBuilder;
        $this->config = $config;
    }


    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }


    /**
     * Get data to send.
     *
     * @param bool $json JSON-encoded.
     *
     * @return \stdClass|string
     */
    public function getBody($json = false)
    {
        return $json ? $this->getBodyJson() : $this->modelBuilder->getBody();
    }


    /**
     * Get data to send (JSON-encoded).
     *
     * @return object
     */
    public function getBodyJson()
    {
        return json_encode($this->modelBuilder->getBody());
    }


    /**
     * Get API URI.
     *
     * @return string
     */
    public function getUri()
    {
        return self::NP_API_HOST_JSON;
    }


    /**
     * Execute HTTP request.
     *
     * @return Response
     */
    public function execute(): Response
    {
        return $this->config->getDriver()->send($this);
    }
}
