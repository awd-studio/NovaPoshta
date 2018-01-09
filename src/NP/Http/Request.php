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

use NP\Entity\Config;
use NP\Exception\Errors;
use NP\NP;


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
     * @var \stdClass
     */
    private $body;

    /**
     * @var Errors NP Errors
     */
    private static $errors;

    /**
     * @var Config NP config.
     */
    private static $config;


    /**
     * Request constructor.
     *
     * @param NP $np NovaPoshta instance.
     */
    public function __construct(NP $np)
    {
        self::$config = $np::config();
        self::$errors = &$np::$errors;
        $this->body = $this->buildData($np);
    }


    /**
     * Data builder.
     *
     * @param NP $np NovaPoshta instance.
     *
     * @return \stdClass
     */
    private function buildData(NP $np)
    {
        $data = new \stdClass();

        if ($np->getModel()) {
            $data->apiKey = $np::config()->getKey();
            $data->modelName = $np->getModel()->getModelName();
            $data->calledMethod = $np->getModel()->getCalledMethod();
            $data->methodProperties = (object) $np->getModel()->getMethodProperties();
        }

        return $data;
    }


    /**
     * Get NP Errors.
     *
     * @return Errors
     */
    public static function errors()
    {
        return self::$errors;
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
        return $json ? $this->getBodyJson() : $this->body;
    }


    /**
     * Get data to send (JSON-encoded).
     *
     * @return object
     */
    public function getBodyJson()
    {
        return json_encode($this->body);
    }


    /**
     * Get API URI.
     *
     * @param bool $json
     *
     * @return string
     */
    public function getUri(bool $json = true)
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
        return self::$config->getDriver()->send($this);
    }
}
