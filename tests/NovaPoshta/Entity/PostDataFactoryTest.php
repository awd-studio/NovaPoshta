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
use AwdStudio\NovaPoshta\Entity\PostDataFactory;
use AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodPost;
use AwdStudio\NovaPoshta\Test\Stubs\StubConfig;
use PHPUnit\Framework\TestCase;

class PostDataFactoryTest extends TestCase
{

    /**
     * Instance.
     *
     * @var PostDataFactory
     */
    private $instance;

    /** @var \AwdStudio\NovaPoshta\Test\Stubs\StubConfig */
    private $config;

    /** @var \AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodPost */
    private $methodPost;

    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new PostDataFactory();
        $this->config = new StubConfig();
        $this->methodPost = new StubMethodPost();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostDataFactory::setConfig
     */
    public function testSetConfig()
    {
        $instance = $this->instance->setConfig($this->config);

        $this->assertInstanceOf(PostDataFactory::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostDataFactory::setMethod
     */
    public function testSetMethod()
    {
        $instance = $this->instance->setMethod($this->methodPost);

        $this->assertInstanceOf(PostDataFactory::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostDataFactory::validate
     * @covers \AwdStudio\NovaPoshta\Entity\PostDataFactory::build
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuild()
    {
        $this->instance->setConfig($this->config);
        $this->instance->setMethod($this->methodPost);

        $instance = $this->instance->build();

        $this->assertInstanceOf(PostData::class, $instance);
    }

    /**
     * Data provider to test validation during the build.
     *
     * @return array
     */
    public function buildDataProvider()
    {
        $withoutConfig = new PostDataFactory();
        $withoutConfig->setMethod(new StubMethodPost());

        $withoutMethod = new PostDataFactory();
        $withoutMethod->setConfig(new StubConfig());

        return [[$withoutConfig], [$withoutMethod]];
    }

    /**
     * @dataProvider buildDataProvider
     * @covers       \AwdStudio\NovaPoshta\Entity\PostDataFactory::validate
     * @covers       \AwdStudio\NovaPoshta\Entity\PostDataFactory::build
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     *
     * @param \AwdStudio\NovaPoshta\Entity\PostDataFactory $instance
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testBuildInvalid(PostDataFactory $instance)
    {
        $instance->build();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostDataFactory::throwRequestException
     * @expectedException \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testThrowRequestException()
    {
        $this->instance->throwRequestException(false);
        $this->instance->throwRequestException(true, 'Test exception');
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\PostDataFactory::create
     *
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function testCreate()
    {
        $instance = PostDataFactory::create($this->config, $this->methodPost);

        $this->assertInstanceOf(PostData::class, $instance);
    }

}
