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

use NP\Common\Config;
use NP\Mock\Model\MockModel;
use NP\Model\Model;
use NP\Model\ModelBuilder;
use NP\Model\ModelBuilderInterface;
use PHPUnit\Framework\TestCase;

class ModelBuilderTest extends TestCase
{

    /**
     * @var string
     */
    private $key;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var string Test called method
     */
    private $calledMethod;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var string Test model name
     */
    private $modelName;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->key = 'testKey';
        $this->calledMethod = 'mockModelMethod';
        $this->modelName = 'MockModel';
        $this->model = new MockModel();
        $this->config = Config::setUp($this->key);
    }


    /**
     * @covers \NP\Model\ModelBuilder::build
     */
    public function testBuild()
    {
        $this->assertInstanceOf(
            ModelBuilderInterface::class,
            ModelBuilder::build($this->config, $this->model, $this->calledMethod)
        );
    }


    /**
     * @covers \NP\Model\ModelBuilder::build
     * @covers \NP\Model\ModelBuilder::hasError
     */
    public function testHasError()
    {
        // ToDo: Realize;
        // $this->assertFalse(ModelBuilder::build($this->config, $this->modelName, $this->calledMethod)->hasError());
        $this->assertTrue(ModelBuilder::build($this->config, $this->modelName, 'undefined')->hasError());
        $this->assertTrue(ModelBuilder::build($this->config, null, $this->calledMethod)->hasError());
        $this->assertTrue(ModelBuilder::build(Config::setUp(null), $this->modelName, $this->calledMethod)->hasError());
    }


    /**
     * @covers \NP\Model\ModelBuilder::getBody
     */
    public function testGetBody()
    {
        $array = ModelBuilder::build($this->config, $this->model, $this->calledMethod)->getBody();

        $this->assertArrayHasKey('apiKey', $array);
        $this->assertArrayHasKey('modelName', $array);
        $this->assertArrayHasKey('calledMethod', $array);
        $this->assertArrayHasKey('methodProperties', $array);
    }
}
