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

namespace NP\Test\Http;

use NP\Exception\ErrorException;
use NP\Http\CurlDriver;
use NP\Http\Request;
use NP\NP;
use NP\Mock\Http\MockRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class CurlDriverTest
 * @package NP\Test\Http
 */
class CurlDriverTest extends TestCase
{

    /**
     * Instance.
     *
     * @var CurlDriver
     */
    private $instance;

    /**
     * Instance.
     *
     * @var Request
     */
    private $request;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new CurlDriver();
        $this->request = new MockRequest(NP::init('', $this->instance));
    }


    /**
     * @covers \NP\Http\CurlDriver::send
     * @throws \NP\Exception\ErrorException
     */
    public function testSend()
    {
        $r = $this->instance->send($this->request);

        $this->assertFalse($r->getRaw());
    }
}
