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

use NP\Model\InternetDocument;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class InternetDocumentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\InternetDocument
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new InternetDocument();
    }


    /**
     * @covers \NP\Model\InternetDocument::saveAction
     */
    public function testSaveAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->saveAction());
    }


    /**
     * @covers \NP\Model\InternetDocument::updateAction
     */
    public function testUpdateAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->updateAction());
    }


    /**
     * @covers \NP\Model\InternetDocument::deleteAction
     */
    public function testDeleteAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteAction());
    }


    /**
     * @covers \NP\Model\InternetDocument::getDocumentPriceAction
     */
    public function testGetDocumentPriceAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getDocumentPriceAction());
    }


    /**
     * @covers \NP\Model\InternetDocument::getDocumentDeliveryDateAction
     */
    public function testGetDocumentDeliveryDateAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getDocumentDeliveryDateAction());
    }


    /**
     * @covers \NP\Model\InternetDocument::getDocumentListAction
     */
    public function testGetDocumentListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getDocumentListAction());
    }


    /**
     * @covers \NP\Model\InternetDocument::generateReportAction
     */
    public function testGenerateReportAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->generateReportAction());
    }

}
