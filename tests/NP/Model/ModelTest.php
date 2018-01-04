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

use PHPUnit\Framework\TestCase;
use NP\Exception\ErrorException;
use NP\Model\Model;

/**
 * Class ModelTest
 * @package NP\Test\Model
 */
class ModelTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Model
     */
    private $instance;

    /**
     * @var string
     */
    private $modelName = 'TestModel';

    /**
     * @var string
     */
    private $calledMethod = 'testCalledMethod';

    /**
     * @var array
     */
    private $data = [];


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Model($this->data);
    }


    /**
     * @covers \NP\Model\Model::__construct
     * @covers \NP\Model\Model::setMethodProperties
     */
    public function testModel()
    {
        $this->assertInstanceOf(Model::class, $this->instance);
    }


    /**
     * @covers \NP\Model\Model::setModelName
     * @covers \NP\Model\Model::getModelName
     */
    public function testSetGetModelName()
    {
        $this->instance->setModelName($this->modelName);
        $this->assertEquals($this->modelName, $this->instance->getModelName());
    }


    /**
     * @covers \NP\Model\Model::setCalledMethod
     * @covers \NP\Model\Model::getCalledMethod
     */
    public function testSetGetCalledMethod()
    {
        $this->instance->setCalledMethod($this->calledMethod);
        $this->assertEquals($this->calledMethod, $this->instance->getCalledMethod());
    }


    /**
     * @covers \NP\Model\Model::setMethodProperties
     * @covers \NP\Model\Model::getMethodProperties
     */
    public function testSetGetMethodProperties()
    {
        $this->instance->setMethodProperties($this->data);
        $this->assertEquals($this->data, $this->instance->getMethodProperties());
    }


    /**
     * @covers \NP\Model\Model::setMethodProperty
     */
    public function testSetMethodProperty()
    {
        $this->instance->setMethodProperty($prop = 'testProperty', $val = 'testValue');
        $this->assertEquals([$prop => $val], $this->instance->getMethodProperties());
    }


    /**
     * @covers \NP\Model\Model::getRequiredProperties
     * @throws \NP\Exception\ErrorException
     */
    public function testGetRequiredProperties()
    {
        $this->expectException(ErrorException::class);
        $this->instance->getRequiredProperties(['noneExixtsProperty']);
    }
}
