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

use NP\NP;
use NP\Mock\Http\MockDriver;
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
     * @var NP
     */
    private $np;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new TrackingDocument($this->data);
        $this->instance->setModelName($this->modelName);
        $this->instance->setCalledMethod($this->calledMethod);
        $this->np = NP::init('key', new MockDriver());
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
     * @covers \NP\NP::with
     * @covers \NP\NP::send
     * @covers \NP\NP::sendWith
     * @covers \NP\Model\Model::getRequiredProperties
     * @covers \NP\Http\Request::buildData
     * @covers \NP\Model\TrackingDocument::getStatusDocumentsAction
     * @throws \NP\Exception\ErrorException
     */
    public function testGetStatusDocumentsActionSuccess()
    {
        $this->np->with('TrackingDocument', 'getStatusDocuments', $this->trackList);
        $r = $this->np->send();
        $this->assertJson($r->getRaw());

        $r = $this->np->sendWith('TrackingDocument', 'getStatusDocuments', $this->trackList);

        $this->assertJson($r->getRaw());

        $this->instance->setMethodProperties($this->trackList);
        $getStatusDocuments = $this->instance->getStatusDocumentsAction();

        $this->assertInstanceOf(Model::class, $getStatusDocuments);
        $this->assertInstanceOf(TrackingDocumentsInterface::class, $getStatusDocuments);
    }


    /**
     * @covers \NP\NP::with
     * @covers \NP\NP::send
     * @covers \NP\Model\TrackingDocument::getStatusDocumentsAction
     * @throws \NP\Exception\ErrorException
     */
    public function testGetStatusDocumentsActionFailed()
    {
        $failedNp = NP::init('key', new MockDriver('failed'));
        $failedNp->with('TrackingDocuments', 'getStatusDocuments', $this->trackList);
        $r = $failedNp->send();

        $this->assertJson($r->getRaw());

        $this->expectException(ErrorException::class);
        $this->instance->getStatusDocumentsAction();
    }
}
