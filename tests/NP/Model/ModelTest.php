<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Model;

use NP\Exception\ErrorException;
use NP\Mock\Model\MockModel;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\Model
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Model();
    }


    /**
     * @covers \NP\Model\Model::__construct
     * @covers \NP\Model\Model::setMethodProperty
     * @covers \NP\Model\Model::setMethodParams
     * @covers \NP\Model\Model::processModel
     * @covers \NP\Model\Model::invokeMethod
     * @covers \NP\Model\Model::checkRequiredProperties
     *
     * @throws \NP\Exception\ErrorException
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Model::class, $this->instance);
        $this->assertInstanceOf(Model::class, new Model([], [['name' => 'test']]));

        $this->expectException(ErrorException::class);
        $this->assertInstanceOf(Model::class, new Model([], [['callbackMethod' => 'undefined']]));
    }


    /**
     * @covers \NP\Model\Model::setMethodProperty
     * @covers \NP\Model\Model::getMethodProperty
     */
    public function testSetGetMethodProperty()
    {
        $unavailablePropName = 'unavailable';
        $availablePropName = 'available';
        $availablePropData = 42;

        $this->instance->setMethodProperty($availablePropName, $availablePropData);
        $this->assertEquals($availablePropData, $this->instance->getMethodProperty($availablePropName));
        $this->assertNull($this->instance->getMethodProperty($unavailablePropName));
    }


    /**
     * @covers \NP\Model\Model::getMethodProperties
     */
    public function testGetMethodProperties()
    {
        $this->assertNotNull($this->instance->getMethodProperties());
    }


    /**
     * @covers \NP\Model\Model::checkRequiredProperties
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testCheckRequiredProperties()
    {
        $this->assertInstanceOf(Model::class, new Model(['undefined' => 42], [
            'undefined' => [
                'name'     => 'undefined',
                'required' => 'true',
            ],
        ]));

        $this->expectException(ErrorException::class);
        (new MockModel([], ['undefined' => [
            'name' => "MockRequiredParam",
            'required' => true,
            'description' => "Mock parameter for testing"
        ]]))->mockModelMethodAction();
    }
}
