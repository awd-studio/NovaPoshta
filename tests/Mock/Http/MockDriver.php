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

namespace NP\Mock\Http;

use NP\Http\DriverInterface;
use NP\Http\Request;
use NP\Http\Response;
use NP\Exception\ErrorException;


/**
 * MockDriver - testing HTTP driver.
 * @package NP\Mock\Http
 */
class MockDriver implements DriverInterface
{

    /**
     * @var string Stub JSON response.
     */
    private $response;


    /**
     * MockDriver constructor.
     *
     * @param string $response Name of Response JSON testing file
     *                         (e.g. "failed" or success).
     *
     * @throws \NP\Exception\ErrorException
     */
    public function __construct(string $response = 'success')
    {
        $file = realpath(dirname(__FILE__) . "/../../assets/json/response/{$response}.json");

        if (is_readable($file)) {
            $this->response = file_get_contents($file);
        } else {
            throw new ErrorException("File \"{$response}.json\" not exists or not readable!");
        }
    }


    /**
     * Send HTTP request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function send(Request $request): Response
    {
        return new Response($this->response);
    }
}
