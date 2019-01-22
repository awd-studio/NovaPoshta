<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Method\Orders;

use AwdStudio\NovaPoshta\Method\Orders\PrintDocument;
use AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface;
use PHPUnit\Framework\TestCase;

class PrintDocumentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var PrintDocument
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new PrintDocument();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Orders\PrintDocument::__construct
     */
    public function test__construct()
    {
        $instance = new PrintDocument();

        $this->assertInstanceOf(PrintDocumentInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Orders\PrintDocument::setOrders
     */
    public function testSetOrders()
    {
        $instance = $this->instance->setOrders([]);

        $this->assertInstanceOf(PrintDocumentInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Orders\PrintDocument::setOrder
     */
    public function testSetOrder()
    {
        $instance = $this->instance->setOrder('test');

        $this->assertInstanceOf(PrintDocumentInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Orders\PrintDocument::setType
     */
    public function testSetType()
    {
        $instance = $this->instance->setType('pdf');

        $this->assertInstanceOf(PrintDocumentInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Orders\PrintDocument::getCalledMethod
     */
    public function testGetCalledMethod()
    {
        $data = $this->instance->getCalledMethod();

        $this->assertEquals('printDocument', $data);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Orders\PrintDocument::getQueryParameters
     */
    public function testGetQueryParameters()
    {
        $this->instance->setOrder('order1');
        $this->instance->setType('html');
        $data = $this->instance->getQueryParameters();

        $this->assertIsArray($data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('orders', $data);
        $this->assertEquals('html', $data['type']);
        $this->assertIsArray($data['orders']);
        $this->assertTrue(in_array('order1', $data['orders']));
    }

}
