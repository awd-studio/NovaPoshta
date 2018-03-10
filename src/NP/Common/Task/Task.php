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


namespace NP\Common\Task;

use NP\Common\Config;
use NP\Exception\ErrorException;
use NP\Http\Request;
use NP\Http\Response;
use NP\Http\ResponseInterface;


/**
 * Class Task
 * @package NP\Common\Task
 */
class Task implements TaskInterface
{

    /**
     * @var Request Task request.
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var Config
     */
    private $config;


    /**
     * Task constructor.
     *
     * @param Config $config NP config.
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config;
    }


    /**
     * Set request.
     *
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Get task request.
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }


    /**
     * Set response.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }


    /**
     * Get task response.
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        if (!$this->response) {
            $this->execute();
        }

        return $this->response;
    }


    /**
     * Execute task request.
     */
    public function execute()
    {
        try {
            if ($this->request) {
                $response = $this->config->getDriver()->send($this->request);
            } else {
                throw new ErrorException('No Request fined.');
            }
        } catch (ErrorException $e) {
            $response = $e->toJson();
        } finally {
            $this->response = new Response($response);
        }
    }
}
