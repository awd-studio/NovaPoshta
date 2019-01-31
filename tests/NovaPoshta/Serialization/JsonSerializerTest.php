<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/NovaPoshta
 */

namespace AwdStudio\NovaPoshta\Test\Serialization;

use AwdStudio\NovaPoshta\Serialization\JsonSerializer;
use PHPUnit\Framework\TestCase;

class JsonSerializerTest extends TestCase
{

    /**
     * Instance.
     *
     * @var JsonSerializer
     */
    private $instance;

    /** @var object */
    private $data;

    /** @var object */
    private $jsonHeaders = ['Content-Type: application/json'];

    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new JsonSerializer();

        $this->data = new \stdClass();
        $this->data->testValue1 = 'testValue1';
        $this->data->testValue2 = 'testValue2';
        $this->data->testValue3 = 'testValue3';
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::headers
     */
    public function testHeaders()
    {
        $this->assertEquals($this->jsonHeaders, $this->instance::headers());
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::format
     */
    public function testFormat()
    {
        $this->assertEquals('json', $this->instance::format());
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::serialize
     */
    public function testSerialize()
    {
        $data = $this->instance->serialize($this->data);

        $this->assertJson($data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::serializeHandler
     */
    public function testSerializeHandler()
    {
        $data = $this->instance->serializeHandler(true);

        $this->assertJson($data);
        $this->assertSame('true', $data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::serializeHandler
     * @expectedException \AwdStudio\NovaPoshta\Exception\JsonException
     */
    public function testSerializeHandlerException()
    {
        $this->instance->serializeHandler("\x99");
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::deserializeHandler
     */
    public function testDeserializeHandler()
    {
        $data = $this->instance->deserializeHandler('true');

        $this->assertTrue($data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::deserializeHandler
     * @expectedException \AwdStudio\NovaPoshta\Exception\JsonException
     */
    public function testDeserializeHandlerException()
    {
        $this->instance->deserializeHandler('{[}');
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Serialization\JsonSerializer::deserialize
     */
    public function testDeserialize()
    {
        $json = json_encode($this->data);

        $result = $this->instance->deserialize($json);

        $this->assertIsObject($result);
        foreach ($this->data as $property => $value) {
            $this->assertObjectHasAttribute($property, $result);
            $this->assertEquals($this->data->{$property}, $result->{$property});
        }
    }

}
