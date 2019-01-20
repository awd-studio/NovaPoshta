<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Entity;

use AwdStudio\NovaPoshta\Entity\PostData;
use AwdStudio\NovaPoshta\Entity\PostDataInterface;
use AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodPost;
use AwdStudio\NovaPoshta\Test\Stubs\StubConfig;
use PHPUnit\Framework\TestCase;

class PostDataTest extends TestCase
{

    /**
     * Instance.
     *
     * @var PostData
     */
    private $instance;

    /** @var \AwdStudio\NovaPoshta\Method\MethodPostInterface */
    private $stubMethod;

    /** @var \AwdStudio\NovaPoshta\ConfigInterface */
    private $config;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new PostData();
        $this->stubMethod = new StubMethodPost();
        $this->config = new StubConfig();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostData::setModelName
     */
    public function testSetModelName()
    {
        $instance = $this->instance->setModelName($this->stubMethod->getModelName());

        $this->assertInstanceOf(PostDataInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostData::setCalledMethod
     */
    public function testSetCalledMethod()
    {
        $instance = $this->instance->setCalledMethod($this->stubMethod->getCalledMethod());

        $this->assertInstanceOf(PostDataInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostData::setMethodProperties
     */
    public function testSetMethodProperties()
    {
        $instance = $this->instance->setMethodProperties($this->stubMethod->getMethodProperties());

        $this->assertInstanceOf(PostDataInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostData::setApiKey
     */
    public function testSetApiKey()
    {
        $instance = $this->instance->setApiKey($this->config->getApiKey());

        $this->assertInstanceOf(PostDataInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostData::getPostData
     * @throws \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     */
    public function testGetPostData()
    {
        $this->instance->setModelName($this->stubMethod->getModelName());
        $this->instance->setCalledMethod($this->stubMethod->getCalledMethod());
        $this->instance->setMethodProperties($this->stubMethod->getMethodProperties());
        $this->instance->setApiKey($this->config->getApiKey());

        $data = $this->instance->getPostData();

        $this->assertIsArray($data);

        $this->assertArrayHasKey('modelName', $data);
        $this->assertEquals($data['modelName'], $this->stubMethod->getModelName());

        $this->assertArrayHasKey('calledMethod', $data);
        $this->assertEquals($data['calledMethod'], $this->stubMethod->getCalledMethod());

        $this->assertArrayHasKey('methodProperties', $data);
        $this->assertEquals($data['methodProperties'], $this->stubMethod->getMethodProperties());

        $this->assertArrayHasKey('apiKey', $data);
        $this->assertEquals($data['apiKey'], $this->config->getApiKey());
    }

    /**
     * Data provider to test exception without required properties.
     *
     * @return array
     */
    public function getPostDataExceptionDataProvider(): array
    {
        /** @var PostDataInterface $withoutModelName */
        $withoutModelName = new PostData();
        $withoutModelName
            ->setCalledMethod((new StubMethodPost())->getCalledMethod())
            ->setMethodProperties((new StubMethodPost())->getMethodProperties())
            ->setApiKey((new StubConfig())->getApiKey());

        /** @var PostDataInterface $withoutCalledMethod */
        $withoutCalledMethod = new PostData();
        $withoutCalledMethod
            ->setModelName((new StubMethodPost())->getModelName())
            ->setMethodProperties((new StubMethodPost())->getMethodProperties())
            ->setApiKey((new StubConfig())->getApiKey());

        /** @var PostDataInterface $withoutMethodProperties */
        $withoutMethodProperties = new PostData();
        $withoutMethodProperties
            ->setModelName((new StubMethodPost())->getModelName())
            ->setCalledMethod((new StubMethodPost())->getCalledMethod())
            ->setApiKey((new StubConfig())->getApiKey());

        /** @var PostDataInterface $withoutApiKey */
        $withoutApiKey = new PostData();
        $withoutApiKey
            ->setModelName((new StubMethodPost())->getModelName())
            ->setCalledMethod((new StubMethodPost())->getCalledMethod())
            ->setMethodProperties((new StubMethodPost())->getMethodProperties());

        return [
            [$withoutModelName],
            [$withoutCalledMethod],
            [$withoutMethodProperties],
            [$withoutApiKey],
        ];
    }

    /**
     * @param \AwdStudio\NovaPoshta\Entity\PostDataInterface $instance
     * @covers       \AwdStudio\NovaPoshta\Entity\PostData::getPostData
     * @dataProvider getPostDataExceptionDataProvider
     * @expectedException \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     */
    public function testGetPostDataExceptions(PostDataInterface $instance)
    {
        $instance->getPostData();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostData::throwWrongHttpDataException
     * @expectedException \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     * @throws \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     */
    public function testThrowWrongHttpDataException()
    {
        $this->instance->throwWrongHttpDataException(false);
        $this->instance->throwWrongHttpDataException(true, 'Test message');
    }

}
