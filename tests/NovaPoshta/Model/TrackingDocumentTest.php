<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Model;

use AwdStudio\NovaPoshta\Model\TrackingDocument;
use PHPUnit\Framework\TestCase;

class TrackingDocumentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var TrackingDocument
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new TrackingDocument();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Model\TrackingDocument::getModelName
     */
    public function testGetModelName()
    {
        $method = $this->instance->getModelName();

        $this->assertEquals('TrackingDocument', $method);
    }

}
