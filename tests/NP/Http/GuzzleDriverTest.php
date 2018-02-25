<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Http;

use NP\Exception\ErrorException;
use NP\Http\GuzzleDriver;
use NP\Mock\Http\MockRequest;
use PHPUnit\Framework\TestCase;

class GuzzleDriverTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Http\GuzzleDriver
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new GuzzleDriver();
    }


    /**
     * @covers \NP\Http\GuzzleDriver::send
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testSend()
    {
        $successRequest = new MockRequest();
        $this->assertJson($this->instance->send($successRequest));

        $failedRequest = new MockRequest(false);
        $this->expectException(ErrorException::class);
        $this->instance->send($failedRequest);
    }
}
