<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Http;

use AwdStudio\NovaPoshta\Http\CurlRequestGet;
use AwdStudio\NovaPoshta\Http\RequestGetInterface;
use AwdStudio\NovaPoshta\Test\Stubs\Http\StubCurlRequestGet;
use PHPUnit\Framework\TestCase;

class CurlRequestGetTest extends TestCase
{
    /** @var string */
    const TEST_EXCEPTION_MESSAGE = 'Test exception message';

    /**
     * Instance.
     *
     * @var CurlRequestGet
     */
    private $instance;


    /**
     * Settings up.
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new CurlRequestGet();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::__construct
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::tryCurl
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::curlInit
     */
    public function test__construct()
    {
        $this->assertInstanceOf(CurlRequestGet::class, $this->instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::throwRequestException
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     * @expectedExceptionMessage \AwdStudio\NovaPoshta\Test\Stubs\Http\StubCurlRequestGet::TEST_EXCEPTION_MESSAGE
     */
    public function testThrowRequestException()
    {
        $this->instance->throwRequestException(true, StubCurlRequestGet::TEST_EXCEPTION_MESSAGE);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::setUrl
     */
    public function testSetUrl()
    {
        $instance = $this->instance->setUrl(StubCurlRequestGet::TEST_URL);

        $this->assertInstanceOf(RequestGetInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::setHeaders
     */
    public function testSetHeaders()
    {
        $instance = $this->instance->setHeaders(StubCurlRequestGet::TEST_HEADERS);

        $this->assertInstanceOf(RequestGetInterface::class, $instance);
    }

    /**
     * @return array
     */
    public function validateRequestDataProvider()
    {
        return [
            ['not a url'],
            [''],
        ];
    }

    /**
     * @param string $url
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::validateRequest
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     * @dataProvider validateRequestDataProvider
     */
    public function testValidateRequestInvalidUrl($url)
    {
        $this->instance->setUrl($url);
        $this->instance->validateRequest();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::curlInit
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testCurlInitException()
    {
        $this->instance->curlInit();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::curlInit
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testCurlInit()
    {
        $this->instance->setUrl(StubCurlRequestGet::TEST_URL);
        $data = $this->instance->curlInit();

        $this->assertNotNull($data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::validateRequest
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::handleRequest
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::execute
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testExecute()
    {
        $this->instance->setUrl(StubCurlRequestGet::TEST_URL);
        $data = $this->instance->execute();

        $this->assertIsString($data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestGet::checkErrors
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testCheckErrors()
    {
        $this->instance->checkErrors(0, 'Test message');
        $this->instance->checkErrors(1, 'Test message');
    }

}
