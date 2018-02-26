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
use NP\Exception\ErrorException;
use NP\Mock\AssetsResponse;


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
     * @var bool
     */
    private $success;


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
        $this->success = $response === 'success';
        $this->response = AssetsResponse::json();
    }


    /**
     * Send HTTP request.
     *
     * @param Request $request
     *
     * @return string
     * @throws ErrorException
     */
    public function send(Request $request): string
    {
        if ($this->success) {
            return $this->response;
        } else {
            throw new ErrorException('MockDriver Error.');
        }
    }
}
