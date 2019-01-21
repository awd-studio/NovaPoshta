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

namespace AwdStudio\NovaPoshta\Test\Stubs\Http;

use AwdStudio\NovaPoshta\Http\RequestGetInterface;

/**
 * Stub Class GetRequest
 * @package AwdStudio\NovaPoshta\Test\Stubs\Http
 */
class StubCurlRequestGet implements RequestGetInterface
{
    /** @var string */
    const TEST_URL = 'http://testapi.novaposhta.ua/';

    /** @var array */
    const TEST_HEADERS = ['Content-Type' => 'application/json'];

    /** @var string */
    const TEST_EXCEPTION_MESSAGE = 'Test exception message';

    /** @var string */
    const TEST_RESPONSE = 'Ok';

    /** @var string */
    private $url;

    /** @var array */
    private $headers;

    /**
     * StubGetRequest constructor.
     */
    public function __construct()
    {
        $this->url = self::TEST_URL;
        $this->headers = self::TEST_HEADERS;
    }


    /**
     * Set up request with headers.
     *
     * @param array|null $headers
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     */
    public function setHeaders(?array $headers = null): RequestGetInterface
    {
        return $this;
    }

    /**
     * Set the URL address.
     *
     * @param string $url
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     */
    public function setUrl(string $url): RequestGetInterface
    {
        return $this;
    }

    /**
     * Execute the request.
     *
     * @return string
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function execute(): string
    {
        return self::TEST_RESPONSE;
    }
}
