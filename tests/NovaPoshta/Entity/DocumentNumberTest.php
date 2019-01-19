<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Entity;

use AwdStudio\NovaPoshta\Entity\DocumentNumber;
use AwdStudio\NovaPoshta\Entity\DocumentNumberInterface;
use AwdStudio\NovaPoshta\Test\Stubs\Entity\StubDocumentNumber;
use PHPUnit\Framework\TestCase;

class DocumentNumberTest extends TestCase
{

    /**
     * Instance.
     *
     * @var DocumentNumber
     */
    private $instance;

    /** @var string */
    private $testPhone;

    /** @var string */
    private $testTrack;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->testPhone = StubDocumentNumber::PHONE;
        $this->testTrack = StubDocumentNumber::TRACK;

        $this->instance = new DocumentNumber();
        $this->instance->setPhone($this->testPhone);
        $this->instance->setDocumentNumber($this->testTrack);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\DocumentNumber::setPhone
     */
    public function testSetPhone()
    {
        $instance = $this->instance->setPhone($this->testPhone);

        $this->assertInstanceOf(DocumentNumberInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\DocumentNumber::setDocumentNumber
     */
    public function testSetDocumentNumber()
    {
        $instance = $this->instance->setDocumentNumber($this->testTrack);

        $this->assertInstanceOf(DocumentNumberInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\DocumentNumber::getDocuments
     */
    public function testGetDocuments()
    {
        $documents = $this->instance->getDocuments();

        $this->assertIsArray($documents);
        $this->assertArrayHasKey('DocumentNumber', $documents);
        $this->assertArrayHasKey('Phone', $documents);
        $this->assertEquals($this->testTrack, $documents['DocumentNumber']);
        $this->assertEquals($this->testPhone, $documents['Phone']);
    }

}
