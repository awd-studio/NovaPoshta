<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Method\TrackingDocument;

use AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocument;
use AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocumentsInterface;
use AwdStudio\NovaPoshta\Test\Stubs\Entity\StubDocumentNumber;
use PHPUnit\Framework\TestCase;

class GetStatusDocumentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var GetStatusDocument
     */
    private $instance;

    /** @var \AwdStudio\NovaPoshta\Entity\DocumentNumberInterface */
    private $documentNumber;

    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new GetStatusDocument();
        $this->documentNumber = new StubDocumentNumber();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocument::setDocuments
     */
    public function testSetDocuments()
    {
        $documents = [$this->documentNumber];
        $instance = $this->instance->setDocuments($documents);

        $this->assertInstanceOf(GetStatusDocumentsInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocument::getModelName
     */
    public function testGetModelName()
    {
        $method = $this->instance->getModelName();

        $this->assertEquals('TrackingDocument', $method);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocument::getCalledMethod
     */
    public function testGetCalledMethod()
    {
        $data = $this->instance->getCalledMethod();

        $this->assertEquals('getStatusDocuments', $data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocument::getMethodProperties
     */
    public function testGetMethodProperties()
    {

        $documents = [$this->documentNumber];
        $this->instance->setDocuments($documents);
        $properties = $this->instance->getMethodProperties();

        $this->assertIsArray($properties);
        $this->assertArrayHasKey('Documents', $properties);
    }

}
