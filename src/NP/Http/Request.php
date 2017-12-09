<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author   Anton Karpov <awd.com.ua@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/awd-studio/novaposhta
 */

namespace NP\Http;

use NP\Model\Model;
use NP\NP;


/**
 * Class Request
 * @package NP\Http
 */
class Request
{

    /**
     * @var object Current data to send.
     */
    private $body;

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
        $data['apiKey'] = $np::getKey();
        $data['modelName'] = $modelName;
        $data['calledMethod'] = $calledMethod;
        $data['methodProperties'] = (object) $np->getModel()->getMethodProperties();

        $this->uri = $np::NP_API_HOST;
        $this->body = $this->buildData($data);

        return $this;
    }


    /**
     * Data builder.
     *
     * @param mixed $data
     * @return object
     */
    private function buildData($data)
    {
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
}
