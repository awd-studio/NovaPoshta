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
use NP\Model\TrackingDocument;
use NP\Model\TrackingDocumentsInterface;

/**
 * Class TrackingDocumentTest
 * @package NP\Test\Model
 */
class TrackingDocumentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var TrackingDocument
     */
    private $instance;

    /**
     * @var string
     */
    private $modelName = 'TrackingDocument';

    /**
     * @var string
     */
    private $calledMethod = 'getStatusDocuments';

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $trackList = ['00000000000000', '00000000000001'];


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new TrackingDocument($this->data);
        $this->instance->setModelName($this->modelName);
        $this->instance->setCalledMethod($this->calledMethod);
    }


    /**
     * @covers \NP\Model\TrackingDocument::__construct
     */
    public function testTrackingDocument()
    {
        $this->assertInstanceOf(Model::class, $this->instance);
        $this->assertInstanceOf(TrackingDocumentsInterface::class, $this->instance);
    }


    /**
     * @covers \NP\Model\TrackingDocument::getStatusDocumentsAction()
     * @throws \NP\Exception\ErrorException
     */
    public function testGetStatusDocumentsActionFailed()
    {
        $this->expectException(ErrorException::class);
        $this->instance->getStatusDocumentsAction();
    }


    /**
     * @covers \NP\Model\TrackingDocument::getStatusDocumentsAction()
     * @throws \NP\Exception\ErrorException
     */
    public function testGetStatusDocumentsActionSuccess()
    {
        $this->instance->setMethodProperties($this->trackList);
        $getStatusDocuments = $this->instance->getStatusDocumentsAction();

        $this->assertInstanceOf(Model::class, $getStatusDocuments);
        $this->assertInstanceOf(TrackingDocumentsInterface::class, $getStatusDocuments);
    }
}
