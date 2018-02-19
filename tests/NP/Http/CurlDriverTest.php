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

use NP\Http\CurlDriver;
use NP\Http\Request;
use NP\Model\Model;
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

        $model = new Model();

        $this->instance = new CurlDriver();
        $this->request = new MockRequest($model);
    }


    /**
     * @covers \NP\Http\CurlDriver::send
     * @covers \NP\Common\Config::getKey
     */
    public function testSend()
    {
        $r = $this->instance->send($this->request);

        $this->assertFalse($r->getRaw());
    }
}
