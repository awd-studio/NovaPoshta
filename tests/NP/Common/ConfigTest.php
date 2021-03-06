<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Common;

use NP\Mock\Common\MockConfig;
use NP\Common\Config;
use NP\Exception\Error;
use NP\Http\DriverInterface;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Common\Config
     */
    private $instance;

    /**
     * @var string
     */
    private $key;


    /**
     * Settings up.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->key = 'testKey';
        $this->instance = Config::setUp($this->key);
    }


    /**
     * Settings clear.
     */
    protected function tearDown()
    {
        $this->instance = null;
    }


    /**
     * @covers \NP\Common\Config::__construct
     * @covers \NP\Common\Config::setUp
     * @covers \NP\Common\Config::setProperty
     * @covers \NP\Common\Config::setDefaults
     * @covers \NP\Common\Config::setDefaultDriver
     */
    public function testSetUp()
    {
        $this->assertInstanceOf(Config::class, $this->instance);

        $configArray = Config::setUp(['key' => $this->key]);
        $this->assertInstanceOf(Config::class, $configArray);
    }


    /**
     * @covers \NP\Common\Config::__construct
     * @covers \NP\Common\Config::setUp
     * @covers \NP\Common\Config::getErrors
     */
    public function testGetErrors()
    {
        $configFailed = Config::setUp(null);

        array_map(function ($error) {
            $this->assertInstanceOf(Error::class, $error);
        }, $configFailed->getErrors());
    }


    /**
     * @covers \NP\Common\Config::getDriver
     */
    public function testGetDriver()
    {
        $this->assertInstanceOf(DriverInterface::class, $this->instance->getDriver());
    }


    /**
     * @covers \NP\Common\Config::getKey
     */
    public function testGetKey()
    {
        $this->assertEquals($this->key, $this->instance->getKey());
    }


    /**
     * @covers \NP\Common\Config::getLanguage
     */
    public function testGetLanguage()
    {
        $this->assertRegExp('/Uk|Ru/', $this->instance->getLanguage());
    }


    /**
     * @covers \NP\Common\Config::isGuzzle
     */
    public function testIsGuzzle()
    {
        $this->assertEquals(class_exists(\GuzzleHttp\Client::class), $this->instance->isGuzzle());
    }


    /**
     * @covers \NP\Common\Config::isCurl
     */
    public function testIsCurl()
    {
        $this->assertEquals(function_exists('curl_init'), $this->instance->isCurl());
    }


    /**
     * @covers \NP\Common\Config::setUp
     * @covers \NP\Common\Config::setDefaultDriver
     * @covers \NP\Common\Config::getErrors
     */
    public function testSetDefaultDriver()
    {
        $ignoredDriverCurl = ['CurlDriver'];
        $config = new MockConfig($this->key, $ignoredDriverCurl);
        $this->assertArrayNotHasKey(0, $config->getErrors());

        $ignoredDriverGuzzle = ['GuzzleDriver'];
        $config = new MockConfig($this->key, $ignoredDriverGuzzle);
        $this->assertArrayNotHasKey(1, $config->getErrors());

        $ignoredDriverBoth = ['GuzzleDriver', 'CurlDriver'];
        $config = new MockConfig($this->key, $ignoredDriverBoth);
        $this->assertArrayNotHasKey(1, $config->getErrors());
    }
}
