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

use NP\Model\AdditionalService;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class AdditionalServiceTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\AdditionalService
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new AdditionalService();
    }


    /**
     * @covers \NP\Model\AdditionalService::saveAction
     */
    public function testSaveAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->saveAction());
    }


    /**
     * @covers \NP\Model\AdditionalService::deleteAction
     */
    public function testDeleteAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteAction());
    }


    /**
     * @covers \NP\Model\AdditionalService::checkPossibilityCreateReturnAction
     */
    public function testCheckPossibilityCreateReturnAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->checkPossibilityCreateReturnAction());
    }


    /**
     * @covers \NP\Model\AdditionalService::getReturnReasonsAction
     */
    public function testGetReturnReasonsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getReturnReasonsAction());
    }


    /**
     * @covers \NP\Model\AdditionalService::getReturnReasonsSubtypesAction
     */
    public function testGetReturnReasonsSubtypesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getReturnReasonsSubtypesAction());
    }


    /**
     * @covers \NP\Model\AdditionalService::getReturnOrdersListAction
     */
    public function testGetReturnOrdersListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getReturnOrdersListAction());
    }

}
