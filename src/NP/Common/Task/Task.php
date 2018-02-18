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

use NP\Http\Request;
use NP\Http\Response;


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
     * Task constructor.
     *
     * @param Request $request Task request.
     */
    public function __construct(Request $request)
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
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }


    /**
     * Get task response.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * Execute task request.
     *
     * @return Response
     */
    public function execute(): Response
    {
        $this->response = $this->request->execute();

        return $this->response;
    }
}
