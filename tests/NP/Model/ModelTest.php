<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode

namespace NP\Test\Model;

use NP\Exception\Errors;
use PHPUnit\Framework\TestCase;
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
     * @var Errors
     */
    private $errors;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->errors = new Errors();

        $this->instance = new Model($this->data, [
            'modelName'    => $this->modelName,
            'calledMethod' => $this->calledMethod,
        ], [
            'testParam' => [],
        ], $this->errors);
    }


    /**
     * @covers \NP\Model\Model::__construct
     * @covers \NP\Model\Model::setActionProperties
     * @covers \NP\Model\Model::setMethodProperties
     * @covers \NP\Model\Model::setMethodParams
     * @covers \NP\Model\Model::invokeMethod
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
     * @covers \NP\Model\Model::checkRequiredProperties
     * @covers \NP\Model\Model::getError
     */
    public function testGetRequiredProperties()
    {
        $newInstance = new Model($this->data, [
            'modelName'    => $this->modelName,
            'calledMethod' => $this->calledMethod,
        ], [
            'testParam' => [
                'required' => true,
            ],
        ], $this->errors);

        $this->assertTrue($newInstance->getError()->getStatus());
        $this->assertInstanceOf(Errors::class, $newInstance->getError());
    }
}
