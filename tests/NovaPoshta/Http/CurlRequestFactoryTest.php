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

use AwdStudio\NovaPoshta\ConfigInterface;
use AwdStudio\NovaPoshta\Http\CurlRequestFactory;
use AwdStudio\NovaPoshta\Http\CurlRequestGet;
use AwdStudio\NovaPoshta\Http\CurlRequestPost;
use AwdStudio\NovaPoshta\Http\RequestInterface;
use AwdStudio\NovaPoshta\Http\RequestInterfacePost;
use AwdStudio\NovaPoshta\Method\MethodInterface;
use AwdStudio\NovaPoshta\Serialization\SerializerInterface;
use AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodGet;
use AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodPost;
use AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodUnknown;
use AwdStudio\NovaPoshta\Test\Stubs\Serialization\StubJsonSerializer;
use AwdStudio\NovaPoshta\Test\Stubs\StubConfig;
use PHPUnit\Framework\TestCase;

class CurlRequestFactoryTest extends TestCase
{

    /**
     * Instance.
     *
     * @var CurlRequestFactory
     */
    private $instance;

    /** @var StubConfig */
    private $config;

    /** @var StubMethodGet */
    private $methodGet;

    /** @var StubMethodPost */
    private $methodPost;

    /** @var StubMethodUnknown */
    private $methodUnknown;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new CurlRequestFactory();
        $this->config = new StubConfig();
        $this->methodGet = new StubMethodGet();
        $this->methodPost = new StubMethodPost();
        $this->methodUnknown = new StubMethodUnknown();
        $this->serializer = new StubJsonSerializer();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::throwRequestException
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     * @expectedExceptionMessage Test message
     */
    public function testThrowRequestException()
    {
        $this->instance->throwRequestException(false);
        $this->instance->throwRequestException(true, 'Test message');
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::setMethod
     */
    public function testSetMethod()
    {
        $instance = $this->instance->setMethod($this->methodPost);

        $this->assertInstanceOf(CurlRequestFactory::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::setSerializer
     */
    public function testSetSerializer()
    {
        $instance = $this->instance->setSerializer($this->serializer);

        $this->assertInstanceOf(CurlRequestFactory::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::setConfig
     */
    public function testSetConfig()
    {
        $instance = $this->instance->setConfig($this->config);

        $this->assertInstanceOf(CurlRequestFactory::class, $instance);
    }

    public function buildDataProviderInvalid()
    {
        return [
            [null, new StubMethodGet(), null],
            [new StubConfig(), null, null],
            [null, new StubMethodPost(), new StubJsonSerializer()],
            [new StubConfig(), null, new StubJsonSerializer()],
            [new StubConfig(), new StubMethodPost(), null],
        ];
    }

    /**
     * @covers       \AwdStudio\NovaPoshta\Http\CurlRequestFactory::build
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     * @dataProvider buildDataProviderInvalid
     * @param \AwdStudio\NovaPoshta\ConfigInterface|null $config
     * @param \AwdStudio\NovaPoshta\Method\MethodInterface|null $method
     * @param \AwdStudio\NovaPoshta\Serialization\SerializerInterface|null $serializer
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuildInvalid(
        ?ConfigInterface $config,
        ?MethodInterface $method,
        ?SerializerInterface $serializer
    ) {
        $this->instance->setConfig($config);
        $this->instance->setMethod($method);
        $this->instance->setSerializer($serializer);

        $this->instance->build();
    }

    public function buildDataProvider()
    {
        return [
            [new StubMethodGet(), null, CurlRequestGet::class],
            [new StubMethodPost(), new StubJsonSerializer(), CurlRequestPost::class],
        ];
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::build
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuildWrongMethod()
    {
        $this->instance->setConfig($this->config);
        $this->instance->setMethod($this->methodUnknown);

        $this->instance->build();
    }

    /**
     * @covers       \AwdStudio\NovaPoshta\Http\CurlRequestFactory::build
     * @dataProvider buildDataProvider
     * @param \AwdStudio\NovaPoshta\Method\MethodInterface $method
     * @param \AwdStudio\NovaPoshta\Serialization\SerializerInterface|null $serializer
     * @param string $type
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuild(MethodInterface $method, ?SerializerInterface $serializer, string $type)
    {
        $this->instance->setConfig(new StubConfig());
        $this->instance->setMethod($method);
        $this->instance->setSerializer($serializer);

        $data = $this->instance->build();

        $this->assertInstanceOf($type, $data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::buildPostRequest
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuildPostRequest()
    {
        $instance = CurlRequestFactory::buildPostRequest($this->config, $this->methodPost, $this->serializer);

        $this->assertInstanceOf(RequestInterfacePost::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Http\CurlRequestFactory::buildGetRequest
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuildGetRequest()
    {
        $instance = CurlRequestFactory::buildGetRequest($this->config, $this->methodGet);

        $this->assertInstanceOf(RequestInterface::class, $instance);
    }
}
