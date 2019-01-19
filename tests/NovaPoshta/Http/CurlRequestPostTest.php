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

use AwdStudio\NovaPoshta\Http\CurlRequestPost;
use AwdStudio\NovaPoshta\Test\Stubs\Http\StubCurlRequestPost;
use PHPUnit\Framework\TestCase;

class CurlRequestPostTest extends TestCase
{
    /**
     * Instance.
     *
     * @var CurlRequestPost
     */
    private $instance;

    /**
     * Settings up.
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new CurlRequestPost();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestPost::setBody
     */
    public function testSetBody()
    {
        $data = $this->instance->setBody(StubCurlRequestPost::TEST_BODY);

        $this->assertInstanceOf(CurlRequestPost::class, $data);
    }

    /**
     * @return array
     */
    public function validateRequestDataProvider()
    {
        return [
            ['not a url', StubCurlRequestPost::TEST_BODY],
            ['', StubCurlRequestPost::TEST_BODY],
            [StubCurlRequestPost::TEST_URL, ''],
        ];
    }

    /**
     * @covers       \AwdStudio\NovaPoshta\Http\CurlRequestPost::validateRequest
     *
     * @param string $url
     * @param string $body
     *
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     * @dataProvider validateRequestDataProvider
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testValidateRequestInvalidUrl($url, $body)
    {
        $this->instance->setUrl($url);
        $this->instance->setBody($body);
        $this->instance->validateRequest();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestPost::validateRequest
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestPost::handleRequest
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testHandleRequest()
    {
        $this->instance->setUrl(StubCurlRequestPost::TEST_URL);
        $this->instance->setBody(StubCurlRequestPost::TEST_BODY);

        $data = $this->instance->execute();

        $this->assertIsString($data);
    }

}
