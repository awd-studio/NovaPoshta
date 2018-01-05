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
     * Request constructor.
     *
     * @param NP $np NovaPoshta instance.
     *
     * @return self
     */
    public function __construct(NP $np)
    {
        $this->body = $this->buildData($np);

        return $this;
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
            $data->apiKey = $np::getKey();
            $data->modelName = $np->getModel()->getModelName();
            $data->calledMethod = $np->getModel()->getCalledMethod();
            $data->methodProperties = (object) $np->getModel()->getMethodProperties();
        }

        return $data;
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
     * @param DriverInterface $driver Current HTTP driver.
     *
     * @return Response
     */
    public function execute(DriverInterface $driver): Response
    {
        return $driver->send($this);
    }
}
