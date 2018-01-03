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
     * @var string - API URI.
     */
    private $uri;


    /**
     * Request constructor.
     *
     * @param NP     $np NovaPoshta instance.
     * @param string $modelName
     * @param string $calledMethod
     *
     * @return self
     */
    public function __construct(NP $np, $modelName, $calledMethod)
    {
        $this->uri = $np::NP_API_HOST_JSON;
        $this->body = $this->buildData($np, $modelName, $calledMethod);

        return $this;
    }


    /**
     * Data builder.
     *
     * @param NP     $np NovaPoshta instance.
     * @param string $modelName
     * @param string $calledMethod
     *
     * @return object
     */
    private function buildData($np, $modelName, $calledMethod)
    {
        $data['apiKey'] = $np::getKey();
        $data['modelName'] = $modelName;
        $data['calledMethod'] = $calledMethod;
        $data['methodProperties'] = (object) $np->getModel()->getMethodProperties();

        return (object) $data;
    }


    /**
     * Get data to send.
     *
     * @param bool $json JSON-encoded.
     * @return object
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
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }


    /**
     * Execute HTTP request.
     * @param DriverInterface $driver Current HTTP driver.
     *
     * @return Response
     */
    public function execute(DriverInterface $driver)
    {
        return $driver->send($this);
    }
}
