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

use NP\Http\GuzzleDriver;
use NP\Http\Request;
use NP\NP;
use NP\Mock\Http\MockRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class GuzzleDriverTest
 * @package NP\Test\Http
 */
class GuzzleDriverTest extends TestCase
{

    /**
     * Instance.
     *
     * @var GuzzleDriver
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

        $this->instance = new GuzzleDriver();
        $this->request = new MockRequest(NP::init('', $this->instance));
    }


    /**
     * @covers \NP\Http\GuzzleDriver::send
     */
    public function testSend()
    {
        $r = $this->instance->send($this->request);

        $this->assertTrue($r->getData()->success);
    }
}
