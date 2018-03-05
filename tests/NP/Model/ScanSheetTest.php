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

use NP\Model\ScanSheet;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class ScanSheetTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\ScanSheet
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new ScanSheet();
    }


    /**
     * @covers \NP\Model\ScanSheet::insertDocumentsAction
     */
    public function testInsertDocumentsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->insertDocumentsAction());
    }


    /**
     * @covers \NP\Model\ScanSheet::getScanSheetAction
     */
    public function testGetScanSheetAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getScanSheetAction());
    }


    /**
     * @covers \NP\Model\ScanSheet::getScanSheetListAction
     */
    public function testGetScanSheetListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getScanSheetListAction());
    }


    /**
     * @covers \NP\Model\ScanSheet::deleteScanSheetAction
     */
    public function testDeleteScanSheetAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteScanSheetAction());
    }


    /**
     * @covers \NP\Model\ScanSheet::removeDocumentsAction
     */
    public function testRemoveDocumentsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->removeDocumentsAction());
    }

}
