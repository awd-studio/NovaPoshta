<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Exception;

use NP\Exception\ErrorException;
use PHPUnit\Framework\TestCase;

class ErrorExceptionTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Exception\ErrorException
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new ErrorException('Test Error Message');
    }


    /**
     * @covers \NP\Exception\ErrorException::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(ErrorException::class, $this->instance);
    }


    /**
     * @covers \NP\Exception\ErrorException::toJson
     */
    public function testToJson()
    {
        $this->assertJson($this->instance->toJson());
    }

}
