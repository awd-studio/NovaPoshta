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
use NP\Model\Model;


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
     * Request constructor.
     *
     * @param Model $model Model instance.
     */
    public function __construct(Model $model)
    {
        $data = new \stdClass();
        $data->apiKey = Config::getInstance()->getKey();
        $data->modelName = $model->getModelName();
        $data->calledMethod = $model->getCalledMethod();
        $data->methodProperties = (object) $model->getMethodProperties();

        $this->body = $data;
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
        return Config::getInstance()->getDriver()->send($this);
    }
}
