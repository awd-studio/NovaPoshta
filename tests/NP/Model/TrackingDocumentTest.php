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
use NP\NP;
use NP\Mock\Http\MockDriver;
use PHPUnit\Framework\TestCase;
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
        $this->instance = new TrackingDocument($this->data, [], $this->errors);
        $this->instance->setModelName($this->modelName);
        $this->instance->setCalledMethod($this->calledMethod);
        $this->np = NP::init(['key' => 'newKey', 'driver' => new MockDriver()]);
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
     * @covers \NP\Model\Model::checkRequiredProperties
     * @covers \NP\Http\Request::buildData
     * @covers \NP\Model\TrackingDocument::getStatusDocumentsAction
     * @covers \NP\Model\TrackingDocument::setDocumentsToMethodProperties
     * @covers \NP\Model\Model::invokeMethod
     * @covers \NP\Util\ActionDoc::__construct
     * @covers \NP\Util\ActionDoc::getDocBlock
     * @covers \NP\Util\ActionDoc::getAnnotation
     * @covers \NP\Util\ActionDoc::parseAction
     * @covers \NP\Util\NPReflectionMethod::build
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
     * @covers \NP\Util\ActionDoc::__construct
     * @covers \NP\Util\ActionDoc::getDocBlock
     * @covers \NP\Util\ActionDoc::getAnnotation
     * @covers \NP\Util\ActionDoc::parseAction
     */
    public function testGetStatusDocumentsActionFailed()
    {
        $failedNp = NP::init(['key' => 'newKey', 'driver' => new MockDriver('failed')]);
        $failedNp->with('TrackingDocuments', 'getStatusDocuments', $this->trackList);
        $r = $failedNp->send();

        $this->assertJson($r->getRaw());
    }
}
