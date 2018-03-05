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

use NP\Model\AdditionalServiceGeneral;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class AdditionalServiceGeneralTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\AdditionalServiceGeneral
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new AdditionalServiceGeneral();
    }


    /**
     * @covers \NP\Model\AdditionalServiceGeneral::saveAction
     */
    public function testSaveAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->saveAction());
    }


    /**
     * @covers \NP\Model\AdditionalServiceGeneral::deleteAction
     */
    public function testDeleteAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteAction());
    }


    /**
     * @covers \NP\Model\AdditionalServiceGeneral::checkPossibilityForRedirectingAction
     */
    public function testCheckPossibilityForRedirectingAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->checkPossibilityForRedirectingAction());
    }


    /**
     * @covers \NP\Model\AdditionalServiceGeneral::getRedirectionOrdersListAction
     */
    public function testGetRedirectionOrdersListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getRedirectionOrdersListAction());
    }

}
