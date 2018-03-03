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

use NP\Model\Model;
use NP\Model\TrackingDocument;
use PHPUnit\Framework\TestCase;

class TrackingDocumentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\TrackingDocument
     */
    private $instance;

    /**
     * @var string
     */
    private $track;

    /**
     * @var string
     */
    private $phone;


    /**
     * Settings up.
     *
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->track = '01234567890123';
        $this->phone = '380112345678';
        $this->instance = new TrackingDocument();
    }


    /**
     * @covers \NP\Model\TrackingDocument::setDocumentsToMethodProperties
     * @covers \NP\Model\Model::getMethodProperties
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testSetDocumentsToMethodProperties()
    {
        $this->instance->setDocumentsToMethodProperties([$this->track]);

        $this->assertArrayHasKey('Documents', $this->instance->getMethodProperties());
    }


    /**
     * @covers \NP\Model\TrackingDocument::getStatusDocumentsAction
     */
    public function testGetStatusDocumentsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getStatusDocumentsAction());
    }


    /**
     * @covers \NP\Model\Model::invokeMethod
     *
     * @throws \NP\Exception\ErrorException
     */
    public function testInvokeMethod()
    {
        $this->assertInstanceOf(Model::class, (new TrackingDocument(['59000296674748'], [
            'documents' => [
                'name'           => 'Documents',
                'required'       => true,
                'callbackMethod' => 'setDocumentsToMethodProperties',
                'description'    => 'Documents mixed Available track-list',
            ],
        ]))->getStatusDocumentsAction());
    }
}
