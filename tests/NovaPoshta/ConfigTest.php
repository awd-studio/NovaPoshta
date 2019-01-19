<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test;

use AwdStudio\NovaPoshta\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    /** @var string */
    private $apiKey = 'test-api-key';

    /**
     * Instance.
     *
     * @var Config
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = Config::create($this->apiKey);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Config::create
     * @covers \AwdStudio\NovaPoshta\Config::__construct
     */
    public function test__construct()
    {
        $instance = Config::create($this->apiKey);

        $this->assertInstanceOf(Config::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Config::getApiKey
     */
    public function testGetApiKey()
    {
        $instance = Config::create($this->apiKey);

        $this->assertEquals($this->apiKey, $instance->getApiKey());
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Config::apiKeyIsValid
     * @covers \AwdStudio\NovaPoshta\Config::validateApiKey
     * @expectedException \AwdStudio\NovaPoshta\Exception\NoApiKeyException
     */
    public function testValidateApiKey()
    {
        $this->instance->validateApiKey($this->instance->apiKeyIsValid());

        $instance = Config::create('');
        $instance->validateApiKey($instance->apiKeyIsValid());
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Config::getApiEntry
     */
    public function testGetApiEntry()
    {
        $this->assertIsString($this->instance->getApiEntry());
        $this->assertNotFalse(filter_var($this->instance->getApiEntry(), FILTER_VALIDATE_URL));
    }

}
