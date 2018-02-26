<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Common\Util;

use NP\Common\Util\ActionDoc;
use NP\Common\Util\NPReflectionMethod;
use NP\Mock\Model\MockModel;
use PHPUnit\Framework\TestCase;

class ActionDocTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Common\Util\ActionDoc
     */
    private $instance;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var string
     */
    protected $calledMethod;

    /**
     * @var NPReflectionMethod
     */
    protected $reflectionMethod;


    /**
     * Settings up.
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();

        $this->modelClass = MockModel::class;
        $this->calledMethod = 'mockModelMethod';
        $this->reflectionMethod = new NPReflectionMethod($this->modelClass, "{$this->calledMethod}Action");
        $this->instance = new ActionDoc($this->reflectionMethod);
    }


    /**
     * @covers \NP\Common\Util\ActionDoc::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(ActionDoc::class, $this->instance);
    }


    /**
     * @covers \NP\Common\Util\ActionDoc::getDocBlock
     */
    public function testGetDocBlock()
    {
        $this->assertNotNull($this->instance->getDocBlock());
    }


    /**
     * @covers \NP\Common\Util\ActionDoc::getAnnotation
     * @covers \NP\Common\Util\ActionDoc::parseAction
     * @covers \NP\Common\Util\ActionDoc::toActionCase
     */
    public function testGetAnnotation()
    {
        $this->assertNotNull($this->instance->getAnnotation('ActionParam'));
    }
}
